<template>
    <form @submit.prevent="create" class="p-2 bg-gray-300 dark:bg-slate-700">
        <h2 class="text-xl font-bold text-gold-secondary dark:text-sky-500 text-center border-b border-gold-secondary dark:border-sky-800 mb-2">
            Створення послуги</h2>
        <div>
            <InputLabel for="name" value="Назва"/>

            <TextInput
                id="name"
                type="text"
                class="w-full"
                v-model="form.name"
                placeholder="Введіть назву"
                required
            />

            <InputError class="mt-1" :message="form.errors.name"/>
        </div>

        <div>
            <InputLabel for="description" value="Опис"/>

            <textarea
                id="description"
                class="w-full"
                v-model="form.description"
                placeholder="Введіть короткий опис"
                required
            />

            <InputError class="mt-1" :message="form.errors.description"/>
        </div>
        <div class="flex justify-end mt-4">
            <PrimaryButton v-show="form.name.length && form.description.length" class="ms-4"
                           :class="{ 'opacity-25': form.processing }">
                Створити
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


const form = useForm({
    name: '',
    description: ''
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

function create() {
    form.post(route('admin.services.store'), {
        onSuccess: () => {
            form.reset()
        }
    })
}
</script>
