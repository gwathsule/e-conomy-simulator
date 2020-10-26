<?php

namespace App\Domains\Evento\Noticias;

use App\Support\Noticia;

class FazerTransferenciaGeralNoticia extends Noticia
{
    protected function getUrlImagem($data): string
    {
        return asset('img/noticias/previsao_pib.jpg');
    }

    protected function getTexto($data): string
    {
        $texto = "O governo aumentou o Bolsa Brasil em R$ {$data['valor_transferencia']}. " .
                   "Isso mostra que o governo vem realizando um bom trabalho apesar dos apesares. " .
                   "Os impostos atuais são R$ {$data['imposto_atual']}" .
                   "e as transferências do governo (esmolas) são R$ {$data['transferencias_atual']}.";
        return $texto;
    }

    protected function getRelevancia(): int
    {
        return self::RELEVANCIA_ALTA;
    }

    protected function regras(array $data): array
    {
        return [
            'valor_transferencia' => ['required'],
        ];
    }
}