<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technologie',
                'slug' => 'technologie',
                'description' => 'Actualités et tendances technologiques, innovations et découvertes dans le monde du numérique.',
            ],
            [
                'name' => 'Développement Web',
                'slug' => 'developpement-web',
                'description' => 'Tutoriels, astuces et bonnes pratiques pour le développement web moderne.',
            ],
            [
                'name' => 'Design',
                'slug' => 'design',
                'description' => 'UI/UX, design graphique et créativité numérique.',
            ],
            [
                'name' => 'Intelligence Artificielle',
                'slug' => 'intelligence-artificielle',
                'description' => 'Machine Learning, Deep Learning et applications de l\'IA.',
            ],
            [
                'name' => 'DevOps',
                'slug' => 'devops',
                'description' => 'CI/CD, automatisation, conteneurisation et infrastructure cloud.',
            ],
            [
                'name' => 'Sécurité',
                'slug' => 'securite',
                'description' => 'Cybersécurité, bonnes pratiques et protection des données.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
