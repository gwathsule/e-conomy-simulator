<?php

namespace App\Domains\Evento\Noticias;

use App\Support\Noticia;

class PrevisaoAnualPibNoticia extends Noticia
{
    protected function getUrlImagem($data): string
    {
        return asset('img/noticias/previsao_pib.jpg');
    }

    protected function getTexto($data): string
    {
        $acao = $data['aumento'] ? 'um aumento' : 'uma baixa';
        $texto = "Especialistas dizem que a previsão do PIB para o próximo ano é de $acao de {$data['previsao']}. ";
        if($data['aumento']) {
            $texto .= "Uma ótima notícia para o país";
        } else {
            $texto .= "Uma péssima notícia para o país";
        }
        return $texto;
    }

    protected function getRelevancia(): int
    {
        return self::RELEVANCIA_ALTA;
    }

    protected function regras(array $data): array
    {
        return [
            'aumento' => ['required', 'boolean'],
            'previsao' => ['required', 'string'],
        ];
    }
}