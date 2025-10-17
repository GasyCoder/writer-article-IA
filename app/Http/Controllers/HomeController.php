<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $articles = Article::with(['user', 'category'])
            ->where('published', true)
            ->latest()
            ->paginate(9);

        return Inertia::render('Home', [
            'articles' => $articles
        ]);
    }
}