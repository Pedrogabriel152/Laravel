<?php

namespace Leilao\Test\Service;

use Leilao\Model\Leilao;
use Leilao\Service\Encerrador;
use PHPUnit\Framework\TestCase;
use Leilao\Dao\Leilao as LeilaoDao;

class LeilaoDaoMock extends LeilaoDao
{
    private $leiloes = [];

    public function salva(Leilao $leilao): void
    {
        $this->leiloes[] = $leilao;
    }

    public function recuperarNaoFinalizados(): array
    {
        return array_filter($this->leiloes, function(Leilao $leilao) {
            return !$leilao->estaFinalizado();
        });
    }

    public function recuperarFinalizados(): array
    {
        return array_filter($this->leiloes, function(Leilao $leilao) {
            return $leilao->estaFinalizado();
        });
    }

    public function atualiza(Leilao $leilao)
    {
        
    }
}

class EncerradorTest extends TestCase
{
    public function testeLeliloesComMaisDeUmaSemanaDevemSerEncerrados() {
        
        $leilao = new Leilao(
            'Fiat 147 0Km', 
            new \DateTimeImmutable('8 days ago')
        );

        $variante = new Leilao(
            'Variant 1972 0Km',
            new \DateTimeImmutable('10 days ago')
        );

        $leilaoDao = new LeilaoDaoMock();
        $leilaoDao->salva($leilao);
        $leilaoDao->salva($variante);

        $encerrador = new Encerrador($leilaoDao);
        $encerrador->encerra();

        $leilao = $leilaoDao->recuperarFinalizados();

        self::assertCount(2, $leilao);
        self::assertEquals('Fiat 147 0Km', $leilao[0]->recuperarDescricao());
        self::assertEquals('Variant 1972 0Km', $leilao[1]->recuperarDescricao());


    }
}