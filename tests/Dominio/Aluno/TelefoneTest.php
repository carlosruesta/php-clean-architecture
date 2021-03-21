<?php

namespace Alura\Arquitetura\Testes\Dominio\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Telefone;
use Alura\Arquitetura\Dominio\Cpf;
use PHPUnit\Framework\TestCase;

class TelefoneTest extends TestCase
{

    private Cpf $cpf;

    public function setUp(): void
    {
        $this->cpf = new Cpf('123.456.789-10');
    }

    public function testTelefoneInvalidoNaoPodeExistir()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Telefone($this->cpf, '1', '222');
    }

    public function testTelefoneInvalidoNaoPodeExistirQuandoDDDVazio()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Telefone($this->cpf,'', '222');
    }

    public function testTelefoneInvalidoNaoPodeExistirQuandoDDDTresDigitos()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Telefone($this->cpf,'123', '222');
    }

    public function testTelefoneDeveConterOitoDigitos()
    {
        $fone = new Telefone($this->cpf,'12', '12345678');
        $this->assertSame('(12)-12345678', (string) $fone);
    }

    public function testTelefoneDeveConterNoveDigitos()
    {
        $fone = new Telefone($this->cpf,'12', '123456789');
        $this->assertSame('(12)-123456789', (string) $fone);
    }
}