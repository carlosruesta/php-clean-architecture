<?php

namespace Alura\Arquitetura;

class Aluno
{
    // O identificador do aluno é o CPF. Essa é uma regra de negócio
    private CPF $cpf;
    private string $nome;
    private Email $email;
}