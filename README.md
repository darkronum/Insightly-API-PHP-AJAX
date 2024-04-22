# Projeto de Integração com a API Insightly 🚀

Este projeto consiste em uma integração com a API do Insightly para criar oportunidades de negócio. Foi desenvolvido como parte de um estudo e implementação no trabalho.

## Como funciona

O código PHP envia uma requisição para a API do Insightly, criando uma nova oportunidade com base nos dados fornecidos via formulário HTML. Após a criação da oportunidade, a função PHP também transfere essa oportunidade para um pipeline específico e para um estágio correto dentro desse pipeline.

## Pré-requisitos

- PHP instalado no servidor
- Chave/Token de acesso API do Insightly
- ID do pipeline e ID da coluna no Insightly

## Configuração

1. No arquivo `insightly.php`, insira sua chave de acesso API do Insightly e os IDs do pipeline e da coluna.
2. Certifique-se de ter estilos CSS adequados no arquivo `styles.css` e funcionalidades de AJAX no arquivo `ajax.js`.
3. Configure seu servidor web para executar o código PHP.

## Uso

1. Preencha o formulário com os dados do cliente.
2. Clique em "Enviar".
3. A oportunidade será criada no Insightly e transferida para o pipeline e estágio corretos.

## Licença

Este projeto é licenciado sob os termos da Licença MIT.
