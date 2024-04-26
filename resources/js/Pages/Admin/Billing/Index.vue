<template>
    <Head title="Billing"/>

    <AuthenticatedLayout>
        <template #header>
            Billing
        </template>
        <FadeInAnimation>
            <template v-if="customerDetails">
                <CustomerDetails class="mb-5" :customer-info="customerDetails"/>
            </template>
        </FadeInAnimation>

        <div class="">
            <section class=" border rounded-lg p-2 border-gray-500">
                <table class="min-w-full divide-y divide-gray-600 dark:divide-gray-400">
                    <thead>
                    <tr>
                        <th scope="col"
                            class="px-4 py-3 text-start whitespace-nowrap text-sm font-medium text-slate-400 uppercase">
                            id
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-start whitespace-nowrap text-sm font-medium text-slate-400 uppercase">
                            client
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-start whitespace-nowrap text-sm font-medium text-slate-400 uppercase">
                            email
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-end whitespace-nowrap text-sm font-medium text-slate-400 uppercase">
                            profit
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-center whitespace-nowrap text-sm font-medium text-slate-400 uppercase">
                            reservations
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-center whitespace-nowrap text-sm font-medium text-slate-400 uppercase">
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-600 opacity-70">
                    <tr v-if="allCustomers.data.length===0">
                        <td class="p-2 text-center text-sm text-gray-secondary tracking-wider">Відсутні бронювання</td>
                    </tr>
                    <template v-else>
                        <tr v-for="(customer,i) in allCustomers.data" :key="i"
                            @click="showCustomerDetails(customer)"
                            class="hover:bg-gray-300 transition-all bg-opacity-25 hover:cursor-pointer hover:dark:bg-gray-700 hover:bg-opacity-55">
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                {{ customer.id }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                {{ customer?.name }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                {{ customer?.email }}
                            </td>
                            <td class="px-4 py-3 text-end whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                {{ currencyFormat(customer?.profit) }}
                            </td>
                            <td class="px-4 py-3 text-center whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                {{ customer?.reservations_count }}
                            </td>
                            <td class="py-3 font-bold text-sky-400 text-center whitespace-nowrap text-sm dark:text-sky-400">
                                більше
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="font-bold text-sky-300 p-2 text-end">
                                Всього: {{ currencyFormat(totalProfitByPage) }}
                            </td>
                        </tr>
                    </template>
                    </tbody>
                </table>
                <Pagination :links="allCustomers.links"/>
            </section>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from '@/Components/dashboard/Pagination.vue'
import FadeInAnimation from '@/Components/animations/FadeIn.vue'
import CustomerDetails from '@/Pages/Admin/Billing/Partials/CustomerDetails.vue'
import {Head} from '@inertiajs/vue3';
import {computed, ref} from "vue";
import {currencyFormat} from '@/utils.js'

const props = defineProps({
    allCustomers: {
        type: Object,
        required: true
    }
})

const customerDetails = ref();

const totalProfitByPage = computed(() => {
    return props.allCustomers.data.reduce((acc, item) => acc + item.profit, 0);
})

function showCustomerDetails(customer) {
    customerDetails.value = customer
    scrollToUp()
}

const scrollToUp = () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth',
    });
}
</script>


