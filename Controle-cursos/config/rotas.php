<?php

return [
    '/login' => \Armazenamento\Controller\FormularioLogin::class,
    '/fazer-login' => \Armazenamento\Controller\Login::class,
    '/logout' => \Armazenamento\Controller\Logout::class,
    '/novo-curso' => \Armazenamento\Controller\FormularioInsercaoCurso::class,
    '/salvar-curso' => \Armazenamento\Controller\PersistenciaCurso::class,
    '/listar-cursos' => \Armazenamento\Controller\ListaDeCursos::class,
    '/editar-curso' => \Armazenamento\Controller\FormularioEdicaoCurso::class,
    '/excluir-curso' => \Armazenamento\Controller\ExclusaoDeCurso::class,
    '/nova-formacao' => \Armazenamento\Controller\FormularioInsercaoFormacao::class,
    '/salvar-formacao' => \Armazenamento\Controller\PersistenciaFormacao::class,
    '/listar-formacoes' => \Armazenamento\Controller\ListaDeFormacoes::class,
];