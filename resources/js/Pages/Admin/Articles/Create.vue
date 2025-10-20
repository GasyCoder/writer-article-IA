<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    categories: Array,
});

const form = useForm({
    title: '',
    excerpt: '',
    content: '',
    image: null,
    category_id: '',
    published: false,
});

const imagePreview = ref(null);

const handleImageChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.image = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const submit = () => {
    form.post('/admin/articles', {
        forceFormData: true,
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <AppLayout>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- En-tête -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Créer un Article</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Rédigez un nouvel article pour votre blog</p>
            </div>

            <!-- Formulaire -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Titre -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Titre de l'article *
                        </label>
                        <input
                            id="title"
                            v-model="form.title"
                            type="text"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Un titre accrocheur..."
                            required
                        />
                        <div v-if="form.errors.title" class="text-red-600 text-sm mt-1">{{ form.errors.title }}</div>
                    </div>

                    <!-- Catégorie -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Catégorie *
                        </label>
                        <select
                            id="category"
                            v-model="form.category_id"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            required
                        >
                            <option value="">Sélectionner une catégorie</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                        <div v-if="form.errors.category_id" class="text-red-600 text-sm mt-1">{{ form.errors.category_id }}</div>
                    </div>

                    <!-- Extrait -->
                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Extrait (optionnel)
                        </label>
                        <textarea
                            id="excerpt"
                            v-model="form.excerpt"
                            rows="2"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Un court résumé de l'article..."
                        ></textarea>
                        <div v-if="form.errors.excerpt" class="text-red-600 text-sm mt-1">{{ form.errors.excerpt }}</div>
                    </div>

                    <!-- Contenu -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Contenu (Markdown) *
                        </label>
                        <textarea
                            id="content"
                            v-model="form.content"
                            rows="12"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-mono text-sm"
                            placeholder="# Votre contenu en Markdown..."
                            required
                        ></textarea>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Utilisez Markdown pour formater votre contenu (# Titre, **gras**, *italique*, etc.)
                        </p>
                        <div v-if="form.errors.content" class="text-red-600 text-sm mt-1">{{ form.errors.content }}</div>
                    </div>

                    <!-- Image -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Image de couverture
                        </label>
                        <input
                            id="image"
                            type="file"
                            accept="image/*"
                            @change="handleImageChange"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        />
                        <div v-if="imagePreview" class="mt-4">
                            <img :src="imagePreview" alt="Aperçu" class="max-h-48 rounded-lg shadow-md" />
                        </div>
                        <div v-if="form.errors.image" class="text-red-600 text-sm mt-1">{{ form.errors.image }}</div>
                    </div>

                    <!-- Publier -->
                    <div class="flex items-center">
                        <input
                            id="published"
                            v-model="form.published"
                            type="checkbox"
                            class="w-5 h-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700"
                        />
                        <label for="published" class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Publier immédiatement
                        </label>
                    </div>

                    <!-- Boutons -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a
                            href="/admin/articles"
                            class="px-6 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-all"
                        >
                            Annuler
                        </a>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-6 py-3 rounded-lg bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium hover:shadow-lg transition-all disabled:opacity-50"
                        >
                            {{ form.processing ? 'Création...' : 'Créer l\'article' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
