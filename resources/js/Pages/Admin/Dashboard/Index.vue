<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            Dashboard
        </template>
        <div class="">dashboard for admin</div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

import {Head} from '@inertiajs/vue3';
</script>
