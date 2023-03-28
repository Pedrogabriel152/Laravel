<?php

$builder = new \DI\ContainerBuilder();

$builder->addDefinitions([
    \Doctrine\ORM\EntityManagerInterface::class => function () {
        return (new \Armazenamento\Infra\EntitymanagerCreator())->getEntityManager();
    },
]);

return $builder->build();