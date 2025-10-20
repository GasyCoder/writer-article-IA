<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    description: '',
});

const submit = () => {
    form.post('/admin/categories', {
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
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Créer une Catégorie</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Ajoutez une nouvelle catégorie pour organiser vos articles</p>
            </div>

            <!-- Formulaire -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Nom -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nom de la catégorie *
                        </label>
                        <input
                            id="name"
                            v-model="form.name"
                            type="text"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Ex: Technologie, Voyage, Cuisine..."
                            required
                        />
                        <div v-if="form.errors.name" class="text-red-600 text-sm mt-1">{{ form.errors.name }}</div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description (optionnel)
                        </label>
                        <textarea
                            id="description"
                            v-model="form.description"
                            rows="4"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Décrivez brièvement cette catégorie..."
                        ></textarea>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Maximum 500 caractères
                        </p>
                        <div v-if="form.errors.description" class="text-red-600 text-sm mt-1">{{ form.errors.description }}</div>
                    </div>

                    <!-- Boutons -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a
                            href="/admin/categories"
                            class="px-6 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-all"
                        >
                            Annuler
                        </a>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-6 py-3 rounded-lg bg-gradient-to-r from-green-500 to-teal-600 text-white font-medium hover:shadow-lg transition-all disabled:opacity-50"
                        >
                            {{ form.processing ? 'Création...' : 'Créer la catégorie' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
