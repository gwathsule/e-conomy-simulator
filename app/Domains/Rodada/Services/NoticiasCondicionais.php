<?php

namespace App\Domains\Rodada\Services;

use App\Domains\Jogo\Jogo;
use App\Support\NoticiaBuilder;

trait NoticiasCondicionais
{
    private function obterNoticiasCondicionais($novaRodada, $ultimaRodada, string $medida, Jogo $jogo) : array
    {
        $noticias = collect();
        $noticia = $this->novoMinistro($ultimaRodada, $jogo);
        if (!is_null($noticia)) {
            $noticias->add($noticia);
            return $noticias->toArray();
        }

        $noticia = $this->inflacaoTotal($novaRodada, $ultimaRodada, $medida, $jogo);
        if (!is_null($noticia)) {
            $noticias->add($noticia);
        }

        $noticia = $this->desemprego($novaRodada, $ultimaRodada, $medida, $jogo);
        if (!is_null($noticia)) {
            $noticias->add($noticia);
        }

        $noticia = $this->bs($novaRodada, $ultimaRodada, $medida, $jogo);
        if (!is_null($noticia)) {
            $noticias->add($noticia);
        }

        $noticia = $this->titulos($novaRodada, $ultimaRodada, $medida, $jogo);
        if (!is_null($noticia)) {
            $noticias->add($noticia);
        }
        if($noticias->count() == 0) {
            return [];
        }  else {
            return $noticias->toArray();
        }
    }

    private function novoMinistro($ultimaRodada, Jogo $jogo) {
        if( is_null($ultimaRodada)) {
            $titulo = "{nomeMinistro} estreia sua jornada no Ministério da Economia do {pais}.";
            $tipo = NoticiaBuilder::TIPO_NOTICIA_LIBERAL;
            $texto = "{nomeMinistro} foi anunciado no Ministério da Economia, assumirá após seu antecessor gerir muito mal a economia do país por 2 anos. Como se sairá nesses 2 ultimos anos restantes de mandato? Será que haverá outra demissão ou {a/o} {ministro/a} irá terminar o mandato?";
            $urlImagem = asset('img/noticias/inflacao_total.jpg');
            return NoticiaBuilder::buildNoticiaCondicional($tipo, $titulo, $texto, $urlImagem, '', $jogo);
        }
        return null;
    }

    private function inflacaoTotal($novaRodada, $ultimaRodada, string $medida, Jogo $jogo)
    {
        if ($medida == null) {
            return null;
        }
        if($novaRodada->inflacao_total - $ultimaRodada->inflacao_total >= 0.005 ) {//subiu 0.05%
            $titulo = "{nomeMinistro} parece não priorizar a saúde fiscal do {pais}.";
            $tipo = NoticiaBuilder::TIPO_NOTICIA_LIBERAL;
            $texto = "{a/o} {ministro/a} {nomeMinistro} tomou uma descisão inconsequente ({ultima_medida}). Ajudar é importante, mas manter o poder de compra é prioridade!";
            $urlImagem = asset('img/noticias/inflacao_total.jpg');
            return NoticiaBuilder::buildNoticiaCondicional($tipo, $titulo, $texto, $urlImagem, $medida, $jogo);
        }

        if($novaRodada->inflacao_total - $ultimaRodada->inflacao_total <= -0.005 ) {//caiu 0.05%
            $titulo = "{nomeMinistro} tenta controlar a inflação.";
            $tipo = NoticiaBuilder::TIPO_NOTICIA_LIBERAL;
            $texto = "{a/o} {ministro/a} {nomeMinistro} parece saber o que faz, sua última descisão ({ultima_medida}) fez as previsões para ano apotarem uma redução na inflação. Nosso {moeda} está saudável!";
            $urlImagem = asset('img/noticias/inflacao_total.jpg');
            return NoticiaBuilder::buildNoticiaCondicional($tipo, $titulo, $texto, $urlImagem, $medida, $jogo);
        }
        return null;
    }

    private function desemprego($novaRodada, $ultimaRodada, string $medida, Jogo $jogo)
    {
        if( $novaRodada->desemprego - $ultimaRodada->desemprego >= 0.002 ) { //aumentou 0,02%
            $titulo = "{nomeMinistro} está perdido? Só a inciativa privada pode ajudar!";
            $tipo = NoticiaBuilder::TIPO_NOTICIA_LIBERAL;
            $texto = "{a/o} {ministro/a} {nomeMinistro} fez a única coisa que não deveria ({ultima_medida}), o recuo da nossa economia pode ser fatal! Precisamos de reformas urgentes!.";
            $urlImagem = asset('img/noticias/inflacao_total.jpg');
            return NoticiaBuilder::buildNoticiaCondicional($tipo, $titulo, $texto, $urlImagem, $medida, $jogo);
        }

        if( $novaRodada->desemprego - $ultimaRodada->desemprego <= -0.002 ) { //caiu 0,02%
            $titulo = "O povo de carteira assinada, parabéns {ministro/a}... Será que dura muito?";
            $tipo = NoticiaBuilder::TIPO_NOTICIA_ESTATAL;
            $texto = "{a/o} {ministro/a} {nomeMinistro} ao ({ultima_medida}) parece ter acertado. Se continuarmos assim o pleno emprego pode ser realidade! Mas ainda sim estamos atentos...";
            $urlImagem = asset('img/noticias/inflacao_total.jpg');
            return NoticiaBuilder::buildNoticiaCondicional($tipo, $titulo, $texto, $urlImagem, $medida, $jogo);
        }
        return null;
    }

    private function bs($novaRodada, $ultimaRodada, string $medida, Jogo $jogo)
    {
        if( $novaRodada->bs - $ultimaRodada->bs >= 15000 ) { //aumentou
            $titulo = "{nomeMinistro} fazendo o que sempre dissemos";
            $tipo = NoticiaBuilder::TIPO_NOTICIA_LIBERAL;
            $texto = "{nomeMinistro} está querendo equilibrar as contas, o seu sucesso como {ministro/a} do {pais} pode ser definido em seus próximos passos com esse orçamento.";
            $urlImagem = asset('img/noticias/inflacao_total.jpg');
            return NoticiaBuilder::buildNoticiaCondicional($tipo, $titulo, $texto, $urlImagem, $medida, $jogo);
        }

        if( $novaRodada->bs - $ultimaRodada->bs <= -15000 ) { //diminuiu
            $titulo = "{nomeMinistro} pode ficar sem recursos";
            $tipo = NoticiaBuilder::TIPO_NOTICIA_ESTATAL;
            $texto = "Se {a/o} {ministro/a} {nomeMinistro} não agir imediatamente pode ficar sem recursos para manter os programas do governo do {pais}. Nessas situações o mais pobre sempre paga a conta...";
            $urlImagem = asset('img/noticias/inflacao_total.jpg');
            return NoticiaBuilder::buildNoticiaCondicional($tipo, $titulo, $texto, $urlImagem, $medida, $jogo);
        }
        return null;
    }

    private function titulos($novaRodada, $ultimaRodada, string $medida, Jogo $jogo)
    {
        if( $novaRodada->titulos - $ultimaRodada->titulos >= 15000 ) { //aumentou
            $titulo = "{nomeMinistro} conhece o nosso endividamento interno?";
            $tipo = NoticiaBuilder::TIPO_NOTICIA_ESTATAL;
            $texto = "{a/o} {ministro/a} {nomeMinistro} tornou os rentistas mais felizes ({ultima_medida}), não sei quais são seus planos, mas se isso se refletir em políticas públicas de verdade, não vou criticar.";
            $urlImagem = asset('img/noticias/inflacao_total.jpg');
            return NoticiaBuilder::buildNoticiaCondicional($tipo, $titulo, $texto, $urlImagem, $medida, $jogo);
        }

        if( $novaRodada->titulos - $ultimaRodada->titulos <= -15000 ) {
            $titulo = "{nomeMinistro} trás mais liquidez ao mercado.";
            $tipo = NoticiaBuilder::TIPO_NOTICIA_LIBERAL;
            $texto = "{a/o} {ministro/a} {nomeMinistro} pode estar acenando para o mercado, não vou me animar agora, mas talvez ele saiba o que está fazendo.";
            $urlImagem = asset('img/noticias/inflacao_total.jpg');
            return NoticiaBuilder::buildNoticiaCondicional($tipo, $titulo, $texto, $urlImagem, $medida, $jogo);
        }
        return null;
    }
}