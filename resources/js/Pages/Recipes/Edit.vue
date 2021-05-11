<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ recipe.name }}
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <RecipeForm id="summary" :recipe="recipe" />

                <jet-section-border />

                <RecipeItemsForm id="ingredients" :recipe="recipe" class="mt-10" />

            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetSectionBorder from "@/Jetstream/SectionBorder";
import RecipeForm from "@/Pages/Recipes/RecipeForm";
import RecipeItemsForm from "@/Pages/Recipes/RecipeItemsForm";

export default {
    components: {
        RecipeForm,
        AppLayout,
        JetSectionBorder,
        RecipeItemsForm,
    },
    props: ['recipe']
}
</script>
