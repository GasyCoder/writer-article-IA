<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    /**
     * Afficher la liste de toutes les catégories
     */
    public function index(): Response
    {
        $categories = Category::withCount('articles')
            ->orderBy('name')
            ->get();

        return Inertia::render('Categories/Index', [
            'categories' => $categories
        ]);
    }

    /**
     * Afficher les articles d'une catégorie spécifique
     */
    public function show(string $slug): Response
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $articles = Article::with(['user', 'category'])
            ->where('category_id', $category->id)
            ->where('published', true)
            ->latest()
            ->paginate(12);

        return Inertia::render('Categories/Show', [
            'category' => $category,
            'articles' => $articles
        ]);
    }
}
