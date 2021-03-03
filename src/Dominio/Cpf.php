<?php

namespace Alura\Arquitetura\Dominio;

class Cpf
{
    private string $cpf;

    public function __construct(string $cpf)
    {
        // usando self-encapsulation
        $this->setCpf($cpf);
    }

    // autoencapsulamento ou self-encapsulation
    // método privado para definir preencher a propriedade
    private function setCpf(string $cpf)
    {
        // Clause Guard
        // Cláusula de guarda, Condição de guarda, Cláusula de prevenção, Cláusula de proteção
        // Validação de pré-condições para execução do código
        $this->validaCpf($cpf);

        $this->cpf = $cpf;
    }

    public function __toString()
    {
        return $this->cpf;
    }

    public function obtemCpfSoNumeros(string $cpf)
    {
        // tirar os pontos e trazos
        return $this->cpf;
    }

    private function validaCpf(string $cpf)
    {
        $opcoes = [
            'options' => [
                'regexp' => '/\d{3}\.\d{3}\.\d{3}\-\d{2}/',
            ],
        ];
        if (filter_var($cpf, FILTER_VALIDATE_REGEXP, $opcoes) === false) {
            throw new \InvalidArgumentException('Número do CPF fornecido em formato inválido');
        }

        // aplicar a regra de validação de numero de CPF
    }
}