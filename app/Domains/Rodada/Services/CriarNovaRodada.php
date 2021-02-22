<?php

namespace App\Domains\Rodada\Services;

use App\Domains\Evento\EventoRepository;
use App\Domains\Evento\Eventos\AlterarGastoGovernamental;
use App\Domains\Evento\Eventos\AlterarGastoGovernamentalMensal;
use App\Domains\Evento\Eventos\AlterarImpostoDeRenda;
use App\Domains\Evento\Eventos\CriarTransferencia;
use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\JogoRepository;
use App\Domains\Medida\Medida;
use App\Domains\Medida\MedidaRepository;
use App\Domains\Rodada\Rodada;
use App\Domains\Rodada\RodadaRepository;
use App\Domains\User\User;
use App\Support\Exceptions\UserException;
use App\Support\Service;
use App\Support\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;
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
                    'medida_id' => ['int', 'nullable'],
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
            /** @var User $user */
            $user = Auth::user();
            if((int)$data['jogo_id'] != $user->getJogoAtivo()->id) {
                throw new UserException(__('nao autorizado'));
            }
            $novaRodada = $this->criarNovaRodada($jogo);
            $noticias = collect();
            $medida = null;
            if(! is_null($data['medida_id'])) {
                /** @var Medida $medida */
                $medida = (new MedidaRepository())->getById($data['medida_id']);
                $noticia = $this->executarMedida($medida, $novaRodada);
                if (!is_null($noticia)) {
                    $noticias->add($noticia);
                }
            }
            $novaRodada->refresh();
            $novaRodada->gastos_governamentais += $novaRodada->gastos_governamentais_fixos;
            $novaRodada->investimentos += $novaRodada->investimentos_fixos;
            $novaRodada->noticias = $noticias->toArray();
            if(! is_null($medida))
                $novaRodada->medida_id = $medida->id;

            if($novaRodada->popularidade_empresarios < 0)
                $novaRodada->popularidade_empresarios = 0;

            if($novaRodada->popularidade_trabalhadores < 0)
                $novaRodada->popularidade_trabalhadores = 0;

            if($novaRodada->popularidade_estado < 0)
                $novaRodada->popularidade_estado = 0;

            if($novaRodada->popularidade_empresarios > 100)
               $novaRodada->popularidade_empresarios = 100;
            if($novaRodada->popularidade_trabalhadores > 100)
               $novaRodada->popularidade_trabalhadores = 100;
            if($novaRodada->popularidade_estado > 100)
               $novaRodada->popularidade_estado = 100;


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
        $novaRodada->medida_id = null;
        $novaRodada->noticias = [];
        $novaRodada->investimentos_fixos = $ultimaRodada->investimentos_fixos;
        $novaRodada->gastos_governamentais_fixos = $ultimaRodada->gastos_governamentais_fixos;
        $novaRodada->transferencias = 0;
        $novaRodada->gastos_governamentais = 0;
        $novaRodada->investimentos = 0;
        $novaRodada->popularidade_empresarios = $ultimaRodada->popularidade_empresarios;
        $novaRodada->popularidade_trabalhadores = $ultimaRodada->popularidade_trabalhadores;
        $novaRodada->popularidade_estado = $ultimaRodada->popularidade_estado;
        $this->rodadaRepository->save($novaRodada);
        return $novaRodada;
    }

    private function executarMedida(Medida $medida, Rodada $rodada)
    {
        $rodada->refresh();
        switch ($medida->codigo_evento) {
            case AlterarGastoGovernamental::CODE:
                return (new AlterarGastoGovernamental())->modificacoes($rodada, $medida);
            case AlterarGastoGovernamentalMensal::CODE:
                return (new AlterarGastoGovernamentalMensal())->modificacoes($rodada, $medida);
            case AlterarImpostoDeRenda::CODE:
                return (new AlterarImpostoDeRenda())->modificacoes($rodada, $medida);
            case CriarTransferencia::CODE:
                return (new CriarTransferencia())->modificacoes($rodada, $medida);
            default:
                return null;
        }
    }
}