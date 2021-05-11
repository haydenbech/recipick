<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ mealPlan.name }}
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <MealPlanForm id="summary" :meal-plan="mealPlan" />

            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetSectionBorder from "@/Jetstream/SectionBorder";
import MealPlanForm from "@/Pages/MealPlans/MealPlanForm";

export default {
    components: {
        MealPlanForm,
        AppLayout,
        JetSectionBorder,
    },
    props: ['mealPlan']
}
</script>
