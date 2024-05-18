<template>
    <table class="min-w-full divide-y divide-gray-400 dark:divide-gray-400">
        <thead>
        <tr>
            <th scope="col"
                class="px-4 py-3 text-start whitespace-nowrap text-sm font-medium text-gold-secondary dark:text-slate-400 uppercase">
                #
            </th>
            <th scope="col"
                class="px-4 py-3 text-start whitespace-nowrap text-sm font-medium text-gold-secondary dark:text-slate-400 uppercase">
                Service
            </th>
            <th scope="col"
                class="px-4 py-3 text-center whitespace-nowrap text-sm font-medium text-gold-secondary dark:text-slate-400 uppercase">
                %
            </th>
            <th scope="col"
                class="px-4 py-3 text-start whitespace-nowrap text-sm font-medium text-gold-secondary dark:text-slate-400 uppercase">
                Start date
            </th>
            <th scope="col"
                class="px-4 py-3 text-start whitespace-nowrap text-sm font-medium text-gold-secondary dark:text-slate-400 uppercase">
                End date
            </th>
            <th scope="col"
                class="px-4 py-3 text-start whitespace-nowrap text-sm font-medium text-gold-secondary dark:text-slate-400 uppercase">
            </th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-500">
        <tr v-if="discounts.length===0">
            <td class="p-2 text-center text-sm text-gray-secondary tracking-wider">Відсутні знижки</td>
        </tr>
        <template v-else>
            <tr v-for="(discount,i) in discounts" :key="i"
                class="hover:bg-gray-200 dark:hover:bg-gray-300 transition-all bg-green-300 bg-opacity-25 hover:cursor-pointer hover:dark:bg-gray-700 hover:bg-opacity-55"
                :class="[{'bg-red-300': moment().isAfter(discount.end,'day')},{'bg-yellow-400': (moment().isSameOrAfter(discount.start,'day') && moment().isSameOrBefore(discount.end,'day')) }]">
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                    {{ discount.id }}
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                    {{ discount?.service?.name }}
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                    -{{ discount.percent }}%
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                    {{ discount.start }}
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                    {{ discount.end }}
                </td>
                <td class="py-3 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200 flex gap-x-2 justify-center">
                    <template
                        v-if="moment().isBefore(discount.start,'day')">
                        <button type="button"
                                title="Видалити"
                                @click="deleteDiscount(discount)"
                                class="hover:opacity-50 hover:text-red-500 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                            </svg>
                        </button>
                    </template>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <p class="flex items-center text-sm text-gold-secondary dark:text-gray-secondary">
                        <span class="block size-2 bg-red-400 dark:bg-red-300 bg-opacity-45 rounded-full mr-2"></span>
                        - знижки в минулому</p>
                    <p class="flex items-center text-sm text-gold-secondary dark:text-gray-secondary">
                        <span
                            class="block size-2 bg-yellow-500 dark:bg-yellow-300 bg-opacity-45 rounded-full mr-2"></span>
                        - поточні знижки</p>
                    <p class="flex items-center text-sm text-gold-secondary dark:text-gray-secondary">
                        <span
                            class="block size-2 bg-green-500 dark:bg-green-300 bg-opacity-45 rounded-full mr-2"></span>
                        - знижки в майбутньму</p>
                </td>
            </tr>
        </template>
        </tbody>
    </table>
    <Pagination :links="allDiscounts.links"/>
</template>

<script setup>
import Pagination from "@/Components/dashboard/Pagination.vue";
import moment from 'moment';
import {router} from "@inertiajs/vue3";
import {computed} from "vue";

const props = defineProps({
    allDiscounts: {
        type: Object,
        required: true
    }
})

const discounts = computed(() => {
    return props.allDiscounts.data
})

function deleteDiscount(discount) {
    if (confirm('Ви впевнені, що бажаєте видалити знижку -' + discount.percent + '%, для: ' + discount?.service.name)) {
        router.delete(route('discount.delete', discount.id))
    }
}
</script>
