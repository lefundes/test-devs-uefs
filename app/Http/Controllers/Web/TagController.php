<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tags = Tag::withCount('posts')->latest()->paginate(12);
        
        $tagsWithPosts = Tag::has('posts')->count();

        return view('tags.index', compact('tags', 'tagsWithPosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
            'slug' => 'required|string|max:255|unique:tags,slug',
            'description' => 'nullable|string',
        ]);

        Tag::create($validated);

        return redirect()->route('tags.index')
            ->with('success', 'Tag criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag): View
    {
        $tag->load(['posts' => function ($query) {
            $query->with('user')->latest();
        }]);

        return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag): View
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
            'slug' => 'required|string|max:255|unique:tags,slug,' . $tag->id,
            'description' => 'nullable|string',
        ]);

        $tag->update($validated);

        return redirect()->route('tags.index')
            ->with('success', 'Tag atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('tags.index')
            ->with('success', 'Tag excluída com sucesso!');
    }
}