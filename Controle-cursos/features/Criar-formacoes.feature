#language: pt
Funcionalidade: Cadastro de formações
    Eu, como intrutor
    Quero cadastrar formações
    Para organizar meus cursos

    Regras: 
        - Formação precisa ter uma descrição
        - Descrição precisa ter pelo menos 2 palavras

    Cenário: Cadastro de formação com uma palavra
        Quando eu tentar criar uma formação com a descrição "PHP"
        Então eu vou ver a sequinte menssagem de erro "Descrição precisa ter pelo menos 2 palavras"
    
    Cenário: Cadastro de formação válida deve salvar no banco
        Dado que estou conectado ao banco de dados
        E este banco de dado é um mysql
        Quando tento criar uma nova formação com descrição "PHP na web"
        Então se eu buscar no banco, devo encontrar essa formação 
