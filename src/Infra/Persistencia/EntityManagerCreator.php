<?php

namespace Alura\Arquitetura\Infra\Persistencia;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;

class EntityManagerCreator
{

    public static function criaEntityManager(): EntityManagerInterface
    {
        $config = Setup::createXMLMetadataConfiguration([
            __DIR__."/Mapeamentos"
        ]);

        $con = [
            'driver'    => 'pdo_sqlite',
            'path'      => __DIR__ . '/../../../banco.sqlite',
        ];

        $em = EntityManager::create($con, $config);

        return $em;
    }
}