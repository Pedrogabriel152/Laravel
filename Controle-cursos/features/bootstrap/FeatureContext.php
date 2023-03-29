<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @When eu tentar criar uma formação com a descrição :arg1
     */
    public function euTentarCriarUmaFormacaoComADescricao($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then eu vou ver a sequinte menssagem de erro :arg1
     */
    public function euVouVerASequinteMenssagemDeErro($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given que estou conectado ao banco de dados
     */
    public function queEstouConectadoAoBancoDeDados()
    {
        throw new PendingException();
    }

    /**
     * @Given este banco de dado é um mysql
     */
    public function esteBancoDeDadoEUmMysql()
    {
        throw new PendingException();
    }

    /**
     * @When tento criar uma nova formação com descrição :arg1
     */
    public function tentoCriarUmaNovaFormacaoComDescricao($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then se eu buscar no banco, devo encontrar essa formação
     */
    public function seEuBuscarNoBancoDevoEncontrarEssaFormacao()
    {
        throw new PendingException();
    }
}
