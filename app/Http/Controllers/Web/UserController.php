<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private $apiUserController;

    public function __construct()
    {
        $this->apiUserController = new ApiUserController(
            app(\App\Services\UserService::class),
            app(\League\Fractal\Manager::class)
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('users.index');
    }

    /**
     * Datatable para listagem de usuários usando o controller da API diretamente
     */
    public function datatable(Request $request)
    {
        try {
            $draw = $request->input('draw');
            $start = $request->input('start');
            $length = $request->input('length');
            $search = $request->input('search.value');
            $orderColumn = $request->input('order.0.column');
            $orderDir = $request->input('order.0.dir');

            // Usa o controller da API diretamente
            $apiResponse = $this->apiUserController->index();
            $apiData = $apiResponse->getData();
            
            $allUsers = $apiData->data ?? [];

            $totalRecords = count($allUsers);

            // Aplica filtro de busca
            if (!empty($search)) {
                $search = strtolower($search);
                $allUsers = array_filter($allUsers, function ($user) use ($search) {
                    return str_contains(strtolower($user->name ?? ''), $search) ||
                           str_contains(strtolower($user->email ?? ''), $search) ||
                           str_contains(strtolower($user->id ?? ''), $search);
                });
            }

            $filteredRecords = count($allUsers);

            // Aplica ordenação
            if ($orderColumn !== null) {
                $columnMap = [
                    0 => 'name',
                    1 => 'email', 
                    2 => 'created_at',
                    3 => 'status'
                ];
                
                $orderField = $columnMap[$orderColumn] ?? 'name';
                
                usort($allUsers, function ($a, $b) use ($orderField, $orderDir) {
                    $valueA = $a->{$orderField} ?? '';
                    $valueB = $b->{$orderField} ?? '';
                    
                    if ($orderDir === 'asc') {
                        return $valueA <=> $valueB;
                    } else {
                        return $valueB <=> $valueA;
                    }
                });
            }

            // Aplica paginação
            $users = array_slice(array_values($allUsers), $start, $length);

            $data = [];
            foreach ($users as $user) {
                // Formata data de criação
                $createdAt = isset($user->created_at) 
                    ? \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i')
                    : 'N/A';

                // Status (sempre ativo para a API)
                $status = '<center><span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-green-600/20 ring-inset">Ativo</span></center>';

                // Ações
                $actions = '
                    <center>
                        <a href="' . route('web.users.show', $user->id) . '" class="text-blue-600 hover:text-blue-900 px-2 py-1" title="Ver">
                            <i class="fas fa-eye fa-sm"></i>
                        </a>
                        <a href="' . route('web.users.edit', $user->id) . '" class="text-green-600 hover:text-green-900 px-2 py-1" title="Editar">
                            <i class="fas fa-edit fa-sm"></i>
                        </a>
                        <button type="button" onclick="confirmDelete(' . $user->id . ')" class="text-red-600 hover:text-red-900 px-2 py-1" title="Excluir">
                            <i class="fas fa-trash fa-sm"></i>
                        </button>
                    </center>';

                $data[] = [
                    '<div class="flex items-center">
                         <div class="bg-blue-100 text-blue-600 rounded-full w-8 h-8 flex items-center justify-center mr-3">
                             <i class="fas fa-user text-xs"></i>
                         </div>
                         <div>
                             <div class="text-sm font-medium text-gray-900">' . ($user->name ?? 'N/A') . '</div>
                             <div class="text-xs text-gray-500">ID: ' . ($user->id ?? 'N/A') . '</div>
                         </div>
                     </div>',
                    $user->email ?? 'N/A',
                    '<center>' . $createdAt . '</center>',
                    $status,
                    $actions
                ];
            }

            return response()->json([
                'draw' => $draw,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $data,
            ]);

        } catch (\Exception $e) {
            Log::error('Error in UserController@datatable: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'Ocorreu um erro ao carregar os dados: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('web.users.index')
            ->with('success', 'Usuário criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('web.users.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('web.users.index')
            ->with('success', 'Usuário excluído com sucesso!');
    }
}