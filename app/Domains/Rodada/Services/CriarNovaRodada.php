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
use App\Domains\ResultadoAnual\ResultadoAnual;
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
        /** @var ResultadoAnual $ultimoAno */
        $ultimoAno = $jogo->resultados_anuais->last();
        if(is_null($ultimaRodada) || $ultimaRodada->rodada == 12) {
            return $this->iniciarPrimeiraRodadaDoAno($ultimoAno, $jogo);
        }
        $novaRodada = new Rodada();
        $novaRodada->jogo_id = $jogo->id;
        $novaRodada->rodada = $jogo->rodadas->count();

        //VALORES DE PROGRESSÃO NORMAL (SEM INTERFERENCIA DO USUÁRIO)
        $novaRodada->pib_investimento_potencial = $ultimoAno->pib_investimento_potencial / 12;
        $novaRodada->gastos_governamentais = $ultimoAno->gastos_governamentais / 12;
        $novaRodada->transferencias = $ultimoAno->transferencias / 12;;
        $novaRodada->taxa_base_de_juros = $ultimaRodada->taxa_base_de_juros;
        $novaRodada->pmgc = $ultimaRodada->pmgc;
        $novaRodada->imposto_renda = $ultimaRodada->imposto_renda;
        $novaRodada->inflacao_de_demanda = $ultimoAno->inflacao_de_demanda;
        $novaRodada->inflacao_de_custo = $ultimoAno->inflacao_de_custo;
        $novaRodada->inflacao_total = $ultimoAno->inflacao_total;
        $novaRodada->efmk = ($ultimoAno->transferencias/1000000000) + 0.075;

        $novaRodada->medida_id = null;
        $novaRodada->noticias = [];
        $novaRodada->popularidade_empresarios = $ultimaRodada->popularidade_empresarios;
        $novaRodada->popularidade_trabalhadores = $ultimaRodada->popularidade_trabalhadores;
        $novaRodada->popularidade_estado = $ultimaRodada->popularidade_estado;
        $this->rodadaRepository->save($novaRodada);
        return $novaRodada;
    }

    private function iniciarPrimeiraRodadaDoAno(ResultadoAnual $ultimoAno, Jogo $jogo)
    {
        $rodada = new Rodada();
        $rodada->jogo_id = $jogo->id;
        $rodada->rodada = $ultimoAno->ano == 0 ? 1 : $jogo->rodadas->count();

        //VALORES DA PRIMEIRA RODADA
        $rodada->pib_investimento_potencial = $ultimoAno->pib_investimento_potencial / 12;
        $rodada->gastos_governamentais = $ultimoAno->gastos_governamentais / 12;
        $rodada->transferencias = $ultimoAno->transferencias / 12;;
        $rodada->taxa_base_de_juros = $ultimoAno->taxa_de_juros_base;
        $rodada->pmgc = $ultimoAno->pmgc;
        $rodada->imposto_renda = $ultimoAno->imposto_de_renda;
        $rodada->inflacao_de_demanda = $ultimoAno->inflacao_de_demanda;
        $rodada->inflacao_de_custo = $ultimoAno->inflacao_de_custo;
        $rodada->inflacao_total = $ultimoAno->inflacao_total;
        $rodada->efmk = ($ultimoAno->transferencias/1000000000) + 0.075;

        $rodada->noticias = [];
        $rodada->save();
        return $rodada;
    }

    private function executarMedida(Medida $medida, Rodada $rodada)
    {
        $rodada->refresh();
        switch ($medida->codigo_evento) {
            case AlterarImpostoDeRenda::CODE:
                return (new AlterarImpostoDeRenda())->modificacoes($rodada, $medida);
            case CriarTransferencia::CODE:
                return (new CriarTransferencia())->modificacoes($rodada, $medida);
            default:
                return null;
        }
    }
}