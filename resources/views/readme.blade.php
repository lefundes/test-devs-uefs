<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UEFS Netra API - Documentação Completa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        secondary: '#0f172a',
                        accent: '#3b82f6',
                        danger: '#dc2626',
                        success: '#16a34a'
                    }
                }
            }
        }
    </script>
    <style>
        .code-block {
            background: #1a1a1a;
            border-radius: 8px;
            padding: 1rem;
            margin: 1rem 0;
            overflow-x: auto;
        }
        .endpoint-method {
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 0.8rem;
        }
        .method-get { background: #10b981; color: white; }
        .method-post { background: #f59e0b; color: white; }
        .method-put { background: #3b82f6; color: white; }
        .method-delete { background: #ef4444; color: white; }
        .copy-btn {
            transition: all 0.3s ease;
        }
        .copy-btn:hover {
            transform: scale(1.05);
        }
        .nav-link {
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            background: #3b82f6;
            color: white;
        }
        .alert {
            border-left: 4px solid;
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 4px;
        }
        .alert-warning {
            background: #fef3cd;
            border-color: #f59e0b;
            color: #92400e;
        }
        .alert-danger {
            background: #fde8e8;
            border-color: #dc2626;
            color: #7f1d1d;
        }
        .alert-success {
            background: #d1fae5;
            border-color: #10b981;
            color: #065f46;
        }
        .alert-info {
            background: #dbeafe;
            border-color: #3b82f6;
            color: #1e40af;
        }
        .tech-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: bold;
            margin: 2px;
        }
        .badge-php { background: #777BB4; color: white; }
        .badge-laravel { background: #FF2D20; color: white; }
        .badge-postgres { background: #336791; color: white; }
        .badge-redis { background: #DC382D; color: white; }
        .badge-docker { background: #2496ED; color: white; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Header -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div class="bg-primary text-white p-3 rounded-lg">
                        <i class="fas fa-code text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-secondary">UEFS Netra API</h1>
                        <p class="text-gray-600">Documentação Completa</p>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <a href="#getting-started" class="nav-link bg-gray-100 px-4 py-2 rounded-lg">Iniciar</a>
                    <a href="#testing-setup" class="nav-link bg-gray-100 px-4 py-2 rounded-lg">Testes</a>
                    <a href="#architecture" class="nav-link bg-gray-100 px-4 py-2 rounded-lg">Arquitetura</a>
                    <a href="#api-docs" class="nav-link bg-gray-100 px-4 py-2 rounded-lg">API</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        <!-- Tech Stack -->
        <div class="text-center mb-8">
            <div class="flex justify-center flex-wrap gap-2 mb-4">
                <span class="tech-badge badge-php">PHP 8.2</span>
                <span class="tech-badge badge-laravel">Laravel 12</span>
                <span class="tech-badge badge-postgres">PostgreSQL</span>
                <span class="tech-badge badge-redis">Redis</span>
                <span class="tech-badge badge-docker">Docker</span>
            </div>
        </div>

        <!-- Hero Section -->
        <section class="text-center mb-16">
            <h2 class="text-4xl font-bold text-secondary mb-4">API RESTful UEFS Netra</h2>
            <p class="text-xl text-gray-600 mb-8">Sistema completo de gerenciamento de usuários, posts e tags</p>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <i class="fas fa-layer-group text-3xl text-primary mb-4"></i>
                    <h3 class="font-bold text-lg mb-2">Arquitetura Avançada</h3>
                    <p class="text-gray-600 text-sm">Repository Pattern + Service Layer</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <i class="fas fa-docker text-3xl text-primary mb-4"></i>
                    <h3 class="font-bold text-lg mb-2">Dockerizada</h3>
                    <p class="text-gray-600 text-sm">PHP 8.2, PostgreSQL, Redis, Nginx</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <i class="fas fa-vial text-3xl text-primary mb-4"></i>
                    <h3 class="font-bold text-lg mb-2">Testes Automatizados</h3>
                    <p class="text-gray-600 text-sm">PHPUnit com PostgreSQL</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <i class="fas fa-database text-3xl text-primary mb-4"></i>
                    <h3 class="font-bold text-lg mb-2">Multi-Ambiente</h3>
                    <p class="text-gray-600 text-sm">Desenvolvimento e Teste</p>
                </div>
            </div>
        </section>

        <!-- Getting Started -->
        <section id="getting-started" class="mb-16">
            <h2 class="text-3xl font-bold text-secondary mb-8">🚀 Início Rápido</h2>
            
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <h3 class="text-2xl font-semibold mb-4">Pré-requisitos</h3>
                <ul class="list-disc list-inside space-y-2 text-gray-700">
                    <li>Docker e Docker Compose instalados</li>
                    <li>Git para clonar o repositório</li>
                    <li>4GB RAM disponível</li>
                </ul>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Setup Steps -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-2xl font-semibold mb-4">Configuração do Ambiente</h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4">
                            <div class="bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0">1</div>
                            <div>
                                <h4 class="font-semibold">Clone e Acesso</h4>
                                <div class="code-block mt-2">
                                    <code class="text-green-400">git clone [repositorio]</code><br>
                                    <code class="text-green-400">cd netra-test-senior</code>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0">2</div>
                            <div>
                                <h4 class="font-semibold">Build e Execução</h4>
                                <div class="code-block mt-2">
                                    <code class="text-green-400">docker-compose build --no-cache</code><br>
                                    <code class="text-green-400">docker-compose up -d</code>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0">3</div>
                            <div>
                                <h4 class="font-semibold">Configuração da Aplicação</h4>
                                <div class="code-block mt-2">
                                    <code class="text-green-400">docker-compose exec app composer install</code><br>
                                    <code class="text-green-400">docker-compose exec app php artisan key:generate</code><br>
                                    <code class="text-green-400">docker-compose exec app php artisan migrate</code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Verification -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-2xl font-semibold mb-4">Verificação</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3 p-4 bg-green-50 rounded-lg">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span>Verificar containers ativos:</span>
                        </div>
                        <div class="code-block">
                            <code class="text-green-400">docker-compose ps</code>
                        </div>

                        <div class="flex items-center space-x-3 p-4 bg-blue-50 rounded-lg">
                            <i class="fas fa-globe text-blue-500"></i>
                            <span>Testar API:</span>
                        </div>
                        <div class="code-block">
                            <code class="text-green-400">curl http://localhost:8000/api/v1/users</code>
                        </div>

                        <div class="flex items-center space-x-3 p-4 bg-purple-50 rounded-lg">
                            <i class="fas fa-vial text-purple-500"></i>
                            <span>Executar testes:</span>
                        </div>
                        <div class="code-block">
                            <code class="text-green-400">docker-compose exec app php artisan test</code>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testing Setup -->
        <section id="testing-setup" class="mb-16">
            <h2 class="text-3xl font-bold text-secondary mb-8">🧪 Configuração de Testes</h2>

            <div class="alert alert-danger mb-6">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-exclamation-circle"></i>
                    <strong>Importante:</strong> 
                    <span>O Laravel por padrão executa os testes com SQLite, porém, as migrations dessa aplicação foram escritas para PostgreSQL e utilizam SEQUENCES explicitas, portanto, devido o SQLite não suportar sequences do explícitas os testes estão configurados para usar o PostgreSQL.</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Database Setup -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-2xl font-semibold mb-4">Configuração do Banco de Testes</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4">
                            <div class="bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0">1</div>
                            <div>
                                <h4 class="font-semibold">Acessar PostgreSQL</h4>
                                <div class="code-block mt-2">
                                    <code class="text-green-400">docker-compose exec postgres psql -U uefs_user -d uefs_netra</code>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0">2</div>
                            <div>
                                <h4 class="font-semibold">Criar Database de Teste</h4>
                                <div class="code-block mt-2">
                                    <code class="text-green-400">CREATE DATABASE uefs_netra_test;</code>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0">3</div>
                            <div>
                                <h4 class="font-semibold">Configurar .env.testing</h4>
                                <div class="code-block mt-2">
                                    <code class="text-yellow-300">APP_ENV=testing</code><br>
                                    <code class="text-yellow-300">DB_CONNECTION=pgsql</code><br>
                                    <code class="text-yellow-300">DB_HOST=postgres</code><br>
                                    <code class="text-yellow-300">DB_DATABASE=uefs_netra_test</code><br>
                                    <code class="text-yellow-300">DB_USERNAME=uefs_user</code><br>
                                    <code class="text-yellow-300">DB_PASSWORD=uefs_password</code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Test Execution -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-2xl font-semibold mb-4">Execução de Testes</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4">
                            <div class="bg-success text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0">1</div>
                            <div>
                                <h4 class="font-semibold">Executar Migrations de Teste</h4>
                                <div class="code-block mt-2">
                                    <code class="text-green-400">docker-compose exec app php artisan migrate --env=testing</code>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-success text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0">2</div>
                            <div>
                                <h4 class="font-semibold">Executar Todos os Testes</h4>
                                <div class="code-block mt-2">
                                    <code class="text-green-400">docker-compose exec app php artisan test</code>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-success text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0">3</div>
                            <div>
                                <h4 class="font-semibold">Testes Específicos</h4>
                                <div class="code-block mt-2">
                                    <code class="text-green-400"># Testes de API</code><br>
                                    <code class="text-green-400">docker-compose exec app php artisan test --filter UserApiTest</code><br>
                                    <code class="text-green-400"># Testes de Serviço</code><br>
                                    <code class="text-green-400">docker-compose exec app php artisan test --filter UserServiceTest</code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sequences vs Serial Explanation -->
            <div class="bg-white rounded-xl shadow-lg p-6 mt-6">
                <h3 class="text-2xl font-semibold mb-4">🔍 Sequences vs Serial no PostgreSQL</h3>
                
                <div class="alert alert-info mb-4">
                    <strong>Por que usamos Sequences explicitamente e não o tipo SERIAL?</strong>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h4 class="font-semibold text-lg mb-2">Sequences Explícitas</h4>
                        <ul class="list-disc list-inside space-y-2 text-gray-700">
                            <li><strong>Controle total</strong> sobre a sequência</li>
                            <li><strong>Flexibilidade</strong> para compartilhar sequences entre tabelas</li>
                            <li><strong>Performance</strong> em cenários de alta concorrência</li>
                            <li><strong>Transparência</strong> - você vê exatamente o que está acontecendo</li>
                            <li><strong>Compatibilidade</strong> com diferentes versões do PostgreSQL</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-2">Problemas com SERIAL</h4>
                        <ul class="list-disc list-inside space-y-2 text-gray-700">
                            <li><strong>Abstração</strong> que esconde a implementação real</li>
                            <li><strong>Limitações</strong> em operações avançadas</li>
                            <li><strong>Dependência</strong> de comportamento implícito</li>
                            <li><strong>Problemas</strong> com replicação e backup</li>
                            <li><strong>Menos controle</strong> sobre os valores da sequência</li>
                        </ul>
                    </div>
                </div>

                <div class="code-block">
                    <code class="text-yellow-300">// Nossa abordagem - Sequences explícitas</code><br>
                    <code class="text-yellow-300">CREATE SEQUENCE users_id_seq;</code><br>
                    <code class="text-yellow-300">CREATE TABLE users (</code><br>
                    <code class="text-yellow-300">    id BIGINT DEFAULT nextval('users_id_seq') PRIMARY KEY,</code><br>
                    <code class="text-yellow-300">    ...</code><br>
                    <code class="text-yellow-300">);</code><br><br>
                    
                    <code class="text-gray-500">// vs Abordagem SERIAL (não usada)</code><br>
                    <code class="text-gray-500">CREATE TABLE users (</code><br>
                    <code class="text-gray-500">    id SERIAL PRIMARY KEY,  // Cria sequence implicitamente</code><br>
                    <code class="text-gray-500">    ...</code><br>
                    <code class="text-gray-500">);</code>
                </div>
            </div>

            <!-- Redis Usage Explanation -->
            <div class="bg-white rounded-xl shadow-lg p-6 mt-6">
                <h3 class="text-2xl font-semibold mb-4">⚡ Uso do Redis na Aplicação</h3>
                
                <div class="alert alert-success mb-4">
                    <strong>Redis implementado para cache, sessões e filas</strong>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="text-center p-4 bg-red-50 rounded-lg">
                        <i class="fas fa-bolt text-red-500 text-2xl mb-2"></i>
                        <h4 class="font-semibold">Cache</h4>
                        <p class="text-sm text-gray-600">Dados frequentemente acessados</p>
                    </div>
                    <div class="text-center p-4 bg-red-50 rounded-lg">
                        <i class="fas fa-users text-red-500 text-2xl mb-2"></i>
                        <h4 class="font-semibold">Sessões</h4>
                        <p class="text-sm text-gray-600">Gerenciamento de estado do usuário</p>
                    </div>
                    <div class="text-center p-4 bg-red-50 rounded-lg">
                        <i class="fas fa-tasks text-red-500 text-2xl mb-2"></i>
                        <h4 class="font-semibold">Filas</h4>
                        <p class="text-sm text-gray-600">Processamento assíncrono</p>
                    </div>
                </div>

                <div class="code-block">
                    <code class="text-yellow-300">// Configuração no .env</code><br>
                    <code class="text-yellow-300">CACHE_DRIVER=redis</code><br>
                    <code class="text-yellow-300">SESSION_DRIVER=redis</code><br>
                    <code class="text-yellow-300">QUEUE_CONNECTION=redis</code><br><br>
                    
                    <code class="text-yellow-300">REDIS_HOST=redis</code><br>
                    <code class="text-yellow-300">REDIS_PASSWORD=null</code><br>
                    <code class="text-yellow-300">REDIS_PORT=6379</code>
                </div>
            </div>
        </section>

        <!-- API Documentation -->
        <section id="api-docs" class="mb-16">
            <h2 class="text-3xl font-bold text-secondary mb-8">📚 Manual da API</h2>

            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-2xl font-semibold mb-4">Documentação Oficial</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold">Acesse:</h4>
                        <a href="http://localhost:8000/api/documentation" target="_parent" class="text-primary">http://localhost:8000/api/documentation</a>
                    </div>
                </div>
            </div>

            <h2 class="text-3xl font-bold text-secondary mb-8">📚 Guia Rápido da API</h2>

            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-2xl font-semibold mb-4">Informações Gerais</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold">Base URL</h4>
                        <code class="text-primary">http://localhost:8000/api/v1</code>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold">Content-Type</h4>
                        <code>application/json</code>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold">Autenticação</h4>
                        <code>Bearer Token (Sanctum)</code>
                    </div>
                </div>
            </div>

            <!-- Users Endpoints -->
            <div class="mb-8">
                <h3 class="text-2xl font-semibold mb-6 text-secondary">👥 CRUD de Usuários</h3>
                
                <!-- List Users -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="endpoint-method method-get">GET</span>
                            <code class="font-mono text-lg">/users</code>
                        </div>
                        <button class="copy-btn bg-gray-100 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">Lista todos os usuários cadastrados</p>
                    
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Response (200)</h4>
                        <div class="code-block">
                            <code class="text-yellow-300">
{
  "data": [
    {
      "id": 1,
      "name": "João Silva",
      "email": "joao@example.com",
      "created_at": "2024-01-01T00:00:00.000000Z",
      "updated_at": "2024-01-01T00:00:00.000000Z"
    }
  ]
}
                            </code>
                        </div>
                    </div>
                </div>

                <!-- Create User -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="endpoint-method method-post">POST</span>
                            <code class="font-mono text-lg">/users</code>
                        </div>
                        <button class="copy-btn bg-gray-100 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">Cria um novo usuário</p>
                    
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Request Body</h4>
                        <div class="code-block">
                            <code class="text-yellow-300">
{
  "name": "João Silva",
  "email": "joao@example.com",
  "password": "senha123"
}
                            </code>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Validation Rules</h4>
                        <ul class="list-disc list-inside text-gray-700">
                            <li><code>name</code>: required|string|max:255</li>
                            <li><code>email</code>: required|email|unique:users</li>
                            <li><code>password</code>: required|string|min:8</li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Response (201)</h4>
                        <div class="code-block">
                            <code class="text-yellow-300">
{
  "data": {
    "id": 1,
    "name": "João Silva",
    "email": "joao@example.com",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
  }
}
                            </code>
                        </div>
                    </div>
                </div>

                <!-- Get User -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="endpoint-method method-get">GET</span>
                            <code class="font-mono text-lg">/users/{id}</code>
                        </div>
                        <button class="copy-btn bg-gray-100 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">Busca um usuário específico</p>
                    
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Response (200)</h4>
                        <div class="code-block">
                            <code class="text-yellow-300">
{
  "data": {
    "id": 1,
    "name": "João Silva",
    "email": "joao@example.com",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
  }
}
                            </code>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Response (404 - Not Found)</h4>
                        <div class="code-block">
                            <code class="text-yellow-300">
{
  "error": "User not found"
}
                            </code>
                        </div>
                    </div>
                </div>

                <!-- Update User -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="endpoint-method method-put">PUT</span>
                            <code class="font-mono text-lg">/users/{id}</code>
                        </div>
                        <button class="copy-btn bg-gray-100 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">Atualiza um usuário existente</p>
                    
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Request Body</h4>
                        <div class="code-block">
                            <code class="text-yellow-300">
{
  "name": "João Santos",
  "email": "joao.santos@example.com"
}
                            </code>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Validation Rules</h4>
                        <ul class="list-disc list-inside text-gray-700">
                            <li><code>name</code>: sometimes|string|max:255</li>
                            <li><code>email</code>: sometimes|email|unique:users,email,{id}</li>
                            <li><code>password</code>: sometimes|string|min:8</li>
                        </ul>
                    </div>
                </div>

                <!-- Delete User -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="endpoint-method method-delete">DELETE</span>
                            <code class="font-mono text-lg">/users/{id}</code>
                        </div>
                        <button class="copy-btn bg-gray-100 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">Exclui um usuário (Soft Delete)</p>
                    
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Response (204 - No Content)</h4>
                        <p class="text-gray-600">Resposta vazia em caso de sucesso</p>
                    </div>
                </div>
            </div>

            <!-- Posts Endpoints -->
            <div class="mb-8">
                <h3 class="text-2xl font-semibold mb-6 text-secondary">📝 CRUD de Posts</h3>
                
                <!-- List Posts -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="endpoint-method method-get">GET</span>
                            <code class="font-mono text-lg">/posts</code>
                        </div>
                        <button class="copy-btn bg-gray-100 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">Lista todos os posts com usuário e tags</p>
                    
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Response (200)</h4>
                        <div class="code-block">
                            <code class="text-yellow-300">
{
  "data": [
    {
      "id": 1,
      "title": "Meu Primeiro Post",
      "content": "Conteúdo do post...",
      "published": true,
      "published_at": "2024-01-01T00:00:00.000000Z",
      "created_at": "2024-01-01T00:00:00.000000Z",
      "updated_at": "2024-01-01T00:00:00.000000Z",
      "user": {
        "id": 1,
        "name": "João Silva",
        "email": "joao@example.com"
      },
      "tags": [
        {
          "id": 1,
          "name": "Tecnologia",
          "slug": "tecnologia"
        }
      ]
    }
  ]
}
                            </code>
                        </div>
                    </div>
                </div>

                <!-- List Published Posts -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="endpoint-method method-get">GET</span>
                            <code class="font-mono text-lg">/posts/published</code>
                        </div>
                        <button class="copy-btn bg-gray-100 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">Lista apenas posts publicados</p>
                </div>

                <!-- Create Post -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="endpoint-method method-post">POST</span>
                            <code class="font-mono text-lg">/posts</code>
                        </div>
                        <button class="copy-btn bg-gray-100 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">Cria um novo post com tags</p>
                    
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Request Body</h4>
                        <div class="code-block">
                            <code class="text-yellow-300">
{
  "user_id": 1,
  "title": "Meu Primeiro Post",
  "content": "Conteúdo do post...",
  "published": true,
  "tag_ids": [1, 2]
}
                            </code>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Validation Rules</h4>
                        <ul class="list-disc list-inside text-gray-700">
                            <li><code>user_id</code>: required|exists:users,id</li>
                            <li><code>title</code>: required|string|max:255</li>
                            <li><code>content</code>: required|string</li>
                            <li><code>published</code>: boolean</li>
                            <li><code>tag_ids</code>: sometimes|array</li>
                            <li><code>tag_ids.*</code>: exists:tags,id</li>
                        </ul>
                    </div>
                </div>

                <!-- Get Post -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="endpoint-method method-get">GET</span>
                            <code class="font-mono text-lg">/posts/{id}</code>
                        </div>
                        <button class="copy-btn bg-gray-100 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">Busca um post específico com relacionamentos</p>
                </div>

                <!-- Update Post -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="endpoint-method method-put">PUT</span>
                            <code class="font-mono text-lg">/posts/{id}</code>
                        </div>
                        <button class="copy-btn bg-gray-100 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">Atualiza um post existente</p>
                    
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Request Body</h4>
                        <div class="code-block">
                            <code class="text-yellow-300">
{
  "title": "Título Atualizado",
  "content": "Conteúdo atualizado...",
  "published": false,
  "tag_ids": [1, 3]
}
                            </code>
                        </div>
                    </div>
                </div>

                <!-- Delete Post -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="endpoint-method method-delete">DELETE</span>
                            <code class="font-mono text-lg">/posts/{id}</code>
                        </div>
                        <button class="copy-btn bg-gray-100 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">Exclui um post (Soft Delete)</p>
                </div>
            </div>

            <!-- Tags Endpoints -->
            <div class="mb-8">
                <h3 class="text-2xl font-semibold mb-6 text-secondary">🏷️ CRUD de Tags</h3>
                
                <!-- List Tags -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="endpoint-method method-get">GET</span>
                            <code class="font-mono text-lg">/tags</code>
                        </div>
                        <button class="copy-btn bg-gray-100 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">Lista todas as tags</p>
                    
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Response (200)</h4>
                        <div class="code-block">
                            <code class="text-yellow-300">
{
  "data": [
    {
      "id": 1,
      "name": "Tecnologia",
      "slug": "tecnologia",
      "description": "Posts sobre tecnologia",
      "created_at": "2024-01-01T00:00:00.000000Z",
      "updated_at": "2024-01-01T00:00:00.000000Z"
    }
  ]
}
                            </code>
                        </div>
                    </div>
                </div>

                <!-- Create Tag -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="endpoint-method method-post">POST</span>
                            <code class="font-mono text-lg">/tags</code>
                        </div>
                        <button class="copy-btn bg-gray-100 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">Cria uma nova tag</p>
                    
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Request Body</h4>
                        <div class="code-block">
                            <code class="text-yellow-300">
{
  "name": "Tecnologia",
  "description": "Posts sobre tecnologia"
}
                            </code>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Validation Rules</h4>
                        <ul class="list-disc list-inside text-gray-700">
                            <li><code>name</code>: required|string|max:255|unique:tags</li>
                            <li><code>description</code>: sometimes|string</li>
                        </ul>
                    </div>
                </div>

                <!-- Get Tag -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="endpoint-method method-get">GET</span>
                            <code class="font-mono text-lg">/tags/{id}</code>
                        </div>
                        <button class="copy-btn bg-gray-100 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">Busca uma tag específica</p>
                </div>

                <!-- Update Tag -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="endpoint-method method-put">PUT</span>
                            <code class="font-mono text-lg">/tags/{id}</code>
                        </div>
                        <button class="copy-btn bg-gray-100 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">Atualiza uma tag existente</p>
                    
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Request Body</h4>
                        <div class="code-block">
                            <code class="text-yellow-300">
{
  "name": "PHP Laravel",
  "description": "Framework PHP para desenvolvimento web"
}
                            </code>
                        </div>
                    </div>
                </div>

                <!-- Delete Tag -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="endpoint-method method-delete">DELETE</span>
                            <code class="font-mono text-lg">/tags/{id}</code>
                        </div>
                        <button class="copy-btn bg-gray-100 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">Exclui uma tag (Soft Delete)</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-secondary text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <div class="flex justify-center space-x-6 mb-4">
                <a href="#" class="hover:text-accent transition-colors">
                    <i class="fab fa-github text-2xl"></i>
                </a>
                <a href="#" class="hover:text-accent transition-colors">
                    <i class="fab fa-docker text-2xl"></i>
                </a>
                <a href="#" class="hover:text-accent transition-colors">
                    <i class="fab fa-laravel text-2xl"></i>
                </a>
            </div>
            <p class="text-gray-400">UEFS Netra API - Desenvolvido com Laravel 12, PHP 8.2, PostgreSQL e Redis</p>
            <p class="text-gray-500 text-sm mt-2">Arquitetura em camadas com Repository Pattern e Service Layer</p>
        </div>
    </footer>

    <script>
        // Copy to clipboard functionality
        document.querySelectorAll('.copy-btn').forEach(button => {
            button.addEventListener('click', function() {
                const codeBlock = this.closest('.bg-white').querySelector('code');
                const textToCopy = codeBlock.textContent;
                
                navigator.clipboard.writeText(textToCopy).then(() => {
                    const originalHTML = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check"></i> Copiado!';
                    this.classList.add('bg-green-100', 'text-green-600');
                    
                    setTimeout(() => {
                        this.innerHTML = originalHTML;
                        this.classList.remove('bg-green-100', 'text-green-600');
                    }, 2000);
                });
            });
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>