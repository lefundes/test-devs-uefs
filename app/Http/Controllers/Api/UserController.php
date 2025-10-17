<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Transformers\UserTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use OpenApi\Annotations as OA;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService,
        private Manager $fractal
    ) {}

    /**
     * @OA\Get(
     *     path="/users",
     *     summary="Listar todos os usuários",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de usuários",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/User"))
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $users = $this->userService->getAllUsers();
        $resource = new Collection($users, new UserTransformer());

        return response()->json($this->fractal->createData($resource)->toArray());
    }

    /**
     * @OA\Post(
     *     path="/users",
     *     summary="Criar um novo usuário",
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserCreate")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Usuário criado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Dados de entrada inválidos",
     *         @OA\JsonContent(ref="#/components/schemas/Error")
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = $this->userService->createUser($request->all());
        $resource = new Item($user, new UserTransformer());

        return response()->json($this->fractal->createData($resource)->toArray(), 201);
    }

    /**
     * @OA\Get(
     *     path="/users/{id}",
     *     summary="Buscar usuário específico",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do usuário",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuário encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Usuário não encontrado",
     *         @OA\JsonContent(ref="#/components/schemas/Error")
     *     )
     * )
     */
    public function show($id): JsonResponse
    {
        $user = $this->userService->getUserById($id);
        
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $resource = new Item($user, new UserTransformer());
        return response()->json($this->fractal->createData($resource)->toArray());
    }

    /**
     * @OA\Put(
     *     path="/users/{id}",
     *     summary="Atualizar usuário",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do usuário",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserUpdate")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuário atualizado",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Usuário não encontrado",
     *         @OA\JsonContent(ref="#/components/schemas/Error")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Dados de entrada inválidos",
     *         @OA\JsonContent(ref="#/components/schemas/Error")
     *     )
     * )
     */
    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:8',
        ]);

        $updated = $this->userService->updateUser($id, $request->all());
        
        if (!$updated) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user = $this->userService->getUserById($id);
        $resource = new Item($user, new UserTransformer());

        return response()->json($this->fractal->createData($resource)->toArray());
    }

    /**
     * @OA\Delete(
     *     path="/users/{id}",
     *     summary="Excluir usuário",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do usuário",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Usuário excluído com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Usuário não encontrado",
     *         @OA\JsonContent(ref="#/components/schemas/Error")
     *     )
     * )
     */
    public function destroy($id): JsonResponse
    {
        $deleted = $this->userService->deleteUser($id);
        
        if (!$deleted) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json(null, 204);
    }
}