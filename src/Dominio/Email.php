<?php

namespace Alura\Arquitetura\Dominio;

// Value Objects, pois não precisa ter um identificador.
// É o Aluno que tem identificação, mas não o Email
class Email
{
    private string $endereco;

    public function __construct(string $endereco)
    {
        if (filter_var($endereco, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException("Endereço de e-mail inválido");
        }
        $this->endereco = $endereco;
    }

    public function __toString()
    {
        return $this->endereco;
    }
}