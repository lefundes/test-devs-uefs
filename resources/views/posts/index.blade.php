@extends('layouts.app')

@section('title', 'Gerenciar Posts')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Gerenciar Posts</h3>
        <p class="text-gray-600">Lista de todos os posts criados no sistema</p>
    </div>
    <div class="flex space-x-3">
        <a href="{{ route('posts.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
            <i class="fas fa-plus mr-2"></i>Novo Post
        </a>
        <a href="{{ route('posts.index', ['published' => 'true']) }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-eye mr-2"></i>Publicados
        </a>
        <a href="{{ route('posts.index', ['published' => 'false']) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition-colors">
            <i class="fas fa-eye-slash mr-2"></i>Rascunhos
        </a>
    </div>
</div>

<!-- Posts Table -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Autor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tags</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($posts as $post)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ Str::limit($post->title, 50) }}</div>
                        <div class="text-sm text-gray-500 mt-1">{{ Str::limit($post->content, 70) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="bg-blue-100 text-blue-600 rounded-full w-8 h-8 flex items-center justify-center mr-3">
                                <i class="fas fa-user text-sm"></i>
                            </div>
                            <div class="text-sm text-gray-900">{{ $post->user->name }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs rounded-full {{ $post->published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $post->published ? 'Publicado' : 'Rascunho' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @foreach($post->tags as $tag)
                            <span class="px-2 py-1 text-xs bg-purple-100 text-purple-800 rounded-full">
                                {{ $tag->name }}
                            </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $post->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="text-green-600 hover:text-green-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este post?')">
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
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                        Nenhum post encontrado
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($posts->hasPages())
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $posts->links() }}
    </div>
    @endif
</div>
@endsection