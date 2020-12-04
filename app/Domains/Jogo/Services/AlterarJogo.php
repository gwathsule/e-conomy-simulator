<?php

namespace App\Domains\Jogo\Services;

use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\JogoRepository;
use App\Domains\Rodada\RodadaRepository;
use App\Domains\Rodada\Rodada;
use App\Support\Service;
use App\Support\Validator;
use Illuminate\Validation\Rule;

class AlterarJogo extends Service
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
                    'id' => ['required', 'int'],
                    'pais' => ['required', 'string'],
                    'moeda' => ['required', 'string'],
                    'ministro' => ['required', 'string'],
                    'genero' => ['required', 'string', 'max:1', Rule::in(['M', 'F'])],
                    'personagem' => ['required', 'int'],
                    'descricao' => ['required', 'string'],
                    'rodadas' => ['required', 'int', 'min:12'],
                ];
            }
        })->validate($data);
    }

    protected function perform(array $data, array $columns = ['*'], array $relations = [])
    {
        $jogo = Jogo::query()->find($data['id']);
        $jogo->pais = $data['pais'];
        $jogo->moeda = $data['moeda'];
        $jogo->ministro = $data['ministro'];
        $jogo->presidente = $data['presidente'];
        $jogo->genero = $data['genero'];
        $jogo->personagem = $data['personagem'];
        $jogo->qtd_rodadas = $data['rodadas'];
        $jogo->update();
        return $jogo;
    }
}
