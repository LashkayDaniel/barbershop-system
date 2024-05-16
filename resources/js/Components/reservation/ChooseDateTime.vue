<template>
    <div class="p-2 px-4 sm:px-10 pb-10 bg-gray-primary">

        <h2 class="text-lg sm:text-xl lg:text-2xl text-gold-primary text-opacity-85 font-bold text-center mb-2 tracking-wide">
            Вибір дати та часу
        </h2>
        <span
            class="block bg-gradient-to-r from-transparent to-transparent via-gold-secondary h-[1.2px] w-full mb-2"></span>
        <p v-if="worktimes===undefined">Loading...</p>

        <div class="w-full mt-4">
            <Datepicker
                v-model="selectedDate"
                :disabled-week-days="[6, 0]"
                :min-date="new Date()"
                :max-date="new Date(new Date().getTime()+(10*24*60*60*1000))"
                :enable-time-picker="false"
                @update:model-value="changeDateHandle"
                :markers="markers"
                locale="uk"
                calendar-cell-class-name="text-gold-primary font-bold"
                placeholder="Виберіть дату"
                disable-month-year-select
                dark
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
        <ul class="flex gap-2 flex-wrap my-5 pb-3 border-b border-gold-secondary">
            <li v-if="validTimes.length===0"
                class="text-yellow-600 text-xs sm:text-sm tracking-wide">
                * Немає вільних місць. Спробуйте вибрати інший день
            </li>
            <li v-else
                v-for="(time,index) in validTimes"
                :key="index"
                @click="selectTime(time)"
                class="px-3 text-gold-primary text-sm sm:text-base hover:bg-opacity-50 font-bold bg-gray-light border border-gold-primary rounded-full cursor-pointer">
                {{ timeFormat(time.time) }}
            </li>
        </ul>
        <div v-if="selectedDate && selectedTime" class="text-gray-text">
            <p>Вибрана дата: {{ moment(selectedDate).format("dddd, D MMMM") }}</p>
            <p>Вибраний час: {{ timeFormat(selectedTime.time) }}</p>
        </div>

    </div>
</template>

<script setup>
import {computed, onMounted, ref, watch} from "vue";
import moment from "moment";
import uk from "moment/dist/locale/uk";

const emit = defineEmits(['selectedDateTime'])

const props = defineProps({
    worktimes: {
        type: Array,
        required: true
    }
})

const selectedDate = ref(moment());
const selectedTime = ref()

onMounted(() => {
    moment.updateLocale("uk", uk);
    loadMarkers()
    changeDateHandle(selectedDate.value)
})

watch(selectedDate, () => {
    selectedTime.value = null
})

const availableWorktimes = computed(() => {
    const data = props.worktimes;
    if (data) {
        return Object.groupBy(data, obj => obj.date)
    }
    return {}
})

const validTimes = ref([]);

const changeDateHandle = (newDate) => {
    const today = moment().format('YYYY-MM-DD');
    const date = new Date(newDate).toISOString().slice(0, 10);
    const dayTimes = availableWorktimes.value[date];

    if (dayTimes === undefined) {
        validTimes.value = [];
        return;
    }

    const currentTime = new Date().toLocaleTimeString();
    validTimes.value = (date === today) ? dayTimes.filter(item => item.date >= today && item.time >= currentTime) : dayTimes;
};

const markers = ref([])

const loadMarkers = () => {
    Object.keys(availableWorktimes.value).map(date => {
        markers.value.push({date: date, type: 'dot', color: 'gold'})
    })
}

const timeFormat = (time) => {
    return time.toString().slice(0, 5)
}

const selectTime = (time) => {
    selectedTime.value = time
    emit('selectedDateTime', {date: selectedDate, time: selectedTime})
}

</script>

