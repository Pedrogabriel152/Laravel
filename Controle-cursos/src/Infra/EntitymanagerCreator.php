<?php

namespace Armazenamento\Infra;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;

class EntitymanagerCreator
{
    private $data;
    
    public function getEntityManager(): EntityManagerInterface
    {
        $this->data = Variaveis::variaveis();
        
        $config = ORMSetup::createAttributeMetadataConfiguration([__DIR__ . '/../Entity'], true);
        $conexao = DriverManager::getConnection([
            'driver' => 'pdo_mysql',
            'host' => $this->data['host'],
            'password' => $this->data['password'],
            'user' => 'root',
            'dbname' => $this->data['dbname']
        ]);

        return new EntityManager($conexao, $config);
    }
}
