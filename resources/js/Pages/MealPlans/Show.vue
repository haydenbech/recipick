<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ mealPlan.name }}
                </h2>
                <div class="space-x-2">
                    <jet-danger-button @click="confirmPlanDeletion">
                        Delete
                    </jet-danger-button>

                    <!-- Delete Plan Confirmation Modal -->
                    <jet-confirmation-modal :show="confirmingPlanDeletion" @close="confirmingPlanDeletion = false">
                        <template #title>
                            Delete Plan
                        </template>

                        <template #content>
                            Are you sure you want to delete this meal plan?
                        </template>

                        <template #footer>
                            <jet-secondary-button @click.native="confirmingPlanDeletion = false">
                                Nevermind
                            </jet-secondary-button>

                            <jet-danger-button class="ml-2" @click.native="deletePlan" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Delete Plan
                            </jet-danger-button>
                        </template>
                    </jet-confirmation-modal>

                    <a :href="route('mealPlans.edit', [mealPlan])" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
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
                            {{ mealPlan.name }}
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            {{ mealPlan.start_date }}
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
    props: ['mealPlan'],

    components: {
        AppLayout,
        JetDangerButton,
        JetConfirmationModal,
        JetSecondaryButton,
    },

    data() {
        return {
            confirmingPlanDeletion: false,

            form: this.$inertia.form(),
        }
    },
    methods: {
        confirmPlanDeletion() {
            this.confirmingPlanDeletion = true;
        },

        deletePlan() {
            this.form.delete(route('mealPlans.destroy', [this.mealPlan]), {
                preserveScroll: true,
                onSuccess: () => this.closeModal(),
            })
        },

        closeModal() {
            this.confirmingPlanDeletion = false
        },
    },
}
</script>
