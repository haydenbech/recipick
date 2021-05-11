<template>

    <div class="col-span-6 grid grid-cols-12 gap-3">
        <!-- Ingredient Name -->
        <div class="col-span-12 sm:col-span-3">
            <jet-label for="ingredient_name" value="Ingredient Name" />
            <template v-if="! editEnabled">
                <span class="text-xs text-gray-500 py-2 mt-1">{{ form.ingredient_name }}</span>
            </template>
            <template v-else>
                <jet-input id="ingredient_name" type="text" class="mt-1 block w-full text-xs" v-model="form.ingredient_name" autocomplete="ingredient_name" />
                <jet-input-error :message="form.errors.ingredient_name" class="mt-2" />
            </template>
        </div>

        <!-- Preparation -->
        <div class="col-span-12 sm:col-span-3">
            <jet-label for="preparation" value="Preparation" />
            <template v-if="! editEnabled">
                <span class="text-xs text-gray-500 py-2 mt-1">{{ form.preparation }}</span>
            </template>
            <template v-else>
                <jet-input id="preparation" type="text" class="mt-1 block w-full text-xs" v-model="form.preparation" />
                <jet-input-error :message="form.errors.preparation" class="mt-2" />
            </template>
        </div>

        <!-- Quantity -->
        <div class="col-span-6 sm:col-span-2">
            <jet-label for="quantity" value="Quantity" />
            <template v-if="! editEnabled">
                <span class="text-xs text-gray-500 py-2 mt-1">{{ form.quantity }}</span>
            </template>
            <template v-else>
                <jet-input id="quantity" type="number" min="1" max="1440" class="mt-1 block w-full text-xs" v-model="form.quantity" />
                <jet-input-error :message="form.errors.quantity" class="mt-2" />
            </template>
        </div>

        <!-- Unit -->
        <div class="col-span-6 sm:col-span-1">
            <jet-label for="unit" value="Unit" />
            <template v-if="! editEnabled">
                <span class="text-xs text-gray-500 py-2 mt-1">{{ form.unit }}</span>
            </template>
            <template v-else>
                <jet-input id="unit" type="text" class="mt-1 block w-full text-xs" v-model="form.unit" autocomplete="unit" />
                <jet-input-error :message="form.errors.unit" class="mt-2" />
            </template>
        </div>

        <div class="col-span-6 sm:col-span-3">
            <jet-label value="&nbsp;" />
            <div class="flex flex-row gap-x-1 mt-1">
                <template v-if="! editEnabled">
                    <jet-secondary-button type="button" class="text-xs flex-col flex-grow" @click="destroy">
                        Remove
                    </jet-secondary-button>
                    <jet-button type="button" class="text-xs flex-col flex-grow" @click="editEnabled = true">
                        Edit
                    </jet-button>
                </template>
                <template v-else>
                    <jet-button type="button" class="text-xs flex-col flex-grow" @click="store">
                        Save
                    </jet-button>
                </template>
            </div>
        </div>
    </div>

</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    name: "RecipeItemForm",
    props: ['recipe', 'item', 'editing'],
    components: {
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
    },
    data() {
        return {
            form: this.$inertia.form({
                ingredient_name: this?.item?.ingredient?.name,
                preparation: this?.item?.preparation,
                quantity: this?.item?.quantity,
                unit: this?.item?.unit,
                order: this?.item?.order,
            }),
            editEnabled: this.editing,
        }
    },
    methods: {
        store() {
            if(this.item){
                this.form.put(this.route('recipes.items.update', [this.recipe, this.item]), {
                    preserveScroll: true,
                })
                this.editEnabled = false;
            } else {
                this.form.post(this.route('recipes.items.store', this.recipe), {
                    preserveScroll: true,
                });
                this.form.reset();
            }
        },
        destroy(){
            this.form.delete(this.route('recipes.items.destroy', [this.recipe, this.item]), {
                preserveScroll: true,
            });
        }
    }
}
</script>

<style scoped>

</style>
