<template>
    <section class="bg-gray-500 bg-opacity-50 p-4 rounded-lg flex items-center">
        <div class="flex-1">
            <div class="pb-4 border-b-2 border-sky-300 border-opacity-30">
                <p class="text-sky-300">Id: <b class="text-sky-400 underline">{{ customerInfo?.id }}</b></p>
                <p class="text-sky-300"> Ім'я: <b class="text-sky-400 underline">{{ customerInfo?.name }}</b></p>
                <p class="text-sky-300"> Пошта: <b class="text-sky-400 underline">{{ customerInfo?.email }}</b></p>
                <p class="text-sky-300"> Номер телефону: <b class="text-sky-400 underline">{{ customerInfo?.phone }}</b>
                </p>
                <p class="text-sky-300"> Створено: <b
                    class="text-sky-400 underline">{{ moment(customerInfo?.created_at).format('LLL') }}</b></p>
                <p class="text-sky-300"> Загальний прибуток: <b
                    class="text-sky-400 underline">{{ currencyFormat(customerInfo?.profit) }}</b></p>
            </div>
            <div class="">
                <h2 class="font-bold mt-2">Бронювання ({{ customerInfo.reservations_count }}):</h2>
                <ul class="">
                    <li v-for="order in customerInfo.orders"
                        @click="selectOrder(order)"
                        class="text-sky-500 underline cursor-pointer hover:opacity-80"
                        :class="{'text-opacity-50':order.id===selectedOrder?.id}">
                        #{{ order.id }}
                        <span class="text-sm">({{ moment(order.created_at).format('L') }})</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="flex-1" v-if="selectedOrder">
            <FadeInAnimation>
                <OrderInfo :order="selectedOrder"/>
            </FadeInAnimation>
        </div>
    </section>
</template>

<script setup>
import OrderInfo from '@/Pages/Admin/Billing/Partials/OrderInfo.vue'
import FadeInAnimation from '@/Components/animations/FadeIn.vue'
import moment from "moment";
import uk from "moment/dist/locale/uk";
import {onMounted, ref, watch} from "vue";
import {currencyFormat} from '@/utils.js'

const props = defineProps({
    customerInfo: {
        type: Object,
        required: true
    }
})

const selectedOrder = ref()

watch(
    () => props.customerInfo,
    () => {
        selectedOrder.value = null
    }
)

onMounted(() => {
    moment.updateLocale("uk", uk);
})

function selectOrder(order) {
    selectedOrder.value = order
}

</script>
