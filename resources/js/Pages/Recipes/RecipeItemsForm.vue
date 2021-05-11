<template>
    <jet-form-section>
        <template #title>
            Ingredients (Optional)
        </template>

        <template #description>
            Start adding ingredients to your recipe. You have the option of adding pre-preparation notes to your ingredients (e.g. "chopped"). You can also skip adding ingredients and do it later.
        </template>

        <template #form>

            <recipe-item-form
                v-for="item in recipe.items"
                :recipe="recipe"
                :item="item"
                :key="item.id"
                :editing="false"
            />

            <recipe-item-form :recipe="recipe" :editing="true" :key="'add_recipe_item'" />

        </template>
    </jet-form-section>
</template>

<script>
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import RecipeItemForm from "@/Pages/Recipes/RecipeItemForm";

export default {
    name: "RecipeItemsForm",
    components: {
        RecipeItemForm,
        JetFormSection,
    },
    props: ['recipe'],
}
</script>

<style scoped>

</style>
