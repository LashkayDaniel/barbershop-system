<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            Dashboard
        </template>
        <div class="mb-12 mt-4 grid gap-x-6 gap-y-10 md:grid-cols-2 xl:grid-cols-4">
            <div
                class="border-blue-gray-100 relative flex flex-col rounded-xl border bg-white bg-clip-border text-gray-700 shadow-sm">
                <div
                    class="absolute mx-4 mt-4 grid h-12 w-12 place-items-center overflow-hidden rounded-xl bg-gradient-to-tr from-gray-900 to-gray-800 bg-clip-border text-white shadow-gray-900/20">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                         class="h-6 w-6 text-white">
                        <path d="M12 7.5a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z"></path>
                        <path fill-rule="evenodd"
                              d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 14.625v-9.75zM8.25 9.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM18.75 9a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V9.75a.75.75 0 00-.75-.75h-.008zM4.5 9.75A.75.75 0 015.25 9h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H5.25a.75.75 0 01-.75-.75V9.75z"
                              clip-rule="evenodd"></path>
                        <path
                            d="M2.25 18a.75.75 0 000 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 00-.75-.75H2.25z"></path>
                    </svg>
                </div>
                <div class="p-4 text-right">
                    <p class="text-blue-gray-600 block font-sans text-sm font-normal leading-normal antialiased">
                        Загальний дохід
                    </p>
                    <h4 class="text-blue-gray-900 block font-sans text-2xl font-semibold leading-snug tracking-normal antialiased">
                        {{ statistics?.income?.total }}₴
                    </h4>
                </div>
                <div class="border-blue-gray-50 border-t p-4">
                    <p class="text-blue-gray-600 block font-sans leading-relaxed antialiased">
                        <strong class="text-green-500"
                                :class="{'text-red-500':percentFormat(statistics?.income?.last_month).slice(0,1).toString() === '-'}">
                            {{ percentFormat(statistics?.income?.last_month) }}
                            <span class="text-sm">%</span>
                        </strong> ніж за минулий місяць</p>
                </div>
            </div>
            <div
                class="border-blue-gray-100 relative flex flex-col rounded-xl border bg-white bg-clip-border text-gray-700 shadow-sm">
                <div
                    class="absolute mx-4 mt-4 grid h-12 w-12 place-items-center overflow-hidden rounded-xl bg-gradient-to-tr from-gray-900 to-gray-800 bg-clip-border text-white shadow-gray-900/20">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                         class="h-6 w-6 text-white">
                        <path
                            d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"></path>
                    </svg>
                </div>
                <div class="p-4 text-right">
                    <p class="text-blue-gray-600 block font-sans text-sm font-normal leading-normal antialiased">
                        Бронювань
                    </p>
                    <h4 class="text-blue-gray-900 block font-sans text-2xl font-semibold leading-snug tracking-normal antialiased">
                        {{ statistics?.reservation.total }}
                    </h4>
                </div>
                <div class="border-blue-gray-50 border-t p-4">
                    <p class="text-blue-gray-600 block font-sans leading-relaxed antialiased">
                        <strong class="text-green-500"
                                :class="{'text-red-500':percentFormat(statistics?.reservation?.last_week).slice(0,1).toString() === '-'}">
                            {{ percentFormat(statistics?.reservation?.last_week) }}
                            <span class="text-sm">%</span>
                        </strong> ніж за минулий місяць</p>
                </div>
            </div>
            <div
                class="border-blue-gray-100 relative flex flex-col rounded-xl border bg-white bg-clip-border text-gray-700 shadow-sm">
                <div
                    class="absolute mx-4 mt-4 grid h-12 w-12 place-items-center overflow-hidden rounded-xl bg-gradient-to-tr from-gray-900 to-gray-800 bg-clip-border text-white shadow-gray-900/20">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                         class="h-6 w-6 text-white">
                        <path
                            d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"></path>
                    </svg>
                </div>
                <div class="p-4 text-right">
                    <p class="text-blue-gray-600 block font-sans text-sm font-normal leading-normal antialiased">
                        Клієнтів
                    </p>
                    <h4 class="text-blue-gray-900 block font-sans text-2xl font-semibold leading-snug tracking-normal antialiased">
                        {{ statistics?.customers.total }}
                    </h4>
                </div>
                <div class="border-blue-gray-50 border-t p-4">
                    <p class="text-blue-gray-600 block font-sans leading-relaxed antialiased">
                        <strong class="text-green-500"
                                :class="{'text-red-500':percentFormat(statistics?.customers?.last_week).slice(0,1).toString() === '-'}">
                            {{ percentFormat(statistics?.customers?.last_week) }}
                            <span class="text-sm">%</span>
                        </strong> ніж за минулий місяць</p>
                </div>
            </div>
            <div
                class="border-blue-gray-100 relative flex flex-col rounded-xl border bg-white bg-clip-border text-gray-700 shadow-sm">
                <div
                    class="absolute mx-4 mt-4 grid h-12 w-12 place-items-center overflow-hidden rounded-xl bg-gradient-to-tr from-gray-900 to-gray-800 bg-clip-border text-white shadow-gray-900/20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         aria-hidden="true" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605"/>
                    </svg>
                </div>
                <div class="p-4 text-right">
                    <p class="text-blue-gray-600 block font-sans text-sm font-normal leading-normal antialiased">
                        Позитивних відгуків
                    </p>
                    <h4 class="text-blue-gray-900 block font-sans text-2xl font-semibold leading-snug tracking-normal antialiased">
                        {{ statistics?.reviews.total }}
                    </h4>
                </div>
                <div class="border-blue-gray-50 border-t p-4">
                    <p class="text-blue-gray-600 block font-sans leading-relaxed antialiased">
                        <strong class="text-green-500"
                                :class="{'text-red-500':percentFormat(statistics?.reviews?.last_week).slice(0,1).toString() === '-'}">
                            {{ percentFormat(statistics?.reviews?.last_week) }}
                            <span class="text-sm">%</span>
                        </strong> ніж за минулий місяць</p>
                </div>
            </div>
        </div>

        <div class="bg-slate-200 p-6 flex items-stretch">
            <div class="flex-1 border rounded-lg border-gray-secondary">
                <div class="flex justify-between items-center p-2 mb-2 border-b border-gray-secondary">
                    <h2 class="font-bold tracking-wide text-xl text-gray-light">Доходи</h2>
                    <select v-model="incomeConfig.year"
                            class="bg-transparent font-bold text-gold-secondary border-0 border-b-2 border-gold-primary focus:ring-gold-primary focus:rounded-lg cursor-pointer">
                        <option v-for="(key,year) in groupedIncomesByYears"
                                :key="key"
                                :value="year">{{ year }}
                        </option>
                    </select>
                </div>
                <apexchart ref="incomeChart" type="area" :options="incomeChartOptions"
                           :series="incomeChartSeries"></apexchart>
            </div>
            <div class="p-4 ml-4 flex-1 border rounded-lg border-gray-secondary">
                <h2 class="font-bold tracking-wide text-xl text-gray-light">Популярні послуги</h2>
                <apexchart type="pie"
                           :options="popularServicesOptions"
                           :series="popularServicesSeries"
                />
            </div>
        </div>
        <div class="bg-slate-200 p-6 mt-2">
            <apexchart type="bar"
                       height="450"
                       :options="employeesDataOptions"
                       :series="employeesDataSeries"
            />
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {currencyFormat} from '@/utils.js'

import {Head} from '@inertiajs/vue3';
import {computed, onMounted, reactive, ref, watch} from "vue";
import months from '@/months.js'

const props = defineProps({
    statistics: {
        type: Object,
        required: true
    }
})

const incomeChart = ref()
const incomeConfig = reactive({
    year: ref(),
    totalYearSum: ref(0),
    categories: reactive([]),
    categoriesData: reactive([])
})


const groupedIncomesByYears = computed(() => {
    return Object.groupBy(props.statistics?.income.income, i => i.year)
})

const percentFormat = (num) => {
    return num < 0 ? num + '' : `+${num}`;
}


onMounted(() => {
    const lastYear = Object.keys(groupedIncomesByYears.value).pop()
    incomeConfig.year = lastYear
    changeIncomeYearHandler(lastYear)
})

watch(
    () => incomeConfig.year,
    () => {
        changeIncomeYearHandler(incomeConfig.year)
    }
)

function changeIncomeYearHandler(year) {
    const profitByYear = groupedIncomesByYears.value[year]
    incomeConfig.categories = Object.values(months)

    incomeConfig.categoriesData = Object.entries(months).map(month => {
        const profitForMonth = profitByYear.find(i => i.month === month[0]);
        return profitForMonth ? profitForMonth.income : 0;
    });

    incomeConfig.totalYearSum = profitByYear.reduce((acc, i) => acc + i.income, 0)
    incomeChartSeries = [{
        name: 'Дохід',
        data: incomeConfig.categoriesData
    }]
    incomeChartOptions = {
        ...incomeChartOptions, ...{
            xaxis: {
                categories: incomeConfig.categories
            },
            title: {
                text: currencyFormat(incomeConfig.totalYearSum)
            }
        }
    }
}

let incomeChartSeries = []
let incomeChartOptions = {
    chart: {
        type: 'area',
        sparkline: {
            enabled: true
        },
    },
    stroke: {
        curve: 'smooth'
    },
    fill: {
        opacity: 0.3
    },
    xaxis: {
        crosshairs: {
            width: 1
        },
    },
    yaxis: {
        show: false
    },
    title: {
        offsetX: 0,
        style: {
            fontSize: '24px',
        }
    },
    subtitle: {
        text: 'За весь рік',
        offsetX: 0,
        style: {
            fontSize: '14px',
        }
    },
    tooltip: {
        fixed: {
            enabled: false
        },
        x: {
            show: true
        },
        y: {
            formatter: function (seriesName) {
                return currencyFormat(seriesName)
            }
        },
        marker: {
            show: false
        }
    }
}

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
    labels: popularServicesTitle.value,
    legend: {
        position: 'left',
        offsetY: 80
    },
    tooltip: {
        y: {
            formatter: function (value) {
                return value + '%';
            }
        }
    }
}


const employeeNames = computed(() => {
    return props.statistics?.employees_data.map(i => i.employee);
})

const employeeOrders = computed(() => {
    return props.statistics?.employees_data.map(i => i.orders);
})

const employeeIncome = computed(() => {
    return props.statistics?.employees_data.map(i => i.income);
})

const employeesDataSeries = [
    {name: 'Загальний прибуток', data: employeeIncome.value},
    {name: 'Бронювань', data: employeeOrders.value},

]

const employeesDataOptions = {
    chart: {
        type: 'bar',
        height: 450
    },
    stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
    },
    plotOptions: {
        bar: {
            borderRadius: 4,
            horizontal: true,
        }
    },
    title: {
        text: 'Статистика працівників',
        style: {
            fontSize: '18px'
        }
    },
    dataLabels: {
        enabled: false
    },
    xaxis: {
        categories: employeeNames.value
    }
}

</script>
