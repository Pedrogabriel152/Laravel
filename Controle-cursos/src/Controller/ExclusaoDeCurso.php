<?php

namespace Armazenamento\Controller;

use Nyholm\Psr7\Response;
use Armazenamento\Entity\Curso;
use Armazenamento\Helper\MensagemFlash;
use Psr\Http\Message\ResponseInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ExclusaoDeCurso implements RequestHandlerInterface
{
    use MensagemFlash;

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $curso = $this->entityManager->getReference(Curso::class, $request->getQueryParams()['id']);
        $this->entityManager->remove($curso);
        $this->entityManager->flush();
        $this->adicionaMensagemFlash('success', 'Curso excluído com sucesso');

        return new Response(302, ['Location' => '/listar-cursos']);
    }
}
