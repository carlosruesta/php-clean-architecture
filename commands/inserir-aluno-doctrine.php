<?php

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Infra\Aluno\RepositorioDeAlunoComDoctrine;
use Alura\Arquitetura\Infra\Persistencia\EntityManagerCreator;
use Doctrine\ORM\EntityManager;

require_once 'vendor/autoload.php';

/** @var EntityManager $em */
$em = EntityManagerCreator::criaEntityManager();

$repositorioDeAlunoComDoctrine = new RepositorioDeAlunoComDoctrine($em);

$aluno1 = Aluno::comCpfNomeEEmail('222.827.708-71', 'Carlos', 'carlos@carlos.com');
$aluno1->adicionarTelefone('19', '888752113');
$aluno1->adicionarTelefone('19', '999421114');

$repositorioDeAlunoComDoctrine->adicionar($aluno1);

echo "Aluno {$aluno1->nome()} inserido com sucesso";