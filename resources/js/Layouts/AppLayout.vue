<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { useDarkMode } from '@/Composables/useDarkMode';

const mobileMenuOpen = ref(false);
const { isDark, toggleDarkMode, initTheme } = useDarkMode();

onMounted(() => {
    initTheme();
});
</script>

<template>
    <div class="min-h-screen bg-white dark:bg-gray-950 transition-colors duration-200">
        <!-- Navigation -->
        <nav class="bg-white/90 dark:bg-gray-900/90 backdrop-blur-lg shadow-sm sticky top-0 z-50 border-b border-gray-200 dark:border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo -->
                    <div class="flex items-center space-x-8">
                        <Link href="/" class="flex items-center space-x-2">
                            <div class="w-9 h-9 bg-gray-900 dark:bg-white rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white dark:text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <span class="text-xl font-light text-gray-900 dark:text-white tracking-tight">
                                MiniBlog
                            </span>
                        </Link>

                        <!-- Navigation Links Desktop -->
                        <div class="hidden md:flex items-center space-x-1">
                            <Link href="/" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-lg text-sm font-light transition-colors">
                                Accueil
                            </Link>
                            <Link href="/articles" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-lg text-sm font-light transition-colors">
                                Articles
                            </Link>
                            <Link href="/categories" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-lg text-sm font-light transition-colors">
                                Catégories
                            </Link>
                        </div>
                    </div>

                    <!-- Navigation Desktop Right -->
                    <div class="hidden md:flex items-center space-x-3">
                        <!-- Dark Mode Toggle -->
                        <button
                            @click="toggleDarkMode"
                            class="p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors"
                            aria-label="Toggle dark mode"
                        >
                            <svg v-if="!isDark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                            <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </button>

                        <template v-if="$page.props.auth.user">
                            <Link
                                v-if="$page.props.auth.user.role === 'admin' || $page.props.auth.user.role === 'writer'"
                                href="/admin/dashboard"
                                class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-lg text-sm font-light transition-colors"
                            >
                                Dashboard
                            </Link>

                            <Link href="/profile" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-lg text-sm font-light transition-colors">
                                Profil
                            </Link>

                            <Link href="/logout" method="post" as="button" class="bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-4 py-2 rounded-lg text-sm font-light hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
                                Déconnexion
                            </Link>
                        </template>

                        <template v-else>
                            <Link href="/login" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-lg text-sm font-light transition-colors">
                                Connexion
                            </Link>
                            <Link href="/register" class="bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-4 py-2 rounded-lg text-sm font-light hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
                                Inscription
                            </Link>
                        </template>
                    </div>

                    <!-- Bouton menu mobile -->
                    <div class="md:hidden flex items-center space-x-2">
                        <!-- Dark Mode Toggle Mobile -->
                        <button
                            @click="toggleDarkMode"
                            class="p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors"
                            aria-label="Toggle dark mode"
                        >
                            <svg v-if="!isDark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                            <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </button>

                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path v-if="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Menu Mobile -->
            <div v-if="mobileMenuOpen" class="md:hidden bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
                <div class="px-4 pt-2 pb-3 space-y-1">
                    <Link href="/" class="block px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-light">
                        Accueil
                    </Link>
                    <Link href="/articles" class="block px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-light">
                        Articles
                    </Link>
                    <Link href="/categories" class="block px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-light">
                        Catégories
                    </Link>

                    <template v-if="$page.props.auth.user">
                        <Link
                            v-if="$page.props.auth.user.role === 'admin' || $page.props.auth.user.role === 'writer'"
                            href="/admin/dashboard"
                            class="block px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-light"
                        >
                            Dashboard
                        </Link>
                        <Link href="/profile" class="block px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-light">
                            Profil
                        </Link>
                        <Link href="/logout" method="post" as="button" class="block w-full text-left px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-light">
                            Déconnexion
                        </Link>
                    </template>
                    <template v-else>
                        <Link href="/login" class="block px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-light">
                            Connexion
                        </Link>
                        <Link href="/register" class="block px-3 py-2 rounded-lg bg-gray-900 dark:bg-white text-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-gray-100 text-sm font-light">
                            Inscription
                        </Link>
                    </template>
                </div>
            </div>
        </nav>

        <!-- Contenu principal -->
        <main class="py-8 px-4 sm:px-6 lg:px-8">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-white/90 dark:bg-gray-900/90 backdrop-blur-lg border-t border-gray-200 dark:border-gray-800 mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="text-center">
                    <p class="text-sm font-light text-gray-600 dark:text-gray-400">
                        © 2025 MiniBlog • Créé avec Laravel & Vue.js
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>
