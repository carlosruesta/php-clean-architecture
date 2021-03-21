<?php

namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\AlunoNaoEncontrado;
use Alura\Arquitetura\Dominio\Aluno\RepositorioAluno;
use Alura\Arquitetura\Dominio\Aluno\Telefone;
use Alura\Arquitetura\Dominio\Cpf;
use Alura\Arquitetura\Dominio\Email;
use PDO;

class RepositorioDeAlunoComPdo implements RepositorioAluno
{

    private \PDO $conexao;

    public function __construct(\PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function adicionar(Aluno $aluno): void
    {
        $sql = 'INSERT INTO alunos (cpf, nome, email) VALUES (:cpf, :nome, :email);';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue('cpf', $aluno->cpf());
        $stmt->bindValue('nome', $aluno->nome());
        $stmt->bindValue('email', $aluno->email());
        $stmt->execute();

        /** @var Telefone $telefone */
        foreach ($aluno->telefones() as $telefone) {
            $this->adicionaTelefoneAoAluno($aluno, $telefone);
        }

    }

    public function buscarPorCpf(Cpf $cpf): Aluno
    {
        $sql = '
            SELECT  cpf, nome, email, ddd, numero as numero_telefone 
            FROM    alunos 
                    LEFT JOIN telefones ON telefones.cpf_aluno = alunos.cpf 
            WHERE alunos.cpf = ?;
        ';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, (string) $cpf);
        $stmt->execute();

        $dadosAluno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($dadosAluno) === 0) {
            throw new AlunoNaoEncontrado($cpf);
        }

        $primeiraLinha = $dadosAluno[0];
        $aluno = new Aluno(new CPF($primeiraLinha['cpf']), $primeiraLinha['nome'], new Email($primeiraLinha['email']));
        $telefones = array_filter($dadosAluno, fn ($linha) => $linha['ddd'] !== null && $linha['numero_telefone'] !== null);
        foreach ($telefones as $linha) {
            $aluno->adicionarTelefone($linha['ddd'], $linha['numero_telefone']);
        }

        return $aluno;
    }

    /**
     * @inheritDoc
     */
    public function buscarTodos(): array
    {
        $statement = $this->conexao->query('SELECT * FROM alunos;');
        $alunosList = $statement->fetchAll(PDO::FETCH_ASSOC);
        $listaAlunos = [];
        foreach ($alunosList as $aluno) {
            $listaAlunos[] = Aluno::comCpfNomeEEmail($aluno['cpf'], $aluno['nome'], $aluno['email']);

        }
    }

    public function adicionaTelefoneAoAluno(Aluno $aluno, Telefone $telefone)
    {
        $stmt = $this->conexao->prepare('INSERT INTO telefones (ddd, numero, cpf_aluno) VALUES (:ddd, :numero, :cpf_aluno);');
        $stmt->bindValue('ddd', $telefone->ddd());
        $stmt->bindValue('numero', $telefone->numero());
        $stmt->bindValue('cpf_aluno', (string) $aluno->cpf());
        $stmt->execute();
    }
}