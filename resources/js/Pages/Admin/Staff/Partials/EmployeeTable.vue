<template>
    <div class="border rounded-lg p-2 border-gold-secondary dark:border-gray-500">
        <table class="min-w-full divide-y divide-gray-600 dark:divide-gray-400">
            <thead>
            <tr>
                <th scope="col"
                    class="px-4 py-3 text-start whitespace-nowrap text-sm font-medium text-gold-secondary dark:text-slate-400 uppercase">
                    id
                </th>
                <th scope="col"
                    class="px-4 py-3 text-start whitespace-nowrap text-sm font-medium text-gold-secondary dark:text-slate-400 uppercase">
                    employee
                </th>
                <th scope="col"
                    class="px-4 py-3 text-start whitespace-nowrap text-sm font-medium text-gold-secondary dark:text-slate-400 uppercase">
                    rank
                </th>
                <th scope="col"
                    class="px-4 py-3 text-start whitespace-nowrap text-sm font-medium text-gold-secondary dark:text-slate-400 uppercase">
                    email
                </th>
                <th scope="col"
                    class="px-4 py-3 text-center whitespace-nowrap text-sm font-medium text-gold-secondary dark:text-slate-400 uppercase">
                    phone
                </th>
                <th scope="col"
                    class="px-4 py-3 text-center whitespace-nowrap text-sm font-medium text-gold-secondary dark:text-slate-400 uppercase">
                    birth
                </th>
                <th scope="col"
                    class="px-4 py-3 text-center whitespace-nowrap text-sm font-medium text-gold-secondary dark:text-slate-400 uppercase">
                    created_at
                </th>
                <th scope="col"
                    class="px-4 py-3 text-center whitespace-nowrap text-sm font-medium text-slate-400 uppercase">
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-400 dark:divide-gray-600 opacity-70">
            <tr v-if="employees.data.length===0">
                <td class="p-2 text-center text-sm text-gray-secondary tracking-wider">Відсутні працівники</td>
            </tr>
            <template v-else>
                <tr v-for="(employee,i) in employees.data" :key="i"
                    @click=""
                    class="hover:bg-gray-300 transition-all bg-opacity-25 hover:cursor-pointer hover:dark:bg-gray-700 hover:bg-opacity-55">
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                        {{ employee.id }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200 flex items-center gap-x-2">
                        <img v-if="employee.avatar"
                             :src="employee.avatar" alt="avatar"
                             class="size-10 rounded-full border border-gold-primary">
                        <div v-else class="size-10 rounded-full bg-gray-500 border border-gold-primary"></div>
                        {{ employee?.name }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                        {{ employee?.rank }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                        {{ employee?.email }}
                    </td>
                    <td class="px-4 py-3 text-center whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                        {{ employee?.phone }}
                    </td>
                    <td class="px-4 py-3 text-center whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                        {{ moment(employee?.birth).format('L') }}
                    </td>
                    <td class="px-4 py-3 text-center whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                        {{ moment(employee?.created_at).format('L, h:m') }}
                    </td>
                    <td class="py-3 font-bold text-gold-primary dark:text-sky-400 text-center whitespace-nowrap text-sm dark:text-sky-400">
                        <button type="button"
                                title="Змінити"
                                @click="updateHandle(employee)"
                                class="hover:opacity-50 transition-all">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                            </svg>
                        </button>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
        <Pagination :links="employees.links"/>
    </div>
</template>

<script setup>
import Pagination from '@/Components/dashboard/Pagination.vue'
import moment from "moment";

defineProps({
    employees: {
        type: Object,
        required: true
    }
})

const emit = defineEmits(['updatedEmployee'])

const updateHandle = (employee) => {
    emit('updatedEmployee', employee)
}

</script>
