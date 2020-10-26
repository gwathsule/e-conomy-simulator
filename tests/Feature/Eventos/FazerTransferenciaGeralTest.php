<?php

namespace Eventos;

use App\Domains\Evento\Eventos\FazerTransferenciaGeral;
use App\Domains\Jogo\Services\CriarNovaRodada;
use App\Domains\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\TarefasBasicasDoJogo;
use Tests\TestCase;

class FazerTransferenciaGeralTest extends TestCase
{
    use RefreshDatabase, TarefasBasicasDoJogo;

    public function testFazerTransferenciaGeral()
    {
        /** @var User $user */
        $user = factory(User::class)->create();
        $jogo = $this->iniciarjogo($user);
        $data = [
            'jogo_id' => $jogo->id,
            'medidas' => [
                [
                    'data' => ['transferencia' => 10000],
                    'code' => FazerTransferenciaGeral::CODE,
                ]
            ],
        ];

        $transferencia_antiga = $jogo->transferencias;
        $imposto_antigo = $jogo->impostos;

        /** @var CriarNovaRodada $servico */
        $servico = app()->make(CriarNovaRodada::class);
        $servico->handle($data);
        $jogo->refresh();

        $this->assertEquals($transferencia_antiga + 10000, $jogo->transferencias);
        $this->assertEquals($imposto_antigo - 10000, $jogo->impostos);
    }
}