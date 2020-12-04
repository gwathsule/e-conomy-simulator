<?php

use App\Domains\Medida\Medida;
use App\Domains\Evento\Eventos\AlterarGastoGovernamental;
use App\Domains\Evento\Eventos\AlterarGastoGovernamentalMensal;
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
        $medida1 = new Medida();
        $medida1->codigo_evento = AlterarGastoGovernamental::CODE;
        $medida1->nome = 'Aumentar Gasto Governamental';
        $medida1->titulo_noticia = 'Governo aumenta gastos nesse mês';
        $medida1->rodadas_para_excutar = 1;
        $medida1->tipo_noticia = Medida::TIPO_NOTICIA_ESTATAL;
        $medida1->texto_noticia = "{a/o} {ministro/a} {nomeMinistro} anunciou neste mês o aumento da verba destinado ao senado. 10 milhões de {moeda} serão destinados a gastos do governo.";
        $medida1->diferenca_financas = +10000000;
        $medida1->diferenca_popularidade_empresarios = -10;
        $medida1->diferenca_popularidade_trabalhadores = -5;
        $medida1->diferenca_popularidade_estado = +15;
        $medida1->save();
        Storage::putFileAs(
            'public/medidas/' . $medida1->id,
            new File(public_path('img/medidas_exemplos/aumentar_gastos_governamentais.jpg')),
            'aumentar_gastos_governamentais.jpg'
        );
        $medida1->url_imagem = 'medidas/' . $medida1->id . '/aumentar_gastos_governamentais.jpg';
        $medida1->update();

        $medida2 = new Medida();
        $medida2->codigo_evento = AlterarGastoGovernamental::CODE;
        $medida2->nome = 'Reduzir Gasto Governamental';
        $medida2->titulo_noticia = 'Governo reduz gastos nesse mês';
        $medida2->rodadas_para_excutar = 1;
        $medida2->tipo_noticia = Medida::TIPO_NOTICIA_LIBERAL;
        $medida2->texto_noticia = "{a/o} {ministro/a} {nomeMinistro} anunciou neste mês uma redução nos gastos governamentais, ainda não se sabe o porquê. O governo não contará com 10 milhões de {moeda} esse mês.";
        $medida2->diferenca_financas = -10000000;
        $medida2->diferenca_popularidade_empresarios = +10;
        $medida2->diferenca_popularidade_trabalhadores = +5;
        $medida2->diferenca_popularidade_estado = -15;
        $medida2->save();
        Storage::putFileAs(
            'public/medidas/' . $medida2->id,
            new File(public_path('img/medidas_exemplos/diminuir_gastos_governamentais.jpg')),
            'diminuir_gastos_governamentais.jpg'
        );
        $medida2->url_imagem = 'medidas/' . $medida2->id . '/diminuir_gastos_governamentais.jpg';
        $medida2->update();

        $medida3 = new Medida();
        $medida3->codigo_evento = AlterarGastoGovernamentalMensal::CODE;
        $medida3->nome = 'Aumentar Gasto Governamental Mensal';
        $medida3->titulo_noticia = 'Governo decide aumentar gastos mensais';
        $medida3->rodadas_para_excutar = 1;
        $medida3->tipo_noticia = Medida::TIPO_NOTICIA_ESTATAL;
        $medida3->texto_noticia = "{a/o} {ministro/a} {nomeMinistro} anunciou neste mês o aumento da verba gasta mensalmente, destinado ao governo. 500 mil {moeda} a mais serão destinados a gastos do governo todo mês.";
        $medida3->diferenca_financas = +500000;
        $medida3->diferenca_popularidade_empresarios = -10;
        $medida3->diferenca_popularidade_trabalhadores = -5;
        $medida3->diferenca_popularidade_estado = +15;
        $medida3->save();
        Storage::putFileAs(
            'public/medidas/' . $medida3->id,
            new File(public_path('img/medidas_exemplos/aumentar_gastos_governamentais.jpg')),
            'aumentar_gastos_governamentais.jpg'
        );
        $medida3->url_imagem = 'medidas/' . $medida3->id . '/aumentar_gastos_governamentais.jpg';
        $medida3->update();

        $medida4 = new Medida();
        $medida4->codigo_evento = AlterarGastoGovernamentalMensal::CODE;
        $medida4->nome = 'Reduzir Gasto Governamental Mensal';
        $medida4->titulo_noticia = 'Governo decide reduzir gastos mensais';
        $medida4->rodadas_para_excutar = 1;
        $medida4->tipo_noticia = Medida::TIPO_NOTICIA_LIBERAL;
        $medida4->texto_noticia = "{a/o} {ministro/a} {nomeMinistro} anunciou neste mês uma redução da verba gasta mensalmente pelo governo. 500 mil {moeda} serão retiradas dos cofres públicos todos os meses.";
        $medida4->diferenca_financas = -500000;
        $medida4->diferenca_popularidade_empresarios = +10;
        $medida4->diferenca_popularidade_trabalhadores = +5;
        $medida4->diferenca_popularidade_estado = -15;
        $medida4->save();
        Storage::putFileAs(
            'public/medidas/' . $medida4->id,
            new File(public_path('img/medidas_exemplos/diminuir_gastos_governamentais.jpg')),
            'diminuir_gastos_governamentais.jpg'
        );
        $medida4->url_imagem = 'medidas/' . $medida4->id . '/diminuir_gastos_governamentais.jpg';
        $medida4->update();

        $medida5 = new Medida();
        $medida5->codigo_evento = AlterarImpostoDeRenda::CODE;
        $medida5->nome = 'Aumentar Imposto de Renda';
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