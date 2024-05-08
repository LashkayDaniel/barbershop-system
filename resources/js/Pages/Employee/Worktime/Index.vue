<template>
    <Head title="Робочий час"/>

    <AuthenticatedLayout>
        <template #header>
            Робочий час
        </template>

        <div class="p-6 space-y-6">
            <div
                class="max-w-2xl mx-auto p-4 sm:p-8 dark:bg-inherit dark:border dark:border-gray-500 bg-white shadow sm:rounded-lg">
                <section class="max-w-xl mx-auto">
                    <header>
                        <h2 class="text-lg font-medium text-gold-secondary dark:text-sky-400">Створіть свій робочий
                            графік</h2>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Вибираючи потрібну дату додавайте або генеруйте бажані години
                        </p>
                    </header>

                    <FadeInAnimation>
                        <p v-if="$page.props.flash.type === 'success' && $page.props.flash.message"
                           class="w-full text-center text-green-600 bg-green-300 font-medium p-2 mt-4">
                            {{ $page.props.flash.message }}
                        </p>

                        <p v-if="$page.props.flash.type === 'error' && $page.props.flash.message"
                           class="w-full text-center text-red-600 bg-red-300 font-medium p-2 mt-4">
                            {{ $page.props.flash.message }}
                        </p>

                        <p v-if="createForm.errors.date"
                           class="w-full text-center text-red-600 bg-red-300 font-medium p-2 mt-4">
                            {{ createForm.errors.date }}
                        </p>
                    </FadeInAnimation>

                    <div class="mt-4">
                        <Datepicker
                            v-model="date"
                            :disabled-week-days="[6, 0]"
                            :min-date="moment().toISOString()"
                            :enable-time-picker="false"
                            :markers="markers"
                            locale="uk"
                            calendar-cell-class-name="text-slate-600 font-bold"
                            disable-year-select
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

                        <ul class="flex flex-wrap">
                            <li v-if="availableTimes.length===0">
                                <p class="text-sm p-2 text-yellow-600">Немає робочих годин на цей день</p>
                            </li>
                            <li v-else v-for="(time,index) in availableTimes" :key="index">
                                <template v-if="!time?.reserved">
                                    <div
                                        class="border rounded-full ps-4 m-1 gap-1 inline-flex items-center py-1 pe-0 dark:bg-sky-300 dark:bg-opacity-20">
                                        <input type="checkbox"
                                               :id="time.id"
                                               :checked="time.is_free"
                                               @change="changeAvailable(time)"
                                               class="peer focus:ring-0 rounded-full focus:ring-offset-0"
                                        >
                                        <label :for="time.id"
                                               class="peer-checked:text-green-500 text-red-300 font-medium select-none cursor-pointer">
                                            {{ timeFormat(time.time) }}
                                        </label>
                                        <button @click="deleteTime(time.id)"
                                                class="ml-1 px-1 rounded-full"
                                                type="button">
                                            <svg class="w-5 h-5 text-red-500 hover:text-red-100 transition-all"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20"
                                                 fill="currentColor">
                                                <path fill-rule="evenodd"
                                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                                <template v-else>
                                    <div
                                        class="border border-red-400 rounded-full px-4 py-1 m-1 bg-red-500 bg-opacity-15">
                                        <span class="text-red-400 font-semibold">{{
                                                timeFormat(time.time)
                                            }}</span>
                                    </div>
                                </template>
                            </li>
                        </ul>
                    </div>

                    <hr class="border-t border-gray-300 m-2">
                    <button class="text-sky-400 bg-sky-200 px-4 py-1 border border-sky-500 rounded-full font-bold"
                            :class="{'bg-slate-300' : showCreateForm}"
                            @click="showCreateForm = !showCreateForm"
                            type="button">
                        <span v-if="!showCreateForm" class="flex gap-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            Додати
                        </span>
                        <span v-else class="flex gap-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/>
                            </svg>
                            Сховати
                        </span>
                    </button>
                    <FadeInAnimation>
                        <form v-if="showCreateForm" @submit.prevent="submitCreateForm"
                              class="mt-2 space-y-2 shadow-md border rounded-lg border-gray-300 dark:border-gray-400 p-2">
                            <h2 class="text-xl font-medium text-center dark:text-sky-400">Додайте нову годину</h2>

                            <div>
                                <InputLabel for="name" value="Година"/>
                                <TextInput
                                    placeholder="input time"
                                    id="name"
                                    type="time"
                                    class="mt-1 block w-full"
                                    v-model="createForm.time"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />

                                <InputError class="mt-1" :message="createForm.errors.time"/>
                            </div>
                            <p v-if="createForm.time" class="dark:text-sky-300">
                                {{
                                    moment(moment(date).format('YYYY-MM-DD') + " " + createForm.time).calendar()
                                }}
                            </p>
                            <primary-button
                                v-if="createForm.time"
                                class="mt-3"
                                type="submit">
                                Зберегти
                            </primary-button>
                        </form>
                    </FadeInAnimation>

                    <button
                        class="m-2 text-sky-400 bg-sky-200 px-4 py-1 border border-sky-500 rounded-full font-bold"
                        :class="{'bg-slate-300' : showGenerateForm}"
                        @click="showGenerateForm = !showGenerateForm"
                        type="button">
                        <span v-if="!showGenerateForm" class="flex gap-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            Згенерувати
                        </span>
                        <span v-else class="flex gap-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/>
                            </svg>
                            Сховати
                        </span>
                    </button>

                    <FadeInAnimation>
                        <form v-if="showGenerateForm" @submit.prevent="submitGenerateForm"
                              class="mt-2 space-y-2 shadow-md border rounded-lg border-gray-300 p-2">
                            <h2 class="text-xl font-medium text-center">Згенеруйте графік на день
                                ({{ moment(date).format('D MMMM') }})</h2>

                            <div class="flex gap-x-2 items-end">
                                <div>
                                    <InputLabel for="from" value="від"/>
                                    <TextInput
                                        placeholder="from"
                                        id="from"
                                        type="time"
                                        class="mt-1 block w-full"
                                        v-model="generateForm.from"
                                        required
                                        autofocus
                                        autocomplete="name"
                                    />
                                </div>
                                <div>
                                    <InputLabel for="to" value="до"/>
                                    <TextInput
                                        placeholder="to"
                                        id="to"
                                        type="time"
                                        class="mt-1 block w-full"
                                        v-model="generateForm.to"
                                        required
                                    />
                                </div>
                                <div>
                                    <InputLabel for="interval" value="інтервал (хв)"/>
                                    <input
                                        placeholder="interval"
                                        id="interval"
                                        type="number"
                                        min="0"
                                        max="60"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        v-model.number="generateForm.interval"
                                        required
                                    />
                                </div>
                                <secondary-button
                                    type="button"
                                    @click="generateWorktimes">Generate
                                </secondary-button>
                            </div>
                            <div class="">
                                <p v-if="generateForm.error"
                                   class="text-red-400">{{ generateForm.error }}</p>

                                <template v-else>
                                    <ul class="flex gap-x-2 gap-y-1 flex-wrap">
                                        <li v-for="(time,i) in generatedWorktimes"
                                            :key="i"
                                            class="border border-sky-500 text-sm font-bold text-sky-500 rounded-full px-2 bg-sky-200">
                                            {{ time }}
                                        </li>
                                    </ul>
                                </template>
                            </div>
                            <primary-button
                                v-if="generatedWorktimes.length>0"
                                class="mt-3"
                                type="submit">save
                            </primary-button>
                        </form>
                    </FadeInAnimation>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>

</template>

<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import FadeInAnimation from '@/Components/animations/FadeIn.vue'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {useForm, Head, usePage, router} from '@inertiajs/vue3';
import {computed, onMounted, reactive, ref, watch} from "vue";

import moment from 'moment';
import uk from "moment/dist/locale/uk";

const props = defineProps({
    worktimes: {
        type: Object,
        required: true,
        default: {}
    },
})


const user = usePage().props.auth.user

const showCreateForm = ref(false)
const showGenerateForm = ref(false)

const date = ref(moment())
const allTimesByDate = ref([])

const markers = reactive([])

const worktimesFormat = computed(() => {
    return Object.groupBy(props.worktimes, obj => obj.date)
})

const timeFormat = (time) => {
    return time.toString().slice(0, 5)
}

const availableTimes = computed(() => {
    const selectedDate = moment(date.value).format('YYYY-MM-DD')
    const currentDate = moment().format('YYYY-MM-DD');
    if (selectedDate !== currentDate) {
        return allTimesByDate.value
    }

    const currentTime = moment().format('LTS')
    return allTimesByDate.value.filter(item => item.time >= currentTime)
})

function changeDateHandle(date) {
    const dateFormat = moment(date).format('YYYY-MM-DD')
    const dayTimes = worktimesFormat.value[dateFormat]

    if (dayTimes === undefined) {
        allTimesByDate.value = []
        return;
    }
    allTimesByDate.value = dayTimes
}

function createMarkers() {
    markers.slice(0)
    for (const date in worktimesFormat.value) {
        const item = {date: '', type: '', tooltip: []}
        item.date = date
        item.type = 'dot'
        const times = worktimesFormat.value[date]
        times.forEach(el => {
            item.tooltip.push({text: el.time, color: el.is_free === 1 ? 'green' : 'red'})
        })
        markers.push(item)
    }
}

onMounted(() => {
    moment.updateLocale("uk", uk);
    createMarkers();
    changeDateHandle(date.value)
})

watch(
    () => date.value,
    () => {
        createForm.date = selectedDateFormat.value
        changeDateHandle(date.value)
    }
)

watch(
    () => usePage().props.flash.message,
    (value) => {
        if (value) {
            setTimeout(() => {
                usePage().props.flash.message = ''
            }, 6000)
        }
    }
)

const selectedDateFormat = computed(() => {
    return moment(date.value).format('YYYY-MM-DD')
})

const createForm = useForm({
    user_id: usePage().props.auth.user.id,
    date: selectedDateFormat.value,
    time: '',
});

const generateForm = reactive({
    from: '',
    to: '',
    interval: 0,
    error: ''
})

const generatedWorktimes = ref([])

function generateWorktimes() {
    const {from, to, interval} = generateForm;
    const generatedTimes = []
    let currentTime = moment(from, 'HH:mm');
    const endTime = moment(to, 'HH:mm');

    while (currentTime.isSameOrBefore(endTime)) {
        generatedTimes.push(currentTime.format('HH:mm'));
        currentTime = currentTime.add(interval, 'minutes');
    }
    generatedWorktimes.value = generatedTimes
    generateForm.error = generatedTimes.length === 0 ? 'Щось пішло не так...' : ''
};

function changeAvailable(time) {
    router.patch(route('worktime.update', time.id), {preserveScroll: true})
}

function deleteTime(id) {
    if (confirm('You really want to delete this time?')) {
        router.delete(route('worktime.delete', id))
        let index = availableTimes.value.findIndex(obj => obj.id === id);
        if (index !== -1) {
            availableTimes.value.splice(index, 1);
        }
    }
}

function submitCreateForm() {
    createForm.post(route('worktime.create'), {
        onSuccess: () => {
            createMarkers()
            changeDateHandle(date.value)
            showCreateForm.value = false
            createForm.time = null
        }
    })
}

function submitGenerateForm() {
    const data = {
        user_id: usePage().props.auth.user.id,
        date: selectedDateFormat.value.toString(),
        times: Array.from(generatedWorktimes.value).map(i => i + ':00')
    }
    router.post(route('worktime.generate'), data, {
        onSuccess: () => {
            showGenerateForm.value = false
            generateForm.from = ''
            generateForm.to = ''
            generateForm.interval = 0
            generateForm.error = ''
        }
    })
}
</script>
