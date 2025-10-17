<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Inertia\Inertia;
use Inertia\Response;

class ArticleController extends Controller
{
    public function show(string $slug): Response
    {
        $article = Article::with(['user', 'category', 'comments.user'])
            ->where('slug', $slug)
            ->where('published', true)
            ->firstOrFail();

        return Inertia::render('Articles/ArticleShow', [
            'article' => $article
        ]);
    }
}