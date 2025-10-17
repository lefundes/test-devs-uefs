<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use App\Transformers\PostTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use OpenApi\Annotations as OA;

class PostController extends Controller
{
    public function __construct(
        private PostService $postService,
        private Manager $fractal
    ) {}

    /**
     * @OA\Get(
     *     path="/posts",
     *     summary="Listar todos os posts",
     *     tags={"Posts"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de posts recuperada com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Post")
     *             )
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $posts = $this->postService->getAllPosts();
        $resource = new Collection($posts, new PostTransformer());

        return response()->json($this->fractal->createData($resource)->toArray());
    }

    /**
     * @OA\Get(
     *     path="/posts/published",
     *     summary="Listar posts publicados",
     *     tags={"Posts"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de posts publicados recuperada com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Post")
     *             )
     *         )
     *     )
     * )
     */
    public function published(): JsonResponse
    {
        $posts = $this->postService->getPublishedPosts();
        $resource = new Collection($posts, new PostTransformer());

        return response()->json($this->fractal->createData($resource)->toArray());
    }

    /**
     * @OA\Post(
     *     path="/posts",
     *     summary="Criar um novo post",
     *     tags={"Posts"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do post a ser criado",
     *         @OA\JsonContent(
     *             required={"user_id", "title", "content"},
     *             ref="#/components/schemas/PostCreate"
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Post criado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/Post")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Dados de entrada inválidos",
     *         @OA\JsonContent(ref="#/components/schemas/ValidationError")
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published' => 'boolean',
            'tag_ids' => 'sometimes|array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $data = $request->only(['user_id', 'title', 'content', 'published']);
        $tagIds = $request->input('tag_ids', []);

        $post = $this->postService->createPost($data, $tagIds);
        $resource = new Item($post, new PostTransformer());

        return response()->json($this->fractal->createData($resource)->toArray(), 201);
    }

    /**
     * @OA\Get(
     *     path="/posts/{id}",
     *     summary="Buscar post específico",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do post",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/Post")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post não encontrado",
     *         @OA\JsonContent(ref="#/components/schemas/Error")
     *     )
     * )
     */
    public function show($id): JsonResponse
    {
        $post = $this->postService->getPostById($id);
        
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $resource = new Item($post, new PostTransformer());
        return response()->json($this->fractal->createData($resource)->toArray());
    }

    /**
     * @OA\Put(
     *     path="/posts/{id}",
     *     summary="Atualizar post",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do post",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do post a ser atualizado",
     *         @OA\JsonContent(ref="#/components/schemas/PostUpdate")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post atualizado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/Post")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post não encontrado",
     *         @OA\JsonContent(ref="#/components/schemas/Error")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Dados de entrada inválidos",
     *         @OA\JsonContent(ref="#/components/schemas/ValidationError")
     *     )
     * )
     */
    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'published' => 'boolean',
            'tag_ids' => 'sometimes|array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $data = $request->only(['title', 'content', 'published']);
        $tagIds = $request->input('tag_ids', []);

        $post = $this->postService->updatePost($id, $data, $tagIds);
        
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $resource = new Item($post, new PostTransformer());
        return response()->json($this->fractal->createData($resource)->toArray());
    }

    /**
     * @OA\Delete(
     *     path="/posts/{id}",
     *     summary="Excluir post",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do post",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Post excluído com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post não encontrado",
     *         @OA\JsonContent(ref="#/components/schemas/Error")
     *     )
     * )
     */
    public function destroy($id): JsonResponse
    {
        $deleted = $this->postService->deletePost($id);
        
        if (!$deleted) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        return response()->json(null, 204);
    }
}