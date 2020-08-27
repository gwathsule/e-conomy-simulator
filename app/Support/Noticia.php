<?php

namespace App\Support;

use App\Support\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

abstract class Noticia
{
    public const RELEVANCIA_ALTA = 3;
    public const RELEVANCIA_MEDIA = 2;
    public const RELEVANCIA_BAIXA = 1;

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    protected abstract function getUrlImagem($data) : string;

    protected abstract function getTexto($data) : string;

    protected abstract function getRelevancia() : int;

    /**
     * seta as regras que precisa para mensagem compilar
     * @param array $data
     * @return array
     */
    protected abstract function regras(array $data) : array;

    /**
     * @param array $data
     * @return false|string
     * @throws ValidationException
     */
    public function buidJsonNoticia()
    {
        $data = $this->data;
        $validator = Validator::make(
            $data,
            $this->regras($data)
        );
        try {
            $validator->validate();
        } catch (ValidationException $e) {
            throw new ValidationException($e->errors(), $e->getMessage());
        }

        $noticia = [
            'url_imagem' => $this->getUrlImagem($data),
            'text' => $this->getTexto($data),
            'relevancia' => $this->getRelevancia(),
        ];
        return json_encode($noticia);
    }
}