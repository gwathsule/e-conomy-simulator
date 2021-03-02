<?php

use App\Domains\Medida\Medida;
use App\Domains\Evento\Eventos\AlterarImpostoDeRenda;
use App\Domains\Evento\Eventos\CriarTransferencia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class MedidasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medida5 = new Medida();
        $medida5->codigo_evento = AlterarImpostoDeRenda::CODE;
        $medida5->nome = 'Aumentar Imposto de Renda';
        $medida5->resumo = 'Imposto de Renda +5%';
        $medida5->titulo_noticia = '{ministro/a} {nomeMinistro} anuncia aumento no IR';
        $medida5->rodadas_para_excutar = 1;
        $medida5->tipo_noticia = Medida::TIPO_NOTICIA_ESTATAL;
        $medida5->texto_noticia = "{a/o} {ministro/a} {nomeMinistro} anunciou um aumento do imposto de renda de 5%.J";
        $medida5->diferenca_financas = +5;
        $medida5->diferenca_popularidade_empresarios = -10;
        $medida5->diferenca_popularidade_trabalhadores = -10;
        $medida5->diferenca_popularidade_estado = +10;
        $medida5->save();
        Storage::putFileAs(
            'public/medidas/' . $medida5->id,
            new File(public_path('img/medidas_exemplos/aumentar_imposto_de_renda.jpg')),
            'aumentar_imposto_de_renda.jpg'
        );
        $medida5->url_imagem = 'medidas/' . $medida5->id . '/aumentar_imposto_de_renda.jpg';
        $medida5->update();

        $medida6 = new Medida();
        $medida6->codigo_evento = AlterarImpostoDeRenda::CODE;
        $medida6->nome = 'Reduzir imposto de renda';
        $medida6->resumo = 'Imposto de Renda -5%';
        $medida6->titulo_noticia = '{nomeMinistro} de bom humor, anuncia redução no IR';
        $medida6->rodadas_para_excutar = 1;
        $medida6->tipo_noticia = Medida::TIPO_NOTICIA_LIBERAL;
        $medida6->texto_noticia = "{a/o} {ministro/a} {nomeMinistro} anunciou uma redução no imposto de renda de 5%. A partir de hoje o imposto será de {imposto_de_renda}%";
        $medida6->diferenca_financas = -5;
        $medida6->diferenca_popularidade_empresarios = +10;
        $medida6->diferenca_popularidade_trabalhadores = +10;
        $medida6->diferenca_popularidade_estado = -10;
        $medida6->save();
        Storage::putFileAs(
            'public/medidas/' . $medida6->id,
            new File(public_path('img/medidas_exemplos/diminuir_imposto_de_renda.jpg')),
            'diminuir_imposto_de_renda.jpg'
        );
        $medida6->url_imagem = 'medidas/' . $medida6->id . '/diminuir_imposto_de_renda.jpg';
        $medida6->update();

        $medida7 = new Medida();
        $medida7->codigo_evento = CriarTransferencia::CODE;
        $medida7->nome = 'Criar Transferencias';
        $medida7->resumo = 'Transferencias +500.000';
        $medida7->titulo_noticia = 'Desvio de dinheiro ou politica social?';
        $medida7->rodadas_para_excutar = 1;
        $medida7->tipo_noticia = Medida::TIPO_NOTICIA_ESTATAL;
        $medida7->texto_noticia = '{a/o} {ministro/a} {nomeMinistro} anunciou o programa social Bolsa Familia, que irá destinar a população carente cerca de 500 mil {moeda}.';
        $medida7->diferenca_financas = 500000;
        $medida7->diferenca_popularidade_empresarios = +5;
        $medida7->diferenca_popularidade_trabalhadores = +20;
        $medida7->diferenca_popularidade_estado = 0;
        $medida7->save();
        Storage::putFileAs(
            'public/medidas/' . $medida7->id,
            new File(public_path('img/medidas_exemplos/criar_transferencias.jpg')),
            'criar_transferencias.jpg'
        );
        $medida7->url_imagem = 'medidas/' . $medida7->id . '/criar_transferencias.jpg';
        $medida7->update();
    }
}