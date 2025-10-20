<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';

defineProps({
    categories: Object,
});

const deleteCategory = (id) => {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')) {
        router.delete(`/admin/categories/${id}`);
    }
};
</script>

<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- En-tête -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Gestion des Catégories</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">{{ categories.total }} catégorie(s) au total</p>
                </div>
                <Link
                    href="/admin/categories/create"
                    class="bg-gradient-to-r from-green-500 to-teal-600 text-white px-6 py-3 rounded-xl font-medium hover:shadow-lg transition-all"
                >
                    ➕ Nouvelle Catégorie
                </Link>
            </div>

            <!-- Tableau des catégories -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Articles</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <tr v-for="category in categories.data" :key="category.id" class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ category.name }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ category.slug }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-700 dark:text-gray-300">
                                    {{ category.description || 'Aucune description' }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                    {{ category.articles_count }} article(s)
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                {{ new Date(category.created_at).toLocaleDateString('fr-FR') }}
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                                <Link
                                    :href="`/admin/categories/${category.id}/edit`"
                                    class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300"
                                >
                                    Modifier
                                </Link>
                                <button
                                    @click="deleteCategory(category.id)"
                                    class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300"
                                    :disabled="category.articles_count > 0"
                                    :class="{ 'opacity-50 cursor-not-allowed': category.articles_count > 0 }"
                                    :title="category.articles_count > 0 ? 'Impossible de supprimer une catégorie avec des articles' : 'Supprimer'"
                                >
                                    Supprimer
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div v-if="categories.links.length > 3" class="flex justify-center space-x-2 mt-8">
                <Link
                    v-for="link in categories.links"
                    :key="link.label"
                    :href="link.url"
                    :class="[
                        'px-4 py-2 rounded-lg text-sm font-medium transition-all',
                        link.active
                            ? 'bg-green-600 text-white'
                            : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-gray-700'
                    ]"
                    v-html="link.label"
                />
            </div>
        </div>
    </AppLayout>
</template>
