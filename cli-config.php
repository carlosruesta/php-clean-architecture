<?php

use Alura\Arquitetura\Infra\Persistencia\EntityManagerCreator;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once 'vendor/autoload.php';

$entityManager = (new EntityManagerCreator())->criaEntityManager();

return ConsoleRunner::createHelperSet($entityManager);