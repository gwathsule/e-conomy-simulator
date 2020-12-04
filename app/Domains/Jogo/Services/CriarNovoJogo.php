<?php

namespace App\Domains\Jogo\Services;

use App\Domains\ConfiguracoesGerais\ConfiguracoesGerais;
use App\Domains\Evento\Evento;
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
        $novoJogo->genero = $data['genero'];
        $novoJogo->personagem = $data['personagem'];
        $novoJogo->ativo = true;
        $novoJogo->qtd_rodadas = ConfiguracoesGerais::QTD_RODADAS;

        $primeiraRodada = new Rodada();
        $primeiraRodada->populacao = ConfiguracoesGerais::POPULACAO_INICIAL;
        $primeiraRodada->pib_previsao_anual = ConfiguracoesGerais::PIB_PREVISAO_ANUAL_INICIAL;
        $primeiraRodada->pmgc = ConfiguracoesGerais::PMGC_INICIAL;
        $primeiraRodada->imposto_renda = ConfiguracoesGerais::IMPOSTO_DE_RENDA_INICIAL;
        $primeiraRodada->investimentos_fixos = ConfiguracoesGerais::INVESTIMENTOS_POR_RODADA;
        $primeiraRodada->investimentos = ConfiguracoesGerais::INVESTIMENTOS_POR_RODADA;
        $primeiraRodada->gastos_governamentais = ConfiguracoesGerais::GASTOS_GOVERNAMENTAIS_POR_RODADA;
        $primeiraRodada->gastos_governamentais_fixos = ConfiguracoesGerais::GASTOS_GOVERNAMENTAIS_POR_RODADA;
        $primeiraRodada->popularidade_empresarios = ConfiguracoesGerais::POPULARIDADE_EMPRESARIOS;
        $primeiraRodada->popularidade_trabalhadores = ConfiguracoesGerais::POPULARIDADE_TRABALHADORES;
        $primeiraRodada->popularidade_estado = ConfiguracoesGerais::POPULARIDADE_ESTADO;
        $primeiraRodada->transferencias = 0;
        $primeiraRodada->medida_id = null;
        $primeiraRodada->noticias = $this->noticiasIniciais();
        $primeiraRodada->rodada = 0;

        DB::transaction(function () use ($data, $novoJogo, $primeiraRodada) {
            /** @var User $user */
            $user = Auth::user();
            /** @var Jogo $ultimoJogo */
            $ultimoJogo = $user->getJogoAtivo();
            if(! is_null($ultimoJogo)) {
                /** @var Rodada $rodada */
                foreach ($ultimoJogo->rodadas as $rodada) {
                    $rodada->delete();
                }

                /** @var Evento $evento */
                foreach ($ultimoJogo->eventos as $evento) {
                    $evento->delete();
                }

                $ultimoJogo->delete();
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
