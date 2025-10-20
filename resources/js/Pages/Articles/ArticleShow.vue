<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';
import { marked } from 'marked';
import { computed } from 'vue';
import { useReadingTime } from '@/Composables/useReadingTime';

const props = defineProps({
    article: Object,
    relatedArticles: {
        type: Array,
        default: () => []
    }
});

const contentHtml = computed(() => marked(props.article.content));
const readingTime = computed(() => useReadingTime(props.article.content));

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
        <div class="max-w-4xl mx-auto">
            <!-- En-tête de l'article -->
            <article class="bg-white dark:bg-gray-900 rounded-lg shadow-sm overflow-hidden mb-8 border border-gray-200 dark:border-gray-800">
                <!-- Image principale -->
                <div v-if="article.image" class="h-96 bg-gray-100 dark:bg-gray-800">
                    <img
                        :src="`/storage/${article.image}`"
                        :alt="article.title"
                        class="w-full h-full object-cover"
                    >
                </div>

                <!-- Contenu principal -->
                <div class="p-8 md:p-12">
                    <!-- Catégorie cliquable -->
                    <div class="mb-6">
                        <Link
                            :href="`/categories/${article.category.slug}`"
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-light border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                        >
                            {{ article.category.name }}
                        </Link>
                    </div>

                    <!-- Titre -->
                    <h1 class="text-4xl md:text-5xl font-light text-gray-900 dark:text-white mb-6 leading-tight">
                        {{ article.title }}
                    </h1>

                    <!-- Métadonnées -->
                    <div class="flex items-center flex-wrap gap-x-4 gap-y-2 text-sm text-gray-600 dark:text-gray-400 mb-8 pb-8 border-b border-gray-200 dark:border-gray-800">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-gray-900 dark:bg-white rounded-full flex items-center justify-center">
                                <span class="text-white dark:text-gray-900 font-light text-sm">{{ article.user.name.charAt(0) }}</span>
                            </div>
                            <span class="font-light">{{ article.user.name }}</span>
                        </div>
                        <span>•</span>
                        <time class="font-light">{{ new Date(article.created_at).toLocaleDateString('fr-FR', { year: 'numeric', month: 'long', day: 'numeric' }) }}</time>
                        <span>•</span>
                        <span class="font-light">{{ readingTime }} lecture</span>
                        <span>•</span>
                        <span class="font-light">{{ article.comments.length }} {{ article.comments.length > 1 ? 'commentaires' : 'commentaire' }}</span>
                    </div>

                    <!-- Contenu de l'article (Markdown converti) -->
                    <div
                        class="prose prose-lg max-w-none dark:prose-invert"
                        v-html="contentHtml"
                    />
                </div>
            </article>

            <!-- Articles connexes -->
            <div v-if="relatedArticles.length > 0" class="mb-8">
                <h2 class="text-2xl font-light text-gray-900 dark:text-white mb-6">Articles connexes</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <article
                        v-for="relatedArticle in relatedArticles"
                        :key="relatedArticle.id"
                        class="bg-white dark:bg-gray-900 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300 border border-gray-200 dark:border-gray-800 group"
                    >
                        <!-- Image -->
                        <Link :href="`/articles/${relatedArticle.slug}`" class="block relative">
                            <div class="h-40 bg-gray-100 dark:bg-gray-800 overflow-hidden">
                                <img
                                    v-if="relatedArticle.image"
                                    :src="`/storage/${relatedArticle.image}`"
                                    :alt="relatedArticle.title"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                >
                                <div v-else class="w-full h-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Badge catégorie -->
                            <div class="absolute top-3 left-3">
                                <span class="inline-block px-2 py-1 rounded-full text-xs font-light bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300">
                                    {{ relatedArticle.category.name }}
                                </span>
                            </div>
                        </Link>

                        <!-- Contenu -->
                        <div class="p-5">
                            <h3 class="text-lg font-light text-gray-900 dark:text-white mb-2 line-clamp-2 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                <Link :href="`/articles/${relatedArticle.slug}`">
                                    {{ relatedArticle.title }}
                                </Link>
                            </h3>

                            <p class="text-gray-600 dark:text-gray-400 font-light text-sm mb-3 line-clamp-2">
                                {{ relatedArticle.excerpt || 'Cliquez pour lire cet article...' }}
                            </p>

                            <!-- Infos -->
                            <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-500 font-light pt-3 border-t border-gray-100 dark:border-gray-800">
                                <div class="flex items-center space-x-2">
                                    <div class="w-5 h-5 bg-gray-200 dark:bg-gray-800 rounded-full flex items-center justify-center">
                                        <span class="text-gray-700 dark:text-gray-300 text-xs">{{ relatedArticle.user.name.charAt(0) }}</span>
                                    </div>
                                    <span>{{ relatedArticle.user.name }}</span>
                                </div>
                                <span class="font-light">{{ useReadingTime(relatedArticle.content) }} lecture</span>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <!-- Section Commentaires -->
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-sm p-8 border border-gray-200 dark:border-gray-800">
                <h2 class="text-2xl font-light text-gray-900 dark:text-white mb-8">
                    Commentaires <span class="text-gray-500 dark:text-gray-400">({{ article.comments.length }})</span>
                </h2>

                <!-- Liste des commentaires -->
                <div class="space-y-6 mb-8">
                    <div
                        v-for="comment in article.comments"
                        :key="comment.id"
                        class="border-l-2 border-gray-200 dark:border-gray-800 pl-4 py-2"
                    >
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-gray-200 dark:bg-gray-800 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-gray-700 dark:text-gray-300 font-light text-xs">{{ comment.user.name.charAt(0) }}</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="font-light text-gray-900 dark:text-white">{{ comment.user.name }}</span>
                                    <span class="text-xs font-light text-gray-500 dark:text-gray-500">
                                        {{ new Date(comment.created_at).toLocaleDateString('fr-FR') }}
                                    </span>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 font-light">{{ comment.content }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Message si aucun commentaire -->
                    <div v-if="article.comments.length === 0" class="text-center py-12 text-gray-500 dark:text-gray-500 font-light">
                        Aucun commentaire pour le moment
                    </div>
                </div>

                <!-- Formulaire d'ajout de commentaire -->
                <div v-if="$page.props.auth.user" class="border-t border-gray-200 dark:border-gray-800 pt-8">
                    <h3 class="text-lg font-light text-gray-900 dark:text-white mb-4">Ajouter un commentaire</h3>
                    <form @submit.prevent="submitComment">
                        <textarea
                            v-model="form.content"
                            rows="4"
                            placeholder="Partagez votre avis..."
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-950 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-500 focus:ring-1 focus:ring-gray-400 dark:focus:ring-gray-600 focus:border-transparent resize-none font-light"
                            required
                        />
                        <div class="mt-4 flex justify-end">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-6 py-2 rounded-lg font-light hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors disabled:opacity-50"
                            >
                                {{ form.processing ? 'Envoi...' : 'Publier' }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Message si non connecté -->
                <div v-else class="border-t border-gray-200 dark:border-gray-800 pt-8 text-center">
                    <p class="text-gray-600 dark:text-gray-400 font-light mb-4">Connectez-vous pour commenter</p>
                    <Link href="/login" class="inline-block bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-6 py-2 rounded-lg hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors font-light">
                        Se connecter
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style>
/* Styles pour le contenu markdown */
.prose { @apply text-gray-700 dark:text-gray-300 font-light; }
.prose h1 { @apply text-3xl font-light text-gray-900 dark:text-white mt-8 mb-4; }
.prose h2 { @apply text-2xl font-light text-gray-900 dark:text-white mt-6 mb-3; }
.prose h3 { @apply text-xl font-light text-gray-900 dark:text-white mt-4 mb-2; }
.prose p { @apply leading-relaxed mb-4; }
.prose strong { @apply font-normal text-gray-900 dark:text-white; }
.prose ul { @apply list-disc list-inside mb-4; }
.prose ol { @apply list-decimal list-inside mb-4; }
.prose a { @apply text-gray-900 dark:text-white underline hover:no-underline; }
.prose code { @apply bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded text-sm; }
.prose blockquote { @apply border-l-4 border-gray-300 dark:border-gray-700 pl-4 italic my-4; }
.prose pre { @apply bg-gray-100 dark:bg-gray-800 p-4 rounded-lg overflow-x-auto; }
.prose img { @apply rounded-lg my-6; }
</style>
