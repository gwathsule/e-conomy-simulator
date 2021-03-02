<?php

namespace Rodada;

use App\Domains\Rodada\Services\CriarNovaRodada;
use App\Domains\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\TarefasBasicasDoJogo;
use Tests\TestCase;

class RodadaTest extends TestCase
{
    use RefreshDatabase, TarefasBasicasDoJogo;

    public function testProgressoDe2AnosSemIntervencaoDoUsuario()
    {
        $user = factory(User::class)->create();
        $jogo = $this->iniciarjogo($user);
        /** @var CriarNovaRodada $servico */
        $servico = app()->make(CriarNovaRodada::class);
        $dataPadrao = [
            'medida_id' => null,
            'jogo_id' => $jogo->id,
        ];
        for($i = 0; $i<=22; $i++){
            $servico->handle($dataPadrao);
        }
        $jogo->refresh();
        $this->assertNotNull($jogo->id);
    }

    //criar um teste igual ao da planilha
    public function testProgressoDe2AnosComIntervencaoDoUsuario()
    {
        $user = factory(User::class)->create();
        $jogo = $this->iniciarjogo($user);
        /** @var CriarNovaRodada $servico */
        $servico = app()->make(CriarNovaRodada::class);
        $dataPadrao = [
            'medida_id' => null,
            'jogo_id' => $jogo->id,
        ];
        for($i = 0; $i<=22; $i++){
            $servico->handle($dataPadrao);
        }
        $jogo->refresh();
        $this->assertNotNull($jogo->id);
    }
}