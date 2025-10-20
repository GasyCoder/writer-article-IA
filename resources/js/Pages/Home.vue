<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { useReadingTime } from '@/Composables/useReadingTime';

defineProps({
    articles: Object,
});
</script>

<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto">
            <!-- En-tête Hero -->
            <div class="text-center mb-16">
                <h1 class="text-5xl md:text-6xl font-light text-gray-900 dark:text-white mb-4 tracking-tight">
                    MiniBlog
                </h1>
                <p class="text-xl font-light text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Articles sur la technologie, le design et le développement
                </p>
            </div>

            <!-- Grille des articles -->
            <div v-if="articles.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                <article
                    v-for="article in articles.data"
                    :key="article.id"
                    class="bg-white dark:bg-gray-900 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300 border border-gray-200 dark:border-gray-800 group"
                >
                    <!-- Image de l'article -->
                    <Link :href="`/articles/${article.slug}`" class="block relative">
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

                        <!-- Badge catégorie -->
                        <div class="absolute top-4 left-4">
                            <Link
                                :href="`/categories/${article.category.slug}`"
                                class="inline-block px-3 py-1 rounded-full text-xs font-light bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-900"
                                @click.stop
                            >
                                {{ article.category.name }}
                            </Link>
                        </div>
                    </Link>

                    <!-- Contenu -->
                    <div class="p-6">
                        <h2 class="text-xl font-light text-gray-900 dark:text-white mb-2 line-clamp-2 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                            <Link :href="`/articles/${article.slug}`">
                                {{ article.title }}
                            </Link>
                        </h2>

                        <p class="text-gray-600 dark:text-gray-400 font-light text-sm mb-4 line-clamp-3">
                            {{ article.excerpt || 'Cliquez pour lire cet article...' }}
                        </p>

                        <!-- Infos auteur et date -->
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
                                <time>
                                    {{ new Date(article.created_at).toLocaleDateString('fr-FR', { day: 'numeric', month: 'short' }) }}
                                </time>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Si aucun article -->
            <div v-else class="text-center py-16">
                <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="text-xl font-light text-gray-600 dark:text-gray-400">Aucun article publié pour le moment</p>
            </div>

            <!-- Pagination -->
            <div v-if="articles.links.length > 3" class="flex justify-center items-center space-x-2">
                <Link
                    v-for="link in articles.links"
                    :key="link.label"
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
