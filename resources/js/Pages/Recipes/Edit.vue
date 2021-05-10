<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ recipe.name }}
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <RecipeForm :recipe="recipe" />

            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import RecipeForm from "@/Pages/Recipes/RecipeForm";

export default {
    components: {
        RecipeForm,
        AppLayout,
    },
    props: ['recipe']
}
</script>
