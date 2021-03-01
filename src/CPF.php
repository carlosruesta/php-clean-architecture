<?php

namespace Alura\Arquitetura;

class CPF
{
    private string $cpf;

    public function __construct(string $cpf)
    {
        $this->validaCpf($cpf);

        $this->cpf = $cpf;
    }

    public function __toString()
    {
        return $this->formataCpf($this->cpf);
    }

    private function formataCpf(string $cpf)
    {
        return 'adiciona pontos e trazos conforme necessário';
    }

    private function validaCpf(string $cpf)
    {
        // aplicar a regra de validação de numero de CPF
        if ($this->cpf === '') {
            throw new \Exception("CPF inválido");
        }
    }
}