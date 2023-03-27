<?php

use Leilao\Dao\Leilao as LeilaoDao;
use Leilao\Infra\ConnectionCreator;
use Leilao\Model\Leilao;

require_once __DIR__ . '/vendor/autoload.php';

$pdo = ConnectionCreator::getConnection();
$leilaoDao = new LeilaoDao($pdo);

$leiloes = $leilaoDao->recuperarNaoFinalizados();

if(sizeof($leiloes) == 0){  
    $leilao1 = new Leilao('Leilão 1');
    $leilao2 = new Leilao('Leilão 2');
    $leilao3 = new Leilao('Leilão 3');
    $leilao4 = new Leilao('Leilão 4');

    $leilaoDao->salva($leilao1);
    $leilaoDao->salva($leilao2);
    $leilaoDao->salva($leilao3);
    $leilaoDao->salva($leilao4);
}

header('Content-type: application/json');
echo json_encode(array_map(function (Leilao $leilao) {
    return [
        'descricao' => $leilao->recuperarDescricao(),
        'estaFinalizado' => $leilao->estaFinalizado(),
    ];
}, $leilaoDao->recuperarNaoFinalizados()));