<?php

namespace App\Domains\Jogo\Services;

use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\JogoRepository;
use App\Domains\Jogo\Validators\CreateNewGameValidator;
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

        //create first timeline with real information of Brazil in 2019
        $primeiroMomento = new Momento();
        $primeiroMomento->pib = $data['populacao'] * config('jogo.inicio.renda_anual_pessoa');

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
            $primeiroMomento->jogo_id = $novoJogo->id;
            $this->momentoRepository->save($primeiroMomento);
        });
        return $novoJogo;
    }
}
