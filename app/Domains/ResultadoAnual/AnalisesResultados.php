<?php

namespace App\Domains\ResultadoAnual;

trait AnalisesResultados
{

    public function analisePib(int $ano, ResultadoAnual $atual, ResultadoAnual $ultimo) {
        $diferenca = (($atual->pib / $ultimo->pib) - 1) * 100;
        if($ano === 1) {
            if ($diferenca > 3) {
                return $this->buildResporta(
                    $diferenca,
                    "Você conseguiu superar a meta de PIB para esse ano! Parabéns!"
                );
            } else {
                return $this->buildResporta(
                    $diferenca,
                    "Sua gestão ficou abaixo da meta do PIB! Se não melhorar ano que vem, seu tempo aqui será reconhecido como uma má gestão!"
                );
            }
        }
        if($ano === 2) {
            if ($diferenca > 3) {
                return $this->buildResporta(
                    $diferenca,
                    "Você conseguiu superar a meta média do PIB nos últimos 2 anos! Parabéns, você alcançou mérito máximo, sua gestão será lembrada por décadas!"
                );
            } else {
                return $this->buildResporta(
                    $diferenca,
                    "Provavelmente se o governo atual ganhar as eleições desse ano, você não voltará ao cargo."
                );
            }
        }
    }

    public function analisePibInvestimentoRealizado(int $ano, ResultadoAnual $atual, ResultadoAnual $ultimo) {
        $diferenca = (($atual->pib_investimento_realizado / $ultimo->pib_investimento_realizado) - 1) * 100;
        if($ano === 1) {
            if ($diferenca > 0) {
                return $this->buildResporta(
                    $diferenca,
                    "Os investimentos melhoraram, provavelmente seu aumento de liquidez deu certo, isso pode gerar um PIB interessante se bem administrado!"
                );
            } else {
                return $this->buildResporta(
                    $diferenca,
                    "Os investimentos pioraram, talvez seja necessário compensar com alguma medida para aquecer mercado, prover liquidez ou gerar gastos governamentais para não reduzir o PIB!"
                );
            }
        }
        if($ano === 2) {
            if ($diferenca > 0) {
                return $this->buildResporta(
                    $diferenca,
                    "Os investimentos melhoraram, provavelmente seu aumento de liquidez deu certo."
                );
            } else {
                return $this->buildResporta(
                    $diferenca,
                    "Os investimentos pioraram, o mercado não foi muito movimentado no seu mandato."
                );
            }
        }
    }

    public function analiseGastosGovernamentais(int $ano, ResultadoAnual $atual, ResultadoAnual $ultimo) {
        $diferenca = (($atual->gastos_governamentais / $ultimo->gastos_governamentais) - 1) * 100;
        if($ano === 1) {
            if ($diferenca > 0) {
                return $this->buildResporta(
                    $diferenca,
                    "Você aumentou os gastos governamentais, isso pode gerar mais consumo e impactar no PIB, mas tome cuidado pra não exceder o seu orçamento."
                );
            } else {
                return $this->buildResporta(
                    $diferenca,
                    "Você reduziu os gastos governamentais, isso pode ser efetivo para economizar, mas não se esqueça das políticas sociais efetivas e o decréscimo do PIB gerado."
                );
            }
        }
        if($ano === 2) {
            if ($diferenca > 0) {
                return $this->buildResporta(
                    $diferenca,
                    "Os investimentos melhoraram, provavelmente seu aumento de liquidez deu certo."
                );
            } else {
                return $this->buildResporta(
                    $diferenca,
                    "Os investimentos pioraram, o mercado não foi muito movimentado no seu mandato."
                );
            }
        }
    }

    public function analiseTransferencias(int $ano, ResultadoAnual $atual, ResultadoAnual $ultimo) {
        $diferenca = (($atual->transferencias / $ultimo->transferencias) - 1) * 100;
        if($ano === 1) {
            if ($diferenca > 0) {
                return $this->buildResporta(
                    $diferenca,
                    "Você aumentou as transferências, bem provável que a população esteja feliz com essas medidas, além disso você está ajudando a manter o mercado aquecido."
                );
            } else {
                return $this->buildResporta(
                    $diferenca,
                    "Você abaixou as transferências, pode ser que tenha economizado caixa com isso, mas a população pode não estar satisfeita e o mercado menos aquecido."
                );
            }
        }
        if($ano === 2) {
            if ($diferenca > 0) {
                return $this->buildResporta(
                    $diferenca,
                    "Você aumentou as transferências, bem provável que a população esteja feliz com essas medidas, além disso você está ajudando a manter o mercado aquecido."
                );
            } else {
                return $this->buildResporta(
                    $diferenca,
                    "Você abaixou as transferências, pode ser que tenha economizado caixa com isso, mas a população pode não estar satisfeita e o mercado menos aquecido."
                );
            }
        }
    }

    public function analiseImpostos(int $ano, ResultadoAnual $atual, ResultadoAnual $ultimo) {
        $diferenca = (($atual->impostos / $ultimo->impostos) - 1) * 100;
        if($ano === 1) {
            if ($diferenca > 0) {
                return $this->buildResporta(
                    $diferenca,
                    "Você aumentou os impostos, com boas políticas públicas isso pode compensar no PIB, mas tome cuidado!"
                );
            } else {
                return $this->buildResporta(
                    $diferenca,
                    "Você reduziu os impostos, isso pode trazer mais produtividade para os investimentos, mas cuidado para ficar sem caixa para as políticas públicas!"
                );
            }
        }
        if($ano === 2) {
            if ($diferenca > 0) {
                return $this->buildResporta(
                    $diferenca,
                    "Você aumentou os impostos, com boas políticas públicas isso pode compensar no PIB, mas tome cuidado!"
                );
            } else {
                return $this->buildResporta(
                    $diferenca,
                    "Você reduziu os impostos, isso pode trazer mais produtividade para os investimentos, mas cuidado para ficar sem caixa para as políticas públicas!"
                );
            }
        }
    }

    public function analiseBs(int $ano, ResultadoAnual $atual, ResultadoAnual $ultimo) {
        $diferenca = (($atual->bs / $ultimo->bs) - 1) * 100;
        if($ano === 1) {
            if ($diferenca > 0) {
                return $this->buildResporta(
                    $diferenca,
                    "O orçamento do país melhorou, você conseguiu deixar uma margem mais interessante para o ano que vem, apesar de talvez ter faltado políticas públicas."
                );
            } else {
                return $this->buildResporta(
                    $diferenca,
                    "É... O orçamento do país piorou, talvez você tenha que melhorar isso para ter sucesso ano que vem, apesar de talvez significar que tenham sido feitas boas políticas públicas."
                );
            }
        }
        if($ano === 2) {
            if ($diferenca > 0) {
                return $this->buildResporta(
                    $diferenca,
                    "O orçamento do país melhorou, você conseguiu deixar uma margem mais interessante para o proximo governo, apesar de talvez ter faltado políticas públicas."
                );
            } else {
                return $this->buildResporta(
                    $diferenca,
                    "É... O orçamento do país piorou, apesar de talvez significar que tenham sido feitas boas políticas públicas."
                );
            }
        }
    }

    public function analiseCaixa(int $ano, ResultadoAnual $atual, ResultadoAnual $ultimo) {
        $diferenca = (($atual->caixa / $ultimo->caixa) - 1) * 100;
        if($ano === 1) {
            if ($diferenca > 20) {
                return $this->buildResporta(
                    $diferenca,
                    "Você conseguiu aumentar muito o caixa! Só tome cuidado pra não economizar demais e esquecer das políticas públicas."
                );
            } else if ($diferenca > 0) {
                return $this->buildResporta(
                    $diferenca,
                    "Você conseguiu aumentar o caixa, isso é bom, pois permite o pagamento da dívida interna de forma mais confortável"
                );
            } else if($diferenca <= 20) {
                return $this->buildResporta(
                    $diferenca,
                    "Você reduziu muito o caixa, cuidado pra isso não representar a falência do governo, os juros e a dívida pública precisa ser paga!"
                );
            } else if($diferenca <= 0) {
                return $this->buildResporta(
                    $diferenca,
                    "Você gastou muito e o caixa se reduziu ou ficou na mesma, cuidado pra não ficar sem dinheiro para quitar os títulos da dívida pública interna!"
                );
            }
        }
        if($ano === 2) {
            if ($diferenca > 20) {
                return $this->buildResporta(
                    $diferenca,
                    "Você conseguiu aumentar muito o caixa! Seu mandato foi ótimo para a saúde financeira do Governo."
                );
            } else if ($diferenca > 0) {
                return $this->buildResporta(
                    $diferenca,
                    "Você conseguiu aumentar o caixa, isso é bom, pois permite o pagamento da dívida interna de forma mais confortável"
                );
            } else if($diferenca <= 20) {
                return $this->buildResporta(
                    $diferenca,
                    "Você reduziu muito o caixa, pegou a casa desarrumada e a demoliu! Com certeza será alvo de investigações futuras!"
                );
            } else if($diferenca <= 0) {
                return $this->buildResporta(
                    $diferenca,
                    "Você gastou muito e o caixa se reduziu ou ficou na mesma, cuidado pra não ficar sem dinheiro para quitar os títulos da dívida pública interna!"
                );
            }
        }
    }

    public function analiseDividaTotal(int $ano, ResultadoAnual $atual, ResultadoAnual $ultimo) {
        $diferenca = (($atual->divida_total / $ultimo->divida_total) - 1) * 100;
        if ($diferenca < -30) {
            return $this->buildResporta(
                $diferenca,
                "Parabéns! A dívida pública interna reduziu consideravelmente! Certamente a sua ação de baixar a Taxa de Juros foi bem eficaz, pois seu mais liquidez ao mercado e elevou os investimentos."
            );
        } else if ($diferenca < 0) {
            return $this->buildResporta(
                $diferenca,
                "Você reduziu a dívida pública interna, isso é importante para a saúde financeira do país e dar mais liquidez ao mercado."
            );
        } else if ($diferenca > 0) {
            return $this->buildResporta(
                $diferenca,
                "A dívida pública interna aumentou. Se esse dinheiro for bem utilizado pode ser que vala a pena, mas seja cauteloso"
            );
        } else if ($diferenca > 25) {
            return $this->buildResporta(
                $diferenca,
                "Você aumentou a dívida pública consideravelmente! Talvez se torne quase irreversível e apenas a taxa de juros pode não ser o suficiente solucionar!"
            );
        }
    }

    public function analiseInflacaoTotal(int $ano, ResultadoAnual $atual, ResultadoAnual $ultimo) {
        $diferenca = ($atual->inflacao_total - $ultimo->inflacao_total) * 100;

        if ($diferenca < -0.5) {
            return $this->buildResporta(
                $diferenca,
                "Fantástico! Você controlou bem a inflação!"
            );
        }
        if ($diferenca < 0) {
            return $this->buildResporta(
                $diferenca,
                "Você controlou a inflação!"
            );
        }
        if ($diferenca < 0.5) {
            return $this->buildResporta(
                $diferenca,
                "Você não controlou bem a inflação, o poder de compra é extremamente importante para um governo de sucesso!"
            );
        }
        return $this->buildResporta(
            $diferenca,
            "O poder de compra se deteriorou! Os preços estão indo para o espaço!"
        );
    }

    public function analiseDesemprego(int $ano, ResultadoAnual $atual, ResultadoAnual $ultimo) {
        $diferenca = ($atual->desemprego - $ultimo->desemprego) * 100;
        if ($diferenca < -0.5) {
            return $this->buildResporta(
                $diferenca,
                "Fantástico! Você reduziu bem o desemprego!"
            );
        }
        if ($diferenca < 0) {
            return $this->buildResporta(
                $diferenca,
                "Você reduziu o desemprego!"
            );
        }
        if ($diferenca < 0.5) {
            return $this->buildResporta(
                $diferenca,
                "A sua criação não de empregos não funcionou, o povo precisa trabalhar para gerar renda e aumentar o PIB!"
            );
        }
        return $this->buildResporta(
            $diferenca,
            "O desemprego aumentou muito! As pessoas estão desesperadas!"
        );
    }

    public function analisePopularidadeEmpresarios(int $ano, ResultadoAnual $atual, ResultadoAnual $ultimo) {
        $diferenca = ($atual->popularidade_empresarios - $ultimo->popularidade_empresarios) * 100;
        if ($diferenca >= 10 && $diferenca <= 20) {
            return $this->buildResporta(
                $diferenca,
                "Os empresários te veem com bons olhos!"
            );
        }
        if ($diferenca > 20) {
            return $this->buildResporta(
                $diferenca,
                "Parabéns! Seu nome é que mais circula na Bolsa de Valores, você é a entidade mais cultuada na Faria Lima!"
            );
        }
        return $this->buildResporta(
            $diferenca,
            "Cuidado, a entidade 'mercado' não está muito agradada com o seu trabalho! Não deixe que tenham motivos para 'mexer os pauzinhos'..."
        );
    }

    public function analisePopularidadeTrabalhadores(int $ano, ResultadoAnual $atual, ResultadoAnual $ultimo) {
        $diferenca = ($atual->popularidade_trabalhadores - $ultimo->popularidade_trabalhadores) * 100;
        if ($diferenca > 10 && $diferenca <= 20) {
            return $this->buildResporta(
                $diferenca,
                "Você priorizou as medidas que beneficiam a população!"
            );
        }
        if ($diferenca > 20) {
            return $this->buildResporta(
                $diferenca,
                "Parabéns! O povo te ama, cuidado para o presidente não ficar com ciúmes rs..."
            );
        }
        return $this->buildResporta(
            $diferenca,
            "Cuidado, a população não gosta muito de você, não deixe isso se deteriorar!"
        );
    }

    public function analisePopularidadeEstado(int $ano, ResultadoAnual $atual, ResultadoAnual $ultimo) {
        $diferenca = ($atual->popularidade_estado - $ultimo->popularidade_estado) * 100;
        if ($diferenca > 10 && $diferenca <= 20) {
            return $this->buildResporta(
                $diferenca,
                "Você priorizou investimentos estatais!"
            );
        }
        if ($diferenca > 20) {
            return $this->buildResporta(
                $diferenca,
                "Parabéns! O setor público te adora, eles nunca foram tão bem tratados como na sua gestão!"
            );
        }
        return $this->buildResporta(
            $diferenca,
            "Cuidado, o setor público não gosta muito de você, não deixe isso se deteriorar!"
        );
    }

    private function buildResporta(float $diferenca, string $analise): array
    {
        return [
            'diferenca' => $diferenca,
            'analise' => $analise,
        ];
    }
}