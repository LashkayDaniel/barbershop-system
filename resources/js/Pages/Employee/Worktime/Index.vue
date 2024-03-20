<template>
    <Head title="Worktime"/>

    <AuthenticatedLayout>
        <template #header>
            Worktime
        </template>

        <div class="p-6 space-y-6">
            <div class="max-w-2xl mx-auto p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section class="max-w-xl mx-auto">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">Create your work time</h2>

                        <p class="text-sm text-gray-600">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        </p>
                    </header>

                    <p v-if="$page.props.flash.type === 'success' && $page.props.flash.message"
                       class="w-full text-center text-green-600 bg-green-300 font-medium p-2 mt-4">
                        {{ $page.props.flash.message }}
                    </p>

                    <p v-if="$page.props.flash.type === 'error' && $page.props.flash.message"
                       class="w-full text-center text-red-600 bg-red-300 font-medium p-2 mt-4">
                        {{ $page.props.flash.message }}
                    </p>

                    <p v-if="form.errors.date"
                       class="w-full text-center text-red-600 bg-red-300 font-medium p-2 mt-4">
                        {{ form.errors.date }}
                    </p>

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
                            <li v-for="(time,index) in availableTimes" :key="index">
                                <div class="border rounded-full ps-4 m-1 gap-1 inline-flex items-center p-2 pe-0">
                                    <input type="checkbox"
                                           :id="time.id"
                                           :checked="time.is_free"
                                           @change="changeAvailable(time)"
                                           class="peer focus:ring-0 rounded-full focus:ring-offset-0"
                                    >
                                    <label :for="time.id"
                                           class="peer-checked:text-green-500 text-red-300 font-medium select-none cursor-pointer">
                                        {{ time.time }}
                                    </label>
                                    <button @click="deleteTime(time.id)"
                                            class="ml-2 px-1 rounded-full"
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
                Add new</span>
                        <span v-else class="flex gap-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/>
                </svg>
                Hide</span>
                    </button>
                    <form v-if="showCreateForm" @submit.prevent="submitForm"
                          class="mt-2 space-y-2 shadow-md border rounded-lg border-gray-300 p-2">
                        <h2 class="text-xl font-medium text-center">Add new time</h2>

                        <div>
                            <InputLabel for="name" value="time"/>
                            <TextInput
                                placeholder="input time"
                                id="name"
                                type="time"
                                class="mt-1 block w-full"
                                v-model="form.time"
                                required
                                autofocus
                                autocomplete="name"
                            />

                            <InputError class="mt-1" :message="form.errors.time"/>
                        </div>
                        <primary-button
                            v-if="form.time"
                            class="mt-3"
                            type="submit">create
                        </primary-button>
                        <p v-if="form.time">{{
                                moment(moment(date).format('YYYY-MM-DD') + " " + form.time).calendar()
                            }}</p>
                    </form>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>

</template>

<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import Modal from '@/Components/Modal.vue'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {useForm, Head, usePage, router} from '@inertiajs/vue3';
import {computed, onMounted, onUpdated, reactive, ref, watch} from "vue";

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

const date = ref(moment())
const allTimesByDate = ref([])

const markers = reactive([])

const worktimesFormat = computed(() => {
    return Object.groupBy(props.worktimes, obj => obj.date)
})

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
    console.log('mounted')
    moment.updateLocale("uk", uk);
    createMarkers();
    changeDateHandle(date.value)
})

watch(
    () => date.value,
    () => {
        form.date = selectedDateFormat.value
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

const form = useForm({
    user_id: usePage().props.auth.user.id,
    date: selectedDateFormat.value,
    time: null,
});

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

function submitForm() {
    form.post(route('worktime.create'), {
        onSuccess: () => {
            createMarkers()
            changeDateHandle(date.value)
            showCreateForm.value = false
            form.time = null
        }
    })
}
</script>
