<?php


use Alura\Arquitetura\Aplicacao\Aluno\MatricularAluno\MatricularAluno;
use Alura\Arquitetura\Aplicacao\Aluno\MatricularAluno\MatricularAlunoDto;
use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Cpf;
use Alura\Arquitetura\Infra\Aluno\RepositorioDeAlunoEmMemoria;
use PHPUnit\Framework\TestCase;

class MatricularAlunoTest extends TestCase
{

    public function testAlunoDeveSerAdicionadoAoRepositorio()
    {
        $dadosAluno = new MatricularAlunoDto(
            '123.456.789-10',
            'nomeAluno',
            'exemplo@mail.com'
        );

        $repositorio = new RepositorioDeAlunoEmMemoria();

        $matricularAluno = new MatricularAluno($repositorio);
        $matricularAluno->executa($dadosAluno);

        /** @var Aluno $aluno */
        $aluno = $repositorio->buscarPorCpf(new Cpf('123.456.789-10'));

        $this->assertSame('nomeAluno', $aluno->nome());
        $this->assertSame('exemplo@mail.com', $aluno->email());
        $this->assertCount(0, $aluno->telefones());
    }
}