<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';

defineProps({
    articles: Object,
});

const deleteArticle = (id) => {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet article ?')) {
        router.delete(`/admin/articles/${id}`);
    }
};
</script>

<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- En-tête -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">📝 Gestion des Articles</h1>
                    <p class="text-gray-600 mt-1">{{ articles.total }} article(s) au total</p>
                </div>
                <Link 
                    href="/admin/articles/create"
                    class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-6 py-3 rounded-xl font-medium hover:shadow-lg transition-all"
                >
                    ➕ Nouvel Article
                </Link>
            </div>

            <!-- Tableau des articles -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Auteur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="article in articles.data" :key="article.id" class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ article.title }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                    {{ article.category.name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ article.user.name }}
                            </td>
                            <td class="px-6 py-4">
                                <span 
                                    :class="[
                                        'px-2 py-1 text-xs font-semibold rounded-full',
                                        article.published 
                                            ? 'bg-green-100 text-green-800' 
                                            : 'bg-yellow-100 text-yellow-800'
                                    ]"
                                >
                                    {{ article.published ? 'Publié' : 'Brouillon' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ new Date(article.created_at).toLocaleDateString('fr-FR') }}
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                                <Link 
                                    :href="`/admin/articles/${article.id}/edit`"
                                    class="text-indigo-600 hover:text-indigo-900"
                                >
                                    Modifier
                                </Link>
                                <button 
                                    @click="deleteArticle(article.id)"
                                    class="text-red-600 hover:text-red-900"
                                >
                                    Supprimer
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div v-if="articles.links.length > 3" class="flex justify-center space-x-2 mt-8">
                <Link 
                    v-for="link in articles.links" 
                    :key="link.label"
                    :href="link.url"
                    :class="[
                        'px-4 py-2 rounded-lg text-sm font-medium transition-all',
                        link.active 
                            ? 'bg-indigo-600 text-white' 
                            : 'bg-white text-gray-700 hover:bg-indigo-50'
                    ]"
                    v-html="link.label"
                />
            </div>
        </div>
    </AppLayout>
</template>