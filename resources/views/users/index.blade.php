@extends('layouts.app')

@section('title', 'Gerenciar Usuários')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Gerenciar Usuários</h3>
        <p class="text-gray-600">Lista de todos os usuários cadastrados no sistema</p>
    </div>
    <a href="{{ route('users.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
        <i class="fas fa-user-plus mr-2"></i>Novo Usuário
    </a>
</div>

<!-- Users Table -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuário</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data Cadastro</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="bg-blue-100 text-blue-600 rounded-full w-8 h-8 flex items-center justify-center mr-3">
                                <i class="fas fa-user text-sm"></i>
                            </div>
                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('users.show', $user->id) }}" class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('users.edit', $user->id) }}" class="text-green-600 hover:text-green-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                        Nenhum usuário cadastrado
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($users->hasPages())
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $users->links() }}
    </div>
    @endif
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
    <div class="bg-blue-50 p-4 rounded-lg">
        <div class="text-blue-600 text-sm font-medium">Total de Usuários</div>
        <div class="text-2xl font-bold text-blue-700">{{ $users->total() }}</div>
    </div>
    <div class="bg-green-50 p-4 rounded-lg">
        <div class="text-green-600 text-sm font-medium">Página Atual</div>
        <div class="text-2xl font-bold text-green-700">{{ $users->currentPage() }}</div>
    </div>
    <div class="bg-purple-50 p-4 rounded-lg">
        <div class="text-purple-600 text-sm font-medium">Por Página</div>
        <div class="text-2xl font-bold text-purple-700">{{ $users->perPage() }}</div>
    </div>
    <div class="bg-orange-50 p-4 rounded-lg">
        <div class="text-orange-600 text-sm font-medium">Total de Páginas</div>
        <div class="text-2xl font-bold text-orange-700">{{ $users->lastPage() }}</div>
    </div>
</div>
@endsection