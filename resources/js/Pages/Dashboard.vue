<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    stats: Object,
    recentArticles: Array,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Statistiques -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Articles</div>
                        <div class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">{{ stats.articles }}</div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Articles Publiés</div>
                        <div class="mt-1 text-3xl font-semibold text-green-600">{{ stats.published_articles }}</div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Catégories</div>
                        <div class="mt-1 text-3xl font-semibold text-blue-600">{{ stats.categories }}</div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Commentaires</div>
                        <div class="mt-1 text-3xl font-semibold text-purple-600">{{ stats.comments }}</div>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Actions Rapides</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <Link
                                :href="route('admin.articles.index')"
                                class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-indigo-500 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all"
                            >
                                <div class="text-3xl mr-4">📝</div>
                                <div>
                                    <div class="font-semibold text-gray-900 dark:text-white">Gérer les Articles</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Voir, modifier et ajouter des articles</div>
                                </div>
                            </Link>

                            <Link
                                :href="route('admin.articles.create')"
                                class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/20 transition-all"
                            >
                                <div class="text-3xl mr-4">✏️</div>
                                <div>
                                    <div class="font-semibold text-gray-900 dark:text-white">Nouvel Article</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Créer un nouvel article</div>
                                </div>
                            </Link>

                            <Link
                                :href="route('admin.categories.index')"
                                class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all"
                            >
                                <div class="text-3xl mr-4">🏷️</div>
                                <div>
                                    <div class="font-semibold text-gray-900 dark:text-white">Gérer les Catégories</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Voir et modifier les catégories</div>
                                </div>
                            </Link>
                        </div>
                    </div>
                </div>

                <!-- Articles récents -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Articles Récents</h3>
                            <Link
                                :href="route('admin.articles.index')"
                                class="text-sm text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                            >
                                Voir tous →
                            </Link>
                        </div>

                        <div v-if="recentArticles.length > 0" class="space-y-3">
                            <div
                                v-for="article in recentArticles"
                                :key="article.id"
                                class="flex items-center justify-between p-3 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all"
                            >
                                <div class="flex-1">
                                    <div class="flex items-center gap-2">
                                        <Link
                                            :href="route('admin.articles.edit', article.id)"
                                            class="font-medium text-gray-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400"
                                        >
                                            {{ article.title }}
                                        </Link>
                                        <span
                                            v-if="article.published"
                                            class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full"
                                        >
                                            Publié
                                        </span>
                                        <span
                                            v-else
                                            class="px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full"
                                        >
                                            Brouillon
                                        </span>
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        {{ article.category?.name }} • Par {{ article.author?.name }}
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <Link
                                        :href="route('admin.articles.edit', article.id)"
                                        class="px-3 py-1 text-sm text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                    >
                                        Modifier
                                    </Link>
                                </div>
                            </div>
                        </div>

                        <div v-else class="text-center py-8 text-gray-500 dark:text-gray-400">
                            Aucun article pour le moment.
                            <Link
                                :href="route('admin.articles.create')"
                                class="block mt-2 text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                            >
                                Créer votre premier article
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
