<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    categories: Array,
});

// Couleurs aléatoires pour les catégories
const colors = [
    'from-red-400 to-pink-500',
    'from-blue-400 to-indigo-500',
    'from-green-400 to-teal-500',
    'from-yellow-400 to-orange-500',
    'from-purple-400 to-pink-500',
    'from-indigo-400 to-purple-500',
];

const getColorForIndex = (index) => colors[index % colors.length];
</script>

<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- En-tête -->
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-4">
                    Catégories
                </h1>
                <p class="text-lg text-gray-600">
                    Explorez nos articles par catégorie
                </p>
            </div>

            <!-- Grille de catégories -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <Link
                    v-for="(category, index) in categories"
                    :key="category.id"
                    :href="`/categories/${category.slug}`"
                    class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2"
                >
                    <!-- En-tête avec dégradé -->
                    <div :class="`h-32 bg-gradient-to-br ${getColorForIndex(index)} relative`">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-white text-6xl">📂</span>
                        </div>
                    </div>

                    <!-- Contenu -->
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">
                            {{ category.name }}
                        </h2>

                        <p v-if="category.description" class="text-gray-600 mb-4 line-clamp-2">
                            {{ category.description }}
                        </p>

                        <!-- Nombre d'articles -->
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-200">
                            <span class="text-sm text-gray-500">
                                {{ category.articles_count }} article{{ category.articles_count > 1 ? 's' : '' }}
                            </span>
                            <span class="text-indigo-600 group-hover:translate-x-2 transition-transform">
                                →
                            </span>
                        </div>
                    </div>
                </Link>
            </div>

            <!-- Message si aucune catégorie -->
            <div v-if="categories.length === 0" class="text-center py-16">
                <div class="text-6xl mb-4">📂</div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Aucune catégorie disponible</h3>
                <p class="text-gray-600">Les catégories seront bientôt ajoutées !</p>
            </div>
        </div>
    </AppLayout>
</template>
