<?php

namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\AlunoNaoEncontrado;
use Alura\Arquitetura\Dominio\Aluno\RepositorioAluno;
use Alura\Arquitetura\Dominio\Cpf;
use Alura\Arquitetura\Infra\Erros\IncosistenciaDeDados;

class RepositorioDeAlunoEmMemoria implements RepositorioAluno
{

    /** @var Aluno[] */
    private $alunos;

    public function __construct()
    {
        $this->alunos = [];
    }

    public function adicionar(Aluno $aluno): void
    {
        $this->alunos[] = $aluno;
    }

    public function buscarPorCpf(Cpf $cpf): Aluno
    {
        $aluno = array_values(
            array_filter($this->alunos, fn (Aluno $aluno) => $aluno->cpf() == $cpf)
        );

        if (count($aluno) === 0) {
            throw new AlunoNaoEncontrado($cpf);
        }

        if (count($aluno) > 1) {
            throw new IncosistenciaDeDados("Inconsistencia de dados . Foram encontrados mais de um aluno com {$cpf}");
        }

        return $aluno[0];
    }

    /**
     * @inheritDoc
     */
    public function buscarTodos(): array
    {
        return $this->alunos;
    }
}