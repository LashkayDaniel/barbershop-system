<template>
    <div class="p-2 bg-gray-primary">

        <h2 class="text-lg sm:text-xl lg:text-2xl text-gold-primary text-opacity-85 font-bold text-center mb-2 tracking-wide">
            Вибір послуги
        </h2>
        <span
            class="block bg-gradient-to-r text-gray-text from-transparent to-transparent via-gold-secondary h-[1.2px] w-full mb-2"></span>
        <p v-if="services===undefined">Loading...</p>

        <ul v-else class="flex flex-col gap-y-3 max-h-[calc(100vh-200px)] overflow-auto p-2 sm:p-6 lg:p-8">
            <li v-for="(service,index) in services"
                :key="index"
                @click="chooseService(service)"
                class="hover:outline outline-1 outline-gold-primary bg-gradient-to-r from-transparent via-gold-secondary to-transparent transition-all duration-400 cursor-pointer">

                <h2 class="text-center p-2 w-full text-sm sm:text-lg lg:text-xl font-semibold text-gray-text text-opacity-50">
                    {{
                        service.name
                    }}</h2>
            </li>
        </ul>
    </div>
</template>

<script setup>
const emit = defineEmits(['selectedService'])

const props = defineProps({
    services: {
        type: Object,
        required: true
    }
})


const chooseService = (service) => {
    emit('selectedService', service)
}

</script>
