![Logo AI Solutions](http://aisolutions.tec.br/wp-content/uploads/sites/2/2019/04/logo.png)

# AI Solutions

## Teste para novos candidatos (PHP/Laravel)

### Introdução

Este teste utiliza PHP 8.1, Laravel 10 e um banco de dados SQLite simples.

1. Faça o clone desse repositório;
1. Execute o `composer install`;
1. Crie e ajuste o `.env` conforme necessário
1. Execute as migrations e os seeders;

### Primeira Tarefa:

Crítica das Migrations e Seeders: Aponte problemas, se houver, e solucione; Implemente melhorias;

### Segunda Tarefa:

Crie a estrutura completa de uma tela que permita adicionar a importação do arquivo `storage/data/2023-03-28.json`, para a tabela `documents`. onde cada registro representado neste arquivo seja adicionado a uma fila para importação.

Feito isso crie uma tela com um botão simples que dispara o processamento desta fila.

Utilize os padrões que preferir para as tarefas.

### Terceira Tarefa:

Crie um test unitário que valide o tamanho máximo do campo conteúdo.

Crie um test unitário que valide a seguinte regra:

Se a categoria for "Remessa" o título do registro deve conter a palavra "semestre", caso contrário deve emitir um erro de registro inválido.
Se a caterogia for "Remessa Parcial", o titulo deve conter o nome de um mês(Janeiro, Fevereiro, etc), caso contrário deve emitir um erro de registro inválido.


Boa sorte!



#########################################################################

# Projeto Laravel com SQLite no Docker

Este é um projeto Laravel configurado para usar o banco de dados SQLite em um ambiente Docker. Abaixo, você encontrará as instruções para configurar e rodar o projeto.

## Requisitos

Antes de começar, certifique-se de ter as seguintes ferramentas instaladas:

- **Docker**: Para gerenciar containers e volumes.
- **Docker Compose**: Para orquestrar múltiplos containers no ambiente de desenvolvimento.
- **PHP e Composer**: Para rodar o Laravel localmente (opcional, caso prefira não usar o Docker).

## Como Configurar o Ambiente

### 1. Clonando o Repositório

Clone este repositório para sua máquina local:

```bash
git clone https://github.com/LucasBarbosaF/teste-php-laravel.git
cd teste-php-laravel
```

### 2. Configurando o Docker

O projeto já está configurado para rodar com o SQLite dentro de um container Docker. Para isso, basta garantir que o docker-compose.yml esteja configurado corretamente.

### 3. Configurando o Arquivo .env
Abra o arquivo .env.example na raiz do projeto e renomeia para .env

### 4. Rodando o Docker
Agora, execute os containers Docker para rodar o aplicativo Laravel com o SQLite:
```bash
docker-compose up -d
```

Isso irá levantar o container do seu projeto Laravel com a configuração do SQLite. O banco de dados será armazenado no arquivo /var/www/html/database/schema/database.sqlite.

### 5. Rodando as Migrações
O próximo passo é rodar as migrações para criar as tabelas necessárias no banco de dados SQLite. Execute o seguinte comando:
```bash
docker-compose exec app php artisan migrate
```
Isso irá criar o banco de dados e as tabelas necessárias dentro do arquivo SQLite.


### 6. Acessando o Aplicativo
Após configurar e rodar o Docker, o aplicativo Laravel estará acessível em http://localhost:8000/documents.

### 7. Parando os Containers
Para parar os containers do Docker, execute o seguinte comando:
```bash
docker-compose down
```


