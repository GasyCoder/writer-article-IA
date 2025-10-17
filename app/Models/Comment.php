<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id', 'article_id'];

    // Un commentaire appartient à un utilisateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Un commentaire appartient à un article
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}