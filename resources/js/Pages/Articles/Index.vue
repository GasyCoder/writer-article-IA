<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    articles: Object,
});
</script>

<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- En-tête -->
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-4">
                    Tous les Articles
                </h1>
                <p class="text-lg text-gray-600">
                    Découvrez nos dernières publications
                </p>
            </div>

            <!-- Grille d'articles -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <article
                    v-for="article in articles.data"
                    :key="article.id"
                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1"
                >
                    <!-- Image -->
                    <div class="h-48 bg-gradient-to-br from-indigo-400 to-purple-500 relative">
                        <img
                            v-if="article.image"
                            :src="`/storage/${article.image}`"
                            :alt="article.title"
                            class="w-full h-full object-cover"
                        >
                        <div v-else class="w-full h-full flex items-center justify-center">
                            <span class="text-white text-6xl">📝</span>
                        </div>
                    </div>

                    <!-- Contenu -->
                    <div class="p-6">
                        <!-- Catégorie -->
                        <Link
                            :href="`/categories/${article.category.slug}`"
                            class="inline-block bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-xs font-semibold mb-3 hover:bg-indigo-200 transition-colors"
                        >
                            {{ article.category.name }}
                        </Link>

                        <!-- Titre -->
                        <Link :href="`/articles/${article.slug}`">
                            <h2 class="text-xl font-bold text-gray-900 mb-2 hover:text-indigo-600 transition-colors line-clamp-2">
                                {{ article.title }}
                            </h2>
                        </Link>

                        <!-- Extrait -->
                        <p v-if="article.excerpt" class="text-gray-600 mb-4 line-clamp-3">
                            {{ article.excerpt }}
                        </p>

                        <!-- Métadonnées -->
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">{{ article.user.name.charAt(0) }}</span>
                                </div>
                                <span>{{ article.user.name }}</span>
                            </div>
                            <span>{{ new Date(article.created_at).toLocaleDateString('fr-FR') }}</span>
                        </div>
                    </div>

                    <!-- Bouton Lire -->
                    <div class="px-6 pb-6">
                        <Link
                            :href="`/articles/${article.slug}`"
                            class="block w-full text-center bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-4 py-2 rounded-xl font-medium hover:shadow-lg transition-all"
                        >
                            Lire l'article
                        </Link>
                    </div>
                </article>
            </div>

            <!-- Message si aucun article -->
            <div v-if="articles.data.length === 0" class="text-center py-16">
                <div class="text-6xl mb-4">📭</div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Aucun article disponible</h3>
                <p class="text-gray-600">Revenez bientôt pour découvrir de nouveaux contenus !</p>
            </div>

            <!-- Pagination -->
            <div v-if="articles.links.length > 3" class="flex justify-center space-x-2">
                <Link
                    v-for="(link, index) in articles.links"
                    :key="index"
                    :href="link.url"
                    :class="{
                        'bg-indigo-600 text-white': link.active,
                        'bg-white text-gray-700 hover:bg-gray-50': !link.active,
                        'cursor-not-allowed opacity-50': !link.url
                    }"
                    class="px-4 py-2 rounded-lg border border-gray-300 transition-colors"
                    v-html="link.label"
                />
            </div>
        </div>
    </AppLayout>
</template>
