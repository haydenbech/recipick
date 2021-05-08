<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Recipes
                </h2>
                <a :href="route('recipes.create')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Create
                </a>
            </div>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <div>
                    <ul class="grid grid-cols-4 gap-4">
                        <li v-for="recipe in recipes" :key="recipe.id" class="flex flex-col justify-between shadow-md sm:rounded-lg p-4 bg-white">
                            <!-- Content -->
                            <div>
                                <inertia-link :href="route('recipes.show', recipe)">{{ recipe.name }}</inertia-link><br>
                                <div class="text-sm text-gray-500 mb-3">{{ recipe.description }}</div>
                            </div>
                            <!-- Meta -->
                            <div class="flex justify-between">
                                <div class="text-sm text-gray-500">
                                    {{ recipe.preparation_time ?? '?' }} | {{ recipe.cooking_time ?? '?' }} min
                                </div>

                                <div class="text-sm text-gray-500">
                                    Serves {{ recipe.servings ?? '?' }}
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    props: ['recipes'],

    components: {
        AppLayout,
    },
}
</script>
