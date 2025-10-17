<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Créer un admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@blog.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Créer un rédacteur
        $writer = User::create([
            'name' => 'John Doe',
            'email' => 'writer@blog.com',
            'password' => bcrypt('password'),
            'role' => 'writer',
            'email_verified_at' => now(),
        ]);

        // Créer des utilisateurs simples
        $users = User::factory(5)->create();

        // Créer des catégories
        $categories = [
            ['name' => 'Technologie', 'slug' => 'technologie', 'description' => 'Articles sur la tech'],
            ['name' => 'Design', 'slug' => 'design', 'description' => 'Articles sur le design'],
            ['name' => 'Business', 'slug' => 'business', 'description' => 'Articles business'],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle', 'description' => 'Articles lifestyle'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Créer des articles
        $articles = [
            [
                'title' => 'Introduction à Laravel 11',
                'slug' => 'introduction-laravel-11',
                'excerpt' => 'Découvrez les nouveautés de Laravel 11',
                'content' => "# Introduction à Laravel 11\n\nLaravel 11 apporte de nombreuses **améliorations** :\n\n- Nouvelle structure de dossiers\n- Performances optimisées\n- Meilleure gestion des files d'attente\n\nC'est un framework **puissant** et **élégant**.",
                'published' => true,
                'user_id' => $admin->id,
                'category_id' => 1,
            ],
            [
                'title' => 'Design Minimaliste en 2025',
                'slug' => 'design-minimaliste-2025',
                'excerpt' => 'Les tendances du design moderne',
                'content' => "# Design Minimaliste\n\nLe design minimaliste est **intemporel**.\n\n## Principes clés\n\n- Moins c'est plus\n- Espaces blancs\n- Typographie claire\n\nAdoptez cette approche pour des interfaces élégantes.",
                'published' => true,
                'user_id' => $writer->id,
                'category_id' => 2,
            ],
            [
                'title' => 'Créer une Startup Tech',
                'slug' => 'creer-startup-tech',
                'excerpt' => 'Guide pour lancer votre startup',
                'content' => "# Créer une Startup\n\nLancer une startup demande **préparation** et **passion**.\n\n## Étapes importantes\n\n1. Trouver une idée\n2. Valider le marché\n3. Construire un MVP\n4. Trouver des investisseurs\n\nBonne chance !",
                'published' => true,
                'user_id' => $admin->id,
                'category_id' => 3,
            ],
        ];

        foreach ($articles as $articleData) {
            $article = Article::create($articleData);

            // Ajouter des commentaires
            foreach ($users->random(3) as $user) {
                Comment::create([
                    'content' => 'Super article ! Merci pour ce contenu de qualité.',
                    'user_id' => $user->id,
                    'article_id' => $article->id,
                ]);
            }
        }
    }
}