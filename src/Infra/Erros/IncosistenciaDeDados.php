<?php

namespace Alura\Arquitetura\Infra\Erros;

use Throwable;

class IncosistenciaDeDados extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}