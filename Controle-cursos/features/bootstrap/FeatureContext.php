<?php

use Armazenamento\Entity\Formacao;
use Armazenamento\Infra\EntitymanagerCreator;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{

    private EntityManagerInterface $em;
    private string $mensagemDeErro = '';
    private int $idFormacao;
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
    public function euTentarCriarUmaFormacaoComADescricao(string $descricaoDaFormacao)
    {
        $formacao = new Formacao();

        try {

            $formacao->setDescricao($descricaoDaFormacao);
            
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
     * @Given que estou conectado ao banco de dados
     */
    public function queEstouConectadoAoBancoDeDados()
    {
        $this->em = (new EntitymanagerCreator())->getEntityManager();
    }

    /**
     * @When tento salvar uma nova formação com descrição :arg1
     */
    public function tentoSalvarUmaNovaFormacaoComDescricao(string $descricaoDaFormacao)
    {
        $formacao = new Formacao();
        $formacao->setDescricao($descricaoDaFormacao);

        $this->em->persist($formacao);
        $this->em->flush();
        $this->idFormacao = $formacao->getId();
    }

    /**
     * @Then se eu buscar no banco, devo encontrar essa formação
     */
    public function seEuBuscarNoBancoDevoEncontrarEssaFormacao()
    {
        /** @var \Doctrine\Persistence\ObjectRepository $repositorio */
        $repositorio = $this->em->getRepository(Formacao::class);
        /** @var Formacao $formacao */
        $formacao = $repositorio->find($this->idFormacao);

        assert($formacao instanceof Formacao);
    }
}
