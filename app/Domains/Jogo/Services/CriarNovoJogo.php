<?php

namespace App\Domains\Jogo\Services;

use App\Domains\ConfiguracoesGerais\ConfiguracoesGerais;
use App\Domains\Evento\Evento;
use App\Domains\Evento\EventoRepository;
use App\Domains\Evento\Eventos\CalcularPibAnual;
use App\Domains\Evento\Eventos\CalcularPrevisaoAnualPIB;
use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\JogoRepository;
use App\Domains\Rodada\RodadaRepository;
use App\Domains\Rodada\Rodada;
use App\Domains\User\User;
use App\Support\Service;
use App\Support\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CriarNovoJogo extends Service
{
    /**
     * @var JogoRepository
     */
    private $jogoRepository;
    /**
     * @var RodadaRepository
     */
    private $rodadaRepository;

    public function __construct(
        JogoRepository $jogoRepository,
        RodadaRepository $rodadaRepository
    )
    {
        $this->jogoRepository = $jogoRepository;
        $this->rodadaRepository = $rodadaRepository;
    }

    public function validate(array $data)
    {
        return (new class extends Validator {
            public function rules()
            {
                return [
                    'pais' => ['required', 'string'],
                    'moeda' => ['required', 'string'],
                    'ministro' => ['required', 'string'],
                    'genero' => ['required', 'string', 'max:1', Rule::in(['M', 'F'])],
                    'personagem' => ['required', 'int'],
                    'presidente' => ['required', 'string'],
                    'descricao' => ['required', 'string'],
                ];
            }
        })->validate($data);
    }

    protected function perform(array $data, array $columns = ['*'], array $relations = [])
    {
        //create a new game
        $novoJogo = new Jogo();
        $novoJogo->pais = $data['pais'];
        $novoJogo->moeda = $data['moeda'];
        $novoJogo->ministro = $data['ministro'];
        $novoJogo->presidente = $data['presidente'];
        $novoJogo->descricao = $data['descricao'];
        $novoJogo->genero = $data['genero'];
        $novoJogo->personagem = $data['personagem'];
        $novoJogo->ativo = true;
        $novoJogo->qtd_rodadas = ConfiguracoesGerais::QTD_RODADAS;

        $primeiraRodada = new Rodada();
        $primeiraRodada->pib = ConfiguracoesGerais::PIB_ANO_ANTERIOR;
        $primeiraRodada->populacao = ConfiguracoesGerais::POPULACAO;
        $primeiraRodada->pib_prox_ano = ConfiguracoesGerais::PREVISAO_ANUAL;
        $primeiraRodada->consumo = ConfiguracoesGerais::CONSUMO;
        $primeiraRodada->investimento = ConfiguracoesGerais::INVESTIMENTO;
        $primeiraRodada->gastos_governamentais = ConfiguracoesGerais::GASTOS_GOVERNAMENTAIS;
        $primeiraRodada->transferencias = ConfiguracoesGerais::TRANSFERENCIAS;
        $primeiraRodada->impostos = ConfiguracoesGerais::IMPOSTOS;
        $primeiraRodada->medidas = [];
        $primeiraRodada->noticias = $this->noticiasIniciais();
        $primeiraRodada->rodada = 0;

        DB::transaction(function () use ($data, $novoJogo, $primeiraRodada) {
            /** @var User $user */
            $user = Auth::user();
            //disable last game
            $ultimoJogo = $user->getJogoAtivo();
            if(! is_null($ultimoJogo)) {
                $this->jogoRepository->delete($ultimoJogo);
            }
            $novoJogo->user_id = $user->id;
            $this->jogoRepository->save($novoJogo);
            $this->iniciarEventos($novoJogo);
            $primeiraRodada->jogo_id = $novoJogo->id;
            $this->rodadaRepository->save($primeiraRodada);
        });
        return $novoJogo;
    }

    private function iniciarEventos(Jogo $novoJogo)
    {
        $evento = new Evento();
        $evento->data = [];
        $evento->rodadas_restantes = CalcularPrevisaoAnualPIB::RODADAS;
        $evento->jogo_id = $novoJogo->id;
        $evento->code = CalcularPrevisaoAnualPIB::CODE;
        (new EventoRepository())->save($evento);

        $evento = new Evento();
        $evento->data = [];
        $evento->rodadas_restantes = CalcularPibAnual::RODADAS;
        $evento->jogo_id = $novoJogo->id;
        $evento->code = CalcularPibAnual::CODE;
        (new EventoRepository())->save($evento);
    }

    /**
     * cria uma noticia de boas vindas
     * @return array
     */
    private function noticiasIniciais()
    {
        // TODO criar uma noticia de boas vindas ao jogo aqui
        return [];
    }
}
