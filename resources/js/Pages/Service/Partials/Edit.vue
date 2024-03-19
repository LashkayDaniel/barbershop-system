<template>
    <form @submit.prevent="update" class="p-2 bg-slate-700">

        <h2 class="text-2xl font-bold text-sky-500 text-center border-b-2 border-sky-800 mb-2">Edit service</h2>

        <div>
            <InputLabel for="name" value="Name"/>

            <TextInput
                id="name"
                type="text"
                class="mt-1 block w-full disabled:opacity-75 disabled:select-none"
                v-model="form.name"
                required
                disabled
                autofocus
            />
        </div>

        <div>
            <InputLabel for="duration" value="Duration"/>

            <TextInput
                id="duration"
                type="number"
                class="mt-1 block"
                v-model="form.duration"
                placeholder="Введіть тривалість"
                required
                autofocus
            />
        </div>

        <div>
            <InputLabel for="price" value="Price"/>

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
            <PrimaryButton v-if="form.isDirty"
                           class="ms-4"
                           :class="{ 'opacity-25': form.processing }">
                Update
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
    duration: props.service?.pivot.duration,
    price: props.service?.pivot.price
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
    form.put(route('services.update', props.service.id))
}

</script>
