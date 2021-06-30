<?php

namespace App\Domains\Rodada\Services;

use App\Domains\Jogo\Jogo;
use App\Domains\Rodada\Rodada;
use App\Support\NoticiaBuilder;

trait NoticiasEndGame
{
    private function obterNoticiasVitoria(Rodada $novaRodada, Jogo $jogo) : array
    {
        $noticias = collect();
        $noticia = $this->vitoria($novaRodada, $jogo);
        $noticias->add($noticia);
        return $noticias->toArray();
    }

    private function obterNoticiasDerrota(Rodada $novaRodada, Jogo $jogo) : array
    {
        $noticias = collect();
        $noticia = $this->caixaNegativo($novaRodada, $jogo);
        if (!is_null($noticia)) {
            $noticias->add($noticia);
            return $noticias->toArray();
        }

        $noticias = collect();
        $noticia = $this->popularidadeBaixaComSetorPrivado($novaRodada, $jogo);
        if (!is_null($noticia)) {
            $noticias->add($noticia);
            return $noticias->toArray();
        }

        $noticias = collect();
        $noticia = $this->popularidadeBaixaComEstado($novaRodada, $jogo);
        if (!is_null($noticia)) {
            $noticias->add($noticia);
            return $noticias->toArray();
        }

        $noticias = collect();
        $noticia = $this->popularidadeBaixaComClasseTrabalhadora($novaRodada, $jogo);
        if (!is_null($noticia)) {
            $noticias->add($noticia);
            return $noticias->toArray();
        }
    }

    private function vitoria(Rodada $rodada, Jogo $jogo){
        if($rodada->caixa >= 0) {
            $titulo = "O mandato acabou, e quem diria, {nomeMinistro} segurous as pontas";
            $tipo = NoticiaBuilder::TIPO_NOTICIA_LIBERAL;
            $texto = "O mandato de {nomeMinistro} chegou ao fim, e mesmo sob olhares de desconfiança {o/a} ministr{o/a} se mostrou forte perante as adversidades e conseguiu finalizar o mandato mantendo as finanças em ordem. Clique em Relatórios Anuais para saber a avaliação do mandato";
            $urlImagem = asset('img/noticias/aplausos.jpg');
            return NoticiaBuilder::buildNoticiaCondicional($tipo, $titulo, $texto, $urlImagem, '', $jogo);
        }
        return null;
    }

    private function caixaNegativo(Rodada $rodada, Jogo $jogo){
        if($rodada->caixa < 0) {
            $titulo = "Extra: O país foi a falência, {o/a} culpad{o/a} de tudo isso: {nomeMinistro}.";
            $tipo = NoticiaBuilder::TIPO_NOTICIA_LIBERAL;
            $texto = "O país faliu e todos estão procurando pel{o/a} culpad{o/a}: {nomeMinistro}! Caos social, bancos roubando dinheiro e fugindo para o exterior, as pessoas estão pegando em armas para tomar o controle das instituições e o presidente está se protegendo com o exército ao seu lado! Não há mais estado para gerir e salve-se quem puder!";
            $urlImagem = asset('img/noticias/caos_social.jpg');
            return NoticiaBuilder::buildNoticiaCondicional($tipo, $titulo, $texto, $urlImagem, '', $jogo);
        }
        return null;
    }

    private function popularidadeBaixaComSetorPrivado(Rodada $rodada, Jogo $jogo){
        if($rodada->popularidade_empresarios <= 0) {
            $titulo = "Por pressão do setor privado, {nomeMinistro} é demitid{o/a} do Ministério da Economia.";
            $tipo = NoticiaBuilder::TIPO_NOTICIA_LIBERAL;
            $texto = "A tensão com os grandes empresários cresceu muito! \"Empresas morrem!\": é o grito de guerra que mais se ouve. No último domingo uma grande manifestação foi realizada com a liderança do MLN e com um ganso de borracha gigante em cada capital, além pessoas vestindo a camisa da seleção do país, foi ridículo, mas o suficiente para o presidente decidir pela sua demissão…";
            $urlImagem = asset('img/noticias/prejuizo_empresa.jpg');
            return NoticiaBuilder::buildNoticiaCondicional($tipo, $titulo, $texto, $urlImagem, '', $jogo);
        }
        return null;
    }

    private function popularidadeBaixaComEstado(Rodada $rodada, Jogo $jogo){
        if($rodada->popularidade_trabalhadores <= 0) {
            $titulo = "Presidente perde a cabeça com {nomeMinistro} e {o/a} demite.";
            $tipo = NoticiaBuilder::TIPO_NOTICIA_ESTATAL;
            $texto = "A tensão com os sindicalistas e movimentos sociais cresceu muito! “O Estado morre!”: é o grito que mais se ouve. As mudanças estruturais fizeram o Estado enfraquecer e ruir, os direitos mais básicos não estão sendo garantidos, os burocratas e carteleiros descaradamente pedem a sua cabeça do alto de seus montes de dólar, terrível, mas o suficiente para o presidente decidir pela sua demissão…";
            $urlImagem = asset('img/noticias/demissao.jpg');
            return NoticiaBuilder::buildNoticiaCondicional($tipo, $titulo, $texto, $urlImagem, '', $jogo);
        }
        return null;
    }

    private function popularidadeBaixaComClasseTrabalhadora(Rodada $rodada, Jogo $jogo){
        if($rodada->popularidade_trabalhadores <= 0) {
            $titulo = "A voz do povo se provou maior que {nomeMinistro}, que agora é ex-ministr{o/a}.";
            $tipo = NoticiaBuilder::TIPO_NOTICIA_ESTATAL;
            $texto = "A tensão com povo cresceu muito! “Pobres morrem!”: é o grito de guerras que mais se ouve. Manifestações estouraram por todo o país devido ao sucatamento dos serviços públicos e crescimento da pobreza, incluindo os grandes movimentos nas capitais liderados pelos jovens Cabeças Raspadas, bizarro, mas o suficiente para o presidente decidir pela sua demissão…";
            $urlImagem = asset('img/noticias/greve_trabalhadores.png');
            return NoticiaBuilder::buildNoticiaCondicional($tipo, $titulo, $texto, $urlImagem, '', $jogo);
        }
        return null;
    }
}