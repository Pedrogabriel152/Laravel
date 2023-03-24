<?php

namespace Leilao\Service;

use Leilao\Model\Leilao;

class EnviadorEmail
{
    public function notificarTerminoLeilao(Leilao $leilao): void
    {
        $sucesso = mail(
            'usuario@email.com',
            'Leilão finalizado',
            'O leilão para ' . $leilao->recuperarDescricao() . ' foi finalizado'
        );

        if (!$sucesso) {
            throw new \DomainException('Erro ao enviar e-mail');
        }
    }
}