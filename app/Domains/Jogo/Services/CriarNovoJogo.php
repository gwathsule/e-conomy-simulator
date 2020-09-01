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

class CriarNovoJogo extends Service
{
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
                    'pais' => ['required'],
                    'moeda' => ['required'],
                    'ministro' => ['required'],
                    'presidente' => ['required'],
                    'descricao' => ['required'],
                    'rodadas' => ['required', 'int', 'min:10'],
                    'populacao' => ['required', 'int'],
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
        $novoJogo->ativo = true;
        $novoJogo->rodadas = $data['rodadas'];
        $novoJogo->pib = $data['populacao'] * config('jogo.inicio.renda_anual_pessoa');
        $novoJogo->pib_prox_ano = config('jogo.pib.previsao_anual');
        $novoJogo->pib_consumo = $novoJogo->pib * config('jogo.pib.consumo');
        $novoJogo->pib_investimento = $novoJogo->pib * config('jogo.pib.investimento');

        //Informação do Brazil em 2019
        $primeiroMomento = new Momento();
        $primeiroMomento->pib = $novoJogo->pib;
        $primeiroMomento->pib_prox_ano = $novoJogo->pib_prox_ano;
        $primeiroMomento->pib_consumo = $novoJogo->pib_consumo;
        $primeiroMomento->pib_investimento = $novoJogo->pib_investimento;
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
