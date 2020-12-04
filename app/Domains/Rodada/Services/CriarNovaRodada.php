<?php

namespace App\Domains\Rodada\Services;

use App\Domains\Evento\Evento;
use App\Domains\Evento\EventoRepository;
use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\JogoRepository;
use App\Domains\Rodada\Rodada;
use App\Domains\Rodada\RodadaRepository;
use App\Support\Service;
use App\Support\Validator;
use Exception;
use Illuminate\Support\Facades\DB;


class CriarNovaRodada extends Service
{
    /**
     * @var JogoRepository
     */
    private $jogoRepository;
    /**
     * @var EventoRepository
     */
    private $eventoRepository;
    /**
     * @var RodadaRepository
     */
    private $rodadaRepository;

    public function __construct(
        JogoRepository $jogoRepository,
        EventoRepository $eventoRepository,
        RodadaRepository $rodadaRepository
    )
    {
        $this->jogoRepository = $jogoRepository;
        $this->eventoRepository = $eventoRepository;
        $this->rodadaRepository = $rodadaRepository;
    }

    public function validate(array $data)
    {
        return (new class extends Validator {
            public function rules()
            {
                return [
                    'medidas.*.data' => ['array'],
                    'medidas.*.code' => ['string'],
                    'jogo_id' => ['int', 'required'],
                ];
            }
        })->validate($data);
    }

    /**
     * @param array $data
     * @param array|string[] $columns
     * @param array $relations
     * @return Jogo|\Illuminate\Database\Eloquent\Model|mixed|null
     * @throws \Exception
     */
    protected function perform(array $data, array $columns = ['*'], array $relations = [])
    {
        DB::beginTransaction();
        try {
            /** @var Jogo $jogo */
            $jogo = $this->jogoRepository->getById($data['jogo_id']);
            $novaRodada = $this->criarNovaRodada($jogo);
            $noticias = collect();
            $jogo->eventos->each(function (Evento $evento, $key) use ($noticias, $novaRodada) {
                if ($evento->rodadas_restantes == 1) {
                    $noticia = $this->executarEvento($evento, $novaRodada);
                    if (!is_null($noticia)) {
                        $noticias->add($noticia);
                    }
                    $this->eventoRepository->delete($evento);
                } else {
                    $evento->rodadas_restantes--;
                    $this->eventoRepository->update($evento);
                }
            });

            foreach ($data['medidas'] as $medida) {
                $noticia = $this->executarMedida($medida, $novaRodada);
                if (!is_null($noticia)) {
                    $noticias->add($noticia);
                }
            }
            $novaRodada->refresh();
            $novaRodada->gastos_governamentais += $novaRodada->gastos_governamentais_fixos;
            $novaRodada->investimentos += $novaRodada->investimentos_fixos;
            $novaRodada->noticias = $noticias->toArray();
            $novaRodada->medidas = $data['medidas'];
            $this->rodadaRepository->save($novaRodada);
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $jogo;
    }

    /**
     * Cria uma nova rodada com os valores iniciais (pode ser modificada durante o processo desse servico)
     */
    private function criarNovaRodada(Jogo $jogo) : Rodada
    {
        /** @var Rodada $ultimaRodada */
        $ultimaRodada = $jogo->rodadas->last();
        $novaRodada = new Rodada();
        $novaRodada->jogo_id = $jogo->id;
        $novaRodada->rodada = $jogo->rodadas->count();
        $novaRodada->pmgc = $ultimaRodada->pmgc;
        $novaRodada->pib_previsao_anual = $ultimaRodada->pib_previsao_anual;
        $novaRodada->populacao = $ultimaRodada->populacao;
        $novaRodada->imposto_renda = $ultimaRodada->imposto_renda;
        $novaRodada->medidas = [];
        $novaRodada->noticias = [];
        $novaRodada->investimentos_fixos = $ultimaRodada->investimentos_fixos;
        $novaRodada->gastos_governamentais_fixos = $ultimaRodada->gastos_governamentais_fixos;
        $novaRodada->transferencias = 0;
        $novaRodada->gastos_governamentais = 0;
        $novaRodada->investimentos = 0;
        $this->rodadaRepository->save($novaRodada);
        return $novaRodada;
    }

    private function executarEvento(Evento $evento, Rodada $rodada)
    {
        $rodada->refresh();
        switch ($evento->code) {
            case CalcularPrevisaoAnualPIB::CODE:
                return (new CalcularPrevisaoAnualPIB())->modificacoes($rodada, $evento->data);
            case CalcularPibAnual::CODE:
                return (new CalcularPibAnual())->modificacoes($rodada, $evento->data);
            default:
                return null;
        }
    }

    private function executarMedida(array $medida, Rodada $rodada)
    {
        $rodada->refresh();
        switch ($medida['code']) {
            //case CalcularPrevisaoAnualPIB::CODE: //caso for uma medida instantanea
            //    return (new CalcularPrevisaoAnualPIB())->modificacoes($jogo, $medida['data']);
            //case CalcularPrevisaoAnualPIB::CODE:
            //    return $this->criarEvento(
            //        $medida['data'],
            //        CalcularPrevisaoAnualPIB::RODADAS,
            //        $medida['code'],
            //        $rodada->jogo_id
            //    );
            default:
                return null;
        }
    }

    private function criarEvento(array $data, $nRodadas, $code, $jogoId)
    {
        $evento = new Evento();
        $evento->data = $data;
        $evento->rodadas_restantes = $nRodadas;
        $evento->jogo_id = $jogoId;
        $evento->code = $code;
        $this->eventoRepository->save($evento);
        return null;
    }
}