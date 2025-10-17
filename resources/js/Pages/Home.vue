<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    articles: Object,
});
</script>

<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- En-tête Hero -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-extrabold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-4">
                    Bienvenue sur MiniBlog
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Découvrez les derniers articles sur la technologie, le design et bien plus encore.
                </p>
            </div>

            <!-- Grille des articles -->
            <div v-if="articles.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <article 
                    v-for="article in articles.data" 
                    :key="article.id"
                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2"
                >
                    <!-- Image de l'article -->
                    <div class="h-48 bg-gradient-to-br from-indigo-400 to-purple-500 relative overflow-hidden">
                        <img 
                            v-if="article.image" 
                            :src="`/storage/${article.image}`" 
                            :alt="article.title"
                            class="w-full h-full object-cover"
                        >
                        <div v-else class="w-full h-full flex items-center justify-center">
                            <span class="text-white text-6xl">📝</span>
                        </div>
                        
                        <!-- Badge catégorie -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-indigo-600">
                                {{ article.category.name }}
                            </span>
                        </div>
                    </div>

                    <!-- Contenu -->
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 hover:text-indigo-600 transition-colors">
                            <Link :href="`/articles/${article.slug}`">
                                {{ article.title }}
                            </Link>
                        </h2>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ article.excerpt || 'Cliquez pour lire cet article...' }}
                        </p>

                        <!-- Infos auteur et date -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">{{ article.user.name.charAt(0) }}</span>
                                </div>
                                <span class="text-sm text-gray-700 font-medium">{{ article.user.name }}</span>
                            </div>
                            <span class="text-xs text-gray-500">
                                {{ new Date(article.created_at).toLocaleDateString('fr-FR') }}
                            </span>
                        </div>

                        <!-- Bouton Lire -->
                        <Link 
                            :href="`/articles/${article.slug}`"
                            class="mt-4 block w-full text-center bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-2 rounded-lg font-medium hover:shadow-lg transition-all"
                        >
                            Lire l'article →
                        </Link>
                    </div>
                </article>
            </div>

            <!-- Si aucun article -->
            <div v-else class="text-center py-12">
                <div class="text-6xl mb-4">📭</div>
                <p class="text-xl text-gray-600">Aucun article publié pour le moment.</p>
            </div>

            <!-- Pagination -->
            <div v-if="articles.links.length > 3" class="flex justify-center space-x-2 mt-12">
                <Link 
                    v-for="link in articles.links" 
                    :key="link.label"
                    :href="link.url"
                    :class="[
                        'px-4 py-2 rounded-lg text-sm font-medium transition-all',
                        link.active 
                            ? 'bg-indigo-600 text-white shadow-lg' 
                            : 'bg-white text-gray-700 hover:bg-indigo-50'
                    ]"
                    v-html="link.label"
                />
            </div>
        </div>
    </AppLayout>
</template>