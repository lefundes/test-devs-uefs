@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h3 class="text-2xl font-bold text-gray-800 mb-2">Visão Geral do Sistema</h3>
    <p class="text-gray-600">Estatísticas e resumo dos dados da aplicação</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="card bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total de Usuários</p>
                <h4 class="text-3xl font-bold text-primary">{{ $stats['users_count'] }}</h4>
            </div>
            <div class="bg-blue-100 text-blue-600 rounded-full p-3">
                <i class="fas fa-users text-2xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('users.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                Ver todos →
            </a>
        </div>
    </div>

    <div class="card bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total de Posts</p>
                <h4 class="text-3xl font-bold text-green-600">{{ $stats['posts_count'] }}</h4>
            </div>
            <div class="bg-green-100 text-green-600 rounded-full p-3">
                <i class="fas fa-file-alt text-2xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('posts.index') }}" class="text-green-600 hover:text-green-800 text-sm font-medium">
                Ver todos →
            </a>
        </div>
    </div>

    <div class="card bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total de Tags</p>
                <h4 class="text-3xl font-bold text-purple-600">{{ $stats['tags_count'] }}</h4>
            </div>
            <div class="bg-purple-100 text-purple-600 rounded-full p-3">
                <i class="fas fa-tags text-2xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('tags.index') }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium">
                Ver todas →
            </a>
        </div>
    </div>
</div>

<!-- Recent Data -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Users -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h4 class="text-lg font-semibold text-gray-800 mb-4">Usuários Recentes</h4>
        <div class="space-y-4">
            @forelse($recentUsers as $user)
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-100 text-blue-600 rounded-full w-10 h-10 flex items-center justify-center">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">{{ $user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    </div>
                </div>
                <span class="text-sm text-gray-500">{{ $user->created_at->format('d/m/Y') }}</span>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">Nenhum usuário cadastrado</p>
            @endforelse
        </div>
    </div>

    <!-- Recent Posts -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h4 class="text-lg font-semibold text-gray-800 mb-4">Posts Recentes</h4>
        <div class="space-y-4">
            @forelse($recentPosts as $post)
            <div class="p-3 bg-gray-50 rounded-lg">
                <div class="flex justify-between items-start mb-2">
                    <h5 class="font-medium text-gray-800">{{ Str::limit($post->title, 40) }}</h5>
                    <span class="text-xs px-2 py-1 rounded-full {{ $post->published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $post->published ? 'Publicado' : 'Rascunho' }}
                    </span>
                </div>
                <p class="text-sm text-gray-600 mb-2">{{ Str::limit($post->content, 60) }}</p>
                <div class="flex justify-between items-center text-xs text-gray-500">
                    <span>Por: {{ $post->user->name }}</span>
                    <span>{{ $post->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">Nenhum post criado</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8 bg-white rounded-xl shadow-lg p-6">
    <h4 class="text-lg font-semibold text-gray-800 mb-4">Ações Rápidas</h4>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="javascript:void(0)" onclick="showDevelopmentAlert('Novo Usuário')" class="flex items-center justify-center p-4 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors cursor-pointer">
            <i class="fas fa-user-plus mr-2"></i>
            Novo Usuário
        </a>
        <a href="javascript:void(0)" onclick="showDevelopmentAlert('Novo Post')" class="flex items-center justify-center p-4 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition-colors cursor-pointer">
            <i class="fas fa-plus mr-2"></i>
            Novo Post
        </a>
        <a href="javascript:void(0)" onclick="showDevelopmentAlert('Nova Tag')" class="flex items-center justify-center p-4 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100 transition-colors cursor-pointer">
            <i class="fas fa-tag mr-2"></i>
            Nova Tag
        </a>
    </div>
</div>

@endsection