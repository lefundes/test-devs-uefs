<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TagService;
use App\Transformers\TagTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use OpenApi\Annotations as OA;

class TagController extends Controller
{
    public function __construct(
        private TagService $tagService,
        private Manager $fractal
    ) {}

    /**
     * @OA\Get(
     *     path="/tags",
     *     summary="Listar todas as tags",
     *     tags={"Tags"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de tags recuperada com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Tag")
     *             )
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $tags = $this->tagService->getAllTags();
        $resource = new Collection($tags, new TagTransformer());

        return response()->json($this->fractal->createData($resource)->toArray());
    }

    /**
     * @OA\Post(
     *     path="/tags",
     *     summary="Criar uma nova tag",
     *     tags={"Tags"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados da tag a ser criada",
     *         @OA\JsonContent(
     *             required={"name"},
     *             ref="#/components/schemas/TagCreate"
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tag criada com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/Tag")
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
            'name' => 'required|string|max:255|unique:tags',
            'description' => 'sometimes|string',
        ]);

        $tag = $this->tagService->createTag($request->all());
        $resource = new Item($tag, new TagTransformer());

        return response()->json($this->fractal->createData($resource)->toArray(), 201);
    }

    /**
     * @OA\Get(
     *     path="/tags/{id}",
     *     summary="Buscar tag específica",
     *     tags={"Tags"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da tag",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tag encontrada",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/Tag")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tag não encontrada",
     *         @OA\JsonContent(ref="#/components/schemas/Error")
     *     )
     * )
     */
    public function show($id): JsonResponse
    {
        $tag = $this->tagService->getTagById($id);
        
        if (!$tag) {
            return response()->json(['error' => 'Tag not found'], 404);
        }

        $resource = new Item($tag, new TagTransformer());
        return response()->json($this->fractal->createData($resource)->toArray());
    }

    /**
     * @OA\Put(
     *     path="/tags/{id}",
     *     summary="Atualizar tag",
     *     tags={"Tags"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da tag",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados da tag a ser atualizada",
     *         @OA\JsonContent(ref="#/components/schemas/TagUpdate")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tag atualizada com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/Tag")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tag não encontrada",
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
            'name' => 'sometimes|string|max:255|unique:tags,name,' . $id,
            'description' => 'sometimes|string',
        ]);

        $updated = $this->tagService->updateTag($id, $request->all());
        
        if (!$updated) {
            return response()->json(['error' => 'Tag not found'], 404);
        }

        $tag = $this->tagService->getTagById($id);
        $resource = new Item($tag, new TagTransformer());

        return response()->json($this->fractal->createData($resource)->toArray());
    }

    /**
     * @OA\Delete(
     *     path="/tags/{id}",
     *     summary="Excluir tag",
     *     tags={"Tags"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da tag",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Tag excluída com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tag não encontrada",
     *         @OA\JsonContent(ref="#/components/schemas/Error")
     *     )
     * )
     */
    public function destroy($id): JsonResponse
    {
        $deleted = $this->tagService->deleteTag($id);
        
        if (!$deleted) {
            return response()->json(['error' => 'Tag not found'], 404);
        }

        return response()->json(null, 204);
    }
}