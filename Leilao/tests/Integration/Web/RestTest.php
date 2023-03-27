<?php

namespace Leilao\Tests\Integration\Web;

use PHPUnit\Framework\TestCase;

class RestTest extends TestCase 
{
    public function testApiRestDeveRetornarArrayDeLeiloes() {

        $response = file_get_contents('http://localhost:8080/rest.php');

        self::assertStringContainsString('200 OK', $http_response_header[0]);
        self::assertIsArray(json_decode($response));
    }
}