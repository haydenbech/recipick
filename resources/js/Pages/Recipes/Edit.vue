<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ recipe.name }}
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <jet-form-section @submitted="store">
                    <template #title>
                        Update Recipe
                    </template>

                    <template #description>
                        Let's get cooking!
                    </template>

                    <template #form>
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label for="name" value="Name" />
                            <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                            <jet-input-error :message="form.errors.name" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label for="description" value="Description" />
                            <jet-input id="description" type="text" class="mt-1 block w-full" v-model="form.description" />
                            <jet-input-error :message="form.errors.description" class="mt-2" />
                        </div>

                        <!-- Preparation Time -->
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label for="preparation_time" value="Preparation Time" />

                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input id="preparation_time" type="number" min="1" max="1440" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm    block w-full flex-1 rounded-none rounded-l-md" v-model="form.preparation_time" autocomplete="preparation_time">
                                <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                min
                                </span>
                            </div>

                            <jet-input-error :message="form.errors.preparation_time" class="mt-2" />
                        </div>

                        <!-- Cooking Time -->
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label for="cooking_time" value="Cooking Time" />

                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input id="cooking_time" type="number" min="1" max="1440" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm    block w-full flex-1 rounded-none rounded-l-md" v-model="form.cooking_time" autocomplete="cooking_time">
                                <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                min
                                </span>
                            </div>

                            <jet-input-error :message="form.errors.cooking_time" class="mt-2" />
                        </div>

                        <!-- Servings -->
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label for="servings" value="Servings" />

                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input id="servings" type="number" min="1" max="8" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm    block w-full flex-1 rounded-none rounded-l-md" v-model="form.servings" autocomplete="servings">
                                <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                people
                                </span>
                            </div>

                            <jet-input-error :message="form.errors.servings" class="mt-2" />
                        </div>

                        <!-- Effort -->
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label for="effort" value="Effort" />

                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input id="effort" type="number" min="1" max="10" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm    block w-full flex-1 rounded-none rounded-l-md" v-model="form.effort" autocomplete="effort">
                                <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                / 10
                                </span>
                            </div>

                            <jet-input-error :message="form.errors.effort" class="mt-2" />
                        </div>

                        <!-- Rating -->
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label for="rating" value="Rating" />

                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input id="rating" type="number" min="1" max="10" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm    block w-full flex-1 rounded-none rounded-l-md" v-model="form.rating" autocomplete="rating">
                                <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                / 10
                                </span>
                            </div>

                            <jet-input-error :message="form.errors.rating" class="mt-2" />
                        </div>
                    </template>

                    <template #actions>
                        <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                            Saved.
                        </jet-action-message>

                        <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Save
                        </jet-button>
                    </template>
                </jet-form-section>

            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    components: {
        AppLayout,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
    },
    props: ['recipe'],

    data() {
        return {
            form: this.$inertia.form({
                name: this.recipe.name,
                description: this.recipe.description,
                preparation_time: this.recipe.preparation_time,
                cooking_time: this.recipe.cooking_time,
                servings: this.recipe.servings,
                effort: this.recipe.effort,
                rating: this.recipe.rating,
            }),
        }
    },
    methods: {
        store() {
            this.form.put(this.route('recipes.update', this.recipe))
        },
    },
}
</script>
