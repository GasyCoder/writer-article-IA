<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { marked } from 'marked';
import { computed } from 'vue';

const props = defineProps({
    article: Object,
});

// Convertir le markdown en HTML
const contentHtml = computed(() => marked(props.article.content));

// Formulaire pour les commentaires
const form = useForm({
    content: '',
});

const submitComment = () => {
    form.post(`/articles/${props.article.id}/comments`, {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <AppLayout>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- En-tête de l'article -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
                <!-- Image principale -->
                <div class="h-96 bg-gradient-to-br from-indigo-400 to-purple-500 relative">
                    <img 
                        v-if="article.image" 
                        :src="`/storage/${article.image}`" 
                        :alt="article.title"
                        class="w-full h-full object-cover"
                    >
                    <div v-else class="w-full h-full flex items-center justify-center">
                        <span class="text-white text-9xl">📝</span>
                    </div>
                </div>

                <!-- Contenu principal -->
                <div class="p-8">
                    <!-- Catégorie -->
                    <div class="mb-4">
                        <span class="bg-indigo-100 text-indigo-800 px-4 py-1 rounded-full text-sm font-semibold">
                            {{ article.category.name }}
                        </span>
                    </div>

                    <!-- Titre -->
                    <h1 class="text-4xl font-extrabold text-gray-900 mb-4">
                        {{ article.title }}
                    </h1>

                    <!-- Métadonnées -->
                    <div class="flex items-center space-x-4 text-gray-600 mb-8 pb-8 border-b border-gray-200">
                        <div class="flex items-center space-x-2">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold">{{ article.user.name.charAt(0) }}</span>
                            </div>
                            <span class="font-medium text-gray-900">{{ article.user.name }}</span>
                        </div>
                        <span>•</span>
                        <span>{{ new Date(article.created_at).toLocaleDateString('fr-FR', { year: 'numeric', month: 'long', day: 'numeric' }) }}</span>
                        <span>•</span>
                        <span>{{ article.comments.length }} commentaire(s)</span>
                    </div>

                    <!-- Contenu de l'article (Markdown converti) -->
                    <div 
                        class="prose prose-lg prose-indigo max-w-none mb-12"
                        v-html="contentHtml"
                    />
                </div>
            </div>

            <!-- Section Commentaires -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    💬 Commentaires ({{ article.comments.length }})
                </h2>

                <!-- Liste des commentaires -->
                <div class="space-y-4 mb-8">
                    <div 
                        v-for="comment in article.comments" 
                        :key="comment.id"
                        class="bg-gray-50 rounded-xl p-4 hover:bg-gray-100 transition-colors"
                    >
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold text-sm">{{ comment.user.name.charAt(0) }}</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-1">
                                    <span class="font-semibold text-gray-900">{{ comment.user.name }}</span>
                                    <span class="text-xs text-gray-500">
                                        {{ new Date(comment.created_at).toLocaleDateString('fr-FR') }}
                                    </span>
                                </div>
                                <p class="text-gray-700">{{ comment.content }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Message si aucun commentaire -->
                    <div v-if="article.comments.length === 0" class="text-center py-8 text-gray-500">
                        Aucun commentaire pour le moment. Soyez le premier à commenter !
                    </div>
                </div>

                <!-- Formulaire d'ajout de commentaire -->
                <div v-if="$page.props.auth.user" class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Ajouter un commentaire</h3>
                    <form @submit.prevent="submitComment">
                        <textarea 
                            v-model="form.content"
                            rows="4"
                            placeholder="Partagez votre avis..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none"
                            required
                        />
                        <div class="mt-4 flex justify-end">
                            <button 
                                type="submit"
                                :disabled="form.processing"
                                class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-6 py-3 rounded-xl font-medium hover:shadow-lg transition-all disabled:opacity-50"
                            >
                                {{ form.processing ? 'Envoi...' : 'Publier le commentaire' }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Message si non connecté -->
                <div v-else class="border-t border-gray-200 pt-6 text-center">
                    <p class="text-gray-600 mb-4">Vous devez être connecté pour commenter.</p>
                    <a href="/login" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                        Se connecter
                    </a>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style>
/* Styles pour le contenu markdown */
.prose h1 { @apply text-3xl font-bold text-gray-900 mt-8 mb-4; }
.prose h2 { @apply text-2xl font-bold text-gray-900 mt-6 mb-3; }
.prose h3 { @apply text-xl font-bold text-gray-900 mt-4 mb-2; }
.prose p { @apply text-gray-700 leading-relaxed mb-4; }
.prose strong { @apply font-bold text-gray-900; }
.prose ul { @apply list-disc list-inside mb-4 text-gray-700; }
.prose ol { @apply list-decimal list-inside mb-4 text-gray-700; }
.prose a { @apply text-indigo-600 hover:text-indigo-800 underline; }
.prose code { @apply bg-gray-100 px-2 py-1 rounded text-sm text-red-600; }
.prose blockquote { @apply border-l-4 border-indigo-500 pl-4 italic text-gray-700 my-4; }
</style>