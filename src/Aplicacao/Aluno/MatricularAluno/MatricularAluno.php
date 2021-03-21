<?php


namespace Alura\Arquitetura\Aplicacao\Aluno\MatricularAluno;


use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\RepositorioAluno;

class MatricularAluno
{
    /**
     * @var RepositorioAluno
     */
    private RepositorioAluno $repositorioAluno;

    public function __construct(RepositorioAluno $repositorioAluno)
    {
        $this->repositorioAluno = $repositorioAluno;
    }

    public function executa(MatricularAlunoDto $dados)
    {
        $aluno = Aluno::comCpfNomeEEmail($dados->cpfAluno, $dados->nomeAluno, $dados->emailAluno);

        $this->repositorioAluno->adicionar($aluno);

    }
}