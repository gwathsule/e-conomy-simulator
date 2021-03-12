<?php

namespace App\Domains\Medida;

use App\Domains\Jogo\Jogo;
use App\Support\NoticiaBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $codigo_evento
 * @property string $nome
 * @property string $resumo
 * @property boolean $medida_imediata
 * @property string $url_imagem
 * @property string $tipo_noticia
 * @property string $texto_noticia
 * @property string $titulo_noticia
 * @property float $diferenca_financas
 * @property float $diferenca_popularidade_empresarios
 * @property float $diferenca_popularidade_trabalhadores
 * @property float $diferenca_popularidade_estado
 */
class Medida extends Model
{

    protected $table = 'medida';

    public function getAvatarNoticia()
    {
        return NoticiaBuilder::getAvatarNoticia($this->tipo_noticia);
    }

    public function getNomeJornal()
    {
        return NoticiaBuilder::getNomeJornal($this->tipo_noticia);
    }

    public function buildTituloNoticia(Jogo $jogo)
    {
        return NoticiaBuilder::buildText($this->titulo_noticia, $jogo);
    }

    public function buildTextoNoticia(Jogo $jogo)
    {
        return NoticiaBuilder::buildText($this->texto_noticia, $jogo);
    }

    public function getImagem(Jogo $jogo)
    {
        if(! is_null($this->url_imagem)) {
           return Storage::url($this->url_imagem);
        } else {
           if($jogo->genero == 'F') {
               return asset('img/medidas_exemplos/medida_padrao_m.jpg');
           } else {
               return asset('img/medidas_exemplos/medida_padrao_h.jpeg');
           }
        }
    }
}