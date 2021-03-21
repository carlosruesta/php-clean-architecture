<?php

namespace Alura\Arquitetura\Testes\DominioUnidade;

use Alura\Arquitetura\Dominio\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testEmailInvalidoNaoPodeExistir()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Email('email invalido');
    }

    public function testEmailNoFormatoValidoPodeSerRepresentadoComoString()
    {
        $email = new Email('usuario@email.com');
        $this->assertSame('usuario@email.com', (string) $email);
    }
}