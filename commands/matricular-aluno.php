<?php

require_once 'vendor/autoload.php';

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Infra\Aluno\RepositorioDeAlunoEmMemoria;

$cpf = $argv[1];
$nome = $argv[2];
$email = $argv[3];
$ddd = $argv[4];
$numero = $argv[5];

$repositorioDeAlunoComPdo = new RepositorioDeAlunoEmMemoria();

$aluno1 = Aluno::comCpfNomeEEmail('222.827.708-70', 'Carlos', 'carlos@carlos.com')
                ->adicionarTelefone('19', '888752112');

$repositorioDeAlunoComPdo->adicionar($aluno1);

echo "Aluno {$aluno1->nome()} inserido com sucesso";