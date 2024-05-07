<template>
    <form @submit.prevent="create" class="p-2 bg-gray-300 dark:bg-slate-700">
        <h2 class="text-xl font-bold text-gold-secondary dark:text-sky-500 text-center border-b border-gold-secondary dark:border-sky-800 mb-2">
            Нова послуга</h2>
        <div>
            <InputLabel for="service" value="Виберіть послугу"/>

            <select class="rounded-lg w-full"
                    id="service"
                    v-model="form.service_id">
                <option v-for="(service,index) in services"
                        class="bg-slate-500 p-2"
                        :value="service.id"
                        :key="index">
                    {{ service.name }}
                </option>
            </select>

            <InputError class="mt-2" :message="form.errors.service_id"/>
        </div>

        <div>
            <InputLabel for="duration" value="Тривалість"/>

            <TextInput
                id="duration"
                type="number"
                class="block"
                v-model="form.duration"
                placeholder="Введіть ціну"
                required
            />

            <InputError class="mt-2" :message="form.errors.price"/>
        </div>

        <div>
            <InputLabel for="price" value="Ціна"/>

            <TextInput
                id="price"
                type="number"
                class="block"
                v-model="form.price"
                placeholder="Введіть ціну"
                required
            />

            <InputError class="mt-2" :message="form.errors.price"/>
        </div>

        <div class="flex justify-end mt-4">
            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Додати
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
    services: {
        type: Array,
        required: true
    }
})

const form = useForm({
    service_id: 1,
    duration: 15,
    price: 250
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
    form.post(route('services.store'), {
        onSuccess: () => {
            form.reset()
        }
    })
}
</script>
