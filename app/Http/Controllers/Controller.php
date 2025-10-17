<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="UEFS Netra API",
 *     version="1.0.0",
 *     description="API RESTful para gerenciamento de usuários, posts e tags",
 *     @OA\Contact(
 *         email="angelolefundes@yahoo.com.br",
 *         name="Desenvolvedor UEFS Netra"
 *     )
 * )
 * 
 * @OA\Server(
 *     url="http://localhost:8000/api/v1",
 *     description="Servidor Local"
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     in="header",
 *     name="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 * 
 * @OA\Schema(
 *     schema="Error",
 *     type="object",
 *     @OA\Property(property="error", type="string")
 * )
 * 
 * @OA\Schema(
 *     schema="Success",
 *     type="object",
 *     @OA\Property(property="message", type="string")
 * )
 * 
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="João Silva"),
 *     @OA\Property(property="email", type="string", example="joao@example.com"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 * 
 * @OA\Schema(
 *     schema="UserCreate",
 *     type="object",
 *     required={"name", "email", "password"},
 *     @OA\Property(property="name", type="string", maxLength=255, example="João Silva"),
 *     @OA\Property(property="email", type="string", format="email", example="joao@example.com"),
 *     @OA\Property(property="password", type="string", minLength=8, example="senha123")
 * )
 * 
 * @OA\Schema(
 *     schema="UserUpdate",
 *     type="object",
 *     @OA\Property(property="name", type="string", maxLength=255, example="João Santos"),
 *     @OA\Property(property="email", type="string", format="email", example="joao.santos@example.com"),
 *     @OA\Property(property="password", type="string", minLength=8, example="novasenha123")
 * )
 * 
 * @OA\Schema(
 *     schema="Post",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Meu Primeiro Post"),
 *     @OA\Property(property="content", type="string", example="Conteúdo do post..."),
 *     @OA\Property(property="published", type="boolean", example=true),
 *     @OA\Property(property="published_at", type="string", format="date-time", nullable=true),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 *     @OA\Property(property="user", ref="#/components/schemas/User"),
 *     @OA\Property(property="tags", type="array", @OA\Items(ref="#/components/schemas/Tag"))
 * )
 * 
 * @OA\Schema(
 *     schema="PostCreate",
 *     type="object",
 *     required={"user_id", "title", "content"},
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", maxLength=255, example="Meu Primeiro Post"),
 *     @OA\Property(property="content", type="string", example="Conteúdo do post..."),
 *     @OA\Property(property="published", type="boolean", example=true),
 *     @OA\Property(property="tag_ids", type="array", @OA\Items(type="integer"), example={1, 2})
 * )
 * 
 * @OA\Schema(
 *     schema="PostUpdate",
 *     type="object",
 *     @OA\Property(property="title", type="string", maxLength=255, example="Título Atualizado"),
 *     @OA\Property(property="content", type="string", example="Conteúdo atualizado..."),
 *     @OA\Property(property="published", type="boolean", example=false),
 *     @OA\Property(property="tag_ids", type="array", @OA\Items(type="integer"), example={1, 3})
 * )
 * 
 * @OA\Schema(
 *     schema="Tag",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Tecnologia"),
 *     @OA\Property(property="slug", type="string", example="tecnologia"),
 *     @OA\Property(property="description", type="string", example="Posts sobre tecnologia"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 * 
 * @OA\Schema(
 *     schema="TagCreate",
 *     type="object",
 *     required={"name"},
 *     @OA\Property(property="name", type="string", maxLength=255, example="Tecnologia"),
 *     @OA\Property(property="description", type="string", example="Posts sobre tecnologia")
 * )
 * 
 * @OA\Schema(
 *     schema="TagUpdate",
 *     type="object",
 *     @OA\Property(property="name", type="string", maxLength=255, example="PHP Laravel"),
 *     @OA\Property(property="description", type="string", example="Framework PHP para desenvolvimento web")
 * )
 * 
 * @OA\Schema(
 *     schema="ValidationError",
 *     type="object",
 *     @OA\Property(property="message", type="string", example="The given data was invalid."),
 *     @OA\Property(
 *         property="errors",
 *         type="object",
 *         @OA\Property(
 *             property="field_name",
 *             type="array",
 *             @OA\Items(type="string", example="The field name is required.")
 *         )
 *     )
 * )
 */

abstract class Controller
{
    //
}