<?php

namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\AlunoNaoEncontrado;
use Alura\Arquitetura\Dominio\Aluno\RepositorioAluno;
use Alura\Arquitetura\Dominio\Aluno\Telefone;
use Alura\Arquitetura\Dominio\Cpf;
use Alura\Arquitetura\Dominio\Email;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use PDO;

class RepositorioDeAlunoComDoctrine implements RepositorioAluno
{

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function adicionar(Aluno $aluno): void
    {
        var_dump($aluno);
        $this->em->persist($aluno);
        $this->em->flush();
    }

    public function buscarPorCpf(Cpf $cpf): Aluno
    {
    }

    /**
     * @inheritDoc
     */
    public function buscarTodos(): array
    {

    }

    public function adicionaTelefoneAoAluno(Aluno $aluno, Telefone $telefone)
    {

    }
}