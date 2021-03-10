<?php

use App\Domains\Medida\Medida;
use App\Domains\Evento\Eventos\AlterarImpostoDeRenda;
use App\Domains\Evento\Eventos\CriarTransferencia;
use App\Domains\Evento\Eventos\AlterarTaxaDeJuros;
use App\Domains\Evento\Eventos\AlterarGastosGovernamentais;
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
        $medida1 = new Medida();
        $medida1->codigo_evento = AlterarImpostoDeRenda::CODE;
        $medida1->nome = 'Abaixar Imposto de Renda';
        $medida1->resumo = 'Imposto de Renda -1%';
        $medida1->titulo_noticia = '{nomeMinistro} de bom humor, anuncia redução no IR';
        $medida1->medida_imediata = true;
        $medida1->tipo_noticia = Medida::TIPO_NOTICIA_LIBERAL;
        $medida1->texto_noticia = "{a/o} {ministro/a} {nomeMinistro} anunciou uma redução no imposto de renda de 1%.";
        $medida1->diferenca_financas = -0.01;
        $medida1->diferenca_popularidade_empresarios = +0.05;
        $medida1->diferenca_popularidade_trabalhadores = +0.05;
        $medida1->diferenca_popularidade_estado = 0;
        $medida1->save();
        Storage::putFileAs(
            'public/medidas/' . $medida1->id,
            new File(public_path('img/medidas_exemplos/diminuir_imposto_de_renda.jpg')),
            'diminuir_imposto_de_renda.jpg'
        );
        $medida1->url_imagem = 'medidas/' . $medida1->id . '/diminuir_imposto_de_renda.jpg';
        $medida1->update();

        $medida2 = new Medida();
        $medida2->codigo_evento = CriarTransferencia::CODE;
        $medida2->nome = 'Aumentar Transferencias';
        $medida2->resumo = 'Transferencias +180.000';
        $medida2->titulo_noticia = 'Desvio de dinheiro ou politica social?';
        $medida2->medida_imediata = false;
        $medida2->tipo_noticia = Medida::TIPO_NOTICIA_ESTATAL;
        $medida2->texto_noticia = '{a/o} {ministro/a} {nomeMinistro} anunciou o programa social Bolsa Familia, que irá destinar a população carente cerca de 180 mil {moeda}.';
        $medida2->diferenca_financas = +180000;
        $medida2->diferenca_popularidade_empresarios = 0;
        $medida2->diferenca_popularidade_trabalhadores = +0.05;
        $medida2->diferenca_popularidade_estado = 0;
        $medida2->save();
        Storage::putFileAs(
            'public/medidas/' . $medida2->id,
            new File(public_path('img/medidas_exemplos/criar_transferencias.jpg')),
            'criar_transferencias.jpg'
        );
        $medida2->url_imagem = 'medidas/' . $medida2->id . '/criar_transferencias.jpg';
        $medida2->update();

        $medida3 = new Medida();
        $medida3->codigo_evento = AlterarTaxaDeJuros::CODE;
        $medida3->nome = 'Abaixar taxa de Juros';
        $medida3->resumo = 'Taxa de Juros -1%';
        $medida3->titulo_noticia = 'Taxa de juros mais baixa a partir de hoje';
        $medida3->medida_imediata = true;
        $medida3->tipo_noticia = Medida::TIPO_NOTICIA_LIBERAL;
        $medida3->texto_noticia = '{a/o} {ministro/a} {nomeMinistro} anunciou a redução da taxa de juros em 1%';
        $medida3->diferenca_financas = -0.01;
        $medida3->diferenca_popularidade_empresarios = 0;
        $medida3->diferenca_popularidade_trabalhadores = 0;
        $medida3->diferenca_popularidade_estado = 0;
        $medida3->save();
        Storage::putFileAs(
            'public/medidas/' . $medida3->id,
            new File(public_path('img/medidas_exemplos/criar_transferencias.jpg')),
            'criar_transferencias.jpg'
        );
        $medida3->url_imagem = 'medidas/' . $medida3->id . '/criar_transferencias.jpg';
        $medida3->update();

        $medida4 = new Medida();
        $medida4->codigo_evento = AlterarGastosGovernamentais::CODE;
        $medida4->nome = 'Investimento em Educação';
        $medida4->resumo = 'Gastos Governamentais +100.000';
        $medida4->titulo_noticia = 'Governo anuncia investimento em educação.';
        $medida4->medida_imediata = false;
        $medida4->tipo_noticia = Medida::TIPO_NOTICIA_ESTATAL;
        $medida4->texto_noticia = '{a/o} {ministro/a} {nomeMinistro} um investimento em educação até o fim do ano, no valor de 100.000';
        $medida4->diferenca_financas = +100000;
        $medida4->diferenca_popularidade_empresarios = 0;
        $medida4->diferenca_popularidade_trabalhadores = 0;
        $medida4->diferenca_popularidade_estado = +0.05;
        $medida4->save();
        Storage::putFileAs(
            'public/medidas/' . $medida4->id,
            new File(public_path('img/medidas_exemplos/criar_transferencias.jpg')),
            'criar_transferencias.jpg'
        );
        $medida4->url_imagem = 'medidas/' . $medida4->id . '/criar_transferencias.jpg';
        $medida4->update();

        $medida5 = new Medida();
        $medida5->codigo_evento = AlterarGastosGovernamentais::CODE;
        $medida5->nome = 'Investimento em Saúde';
        $medida5->resumo = 'Gastos Governamentais + 100.000';
        $medida5->titulo_noticia = 'Governo anuncia investimento em saúde.';
        $medida5->medida_imediata = false;
        $medida5->tipo_noticia = Medida::TIPO_NOTICIA_ESTATAL;
        $medida5->texto_noticia = '{a/o} {ministro/a} {nomeMinistro} um investimento em saúde pública até o fim do ano, no valor de 100.000';
        $medida5->diferenca_financas = +100000;
        $medida5->diferenca_popularidade_empresarios = 0;
        $medida5->diferenca_popularidade_trabalhadores = +0.05;
        $medida5->diferenca_popularidade_estado = 0;
        $medida5->save();
        Storage::putFileAs(
            'public/medidas/' . $medida5->id,
            new File(public_path('img/medidas_exemplos/criar_transferencias.jpg')),
            'criar_transferencias.jpg'
        );
        $medida5->url_imagem = 'medidas/' . $medida5->id . '/criar_transferencias.jpg';
        $medida5->update();
    }
}