<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { useReadingTime } from '@/Composables/useReadingTime';

const props = defineProps({
    category: Object,
    articles: Object,
});
</script>

<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto py-12">
            <!-- En-tête de la catégorie -->
            <div class="mb-12">
                <Link href="/categories" class="inline-flex items-center text-sm font-light text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors mb-6">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Retour aux catégories
                </Link>

                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-sm p-8 border border-gray-200 dark:border-gray-800">
                    <div class="flex items-start">
                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-600 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <div>
                            <h1 class="text-4xl md:text-5xl font-light text-gray-900 dark:text-white mb-3">
                                {{ category.name }}
                            </h1>
                            <p v-if="category.description" class="text-lg font-light text-gray-600 dark:text-gray-400 mb-4">
                                {{ category.description }}
                            </p>
                            <div class="text-sm font-light text-gray-500 dark:text-gray-500">
                                {{ articles.total }} {{ articles.total > 1 ? 'articles' : 'article' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grille d'articles -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                <article
                    v-for="article in articles.data"
                    :key="article.id"
                    class="bg-white dark:bg-gray-900 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300 border border-gray-200 dark:border-gray-800 group"
                >
                    <!-- Image -->
                    <Link :href="`/articles/${article.slug}`" class="block">
                        <div class="h-48 bg-gray-100 dark:bg-gray-800 overflow-hidden">
                            <img
                                v-if="article.image"
                                :src="`/storage/${article.image}`"
                                :alt="article.title"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            >
                            <div v-else class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                    </Link>

                    <!-- Contenu -->
                    <div class="p-6">
                        <!-- Titre -->
                        <Link :href="`/articles/${article.slug}`">
                            <h2 class="text-xl font-light text-gray-900 dark:text-white mb-2 hover:text-gray-600 dark:hover:text-gray-300 transition-colors line-clamp-2">
                                {{ article.title }}
                            </h2>
                        </Link>

                        <!-- Extrait -->
                        <p v-if="article.excerpt" class="text-gray-600 dark:text-gray-400 font-light text-sm mb-4 line-clamp-3">
                            {{ article.excerpt }}
                        </p>

                        <!-- Métadonnées -->
                        <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-500 font-light pt-4 border-t border-gray-100 dark:border-gray-800">
                            <div class="flex items-center space-x-2">
                                <div class="w-6 h-6 bg-gray-200 dark:bg-gray-800 rounded-full flex items-center justify-center">
                                    <span class="text-gray-700 dark:text-gray-300 text-xs">{{ article.user.name.charAt(0) }}</span>
                                </div>
                                <span>{{ article.user.name }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span>{{ useReadingTime(article.content) }} lecture</span>
                                <span>•</span>
                                <time>{{ new Date(article.created_at).toLocaleDateString('fr-FR', { day: 'numeric', month: 'short' }) }}</time>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Message si aucun article -->
            <div v-if="articles.data.length === 0" class="text-center py-16 bg-white dark:bg-gray-900 rounded-lg shadow-sm border border-gray-200 dark:border-gray-800">
                <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-xl font-light text-gray-900 dark:text-white mb-2">Aucun article dans cette catégorie</h3>
                <p class="text-gray-600 dark:text-gray-400 font-light mb-6">Revenez bientôt pour découvrir de nouveaux contenus</p>
                <Link
                    href="/articles"
                    class="inline-block bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-6 py-2 rounded-lg font-light hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors"
                >
                    Voir tous les articles
                </Link>
            </div>

            <!-- Pagination -->
            <div v-if="articles.links.length > 3" class="flex justify-center items-center space-x-2">
                <Link
                    v-for="(link, index) in articles.links"
                    :key="index"
                    :href="link.url"
                    :class="{
                        'bg-gray-900 dark:bg-white text-white dark:text-gray-900': link.active,
                        'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800': !link.active,
                        'cursor-not-allowed opacity-50': !link.url
                    }"
                    class="px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-800 transition-colors text-sm font-light"
                    v-html="link.label"
                />
            </div>
        </div>
    </AppLayout>
</template>
