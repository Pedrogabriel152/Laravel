<?php

namespace Leilao\Tests\Integration\Dao;

use Leilao\Dao\Leilao as DaoLeilao;
use Leilao\Infra\ConnectionCreator;
use Leilao\Model\Leilao;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertSame;

class LeilaoDaoTest extends TestCase
{
    public function testInsercaoEBuscaDevemFuncionar() {

        $leilao = new Leilao('Variante 0Km');
        $pdo = ConnectionCreator::getConnection();
        $leilaoDao = new DaoLeilao($pdo);

        $leilaoDao->salva($leilao);

        $leiloes = $leilaoDao->recuperarNaoFinalizados();

        self::assertCount(1, $leiloes);
        self::assertContainsOnlyInstancesOf(Leilao::class, $leiloes);
        self::assertSame('Variante 0Km', $leiloes[0]->recuperarDescricao());

        $pdo->exec('DELETE FROM leiloes');
    }
}