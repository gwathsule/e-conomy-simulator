<?php

namespace App\Domains\Jogo\Services;

use App\Domains\Evento\Evento;
use App\Domains\Evento\EventoRepository;
use App\Domains\Evento\Eventos\CalcularPrevisaoAnualPIB;
use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\JogoRepository;
use App\Domains\Momento\Momento;
use App\Domains\Momento\MomentoRepository;
use App\Support\Service;
use App\Support\Validator;

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
     * @var MomentoRepository
     */
    private $momentoRepository;

    public function __construct(
        JogoRepository $jogoRepository,
        EventoRepository $eventoRepository,
        MomentoRepository $momentoRepository
    )
    {
        $this->jogoRepository = $jogoRepository;
        $this->eventoRepository = $eventoRepository;
        $this->momentoRepository = $momentoRepository;
    }

    public function validate(array $data)
    {
        return (new class extends Validator {
            public function rules()
            {
                return [
                    'medidas' => ['array', 'required'],
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
        /** @var Jogo $jogo */
        $jogo = $this->jogoRepository->getById($data['jogo_id']);
        $noticias = collect();
        $jogo->eventos->each(function (Evento $evento, $key) use ($noticias, $jogo){
            if($evento->rodadas_restantes == 0) {
                $noticia = $this->executarEvento($evento, $jogo->id);
                if(! is_null($noticia)) {
                    $noticias->add($noticia);
                }
                $this->eventoRepository->delete($evento);
            } else {
                $evento->rodadas_restantes--;
                $this->eventoRepository->update($evento);
            }
        });

        foreach ($data['medidas'] as $medida) {
            $noticia = $this->executarMedida($medida, $jogo->id);
            if(! is_null($noticia)) {
                $noticias->add($noticia);
            }
        }

        $jogo = $this->jogoRepository->getById($data['jogo_id']);
        $momento = new Momento();
        $momento->jogo_id = $jogo->id;
        $momento->noticias = $noticias->toArray();
        $momento->medidas = $data['medidas'];
        $momento->pib = $jogo->pib;
        $momento->pib_prox_ano = $jogo->pib_prox_ano;
        $momento->pib_consumo = $jogo->pib_consumo;
        $momento->pib_investimento = $jogo->pib_investimento;
        $momento->rodada = $jogo->momentos->count() + 1;
        $this->momentoRepository->save($momento);
        return $jogo;
    }

    private function executarEvento(Evento $evento, int $jogoId)
    {
        /** @var Jogo $jogo */
        $jogo = $this->jogoRepository->getById($jogoId);
        switch ($evento->code) {
            case CalcularPrevisaoAnualPIB::CODE:
                return (new CalcularPrevisaoAnualPIB())->modificacoes($jogo, $evento->data);
            default:
                return null;
        }
    }

    private function executarMedida(array $medida, int $jogoId)
    {
        /** @var Jogo $jogo */
        $jogo = $this->jogoRepository->getById($jogoId);

        switch ($medida['code']) {
            //case CalcularPrevisaoAnualPIB::CODE: //caso for uma medida instantanea
            //    return (new CalcularPrevisaoAnualPIB())->modificacoes($jogo, $medida['data']);
            case CalcularPrevisaoAnualPIB::CODE:
                return $this->criarEvento(
                    $medida['data'],
                    CalcularPrevisaoAnualPIB::RODADAS,
                    $medida['code'],
                    $jogoId
                );
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