<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display dashboard with statistics.
     */
    public function index(): View
    {
        // Estatísticas principais
        $stats = [
            'users_count' => User::count(),
            'posts_count' => Post::count(),
            'tags_count' => Tag::count(),
        ];

        // Dados recentes
        $recentPosts = Post::with('user')
            ->latest()
            ->take(5)
            ->get();

        $recentUsers = User::latest()
            ->take(5)
            ->get();

        // Estatística adicional (se necessário para outros usos)
        $publishedPosts = Post::where('published', true)->count();

        return view('dashboard', compact(
            'stats',
            'recentPosts',
            'recentUsers',
            'publishedPosts'
        ));
    }

    /**
     * Instruções de uso da app.
     */    
    public function readme(){
        return view('readme');       
    }
}