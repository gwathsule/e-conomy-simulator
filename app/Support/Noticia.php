<?php

namespace App\Support;

use App\Domains\Medida\Medida;

class Noticia
{
    /**
     * @var Medida $medida
     */
    public $medida;

    public function __construct(Medida $medida)
    {
        $this->medida = $medida;
    }

    private function buildText() : string
    {
        return $this->medida->texto_noticia;
    }

    /**
     * @param array $data
     * @return array
     */
    public function buidDataNoticia()
    {
        return [
            'url_imagem' => $this->medida->url_imagem,
            'text' => $this->buildText(),
            'tipo' => $this->medida->tipo_noticia,
        ];
    }
}