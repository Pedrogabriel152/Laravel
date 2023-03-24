<?php

namespace Leilao\Tests\Integration\Dao;

use Leilao\Dao\Leilao as DaoLeilao;
use Leilao\Infra\ConnectionCreator;
use Leilao\Model\Leilao;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertSame;

class LeilaoDaoTest extends TestCase
{
    private static \PDO $pdo;

    public static function setUpBeforeClass(): void {
        self::$pdo = ConnectionCreator::getConnection();
    }

    protected function setUp(): void
    {
        self::$pdo->beginTransaction();
        self::$pdo->exec('DELETE FROM leiloes');
    }

    /**
     * @dataProvider leiloes
     */
    public function testBuscaLeiloesNaoFinalizados(array $leiloes) {

        $leilaoDao = new DaoLeilao(self::$pdo);

        foreach ($leiloes as $leilao) {
            $leilaoDao->salva($leilao);
        }

        $leiloes = $leilaoDao->recuperarNaoFinalizados();

        self::assertCount(1, $leiloes);
        self::assertContainsOnlyInstancesOf(Leilao::class, $leiloes);
        self::assertSame('Variante 0Km', $leiloes[0]->recuperarDescricao());
        self::assertFalse($leiloes[0]->estaFinalizado());
    }

    /**
     * @dataProvider leiloes
     */
    public function testBuscaLeiloesFinalizados(array $leiloes) {
        
        $leilaoDao = new DaoLeilao(self::$pdo);

        foreach ($leiloes as $leilao) {
            $leilaoDao->salva($leilao);
        }

        $leiloes = $leilaoDao->recuperarFinalizados();

        self::assertCount(1, $leiloes);
        self::assertContainsOnlyInstancesOf(Leilao::class, $leiloes);
        self::assertSame('Fiat 147 0Km', $leiloes[0]->recuperarDescricao());
        self::assertTrue($leiloes[0]->estaFinalizado());

    }

    protected function tearDown(): void
    {
        self::$pdo->rollBack();
    }

    public static function leiloes() {
        $leilaoNaoFinalizado = new Leilao('Variante 0Km');
        $leilaoFinalizado = new Leilao('Fiat 147 0Km');
        $leilaoFinalizado->finaliza();
        return [
            [
                [$leilaoNaoFinalizado, $leilaoFinalizado]
            ]
        ];
    }
}