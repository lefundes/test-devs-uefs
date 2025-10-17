@extends('layouts.app')

@section('title', 'Gerenciar Tags')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Gerenciar Tags</h3>
        <p class="text-gray-600">Lista de todas as tags disponíveis no sistema</p>
    </div>
    <a href="{{ route('tags.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
        <i class="fas fa-tag mr-2"></i>Nova Tag
    </a>
</div>

<!-- Tags Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($tags as $tag)
    <div class="card bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h4 class="text-lg font-semibold text-gray-800">{{ $tag->name }}</h4>
                <p class="text-sm text-gray-500 mt-1">{{ $tag->slug }}</p>
            </div>
            <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">
                {{ $tag->posts_count }} posts
            </span>
        </div>
        
        @if($tag->description)
        <p class="text-gray-600 text-sm mb-4">{{ $tag->description }}</p>
        @endif
        
        <div class="flex justify-between items-center text-sm text-gray-500">
            <span>Criada em: {{ $tag->created_at->format('d/m/Y') }}</span>
            <div class="flex space-x-2">
                <a href="{{ route('tags.show', $tag->id) }}" class="text-blue-600 hover:text-blue-900">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('tags.edit', $tag->id) }}" class="text-green-600 hover:text-green-900">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir esta tag?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-12">
        <i class="fas fa-tags text-4xl text-gray-300 mb-4"></i>
        <p class="text-gray-500 text-lg">Nenhuma tag cadastrada</p>
        <p class="text-gray-400 mt-2">Crie a primeira tag para começar a organizar seus posts</p>
    </div>
    @endforelse
</div>

<!-- Pagination -->
@if($tags->hasPages())
<div class="mt-6 bg-white px-4 py-3 rounded-lg shadow-lg">
    {{ $tags->links() }}
</div>
@endif

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
    <div class="bg-purple-50 p-4 rounded-lg">
        <div class="text-purple-600 text-sm font-medium">Total de Tags</div>
        <div class="text-2xl font-bold text-purple-700">{{ $tags->total() }}</div>
    </div>
    <div class="bg-blue-50 p-4 rounded-lg">
        <div class="text-blue-600 text-sm font-medium">Tags com Posts</div>
        <div class="text-2xl font-bold text-blue-700">{{ $tagsWithPosts }}</div>
    </div>
    <div class="bg-green-50 p-4 rounded-lg">
        <div class="text-green-600 text-sm font-medium">Média por Página</div>
        <div class="text-2xl font-bold text-green-700">{{ round($tags->total() / max($tags->lastPage(), 1), 1) }}</div>
    </div>
</div>
@endsection