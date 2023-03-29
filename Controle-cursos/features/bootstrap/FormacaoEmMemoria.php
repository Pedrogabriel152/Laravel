<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Armazenamento\Entity\Formacao;

class FormacaoEmMemoria implements Context
{
    private string $mensagemDeErro = '';
    private Formacao $formacao;
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */

    /**
     * @When eu tentar criar uma formação com a descrição :arg1
     */
    public function euTentarCriarUmaFormacaoComADescricao(string $descricaoDaFormacao)
    {
        $this->formacao = new Formacao();

        try {

            $this->formacao->setDescricao($descricaoDaFormacao);
            
        } catch (\InvalidArgumentException $e) {
            $this->mensagemDeErro = $e->getMessage();
        }
        
    }

    /**
     * @Then eu vou ver a sequinte menssagem de erro :arg1
     */
    public function euVouVerASequinteMenssagemDeErro(string $mensagemDeErro)
    {
        assert($mensagemDeErro === $this->mensagemDeErro);
    }

    

    /**
     * @Then eu devo ter uma formação criada com a descrição :arg1
     */
    public function euDevoTerUmaFormacaoCriadaComADescricao(string $descricaoDaFormacao)
    {
        assert($this->formacao->getDescricao() === $descricaoDaFormacao);
    }
}
