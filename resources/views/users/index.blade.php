@extends('layouts.app')

@section('content')
<div class="mb-8">
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Gerenciar Usuários</h3>
            <p class="text-gray-600">Lista de todos os usuários do sistema</p>
        </div>
        <a href="{{ route('web.users.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center">
            <i class="fas fa-user-plus mr-2"></i>
            Novo Usuário
        </a>
    </div>
</div>

<!-- Alertas -->
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
    <div class="flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        <span>{{ session('success') }}</span>
    </div>
</div>
@endif

<!-- Users Table -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="overflow-x-hidden">
        <table id="users-datatable" class="table table-striped table-bordered foo-data-table-filterable default footable-loaded footable dataTable no-footer w-full whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50 text-left">
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Usuário</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">Data Cadastro</th>
                    <th class="px-6 py-3 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection

@push('page-scripts')
<!-- JavaScript para ações e carregamentos de dados do datatable -->
<script src="{{ asset('/js/users/main.js') }}"></script>

<!-- JavaScript para confirmação de exclusão -->
<script>
function confirmDelete(userId) {
    if (confirm('Tem certeza que deseja excluir este usuário? Esta ação não pode ser desfeita.')) {
        const form = document.getElementById('delete-form');
        form.action = '{{ url("users") }}/' + userId;
        form.submit();
    }
}
</script>
@endpush
