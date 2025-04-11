# Task Manager

Projeto desenvolvido como case de estágio para a **Madatech**

## Funcionalidades

- Cadastrar, visualizar, editar e excluir tarefas (CRUD)
- Interface responsiva com bootstrap
- Integração com API REST usando JavaScript

## Como rodar o projeto

Clone o repositório:
-```bash
-git clone https://github.com/luhrsouza/task-manager.git
-cd task-manager

Instale as dependências:

-composer install

Copie o arquivo .env e configure
-cp env .env

Edite o .env com as credenciais do seu banco PostgreSQL

    database.default.hostname = localhost
    database.default.database = taskmanager
    database.default.username = seu_user
    database.default.password = sua_senha
    database.default.DBDriver = Postgre

No PostgreSQL, crie um banco com o nome "taskmanager":
- CREATE DATABASE taskmanager;

Execute as migrations:
-php spark migrate

Inicie o servidor:
-php spark serve

Acesse: http://localhost:8080

#Observações

A pasta public/ deve ser configurada como raiz no seu servidor local.
Caso utilize Laragon, basta mover a pasta para C:\laragon\www.

Feito por @luhrsouza
