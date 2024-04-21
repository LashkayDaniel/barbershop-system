<template>
    <Head title="Discounts"/>

    <AuthenticatedLayout>
        <template #header>
            Discounts
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

        <div class="max-w-xl mx-auto">
            <section>
                <div class="flex justify-between py-4 items-center">
                    <h2 class=" font-bold text-2xl tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-sky-400">
                        Дійсні знижки</h2>
                    <button
                        class="text-sky-200 font-bold bg-sky-500 p-2 px-4 rounded-full hover:bg-sky-600 transition-all"
                        type="button"
                        @click="showOptions.createForm = !showOptions.createForm">
                        + Додати
                    </button>
                </div>
                <!--                {{ createForm.data() }}-->
                <!--                <pre>{{ allServices }}</pre>-->
                <FadeInAnimation>
                    <form @submit.prevent="createDiscount" v-show="showOptions.createForm"
                          class="bg-gray-500 mb-4 p-2 rounded-lg">
                        <div class="w-full flex">
                            <select class="flex-1 rounded-lg"
                                    v-model="createForm.serviceId">
                                <option selected disabled value="">Виберіть послугу</option>
                                <option v-for="(service,i) in allServices"
                                        :key="i"
                                        :value="service.id">
                                    {{ service.name }}
                                </option>
                            </select>
                            <input v-model="createForm.discount"
                                   type="number" min="0" max="100" class="ml-2 rounded-lg"
                                   placeholder="знижка (1-100%)">
                        </div>
                        <div class="mt-2">
                            <Datepicker
                                placeholder="Виберіть дату початку та кінця"
                                v-model="createForm.dateRange"
                                :min-date="moment().toISOString()"
                                :enable-time-picker="false"
                                locale="uk"
                                :format="dateFormat"
                                calendar-cell-class-name="text-slate-600 font-bold"
                                disable-year-select
                                :month-change-on-scroll="false"
                                auto-apply
                                range
                            >
                                <template #calendar-header="{ index, day }">
                                    <div :class="index === 5 || index === 6 ? 'text-red-500' : ''">
                                        {{ day }}
                                    </div>
                                </template>
                            </Datepicker>
                        </div>
                        <div v-if="createForm.hasErrors">
                            <p v-for="error in createForm.errors" class="text-red-500 p-2 bg-slate-700 text-sm">
                                *{{ error }}
                            </p>
                        </div>
                        <FadeInAnimation>
                            <div class="w-full text-end mt-4" v-if="createFormIsFilled">
                                <PrimaryButton type="submit">Save</PrimaryButton>
                            </div>
                        </FadeInAnimation>
                    </form>
                </FadeInAnimation>

                <ul class="flex flex-col gap-y-2">
                    <li v-if="discountServices.length===0" class="text-sm text-gray-secondary text-center">
                        Наразі немає дійсних знижок
                    </li>
                    <template v-else v-for="service in discountServices">
                        <li v-if="service.discount" class="py-4 px-6 bg-gray-600 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-1 text-gray-400">
                                    <p class="font-semibold text-sky-300 tracking-wide mb-2 flex justify-between">
                                        <span class="underline">{{ service.name }}</span>
                                        <b class="px-2 rounded-full font-bold text-sky-400 bg-sky-400 bg-opacity-20">
                                            -{{ service.discount.percent }}%</b>
                                    </p>
                                    <p><b class="font-semibold">Початок (включно):</b>
                                        {{ service.discount.start }}</p>
                                    <p><b class="font-semibold">Кінець (включно):</b>
                                        {{ service.discount.end }}
                                    </p>
                                    <p><b class="font-semibold">Тривалість:</b>
                                        {{
                                            calcDiscountDuration(service.discount.start, service.discount.end)
                                        }}
                                    </p>
                                    <p><b class="font-semibold">Залишилося:</b>
                                        {{
                                            calcDiscountDuration(moment().format('YYYY-MM-DD'), service.discount.end)
                                        }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    </template>
                </ul>
            </section>
        </div>

        <section class="max-w-2xl mx-auto border border-gray-500 rounded-lg p-2 my-5">
            <h3 class="mb-2 font-bold text-xl text-center text-sky-500">Всі знижки</h3>
            <DiscountTable :all-discounts="allDiscounts"/>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DiscountTable from '@/Pages/Admin/Discount/Partials/DiscountTable.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import FadeInAnimation from '@/Components/animations/FadeIn.vue'
import {Head, router, useForm, usePage} from '@inertiajs/vue3';
import moment from 'moment';
import {computed, reactive, ref, watch} from "vue";

const props = defineProps({
    allServices: {
        type: Array,
        required: true
    },
    allDiscounts: {
        type: Array,
        required: true
    },
})

const showOptions = reactive({
    createForm: ref(false)
})

const createForm = useForm({
    serviceId: null,
    discount: null,
    dateRange: null
})

const createFormIsFilled = computed(() => {
    const {serviceId, discount, dateRange} = createForm
    return !!(serviceId && discount && dateRange)
})

const discountServices = computed(() => {
    return props.allServices.filter(s => s.discount)
})


const dateFormat = (date) => {
    const [start, end] = date
    const startDate = moment(start).format('YYYY-MM-DD')
    const endDate = moment(end).format('YYYY-MM-DD')
    return `з ${startDate} по ${endDate}`;
}

const correctDayName = (dayNum) => {
    return dayNum + ' ' + (dayNum === 1 ? 'день' : dayNum < 5 ? 'дні' : 'днів');
}

const calcDiscountDuration = (startDate, endDate) => {
    const diff = moment(endDate).diff(startDate, 'days') + 1;
    return correctDayName(diff)
}

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

function createDiscount() {
    createForm.transform((data) => ({
        service_id: data.serviceId,
        discount: data.discount,
        date_start: moment(data.dateRange[0]).format('YYYY-MM-DD'),
        date_end: moment(data.dateRange[1]).format('YYYY-MM-DD')
    })).post(route('discount.store'), {
        onSuccess: () => {
            createForm.reset()
            showOptions.createForm = false
        }
    })
}


</script>


