<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Un utilisateur a plusieurs articles
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    // Un utilisateur a plusieurs commentaires
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // Vérifier si l'utilisateur est admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Vérifier si l'utilisateur est rédacteur
    public function isWriter(): bool
    {
        return $this->role === 'writer' || $this->isAdmin();
    }
}