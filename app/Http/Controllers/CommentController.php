<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'article_id' => $article->id,
        ]);

        return redirect()->back()->with('success', 'Commentaire ajouté avec succès !');
    }
}