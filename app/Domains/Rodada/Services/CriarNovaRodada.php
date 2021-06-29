<?php

namespace App\Domains\Rodada\Services;

use App\Domains\Evento\Evento;
use App\Domains\Evento\EventoRepository;
use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\JogoRepository;
use App\Domains\Medida\Medida;
use App\Domains\Medida\MedidaRepository;
use App\Domains\ResultadoAnual\ResultadoAnual;
use App\Domains\ResultadoAnual\Services\CriarResultadoAnual;
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
    use NoticiasCondicionais, NoticiasEndGame;
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
        RodadaRepository $rodadaRepository,
        CriarResultadoAnual $criarResultadoAnual
    )
    {
        $this->jogoRepository = $jogoRepository;
        $this->eventoRepository = $eventoRepository;
        $this->rodadaRepository = $rodadaRepository;
        $this->criarResultadoAnual = $criarResultadoAnual;
    }

    public function validate(array $data)
    {
        return (new class extends Validator {
            public function rules()
            {
                return [
                    'medida_code' => ['string', 'nullable'],
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
            if($jogo->finalizado()) {
                throw new UserException('O jogo atual conta como finalizado, inicie um novo');
            }
            /** @var User $user */
            $user = Auth::user();
            if((int)$data['jogo_id'] != $user->getJogoAtivo()->id) {
                throw new UserException(__('nao autorizado'));
            }
            /** @var Rodada $ultimaRodada */
            $ultimaRodada = $jogo->rodadas->last();
            /** @var ResultadoAnual $ultimoAno */
            $ultimoAno = $jogo->resultados_anuais->last();
            $novaRodada = $this->criarNovaRodada($jogo, $ultimaRodada, $ultimoAno);
            $medida = null;
            $nomeUltimaMedida = "";
            $codeEventoUltimaMedida = "";
            if(! is_null($data['medida_id'])) {
                /** @var Medida $medida */
                $medida = (new MedidaRepository())->getById($data['medida_id']);
                $nomeUltimaMedida = $medida->nome;
                $codeEventoUltimaMedida = $medida->codigo_evento;
                $novaRodada->medida_id = $data['medida_id'];
                $this->executarMedida($novaRodada, $medida);
            }
            /** @var Evento $evento */
            foreach ($jogo->eventos as $evento) {
                $this->executarEvento($evento, $novaRodada);
            }
            $novaRodada->refresh();
            $calculador = new CalcularResultantes($novaRodada, $ultimoAno, $codeEventoUltimaMedida, $ultimaRodada);
            $novaRodada = $calculador->perform();
            $novaRodada = $this->verificarPopularidade($novaRodada, $jogo);
            $novaRodada->noticias = $this->obterNoticiasCondicionais($novaRodada, $ultimaRodada, $nomeUltimaMedida, $jogo);
            $novaRodada->update();
            $jogo->refresh();
            if($ultimaRodada != null && ($novaRodada->rodada == 12 || $novaRodada->rodada == 24)){
                $criadorDeResultado = new CriarResultadoAnual($jogo);
                $criadorDeResultado->perform();
                $novaRodada->caixa = $ultimaRodada->caixa - $ultimaRodada->divida_total;
                $novaRodada->divida_total = 0;
                if($novaRodada->rodada == 24){
                    $jogo->status = Jogo::STATUS_VENCIDO;
                }
                if($novaRodada->caixa <= 0) {
                    $jogo->status = Jogo::STATUS_PERDIDO;
                }
                $jogo->save();
            }
            if($jogo->status === Jogo::STATUS_PERDIDO) {
                $novaRodada->noticias = $this->obterNoticiasDerrota($novaRodada, $jogo);
            }
            if($jogo->status === Jogo::STATUS_VENCIDO) {
                $novaRodada->noticias = $this->obterNoticiasVitoria($novaRodada, $jogo);
            }
            $novaRodada->save();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $jogo;
    }

    private function verificarPopularidade(Rodada $novaRodada, Jogo $jogo)
    {
        if(
            $novaRodada->popularidade_empresarios <= 0 ||
            $novaRodada->popularidade_trabalhadores <= 0 ||
            $novaRodada->popularidade_estado <= 0
        ) {
            $jogo->status = Jogo::STATUS_PERDIDO;
            $jogo->save();
        }

        if($novaRodada->popularidade_empresarios > 1)
            $novaRodada->popularidade_empresarios = 1;
        if($novaRodada->popularidade_trabalhadores > 1)
            $novaRodada->popularidade_trabalhadores = 1;
        if($novaRodada->popularidade_estado > 1)
            $novaRodada->popularidade_estado = 1;

        return $novaRodada;
    }

    /**
     * Cria uma nova rodada com os valores iniciais (pode ser modificada durante o processo desse servico)
     */
    private function criarNovaRodada(
        Jogo $jogo,
        Rodada $ultimaRodada = null,
        ResultadoAnual $ultimoAno = null
    ) : Rodada
    {
        if(is_null($ultimaRodada)) {
            return $this->iniciarPrimeiraRodada($ultimoAno, $jogo);
        }
        $novaRodada = new Rodada();
        $novaRodada->jogo_id = $jogo->id;
        $novaRodada->rodada = $jogo->rodadas->count() + 1;

        //VALORES DE PROGRESSÃO NORMAL (SEM INTERFERENCIA DO USUÁRIO)
        $novaRodada->pib_investimento_potencial = $ultimoAno->pib_investimento_potencial / 12;
        $novaRodada->gastos_governamentais = $ultimoAno->gastos_governamentais / 12;
        $novaRodada->transferencias = number_format($ultimoAno->transferencias / 12, 2, '.', '');
        $novaRodada->taxa_de_juros_base = $ultimaRodada->taxa_de_juros_base;
        $novaRodada->imposto_de_renda = $ultimaRodada->imposto_de_renda;

        $novaRodada->medida_id = null;
        $novaRodada->noticias = [];
        $novaRodada->popularidade_empresarios = $ultimaRodada->popularidade_empresarios;
        $novaRodada->popularidade_trabalhadores = $ultimaRodada->popularidade_trabalhadores;
        $novaRodada->popularidade_estado = $ultimaRodada->popularidade_estado;
        $novaRodada->save();
        return $novaRodada;
    }

    /**
     * inicia primeira rodada da partida
     * @param ResultadoAnual $ultimoAno
     * @param Jogo $jogo
     * @return Rodada
     */
    private function iniciarPrimeiraRodada(ResultadoAnual $ultimoAno, Jogo $jogo)
    {
        $rodada = new Rodada();
        $rodada->jogo_id = $jogo->id;
        $popularidadePrimaria = 0.5;
        if($jogo->dificuldade === Jogo::DIFICULDADE_FACIL)
            $popularidadePrimaria = 1;
        if($jogo->dificuldade === Jogo::DIFICULDADE_NORMAL)
            $popularidadePrimaria = 0.5;
        if($jogo->dificuldade === Jogo::DIFICULDADE_DIFICIL)
            $popularidadePrimaria = 0.30;
        $rodada->popularidade_empresarios = $popularidadePrimaria;
        $rodada->popularidade_trabalhadores = $popularidadePrimaria;
        $rodada->popularidade_estado = $popularidadePrimaria;
        $rodada->rodada = 1;
        $rodada->pib_investimento_potencial = $ultimoAno->pib_investimento_potencial / 12;
        $rodada->gastos_governamentais = $ultimoAno->gastos_governamentais / 12;
        $rodada->transferencias = $ultimoAno->transferencias / 12;;
        $rodada->taxa_de_juros_base = $ultimoAno->taxa_de_juros_base;
        $rodada->imposto_de_renda = $ultimoAno->imposto_de_renda;
        $rodada->noticias = [];
        $rodada->save();
        return $rodada;
    }

    private function executarEvento(Evento $evento, Rodada $novaRodada) {
        $eventoService = (new EventoRepository())->getService($evento->code);
        $eventoService->modificacoes($novaRodada, $evento);
    }

    private function executarMedida(Rodada $novaRodada, Medida $medida)
    {
        $eventoService = (new EventoRepository())->getService($medida->codigo_evento);
        $evento = new Evento();
        $evento->code = $eventoService->getCode();
        $evento->jogo_id = $novaRodada->jogo_id;
        if($medida->medida_imediata) {
            $evento->data = $eventoService->buidData($medida->diferenca_financas);
            $evento->rodadas_restantes = 1;
        } else {
            $rodadasRestantes = $this->getNumerosDeRodadasFaltantes($novaRodada);
            $evento->data = $eventoService->buidData($medida->diferenca_financas / $rodadasRestantes);
            $evento->rodadas_restantes = $rodadasRestantes;
        }
        $evento->save();

        $novaRodada->popularidade_empresarios += $medida->diferenca_popularidade_empresarios;
        $novaRodada->popularidade_trabalhadores += $medida->diferenca_popularidade_trabalhadores;
        $novaRodada->popularidade_estado += $medida->diferenca_popularidade_estado;
        $novaRodada->update();
    }

    private function getNumerosDeRodadasFaltantes(Rodada $novaRodada)
    {
        if($novaRodada->rodada <= 12) {
            return 13 - $novaRodada->rodada;
        } else {
            return 25 - $novaRodada->rodada;
        }
    }
}