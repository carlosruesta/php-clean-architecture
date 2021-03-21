<?php

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Infra\Aluno\RepositorioDeAlunoComPdo;
use Alura\Arquitetura\Infra\Persistencia\CriadorConexaoPdo;

require_once 'vendor/autoload.php';

$pdo = CriadorConexaoPdo::criaConexao();

$repositorioDeAlunoComPdo = new RepositorioDeAlunoComPdo($pdo);

$aluno1 = Aluno::comCpfNomeEEmail('222.827.708-70', 'Carlos', 'carlos@carlos.com');
$aluno1->adicionarTelefone('19', '888752112');
$aluno1->adicionarTelefone('19', '999421112');

$repositorioDeAlunoComPdo->adicionar($aluno1);

echo "Aluno {$aluno1->nome()} inserido com sucesso";