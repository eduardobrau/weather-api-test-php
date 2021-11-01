# REGRAS GERAIS

- O projeto deve ser desenvolvido em Node.js ou PHP
- Você pode usar quaisquer bibliotecas de terceiros ou frameworks

## Você deverá criar uma api de previsão de tempo onde os requisitos são:
- Lista de cidades
- Lista de cidades que possuem um clima disponível com a informação do clima
- Visualizar uma cidade X com o seu clima
- Visualizar uma cidade X com o seu clima e filtrar o clima em um range de tempo Ex. (2017-03-12 até 2017-03-21)

### Bonus
- Filtrar a lista de cidades por latitude e longitude
- Documentação
- Desenvolvimento da api em mais uma linguagem à sua escolha

## Desenvolvimento

Não faça um fork do projeto, você pode fazer um clone e subir em seu próprio git ou nos enviar um zip contendo o .git.

Faça commits durante o desenvolvimento do projeto, é importante para analisarmos a sua linha de pensamento.

Não é necessário utilizar banco de dados, você somente deve utilizar como os dois arquivos "city_list.json" e "weather_list.json".

## O que iremos analisar:
- Seu conhecimento geral sobre APIs REST
- Como você organiza/estrutura seu código
- Sua habilidade de entender uma documentação
- Testes

## Como executar e testar os diferentes endpoint da API REST:
- Navegar dentro da pasta raiz do projeto weather-api-test-php
- Verificar se tem o PHP instalado com o comando php -v se tudo estiver certo verá algo, PHP 7.4.18
- Subir o servidor embutido do PHP php -S localhost:8000 caso a porta esteja ocupada pode-se trocar
- Como se trata de listas e visualização pode-se usar o próprio navegador para testar os endpoints 
* Exemplo:
    * http://localhost:8000/cidades
    * http://localhost:8000/cidades/climas
    * http://localhost:8000/cidades/climas/id
    * http://localhost:8000/cidades/climas/3992619/?data_ini=2017-03-01&data_fim=2017-03-15
 