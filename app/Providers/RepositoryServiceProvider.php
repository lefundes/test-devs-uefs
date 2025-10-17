<?php

namespace App\Providers;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\PostRepository;
use App\Repositories\TagRepository;
use App\Repositories\UserRepository;
use App\Services\PostService;
use App\Services\TagService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind repositories
        $this->app->bind(RepositoryInterface::class, function ($app, $parameters) {
            $model = $parameters['model'] ?? null;
            
            return match($model) {
                'User' => $app->make(UserRepository::class),
                'Post' => $app->make(PostRepository::class),
                'Tag' => $app->make(TagRepository::class),
                default => throw new \InvalidArgumentException("Unknown model: $model")
            };
        });

        // Bind services
        $this->app->singleton(UserService::class, function ($app) {
            return new UserService($app->make(UserRepository::class));
        });

        $this->app->singleton(PostService::class, function ($app) {
            return new PostService($app->make(PostRepository::class));
        });

        $this->app->singleton(TagService::class, function ($app) {
            return new TagService($app->make(TagRepository::class));
        });
    }
}