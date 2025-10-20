<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    stats: Object,
});
</script>

<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">📊 Dashboard Admin</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Gérez votre blog facilement</p>
            </div>

            <!-- Cartes de navigation -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Articles -->
                <Link 
                    href="/admin/articles"
                    class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl shadow-lg p-8 text-white hover:shadow-2xl transition-all transform hover:-translate-y-2"
                >
                    <div class="text-5xl mb-4">📝</div>
                    <h2 class="text-2xl font-bold mb-2">Articles</h2>
                    <p class="text-indigo-100">Gérer les articles du blog</p>
                </Link>

                <!-- Catégories -->
                <Link
                    href="/admin/categories"
                    class="bg-gradient-to-br from-green-500 to-teal-600 rounded-2xl shadow-lg p-8 text-white hover:shadow-2xl transition-all transform hover:-translate-y-2"
                >
                    <div class="text-5xl mb-4">🏷️</div>
                    <h2 class="text-2xl font-bold mb-2">Catégories</h2>
                    <p class="text-green-100">Gérer les catégories</p>
                </Link>

                <!-- Utilisateurs -->
                <div class="bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl shadow-lg p-8 text-white opacity-50 cursor-not-allowed">
                    <div class="text-5xl mb-4">👥</div>
                    <h2 class="text-2xl font-bold mb-2">Utilisateurs</h2>
                    <p class="text-orange-100">Bientôt disponible</p>
                </div>
            </div>

            <!-- Statistiques rapides -->
            <div class="mt-12 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">📈 Statistiques</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-indigo-600">{{ stats.articles }}</div>
                        <div class="text-gray-600 dark:text-gray-400 text-sm mt-1">Articles publiés</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-600">{{ stats.comments }}</div>
                        <div class="text-gray-600 dark:text-gray-400 text-sm mt-1">Commentaires</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-purple-600">{{ stats.users }}</div>
                        <div class="text-gray-600 dark:text-gray-400 text-sm mt-1">Utilisateurs</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-orange-600">{{ stats.categories }}</div>
                        <div class="text-gray-600 dark:text-gray-400 text-sm mt-1">Catégories</div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>