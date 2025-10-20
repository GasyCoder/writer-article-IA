<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $stats = [
            'articles' => Article::count(),
            'published_articles' => Article::where('published', true)->count(),
            'categories' => Category::count(),
            'comments' => Comment::count(),
        ];

        $recentArticles = Article::with('category', 'author')
            ->latest()
            ->take(5)
            ->get();

        return Inertia::render('Dashboard', [
            'stats' => $stats,
            'recentArticles' => $recentArticles,
        ]);
    }
}
