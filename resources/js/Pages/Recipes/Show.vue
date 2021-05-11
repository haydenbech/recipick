<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ recipe.name }}
                </h2>
                <div class="space-x-2">
                    <jet-danger-button @click="confirmRecipeDeletion">
                        Delete
                    </jet-danger-button>

                    <!-- Delete Recipe Confirmation Modal -->
                    <jet-confirmation-modal :show="confirmingRecipeDeletion" @close="confirmingRecipeDeletion = false">
                        <template #title>
                            Delete Recipe
                        </template>

                        <template #content>
                            Are you sure you want to delete this recipe?
                        </template>

                        <template #footer>
                            <jet-secondary-button @click.native="confirmingRecipeDeletion = false">
                                Nevermind
                            </jet-secondary-button>

                            <jet-danger-button class="ml-2" @click.native="deleteRecipe" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Delete Recipe
                            </jet-danger-button>
                        </template>
                    </jet-confirmation-modal>

                    <a :href="route('recipes.edit', recipe)" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                        Edit
                    </a>
                </div>
            </div>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{ recipe.name }}
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            {{ recipe.description }}
                        </p>
                    </div>
                    <div class="border-t border-gray-200">
                        <dl>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Preparation Time
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ recipe.preparation_time ?? '?' }} min
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Cooking Time
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ recipe.cooking_time ?? '?' }} min
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Serves
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ recipe.servings ?? '?' }} people
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Effort
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ recipe.effort ?? '?' }} / 10
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Rating
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ recipe.rating ?? '?' }} / 10
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Created
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ recipe.created_at }}
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Updated
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ recipe.updated_at }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div class="bg-white shadow overflow-hidden sm:rounded-lg mt-10">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Ingredients
                        </h3>

                        <ul v-if="recipe.items.length > 0" class="mt-1 max-w-2xl text-sm text-gray-500">
                            <li v-for="item in recipe.items" class="mb-2">
                                {{ item.quantity }}{{ item.unit }} {{ item.ingredient.name }}, {{ item.preparation }}
                            </li>
                        </ul>
                        <p v-else class="mt-1 max-w-2xl text-sm text-gray-500">
                            No ingredients yet. <br>
                            <a :href="route('recipes.edit', recipe)+'#ingredients'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mt-2">
                                Add Ingredients
                            </a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetDangerButton from "@/Jetstream/DangerButton";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    props: ['recipe'],

    components: {
        AppLayout,
        JetDangerButton,
        JetConfirmationModal,
        JetSecondaryButton,
    },

    data() {
        return {
            confirmingRecipeDeletion: false,

            form: this.$inertia.form(),
        }
    },
    methods: {
        confirmRecipeDeletion() {
            this.confirmingRecipeDeletion = true;
        },

        deleteRecipe() {
            this.form.delete(route('recipes.destroy', this.recipe), {
                preserveScroll: true,
                onSuccess: () => this.closeModal(),
            })
        },

        closeModal() {
            this.confirmingRecipeDeletion = false
        },
    },
}
</script>
