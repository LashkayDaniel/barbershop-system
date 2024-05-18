<template>
    <section
        class="border-2 border-gold-secondary text-gold-secondary dark:text-slate-400 dark:border-sky-300 border-opacity-30 rounded-lg p-2">
        <h1 class="text-xl font-bold text-gold-primary dark:text-slate-300 text-center mb-4">Деталі бронювання</h1>
        <p><b>Створено: </b>{{ moment(order.created_at).format('LLLL') }}</p>
        <p><b>Послуга: </b>{{ order.service.name }}</p>
        <p><b>Дата: </b>{{ moment(order.worktime.date).format('LL') }}</p>
        <p><b>Час: </b>{{ order.worktime.time }}</p>
        <p class="border-b border-gold-primary dark:border-gray-500"><b>Вартість: </b>{{
                currencyFormat(order.service.price)
            }}</p>
        <template v-if="order.discount">
            <p><b>Знижка: </b>{{ order?.discount?.percent }}%</p>
            <p><b>Вартість зі
                знижкою: </b>{{ currencyFormat(priceWithDiscount(order.service.price, order?.discount?.percent)) }}</p>
            <p><b>Початок дії знижки: </b>{{ moment(order?.discount.start).format('LL') }}</p>
            <p><b>Кінець дії знижки (включно): </b>{{ moment(order?.discount.end).format('LL') }}</p>
        </template>
        <p class="border-t border-gray-500"><b>Майстер: </b>{{ order.user.name }}</p>
        <p><b>Ранг: </b>{{ order.user.rank }}</p>

    </section>
</template>

<script setup>
import {currencyFormat} from '@/utils.js'
import moment from "moment";

const props = defineProps({
    order: {
        type: Object,
        required: true
    }
})

const priceWithDiscount = (price, discount) => {
    return Math.round(price * (1 - discount / 100))
}

</script>
