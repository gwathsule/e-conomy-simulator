<?php

namespace App\Domains\Jogo\Services;

use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\JogoRepository;
use App\Domains\Momento\MomentoRepository;
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
                    'id' => ['required', 'int'],
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
        $jogo = Jogo::query()->find($data['id']);
        $jogo->pais = $data['pais'];
        $jogo->moeda = $data['moeda'];
        $jogo->ministro = $data['ministro'];
        $jogo->presidente = $data['presidente'];
        $jogo->descricao = $data['descricao'];
        $jogo->genero = $data['genero'];
        $jogo->personagem = $data['personagem'];
        $jogo->rodadas = $data['rodadas'];
        $jogo->update();
        return $jogo;
    }
}
