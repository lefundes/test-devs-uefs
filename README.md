````markdown
# 🧭 UEFS Netra — API RESTful

[![PHP](https://img.shields.io/badge/PHP-8.2-blue.svg)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com)
[![Docker](https://img.shields.io/badge/Docker-Ready-blue.svg)](https://www.docker.com/)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-Database-informational.svg)](https://www.postgresql.org/)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

**API RESTful** desenvolvida como parte do teste técnico para a vaga de Engenheiro de Software no projeto **UEFS - NETRA**.  
Sistema completo para **gerenciamento de usuários, posts e tags**, com arquitetura em camadas, testes automatizados e ambiente multi-contêiner Docker.

---

## 🧱 Arquitetura do Projeto

O projeto segue uma **arquitetura em camadas**, organizada para facilitar manutenção, escalabilidade e testes:

- **Controllers** — Recebem requisições e retornam respostas HTTP.  
- **Services** — Contêm a lógica de negócio.  
- **Repositories** — Acesso a dados, implementando o *Repository Pattern*.  
- **Models** — Entidades do domínio.  
- **Transformers** — Transformam dados para resposta da API.

---

## 🧰 Tecnologias Utilizadas

- **Linguagem:** PHP 8.4.12  
- **Framework:** Laravel Framework 12.34.0  
- **Banco de Dados:** PostgreSQL  
- **Cache:** Redis  
- **Servidor Web:** Nginx  
- **Containerização:** Docker & Docker Compose  
- **Transformação de Dados:** Fractal  
- **Testes Automatizados:** PHPUnit

---

## 🗃️ Estrutura do Banco de Dados

- `users` — Tabela de usuários  
- `posts` — Tabela de posts  
- `tags` — Tabela de tags  
- `post_tag` — Relacionamento muitos-para-muitos entre posts e tags

---

## 🚀 Início Rápido

### ✅ Pré-requisitos

- [Docker](https://docs.docker.com/get-docker/) e [Docker Compose](https://docs.docker.com/compose/install/)
- [Git](https://git-scm.com/) para clonar o repositório
- Pelo menos **4 GB de RAM** disponível

---

### ⚡ Passos para Configuração do Ambiente

#### 1. Clone e Acesse o Projeto
```bash
git clone https://github.com/lefundes/test-devs-uefs.git
cd uefs-netra
````

#### 2. Build e Execução dos Containers

```bash
docker-compose build --no-cache
docker-compose up -d
```

#### 3. Instalação e Configuração da Aplicação

```bash
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
```

#### 4. Verificação

Verifique os containers ativos:

```bash
docker-compose ps
```

---

## 🌐 URL Inicial e Teste da Aplicação

Após a configuração, a aplicação estará disponível em:

```
http://localhost:8000
```

📄 **Observação:** A documentação completa da API será acessível após a configuração básica do ambiente.

---

## 🧪 Configuração de Testes Automatizados

⚠️ **Importante:**
O Laravel, por padrão, executa os testes com **SQLite**, porém esta aplicação utiliza **PostgreSQL** com **SEQUENCES explícitas** nas migrations, o que não é suportado pelo SQLite.
Por isso, os testes estão configurados para rodar diretamente em PostgreSQL.

---

### 🐘 Configuração do Banco de Testes

#### 1. Acessar o PostgreSQL

```bash
docker-compose exec postgres psql -U uefs_user -d uefs_netra
```

#### 2. Criar Database de Teste

```sql
CREATE DATABASE uefs_netra_test;
```

#### 3. Configurar `.env.testing`

```dotenv
APP_ENV=testing
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_DATABASE=uefs_netra_test
DB_USERNAME=uefs_user
DB_PASSWORD=uefs_password
```

---

## 🧭 Execução de Testes

#### 1. Executar Migrations de Teste

```bash
docker-compose exec app php artisan migrate --env=testing
```

#### 2. Executar Todos os Testes

```bash
docker-compose exec app php artisan test
```

#### 3. Executar Testes Específicos

```bash
# Testes de API
docker-compose exec app php artisan test --filter UserApiTest

# Testes de Serviço
docker-compose exec app php artisan test --filter UserServiceTest
```

---

## 🧱 Estrutura de Pastas

```
├── app
│   ├── Http
│   │   └── Controllers
│   ├── Models
│   │   ├── Post.php
│   │   ├── Tag.php
│   │   └── User.php
│   ├── Providers
│   │   ├── AppServiceProvider.php
│   │   ├── RepositoryServiceProvider.php
│   │   └── RouteServiceProvider.php
│   ├── Repositories
│   │   ├── BaseRepository.php
│   │   ├── Contracts
│   │   ├── PostRepository.php
│   │   ├── TagRepository.php
│   │   └── UserRepository.php
│   ├── Services
│   │   ├── PostService.php
│   │   ├── TagService.php
│   │   └── UserService.php
│   └── Transformers
│       ├── PostTransformer.php
│       ├── TagTransformer.php
│       └── UserTransformer.php
├── artisan
├── bootstrap
│   ├── app.php
│   ├── cache
│   │   ├── packages.php
│   │   └── services.php
│   └── providers.php
├── composer.json
├── composer.lock
├── config
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── database.php
│   ├── filesystems.php
│   ├── l5-swagger.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── sanctum.php
│   ├── services.php
│   └── session.php
├── database
│   ├── factories
│   │   ├── PostFactory.php
│   │   ├── TagFactory.php
│   │   └── UserFactory.php
│   ├── migrations
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2025_10_16_173849_create_posts_table.php
│   │   ├── 2025_10_16_173849_create_tags_table.php
│   │   ├── 2025_10_16_173942_create_post_tag_table.php
│   │   └── 2025_10_17_123529_create_personal_access_tokens_table.php
│   └── seeders
│       └── DatabaseSeeder.php
├── docker
│   ├── nginx.conf
│   └── postgres
│       └── init.sql
├── docker-compose.yml
├── Dockerfile
├── package.json
├── phpunit.xml
├── public
│   ├── css
│   │   └── alert
│   ├── favicon.ico
│   ├── index.php
│   ├── js
│   │   └── alert
│   └── robots.txt
├── README.md
├── resources
│   ├── css
│   │   └── app.css
│   ├── js
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views
│       ├── dashboard.blade.php
│       ├── layouts
│       ├── posts
│       ├── readme.blade.php
│       ├── tags
│       ├── users
│       └── vendor
├── routes
│   ├── api.php
│   ├── console.php
│   └── web.php
├── storage
│   ├── api-docs
│   │   └── api-docs.json
│   ├── app
│   │   ├── private
│   │   └── public
│   ├── framework
│   │   ├── cache
│   │   ├── sessions
│   │   ├── testing
│   │   └── views
│   └── logs
│       └── laravel.log
├── tests
│   ├── Feature
│   │   ├── Api
│   │   └── ExampleTest.php
│   ├── TestCase.php
│   └── Unit
│       ├── ExampleTest.php
│       └── UserServiceTest.php
└── vite.config.js