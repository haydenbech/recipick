<template>
    <jet-form-section @submitted="store">
        <template #title>
            <template v-if="mealPlan">
                Update Meal Plan
            </template>
            <template v-else>
                Create Meal Plan
            </template>
        </template>

        <template #description>
            Let's plan your week!
        </template>

        <template #form>
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Name" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>

            <!-- Date -->
            <div class="col-span-6 sm:col-span-2">
                <jet-label for="start_date" value="Start Date" />
                <jet-input id="start_date" type="text" class="mt-1 block w-full" v-model="form.start_date" autocomplete="start_date" />
                <jet-input-error :message="form.errors.start_date" class="mt-2" />
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
</template>

<script>
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    name: "MealPlanForm",
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
    },
    props: ['mealPlan'],
    data() {
        return {
            form: this.$inertia.form({
                name: this?.mealPlan?.name,
                start_date: this?.mealPlan?.start_date,
            }),
        }
    },
    methods: {
        store() {
            if(this.mealPlan){
                this.form.put(this.route('mealPlans.update', this.mealPlan))
            } else {
                this.form.post(this.route('mealPlans.store'))
            }
        },
    }
}
</script>

<style scoped>

</style>
