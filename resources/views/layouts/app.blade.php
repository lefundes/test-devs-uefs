<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UEFS Netra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ asset('css/datatables/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables/widgets.min.css') }}">    
    <!-- Toastr CSS -->
    <link href="{{ asset('css/alert/toastr.min.css') }}" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        secondary: '#0f172a',
                        accent: '#3b82f6'
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .nav-link {
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            background: #3b82f6;
            color: white;
        }
        .nav-link.active {
            background: #3b82f6;
            color: white;
        }
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar bg-white w-64 shadow-lg">
            <div class="px-6 py-2 bg-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="bg-primary text-white p-2 rounded-lg">
                        <i class="fas fa-code"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-secondary">UEFS Netra</h1>
                    </div>
                </div>
            </div>

            <nav class="mt-6">
                <a href="{{ route('dashboard') }}" class="nav-link flex items-center px-6 py-3 text-gray-700 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar w-6"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                <a href="{{ route('web.users.index') }}" class="nav-link flex items-center px-6 py-3 text-gray-700 {{ request()->routeIs('web.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users w-6"></i>
                    <span class="ml-3">Usuários</span>
                </a>
                <a href="javascript:void(0)" onclick="showDevelopmentAlert('Posts')" class="nav-link flex items-center px-6 py-3 text-gray-700 {{ request()->routeIs('posts.*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt w-6"></i>
                    <span class="ml-3">Posts</span>
                </a>
                <a href="javascript:void(0)" onclick="showDevelopmentAlert('Tags')" class="nav-link flex items-center px-6 py-3 text-gray-700 {{ request()->routeIs('tags.*') ? 'active' : '' }}">
                    <i class="fas fa-tags w-6"></i>
                    <span class="ml-3">Tags</span>
                </a>
                <a href="{{ route('readme') }}" target="_blank" class="nav-link flex items-center px-6 py-3 text-gray-700">
                    <i class="fas fa-exclamation-circle w-6"></i>
                    <span class="ml-3">Instruções</span>
                    <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                </a>
                <a href="http://localhost:8000/api/documentation" target="_blank" class="nav-link flex items-center px-6 py-3 text-gray-700">
                    <i class="fas fa-book w-6"></i>
                    <span class="ml-3">API Docs</span>
                    <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Header -->
            <header class="bg-gray-200 shadow-sm">
                <div class="flex justify-between items-center px-6 py-4">
                    <h2 class="text-2xl font-semibold text-gray-800"></h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">{{ now()->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Mobile sidebar toggle (para responsividade futura)
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('hidden');
        }

        // Auto-refresh data (opcional)
        setInterval(() => {
            if (window.location.pathname === '/dashboard') {
                // Recarregar dados do dashboard a cada 30 segundos
                window.location.reload();
            }
        }, 30000);
    </script>
    
    @yield('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>   
            
    <!-- Datatable JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/datatables/footable.all.js') }}"></script>
    <script src="{{ asset('js/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.tableTools.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap.js') }}"></script>

    <!-- Toastr JS -->
    <script src="{{ asset('js/alert/toastr.min.js') }}"></script>

    <script>
    function showDevelopmentAlert(feature, type = 'warning') {
        const messages = {
            'info': 'Funcionalidade em breve',
            'warning': 'Funcionalidade em desenvolvimento', 
            'error': 'Funcionalidade temporariamente indisponível',
            'success': 'Funcionalidade disponível em breve'
        };
        
        toastr[type](messages[type], feature);
    }
    </script>

    <!-- Scripts específicos da página (carregados DEPOIS de todos os scripts base) -->
    @stack('page-scripts')
</body>
</html>