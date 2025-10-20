<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    categories: Array,
});
</script>

<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto py-12">
            <!-- En-tête -->
            <div class="mb-12">
                <h1 class="text-4xl md:text-5xl font-light text-gray-900 dark:text-white mb-3">
                    Catégories
                </h1>
                <p class="text-lg font-light text-gray-600 dark:text-gray-400">
                    Explorez nos articles par catégorie
                </p>
            </div>

            <!-- Grille de catégories -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <Link
                    v-for="category in categories"
                    :key="category.id"
                    :href="`/categories/${category.slug}`"
                    class="group bg-white dark:bg-gray-900 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-all duration-300 border border-gray-200 dark:border-gray-800"
                >
                    <!-- Contenu -->
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h2 class="text-2xl font-light text-gray-900 dark:text-white mb-2 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors">
                                    {{ category.name }}
                                </h2>

                                <p v-if="category.description" class="text-gray-600 dark:text-gray-400 font-light text-sm line-clamp-2">
                                    {{ category.description }}
                                </p>
                            </div>

                            <svg class="w-6 h-6 text-gray-400 dark:text-gray-600 group-hover:text-gray-600 dark:group-hover:text-gray-400 transition-colors flex-shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>

                        <!-- Nombre d'articles -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-800">
                            <span class="text-sm font-light text-gray-500 dark:text-gray-500">
                                {{ category.articles_count }} {{ category.articles_count > 1 ? 'articles' : 'article' }}
                            </span>
                            <svg class="w-4 h-4 text-gray-400 dark:text-gray-600 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </Link>
            </div>

            <!-- Message si aucune catégorie -->
            <div v-if="categories.length === 0" class="text-center py-16">
                <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <h3 class="text-xl font-light text-gray-900 dark:text-white mb-2">Aucune catégorie disponible</h3>
                <p class="text-gray-600 dark:text-gray-400 font-light">Les catégories seront bientôt ajoutées</p>
            </div>
        </div>
    </AppLayout>
</template>
