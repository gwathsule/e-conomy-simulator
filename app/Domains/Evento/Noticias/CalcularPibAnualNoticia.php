<?php

namespace App\Domains\Evento\Noticias;

use App\Support\Noticia;

class CalcularPibAnualNoticia extends Noticia
{
    protected function getUrlImagem($data): string
    {
        return asset('img/noticias/previsao_pib.jpg');
    }

    protected function getTexto($data): string
    {
        $texto = "";
        if($data['aumentou']) {
            $texto .= "O PIB do pais aumentou em {$data['porcentagem_aumento']}% neste último ano de governo. " .
                   "Isso mostra que o governo vem realizando um bom trabalho apesar dos apesares. " ;
        } else {
            $texto .= "O PIB do pais caiu em {$data['porcentagem_aumento']}% neste último ano de governo. " .
                "Resultado de um ano em que o governo cometeu erros atrás de erros. Esperamos melhoras nesse próximo ano. ";
        }
        $texto .= "O PIB no anterior foi de $ {$data['valor_antigo']} o novo valor é de $ {$data['valor_novo']}. ";
        return $texto;
    }

    protected function getRelevancia(): int
    {
        return self::RELEVANCIA_ALTA;
    }

    protected function regras(array $data): array
    {
        return [
            'valor_antigo' => ['required'],
            'valor_novo' => ['required'],
            'porcentagem_aumento' => ['required'],
            'aumentou' => ['required', 'boolean'],
        ];
    }
}