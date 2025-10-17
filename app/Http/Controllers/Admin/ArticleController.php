<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class ArticleController extends Controller
{
    public function index(): Response
    {
        $articles = Article::with(['user', 'category'])
            ->latest()
            ->paginate(10);

        return Inertia::render('Admin/Articles/Index', [
            'articles' => $articles
        ]);
    }

    public function create(): Response
    {
        $categories = Category::all();

        return Inertia::render('Admin/Articles/Create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'published' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article créé avec succès !');
    }

    public function edit(Article $article): Response
    {
        $categories = Category::all();

        return Inertia::render('Admin/Articles/Edit', [
            'article' => $article,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'published' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article mis à jour !');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article supprimé !');
    }
}