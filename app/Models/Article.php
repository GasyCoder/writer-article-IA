<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'published',
        'user_id',
        'category_id'
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    // Un article appartient à un utilisateur (auteur)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Un article appartient à une catégorie
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Un article a plusieurs commentaires
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}