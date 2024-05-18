<template>
    <form @submit.prevent="submit" class="w-1/2 mx-auto bg-white dark:bg-gray-600 p-4 rounded-lg">
        <h1 class="font-bold text-xl text-center text-gold-primary dark:text-sky-500">Оновлення даних працівника</h1>
        <div>
            <InputLabel for="name" value="Name"/>

            <TextInput
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                placeholder="Введіть ім'я"
                required
                autofocus
                autocomplete="name"
            />

            <InputError class="mt-2" :message="form.errors.name"/>
        </div>

        <div class="mt-4">
            <InputLabel for="email" value="Email"/>

            <TextInput
                id="email"
                type="email"
                class="mt-1 block w-full"
                v-model="form.email"
                placeholder="Введіть пошту"
                required
                autocomplete="username"
            />

            <InputError class="mt-2" :message="form.errors.email"/>
        </div>

        <div class="mt-4">
            <InputLabel for="phone" value="Phone"/>

            <input
                @input="formatPhoneNumber"
                id="phone"
                type="tel"
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                v-model="form.phone"
                placeholder="(050) xxx-xxxx"
                required
            />

            <InputError class="mt-2" :message="form.errors.phone"/>
        </div>

        <div class="mt-4">
            <InputLabel for="rank" value="Rank"/>

            <TextInput
                id="rank"
                type="text"
                class="mt-1 block w-full"
                v-model="form.rank"
                placeholder="Введіть ранг"
                required
            />

            <InputError class="mt-2" :message="form.errors.rank"/>
        </div>

        <div class="mt-4">
            <InputLabel for="birth" value="Birth"/>

            <TextInput
                id="birth"
                type="date"
                class="mt-1 block w-full"
                v-model="form.birth"
                placeholder="Введіть дату народження"
                required
            />

            <InputError class="mt-2" :message="form.errors.birth"/>
        </div>
        <div class="flex items-center justify-end mt-4">
            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                           :disabled="form.processing">
                Update
            </PrimaryButton>
        </div>
    </form>
</template>

<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm} from '@inertiajs/vue3';
import {watch} from "vue";

const props = defineProps({
    employee: {
        type: Object,
        required: true
    }
})

const emit = defineEmits(['success'])

const form = useForm({
    name: props.employee?.name,
    email: props.employee?.email,
    birth: props.employee?.birth,
    phone: props.employee?.phone,
    rank: props.employee?.rank,
});

watch(
    () => props.employee,
    () => {
        form.name = props.employee?.name
        form.email = props.employee?.email
        form.birth = props.employee?.birth
        form.phone = props.employee?.phone
        form.rank = props.employee?.rank
    }
)

const formatPhoneNumber = (event) => {
    const digits = event.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
    form.phone = !digits[2] ? digits[1] : '(' + digits[1] + ') ' + digits[2] + (digits[3] ? '-' + digits[3] : '');
};

const submit = () => {
    form.patch(route('staff.update', props?.employee.id), {
        onSuccess: () => {
            emit('success', true)
        }
    });
};
</script>
