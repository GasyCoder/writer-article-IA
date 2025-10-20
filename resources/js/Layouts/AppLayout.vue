<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

// État du menu mobile
const mobileMenuOpen = ref(false);
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
        <!-- Navigation -->
        <nav class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <Link href="/" class="flex items-center space-x-2">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                <span class="text-white font-bold text-xl">✒️</span>
                            </div>
                            <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                MiniBlog
                            </span>
                        </Link>
                    </div>

                    <!-- Navigation Desktop -->
                    <div class="hidden md:flex items-center space-x-4">
                        <Link href="/" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            Accueil
                        </Link>

                        <template v-if="$page.props.auth.user">
                            <!-- Si l'utilisateur est admin ou rédacteur -->
                            <Link 
                                v-if="$page.props.auth.user.role === 'admin' || $page.props.auth.user.role === 'writer'"
                                href="/admin/dashboard" 
                                class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors"
                            >
                                Dashboard
                            </Link>

                            <Link href="/profile" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                                Profil
                            </Link>

                            <Link href="/logout" method="post" as="button" class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:shadow-lg transition-all">
                                Déconnexion
                            </Link>
                        </template>

                        <template v-else>
                            <Link href="/login" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                                Connexion
                            </Link>
                            <Link href="/register" class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:shadow-lg transition-all">
                                Inscription
                            </Link>
                        </template>
                    </div>

                    <!-- Bouton menu mobile -->
                    <div class="md:hidden flex items-center">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-700 hover:text-indigo-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Menu Mobile -->
            <div v-if="mobileMenuOpen" class="md:hidden bg-white border-t border-gray-100">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <Link href="/" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                        Accueil
                    </Link>
                    <template v-if="$page.props.auth.user">
                        <Link 
                            v-if="$page.props.auth.user.role === 'admin' || $page.props.auth.user.role === 'writer'"
                            href="/admin/dashboard" 
                            class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600"
                        >
                            Dashboard
                        </Link>
                        <Link href="/profile" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                            Profil
                        </Link>
                        <Link href="/logout" method="post" as="button" class="block w-full text-left px-3 py-2 rounded-lg text-red-600 hover:bg-red-50">
                            Déconnexion
                        </Link>
                    </template>
                    <template v-else>
                        <Link href="/login" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                            Connexion
                        </Link>
                        <Link href="/register" class="block px-3 py-2 rounded-lg text-white bg-indigo-600 hover:bg-indigo-700">
                            Inscription
                        </Link>
                    </template>
                </div>
            </div>
        </nav>

        <!-- Contenu principal -->
        <main class="py-8">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-white/80 backdrop-blur-md border-t border-gray-100 mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="text-center text-gray-600">
                    <p class="text-sm">© 2025 MiniBlog - Créé avec ❤️ avec Laravel & Vue.js</p>
                </div>
            </div>
        </footer>
    </div>
</template>