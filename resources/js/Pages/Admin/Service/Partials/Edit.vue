<template>
    <form @submit.prevent="update" class="p-2 bg-gray-300 dark:bg-slate-700">

        <h2 class="text-xl font-bold text-gold-secondary dark:text-sky-500 text-center border-b border-gold-secondary dark:border-sky-800 mb-2">
            Редагування</h2>
        <div>
            <InputLabel for="name" value="Назва"/>

            <TextInput
                id="name"
                type="text"
                class="w-full"
                v-model="form.name"
                placeholder="Введіть назву послуги"
                required
                autofocus
            />
            <InputError class="mt-2" :message="form.errors.name"/>
        </div>

        <div>
            <InputLabel for="description" value="Опис"/>

            <textarea
                id="description"
                class="w-full"
                v-model="form.description"
                placeholder="Введіть опис"
                required
            />

            <InputError class="mt-2" :message="form.errors.description"/>
        </div>

        <div class="flex justify-end mt-4">
            <PrimaryButton v-show="form.isDirty"
                           class="ms-4"
                           :class="{ 'opacity-25': form.processing }">
                Змінити
            </PrimaryButton>
        </div>

        <p v-if="$page.props.flash.type === 'success' && $page.props.flash.message"
           class="w-full text-center text-green-600 bg-green-300 font-medium p-2 mt-4">
            {{ $page.props.flash.message }}
        </p>
    </form>
</template>

<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {useForm, usePage} from "@inertiajs/vue3";
import {watch} from "vue";

const props = defineProps({
    service: {
        type: Object,
        required: true
    }
})

const form = useForm({
    name: props.service.name,
    description: props.service.description
})
watch(
    () => usePage().props.flash.message,
    (value) => {
        if (value) {
            setTimeout(() => {
                usePage().props.flash.message = ''
            }, 2000)
        }
    }
)

function update() {
    form.put(route('admin.services.update', props.service.id))
}

</script>
