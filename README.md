# UEFS Netra — API RESTful

API RESTful desenvolvida para o teste técnico da vaga de Engenheiro de Software no projeto **UEFS - NETRA**.  
Sistema completo de **gerenciamento de usuários, posts e tags**, com arquitetura avançada, testes automatizados e ambiente multi-contêiner Docker.

---

## Arquitetura do Projeto

O projeto segue uma arquitetura em camadas, organizada para facilitar manutenção, escalabilidade e testes:

- **Controllers** — Camada de apresentação: recebe requisições e retorna respostas.
- **Services** — Camada de negócio: contém a lógica da aplicação.
- **Repositories** — Camada de acesso a dados: implementa o padrão Repository.
- **Models** — Representam as entidades do domínio.
- **Transformers** — Responsáveis pela transformação dos dados para a API.

---

## Tecnologias Utilizadas

- **Linguagem:** PHP 8.2  
- **Framework:** Laravel 10  
- **Banco de Dados:** PostgreSQL  
- **Cache:** Redis  
- **Servidor Web:** Nginx  
- **Containerização:** Docker & Docker Compose  
- **Transformação de Dados:** Fractal  
- **Testes Automatizados:** PHPUnit

---

## Estrutura do Banco de Dados

- `users` — Tabela de usuários  
- `posts` — Tabela de posts  
- `tags` — Tabela de tags  
- `post_tag` — Relacionamento muitos-para-muitos entre posts e tags

---

## Início Rápido

### Pré-requisitos

- [Docker](https://docs.docker.com/get-docker/) e [Docker Compose](https://docs.docker.com/compose/install/)
- [Git](https://git-scm.com/) para clonar o repositório
- Pelo menos **4 GB de RAM** disponível

---

### Passos para Configuração do Ambiente

#### 1. Clone e Acesse o Projeto
```bash
git clone https://github.com/lefundes/test-devs-uefs.git
cd uefs-netra

#### 2. Build e Execução dos Containers
```bash
docker-compose build --no-cache
docker-compose up -d

#### 3. Instalação e Configuração da Aplicação
```bash
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate

#### 4. Verificação

Verifique os containers ativos:

```bash
docker-compose ps


## Teste a API:

curl http://localhost:8000/api/v1/users

# URL Inicial da Aplicação

Após a configuração, a aplicação estará disponível em:

http://localhost:8000


# A documentação completa da API será acessível após a configuração básica do ambiente.

## Configuração de Testes Automatizados

# Importante:
O Laravel por padrão executa os testes com SQLite. No entanto, esta aplicação utiliza PostgreSQL e as migrations possuem SEQUENCES explícitas, não suportadas pelo SQLite.
Por isso, os testes estão configurados para usar PostgreSQL.

### Configuração do Banco de Testes
#### 1. Acessar o PostgreSQL
```bash
docker-compose exec postgres psql -U uefs_user -d uefs_netra

### 2. Criar Database de Teste
```bash
CREATE DATABASE uefs_netra_test;

### 3. Configurar .env.testing
```bash
APP_ENV=testing
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_DATABASE=uefs_netra_test
DB_USERNAME=uefs_user
DB_PASSWORD=uefs_password

### Execução de Testes
#### 1. Executar Migrations de Teste
```bash
docker-compose exec app php artisan migrate --env=testing

#### 2. Executar Todos os Testes
```bash
docker-compose exec app php artisan test

### 3. Executar Testes Específicos
#### Testes de API
```bash
docker-compose exec app php artisan test --filter UserApiTest

# Testes de Serviço
```bash
docker-compose exec app php artisan test --filter UserServiceTest

# Estrutura de Pastas da aplicação (Visão Geral)
uefs-netra/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   ├── Models/
│   ├── Services/
│   └── Repositories/
├── database/
│   ├── migrations/
│   └── seeders/
├── tests/
│   ├── Feature/
│   └── Unit/
├── docker-compose.yml
├── .env.example
└── README.md