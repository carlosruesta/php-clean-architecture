<?php

namespace Alura\Arquitetura\Dominio\Aluno;

use Alura\Arquitetura\Dominio\Cpf;
use Alura\Arquitetura\Dominio\Email;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Aluno
{
    // O identificador do aluno é o CPF. Essa é uma regra de negócio
    private Cpf $cpf;
    private string $nome;
    private Email $email;
    private Collection $telefones;

    public function __construct(Cpf $cpf, string $nome, Email $email)
    {
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->email = $email;
        $this->telefones = new ArrayCollection();
    }

    // Usando named-constructor
    public static function comCpfNomeEEmail(string $cpf, string $nome, string $email)
    {
        return new Aluno(new Cpf($cpf), $nome, new Email($email));
    }

    public function adicionarTelefone(string $ddd, string $numero)
    {
        $this->telefones[] = new Telefone($this->cpf, $ddd, $numero);
        return $this;
    }

    public function cpf(): string
    {
        return $this->cpf;
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function email(): string
    {
        return $this->email;
    }

    /** @return ArrayCollection */
    public function telefones(): array
    {
        return $this->telefones;
    }
}