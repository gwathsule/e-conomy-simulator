<?php

namespace App\Domains\Jogo\Services;

use App\Domains\Evento\Evento;
use App\Domains\Evento\EventoRepository;
use App\Domains\Evento\Eventos\CalcularPibAnual;
use App\Domains\Evento\Eventos\CalcularPrevisaoAnualPIB;
use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\JogoRepository;
use App\Domains\Momento\MomentoRepository;
use App\Domains\Momento\Momento;
use App\Domains\User\User;
use App\Support\Service;
use App\Support\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CriarNovoJogo extends Service
{
    private const POPULACAO = 100000;
    private const PIB_PER_CAPITA = 1200;
    private const PREVISAO_ANUAL = 0.03;
    private const PIB = self::POPULACAO * self::PIB_PER_CAPITA;

    private const CONSUMO = self::PIB * 0.60;
    private const INVESTIMENTO = self::PIB * 0.15;
    private const IMPOSTOS = self::PIB * 0.25;

    private const GASTOS_GOVERNAMENTAIS = self::IMPOSTO * 0.80; //80% do imposto arrecadado
    private const TRANSFERENCIAS = self::IMPOSTO * 0.20; //20% do imposto arrecadado

    private const BS = self::IMPOSTOS - self::TRANSFERENCIAS - self::GASTOS_GOVERNAMENTAIS;

    /**
     * @var JogoRepository
     */
    private $jogoRepository;
    /**
     * @var MomentoRepository
     */
    private $momentoRepository;

    public function __construct(
        JogoRepository $jogoRepository,
        MomentoRepository $momentoRepository
    )
    {
        $this->jogoRepository = $jogoRepository;
        $this->momentoRepository = $momentoRepository;
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
                    'rodadas' => ['required', 'int', 'min:12'],
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
        $novoJogo->rodadas = $data['rodadas'];
        $novoJogo->populacao = self::POPULACAO;
        $novoJogo->pib = self::PIB;
        $novoJogo->pib_prox_ano = self::PREVISAO_ANUAL;
        $novoJogo->consumo = self::CONSUMO;
        $novoJogo->investimento = self::INVESTIMENTO;
        $novoJogo->gastos_governamentais = self::GASTOS_GOVERNAMENTAIS;
        $novoJogo->transferencias = self::TRANSFERENCIAS;
        $novoJogo->impostos = self::IMPOSTOS;

        $primeiroMomento = new Momento();
        $primeiroMomento->pib = $novoJogo->pib;
        $primeiroMomento->pib_prox_ano = $novoJogo->pib_prox_ano;
        $primeiroMomento->consumo = $novoJogo->consumo;
        $primeiroMomento->investimento = $novoJogo->investimento;
        $primeiroMomento->gastos_governamentais = $novoJogo->gastos_governamentais;
        $primeiroMomento->transferencias = $novoJogo->transferencias;
        $primeiroMomento->impostos = $novoJogo->impostos;
        $primeiroMomento->medidas = [];
        $primeiroMomento->noticias = $this->noticiasIniciais();
        $primeiroMomento->rodada = 0;

        DB::transaction(function () use ($data, $novoJogo, $primeiroMomento) {
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
            $primeiroMomento->jogo_id = $novoJogo->id;
            $this->momentoRepository->save($primeiroMomento);
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
