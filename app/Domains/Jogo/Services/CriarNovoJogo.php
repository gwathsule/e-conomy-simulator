<?php

namespace App\Domains\Jogo\Services;

use App\Domains\Evento\Evento;
use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\JogoRepository;
use App\Domains\ResultadoAnual\ResultadoAnual;
use App\Domains\ResultadoAnual\Services\CriarResultadoAnualPrimario;
use App\Domains\Rodada\RodadaRepository;
use App\Domains\Rodada\Rodada;
use App\Domains\Rodada\Services\CriarNovaRodada;
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
    /**
     * @var CriarNovaRodada
     */
    private $novaRodadaService;
    /**
     * @var CriarResultadoAnualPrimario
     */
    private $resulAnualPrimarioService;

    public function __construct(
        JogoRepository $jogoRepository,
        RodadaRepository $rodadaRepository,
        CriarNovaRodada $novaRodadaService,
        CriarResultadoAnualPrimario $resulAnualPrimarioService
    )
    {
        $this->jogoRepository = $jogoRepository;
        $this->rodadaRepository = $rodadaRepository;
        $this->novaRodadaService = $novaRodadaService;
        $this->resulAnualPrimarioService = $resulAnualPrimarioService;
    }

    public function validate(array $data)
    {
        return (new class extends Validator {
            public function rules()
            {
                return [
                    'pais' => ['required', 'string'],
                    'moeda' => ['required', 'string'],
                    'ministro' => ['required', 'string', 'max:30'],
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
        $novoJogo->status = Jogo::STATUS_EM_ANDAMENTO;
        $novoJogo->qtd_rodadas = 24;

        DB::transaction(function () use ($data, $novoJogo) {
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
                /** @var ResultadoAnual $resultado */
                foreach ($ultimoJogo->resultados_anuais as $resultado) {
                    $resultado->delete();
                }
                $ultimoJogo->delete();
            }
            $novoJogo->user_id = $user->id;
            $novoJogo->save();
            $this->resulAnualPrimarioService->handle([
                'jogo_id' => $novoJogo->id,
            ]);
            $this->novaRodadaService->handle([
                'medida_id' => null,
                'jogo_id' => $novoJogo->id,
            ]);
        });
        return $novoJogo;
    }
}
