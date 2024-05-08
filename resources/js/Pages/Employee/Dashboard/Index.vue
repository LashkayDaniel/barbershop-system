<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            Dashboard
        </template>
        <div class="flex gap-2">
            <div class="flex-1 flex flex-col items-stretch gap-y-2">
                <div
                    class="h-full relative flex flex-col rounded-xl dark:bg-gray-400 bg-white text-gray-700 shadow-sm">
                    <div
                        class="absolute mx-4 mt-4 grid h-20 w-20 place-items-center overflow-hidden rounded-xl bg-gradient-to-tr from-gray-900 to-gray-800 bg-clip-border text-white shadow-gray-900/20">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                             aria-hidden="true"
                             class="h-12 w-12 text-white">
                            <path d="M12 7.5a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z"></path>
                            <path fill-rule="evenodd"
                                  d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 14.625v-9.75zM8.25 9.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM18.75 9a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V9.75a.75.75 0 00-.75-.75h-.008zM4.5 9.75A.75.75 0 015.25 9h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H5.25a.75.75 0 01-.75-.75V9.75z"
                                  clip-rule="evenodd"></path>
                            <path
                                d="M2.25 18a.75.75 0 000 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 00-.75-.75H2.25z"></path>
                        </svg>
                    </div>
                    <div class="p-4 text-right">
                        <p class="text-blue-gray-600 block font-sans text-base font-normal leading-normal antialiased">
                            Загальний дохід
                        </p>
                        <h4 class="text-blue-gray-900 block font-sans text-3xl font-semibold leading-snug tracking-normal antialiased">
                            {{ profit }}₴
                        </h4>
                    </div>
                </div>

                <div
                    class="h-full relative flex flex-col rounded-xl dark:bg-gray-400 bg-white text-gray-700 shadow-sm">
                    <div
                        class="absolute mx-4 mt-4 grid h-20 w-20 place-items-center overflow-hidden rounded-xl bg-gradient-to-tr from-gray-900 to-gray-800 bg-clip-border text-white shadow-gray-900/20">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                             aria-hidden="true"
                             class="h-12 w-12 text-white">
                            <path
                                d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"></path>
                        </svg>
                    </div>
                    <div class="p-4 text-right">
                        <p class="text-blue-gray-600 block font-sans text-base font-normal leading-normal antialiased">
                            Бронювань
                        </p>
                        <h4 class="text-blue-gray-900 block font-sans text-3xl font-semibold leading-snug tracking-normal antialiased">
                            {{ orders }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="flex-1 p-6 dark:bg-gray-400 bg-white rounded-lg">
                <apexchart type="pie"
                           :options="popularServicesOptions"
                           :series="popularServicesSeries"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

import {Head} from '@inertiajs/vue3';
import {computed} from "vue";

const props = defineProps({
    statistics: {
        type: Object,
        required: true
    }
})

const profit = computed(() => props.statistics?.employee_data?.profit)
const orders = computed(() => props.statistics?.employee_data?.orders)

const popularServicesTitle = computed(() => {
    return props.statistics?.popular_services.map(i => i.name)
})
const popularServicesSeries = computed(() => {
    return props.statistics?.popular_services.map(i => i.percent)
})

const popularServicesOptions = {
    chart: {
        type: 'pie',
        width: '100%',
        height: '100%'
    },
    colors: ['#00D8B6', '#008FFB', '#FEB019', '#FF4560', '#775DD0'],
    title: {
        text: 'Популярні послуги',
        style: {
            fontSize: '18px'
        }
    },
    labels: popularServicesTitle.value,
    legend: {
        position: 'left',
        offsetY: 30
    },
    tooltip: {
        y: {
            formatter: function (value) {
                return value + '%';
            }
        }
    }
}
</script>
