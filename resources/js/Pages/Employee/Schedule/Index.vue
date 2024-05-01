<template>
    <Head title="Schedule"/>

    <AuthenticatedLayout>
        <template #header>
            Schedule
        </template>

        <section class="max-w-2xl mx-auto p-8 bg-white dark:bg-gray-400 rounded-lg">
            <header>
                <h2 class="text-lg font-medium text-gray-900">Ваш графік записів</h2>

                <p class="text-sm text-gray-600">
                    Вибираючи потрібну дату переглядайте всі записи клієнтів
                </p>
            </header>

            <div class="mt-4 flex gap-x-2">
                <div>
                    <Datepicker
                        v-model="selectedDate"
                        :disabled-week-days="[6, 0]"
                        :enable-time-picker="false"
                        locale="uk"
                        calendar-cell-class-name="text-slate-600 font-bold"
                        :month-change-on-scroll="false"
                        auto-apply
                        inline
                    >
                        <template #calendar-header="{ index, day }">
                            <div :class="index === 5 || index === 6 ? 'text-red-500' : ''">
                                {{ day }}
                            </div>
                        </template>
                    </Datepicker>
                </div>

                <div class="flex-1 h-[500px] flex flex-col justify-between">
                    <h2 class="font-bold text-center mb-2 text-lg text-sky-700">Всі записи на цей день
                        <span class="text-sm">({{ moment(selectedDate).format('L') }})</span>
                    </h2>

                    <div v-show="showLoading" class="flex flex-col items-center justify-center">
                        <span>Зачекайте...</span>
                        <Loader></Loader>
                    </div>

                    <ul class="flex flex-col h-full gap-y-1 overflow-y-auto">
                        <li v-if="!showLoading && orders.length===0">
                            <p class="text-center">Записів не знайдено</p>
                        </li>
                        <li v-else v-for="order in sortedOrdersByTime"
                            class="w-full rounded-xl bg-gray-700 bg-opacity-30 p-2 flex">
                            <div class="flex-1">
                                <h3 class="font-bold">{{ order?.service?.name }}</h3>
                                <p class="text-sm">від: {{ order?.client?.name }}</p>
                                <p class="text-sm">тел: {{ order?.client?.phone }}</p>
                            </div>
                            <div class="text-sm font-bold flex items-center">
                                {{ order?.start_time }} - {{ order?.end_time }}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>

</template>

<script setup>
import Loader from '@/Components/other/Loader.vue'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, usePage} from '@inertiajs/vue3';
import {computed, onMounted, ref, watch} from "vue";

import moment from 'moment';
import uk from "moment/dist/locale/uk";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
})

const selectedDate = ref(moment())
const showLoading = ref(false)
const orders = ref([])

onMounted(() => {
    moment.updateLocale("uk", uk);
    getOrders()
})

const dateISOFormat = computed(() => {
    return moment(selectedDate.value).format('YYYY-MM-DD')
})

function getOrders() {
    showLoading.value = true;
    axios.get(`/schedule/${dateISOFormat.value}`)
        .then((response) => {
            orders.value = response.data
            showLoading.value = false
        })
}

const sortedOrdersByTime = computed(() => {
    return orders.value.slice().sort((a, b) => {
        return a.start_time.localeCompare(b.start_time)
    })
})

watch(
    () => selectedDate.value,
    () => {
        getOrders()
    }
)
</script>
