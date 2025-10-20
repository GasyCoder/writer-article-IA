<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer toutes les catégories
        $categories = Category::all();

        // Récupérer le premier utilisateur ou en créer un
        $user = User::first();

        if (!$user) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        $articles = [
            [
                'title' => 'Introduction à Laravel 11',
                'excerpt' => 'Découvrez les nouvelles fonctionnalités de Laravel 11 et comment migrer votre application.',
                'content' => "# Introduction à Laravel 11\n\nLaravel 11 apporte son lot de nouveautés et d'améliorations...\n\n## Nouvelles fonctionnalités\n\n- Performance améliorée\n- Nouvelle syntaxe pour les routes\n- Meilleure gestion des jobs\n\n## Migration depuis Laravel 10\n\nVoici les étapes pour migrer votre application...",
            ],
            [
                'title' => 'Vue 3 et Composition API',
                'excerpt' => 'Maîtrisez la Composition API de Vue 3 pour créer des applications plus maintenables.',
                'content' => "# Vue 3 et Composition API\n\nLa Composition API est l'une des fonctionnalités les plus importantes de Vue 3...\n\n## Avantages\n\n- Meilleure réutilisabilité du code\n- TypeScript natif\n- Performance optimisée",
            ],
            [
                'title' => 'Les principes du Design System',
                'excerpt' => 'Comment créer et maintenir un design system efficace pour votre équipe.',
                'content' => "# Les principes du Design System\n\nUn design system est essentiel pour maintenir la cohérence visuelle...\n\n## Composants essentiels\n\n- Couleurs et typographie\n- Composants réutilisables\n- Documentation claire",
            ],
            [
                'title' => 'ChatGPT et le futur de l\'IA',
                'excerpt' => 'L\'impact des modèles de langage sur notre quotidien et le développement logiciel.',
                'content' => "# ChatGPT et le futur de l'IA\n\nLes modèles de langage comme ChatGPT révolutionnent notre façon de travailler...\n\n## Applications pratiques\n\n- Assistance au développement\n- Génération de contenu\n- Automatisation des tâches",
            ],
            [
                'title' => 'Docker pour les débutants',
                'excerpt' => 'Apprenez les bases de Docker et la conteneurisation de vos applications.',
                'content' => "# Docker pour les débutants\n\nDocker simplifie le déploiement et la gestion des applications...\n\n## Concepts clés\n\n- Images et conteneurs\n- Docker Compose\n- Volumes et réseaux",
            ],
            [
                'title' => 'Sécuriser votre API REST',
                'excerpt' => 'Les meilleures pratiques pour protéger vos APIs contre les attaques.',
                'content' => "# Sécuriser votre API REST\n\nLa sécurité est primordiale lors du développement d'APIs...\n\n## Points essentiels\n\n- Authentification JWT\n- Rate limiting\n- Validation des données\n- CORS et HTTPS",
            ],
        ];

        foreach ($articles as $index => $articleData) {
            $category = $categories->random();

            Article::create([
                'title' => $articleData['title'],
                'slug' => Str::slug($articleData['title']),
                'excerpt' => $articleData['excerpt'],
                'content' => $articleData['content'],
                'published' => true,
                'user_id' => $user->id,
                'category_id' => $category->id,
            ]);
        }
    }
}
