<template>
    <div class="p-2 bg-gray-primary">

        <h2 class="text-lg sm:text-xl lg:text-2xl text-gold-primary text-opacity-85 font-bold text-center mb-2 tracking-wide">
            Вибір
            майстра</h2>
        <span
            class="block bg-gradient-to-r text-gray-text from-transparent to-transparent via-gold-secondary h-[1.2px] w-full mb-2"></span>
        <p v-if="masters===undefined">Loading...</p>

        <ul v-else class="flex flex-col gap-y-2 sm:gap-y-4 max-h-[calc(100vh-200px)] overflow-auto p-2 sm:p-6">
            <li v-for="(master,index) in masters"
                :key="index"
                @click="chooseMaster(master)"
                class="flex hover:outline outline-1 outline-gold-primary bg-gradient-to-r from-gold-secondary from-10% transition-all duration-400 cursor-pointer">

                <img class="size-20 h-full object-cover ring-2 ring-transparent"
                     :src="master.avatar" alt="avatar">
                <div class="flex flex-col justify-center p-2">
                    <div class="flex items-center">
                        <h2 class="text-lg sm:text-xl font-semibold text-gray-secondary">{{ master.name }}</h2>
                        <svg width="17" height="17" viewBox="0 0 11 10"
                             fill="currentColor"
                             class="ml-2 text-gold-primary"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"/>
                        </svg>
                        <h3 class="font-bold text-sm sm:text-base text-gray-text ml-1 text-opacity-75">{{
                                master.rating
                            }}</h3>
                    </div>
                    <p class="text-xs sm:text-sm tracking-wider font-medium text-gray-primary">{{ master.rank }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script setup>
const emit = defineEmits(['selectedMaster'])

const props = defineProps({
    masters: {
        type: Object,
        required: true
    }
})


const chooseMaster = (master) => {
    emit('selectedMaster', master)
}

</script>
