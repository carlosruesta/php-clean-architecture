<?php

namespace Alura\Arquitetura\Testes\Unit\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Telefone;
use PHPUnit\Framework\TestCase;

class TelefoneTest extends TestCase
{
    public function testTelefoneInvalidoNaoPodeExistir()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Telefone('1', '222');
    }

    public function testTelefoneInvalidoNaoPodeExistirQuandoDDDVazio()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Telefone('', '222');
    }

    public function testTelefoneInvalidoNaoPodeExistirQuandoDDDTresDigitos()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Telefone('123', '222');
    }

    public function testTelefoneDeveConterOitoDigitos()
    {
        $fone = new Telefone('12', '12345678');
        $this->assertSame('(12)-12345678', (string) $fone);
    }

    public function testTelefoneDeveConterNoveDigitos()
    {
        $fone = new Telefone('12', '123456789');
        $this->assertSame('(12)-123456789', (string) $fone);
    }
}