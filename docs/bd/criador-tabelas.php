<?php

use Alura\Arquitetura\Infra\Persistencia\CriadorConexaoPdo;

require_once 'vendor/autoload.php';

$conexaoPdo = CriadorConexaoPdo::criaConexao();

$conexaoPdo->exec("
    CREATE TABLE alunos (
        cpf TEXT PRIMARY KEY,
        nome TEXT,
        email TEXT
    );    
");

$conexaoPdo->exec("
    CREATE TABLE telefones (
        ddd TEXT,
        numero TEXT,
        cpf_aluno TEXT,
        PRIMARY KEY (ddd, numero),
        FOREIGN KEY(cpf_aluno) REFERENCES alunos(cpf)
    );    
");

$conexaoPdo->exec("
    CREATE TABLE indicacoes (
        cpf_indicante TEXT,
        cpf_indicado TEXT,
        data_indicacao TEXT,
        PRIMARY KEY (cpf_indicante, cpf_indicado),
        FOREIGN KEY(cpf_indicado) REFERENCES alunos(cpf),
        FOREIGN KEY(cpf_indicante) REFERENCES alunos(cpf)
    ); 
");