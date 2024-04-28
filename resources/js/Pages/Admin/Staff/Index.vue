<template>
    <Head title="Staff"/>

    <AuthenticatedLayout>
        <template #header>
            Staff
        </template>
        <FadeInAnimation>
            <p v-if="$page.props.flash.type === 'success' && $page.props.flash.message"
               class="w-full text-center text-green-600 bg-green-300 font-medium p-2 my-4">
                {{ $page.props.flash.message }}
            </p>

            <p v-if="$page.props.flash.type === 'error' && $page.props.flash.message"
               class="w-full text-center text-red-600 bg-red-300 font-medium p-2 my-4">
                {{ $page.props.flash.message }}
            </p>
        </FadeInAnimation>
        <PrimaryButton @click="showRegisterForm = !showRegisterForm">
            Register
        </PrimaryButton>

        <section class="my-2 flex items-center gap-x-4">
            <FadeInAnimation>
                <Register v-show="showRegisterForm"/>
            </FadeInAnimation>

            <FadeInAnimation>
                <Update v-if="showUpdateForm" :employee="updatedEmployee" @success="showUpdateForm = false"/>
            </FadeInAnimation>
        </section>

        <section>
            <EmployeeTable :employees="employees" @updatedEmployee="updatedEmployeeEvent"/>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, usePage} from '@inertiajs/vue3';
import EmployeeTable from '@/Pages/Admin/Staff/Partials/EmployeeTable.vue'
import FadeInAnimation from '@/Components/animations/FadeIn.vue'
import Register from '@/Pages/Auth/Register.vue'
import Update from '@/Pages/Admin/Staff/Partials/Update.vue'
import {ref, watch} from "vue";

defineProps({
    employees: {
        type: Object,
        required: true
    },
})
watch(
    () => usePage().props.flash.message,
    (value) => {
        if (value) {
            setTimeout(() => {
                usePage().props.flash.message = ''
            }, 4000)
        }
    }
)
const showRegisterForm = ref(false);
const showUpdateForm = ref(false);
const updatedEmployee = ref();

const updatedEmployeeEvent = (employee) => {
    updatedEmployee.value = employee;
    showUpdateForm.value = true;
}

</script>
