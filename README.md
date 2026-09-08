# HelpDesk TI

Sistema de abertura e gerenciamento de chamados técnicos para suporte de TI.

---

## Tecnologias

* **PHP 8+** (Arquitetura MVC simples)
* **SQLite** (Banco de dados em arquivo local)
* **RedBeanPHP** (Persistência e manipulação do banco)
* **Pico.css v2** (Interface responsiva e tema dark)

---

## Pré-requisitos

* PHP 8.1 ou superior instalado
* Extensões ativas no `php.ini`: `pdo_sqlite` e `sqlite3`

---

## Como Executar

1. Clone o repositório:

git clone <LINK_DO_SEU_REPOSITORIO>
cd PROJETO_ESTAGIO_2026_2


2. Inicie o servidor embutido do PHP:

php -S localhost:8000 -t public


3. Acesse no navegador:
* **Página Pública (Abertura de Chamado):** `http://localhost:8000`
* **Painel Administrativo (Login):** `http://localhost:8000/login`

---

## Acesso do Administrador

Credenciais para teste do painel de gestão:

* **Usuário:** `admin`
* **Senha:** `admin123`