<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Inertia\Inertia;
use Inertia\Response;

class ArticleController extends Controller
{
    /**
     * Afficher la liste de tous les articles publiés
     */
    public function index(): Response
    {
        $articles = Article::with(['user', 'category'])
            ->where('published', true)
            ->latest()
            ->paginate(12);

        return Inertia::render('Articles/Index', [
            'articles' => $articles
        ]);
    }

    /**
     * Afficher un article spécifique
     */
    public function show(string $slug): Response
    {
        $article = Article::with(['user', 'category', 'comments.user'])
            ->where('slug', $slug)
            ->where('published', true)
            ->firstOrFail();

        // Récupérer les articles connexes (même catégorie, excluant l'article actuel)
        $relatedArticles = Article::with(['user', 'category'])
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('published', true)
            ->latest()
            ->take(3)
            ->get();

        return Inertia::render('Articles/ArticleShow', [
            'article' => $article,
            'relatedArticles' => $relatedArticles
        ]);
    }
}