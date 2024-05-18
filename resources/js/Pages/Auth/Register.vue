<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm} from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    birth: '',
    phone: '',
    rank: '',
    password: '',
    password_confirmation: '',
});

const formatPhoneNumber = (event) => {
    const digits = event.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
    form.phone = !digits[2] ? digits[1] : '(' + digits[1] + ') ' + digits[2] + (digits[3] ? '-' + digits[3] : '');
};

const submit = () => {
    form.post(route('staff.register'), {
        onSuccess: () => {
            form.reset()
        },
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <form @submit.prevent="submit" class="w-1/2 mx-auto bg-white dark:bg-gray-600 p-4 rounded-lg">
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

        <div class="mt-4">
            <InputLabel for="password" value="Password"/>

            <TextInput
                id="password"
                type="password"
                class="mt-1 block w-full"
                v-model="form.password"
                placeholder="Введіть пароль"
                required
                autocomplete="new-password"
            />

            <InputError class="mt-2" :message="form.errors.password"/>
        </div>

        <div class="mt-4">
            <InputLabel for="password_confirmation" value="Confirm Password"/>

            <TextInput
                id="password_confirmation"
                type="password"
                class="mt-1 block w-full"
                v-model="form.password_confirmation"
                placeholder="Введіть пароль ще раз"
                required
                autocomplete="new-password"
            />

            <InputError class="mt-2" :message="form.errors.password_confirmation"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Register
            </PrimaryButton>
        </div>
    </form>
</template>
