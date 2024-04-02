<template>
    <ImageViewer
        :src="imageView.src"
        :show="imageView.show"
        @close="imageView.show = !imageView.show">
    </ImageViewer>

    <article class="bg-body flex flex-col px-10 py-5 gap-y-2 h-full overflow-auto">
        <header class="bg-gray-primary h-96 flex">
            <div class="w-2/5 h-full">
                <img :src="data?.avatar" class="object-contain w-full h-full" alt="master photo">
            </div>
            <div class="flex-1 px-5 text-gray-text py-4">
                <div class="flex items-start gap-x-">
                    <div class="flex-1">
                        <h2 class="font-bold text-2xl tracking-wider uppercase whitespace-nowrap">{{ data?.name }}</h2>
                        <p class="text-gray-secondary tracking-wider">{{ data?.rank }}</p>
                    </div>
                    <div class="flex-1 flex justify-end">
                        <div
                            class="text-center px-4 border-2 border-gold-secondary bg-[#363434]">
                            <b class="text-gray-text tracking-wide font-bold">{{ data?.rating }}</b>
                            <div class="flex flex-row justify-center items-center">
                                <svg v-for="i in 5" width="15" height="15" viewBox="0 0 11 10"
                                     fill="currentColor"
                                     class="text-gray-500"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        :class="{'text-[#E5B454]':i<=Math.floor(data?.rating)}"
                                        d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-sm mt-2 hyphens-auto opacity-85 tracking-wide">{{ data?.description }}</p>
                <div class="flex items-start gap-x-4 -translate-x-10 pt-5">
                    <span class="block w-20 border-b border-gold-primary translate-y-3"></span>
                    <div class="">
                        <h2 class="uppercase text-gray-text text-xl font-bold tracking-widest">Послуги</h2>
                        <ul class="opacity-65 *:tracking-wider" v-for="service in data?.services">
                            <li class="flex items-center gap-x-2">
                                    <span
                                        class="block size-2 border-2 border-gold-primary bg-gold-secondary rounded-full"></span>
                                {{ service.name }} - {{ service.price }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div
                    class="pt-2 mt-5 text-gold-primary text-sm">
                    <span
                        class="block bg-gradient-to-r from-transparent to-transparent via-gold-secondary h-[1.2px] w-full mb-2"></span>
                    <div class="flex justify-center items-center">
                        <div class="flex items-center mx-5 opacity-65 whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-4 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                            </svg>
                            {{ data?.email }}
                        </div>
                        <span class="block size-1 bg-gold-primary opacity-85 rounded-full"></span>
                        <div class="flex items-center mx-5 opacity-65 whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-4 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/>
                            </svg>
                            {{ data?.phone }}
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section v-if="data.portfolio.length>0">
            <div class="flex justify-between">
                <div class="flex items-start gap-x-4 -translate-x-5 pt-5">
                    <span class="block w-20 border-b border-gold-primary translate-y-4"></span>
                    <h2 class="uppercase text-gray-text text-2xl font-bold tracking-widest">Роботи майстра</h2>
                </div>
                <div class="flex justify-center items-center gap-x-2 mt-4 px-4">
                    <div id="gallery-btn-prev"
                         class="cursor-pointer hover:opacity-70 hover:-translate-x-2 duration-300 transition-all">
                        <svg
                            class="rotate-180 "
                            width="50" height="16" viewBox="0 0 78 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M77.398 8.70711C77.7885 8.31658 77.7885 7.68342 77.398 7.29289L71.034 0.928932C70.6435 0.538408 70.0103 0.538408 69.6198 0.928932C69.2293 1.31946 69.2293 1.95262 69.6198 2.34315L75.2766 8L69.6198 13.6569C69.2293 14.0474 69.2293 14.6805 69.6198 15.0711C70.0103 15.4616 70.6435 15.4616 71.034 15.0711L77.398 8.70711ZM0.763367 9H76.6908V7H0.763367V9Z"
                                fill="#9C846E"/>
                        </svg>
                    </div>
                    <div id="gallery-btn-next"
                         class="cursor-pointer hover:opacity-70 hover:translate-x-2 duration-300 transition-all">
                        <svg
                            width="50"
                            height="16"
                            viewBox="0 0 78 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M77.398 8.70711C77.7885 8.31658 77.7885 7.68342 77.398 7.29289L71.034 0.928932C70.6435 0.538408 70.0103 0.538408 69.6198 0.928932C69.2293 1.31946 69.2293 1.95262 69.6198 2.34315L75.2766 8L69.6198 13.6569C69.2293 14.0474 69.2293 14.6805 69.6198 15.0711C70.0103 15.4616 70.6435 15.4616 71.034 15.0711L77.398 8.70711ZM0.763367 9H76.6908V7H0.763367V9Z"
                                fill="#9C846E"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="w-full my-4 h-[300px]">
                <swiper class="flex w-full h-full gap-x-2"
                        :slides-per-view="3"
                        :loop="true"
                        :space-between="10"
                        :navigation="{
                                nextEl: '#gallery-btn-next',
                                prevEl: '#gallery-btn-prev'
                            }"
                        :modules="[Navigation, Autoplay]"
                        :autoplay="{delay:4000}"

                >
                    <swiper-slide v-for="(image,index) in data?.portfolio"
                                  :key="index"
                                  class="flex items-center">
                        <div @click="showImage(image.url)"
                             class="grow h-full cursor-pointer transition-all duration-200 hover:translate-x-1 hover:-translate-y-2">
                            <img class="select-none mx-auto object-cover h-full"
                                 :src="image.url" :alt="'image '+index"
                                 loading="lazy">
                        </div>
                    </swiper-slide>
                </swiper>
            </div>
        </section>

        <section>
            <div class="flex items-start gap-x-4 -translate-x-5 pt-5">
                <span class="block w-20 border-b border-gold-primary translate-y-4"></span>
                <h2 class="uppercase text-gray-text text-2xl font-bold tracking-widest">Відгуки</h2>
                <span class="text-gray-secondary tracking-wider">({{ responses.length }})</span>
            </div>

            <swiper class="w-full py-5 my-5 flex gap-x-2"
                    :slides-per-view="3"
                    :space-between="10"
                    :navigation="{
                                nextEl: '#gallery-btn-next',
                                prevEl: '#gallery-btn-prev'
                            }"
                    :modules="[Navigation, Autoplay]"
                    :autoplay="{delay:4000}"

            >
                <swiper-slide class="w-full" v-for="response in responses">
                    <div class="p-2 bg-gray-primary flex">
                        <div
                            class="size-12 rounded-full flex items-center justify-center bg-[#393737] text-[#7E6B6B]"><span
                            class="font-bold text-3xl uppercase">{{ response.name.slice(0, 1) }}</span></div>
                        <div class="text-gray-text flex-1 px-5">
                            <div class="flex justify-between items-center border-b pb-1 border-gray-light">
                                <h3 class="uppercase font-bold text-sm tracking-wide">{{ response.name }}</h3>
                                <div class="flex items-center">
                                    <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                            fill="#E5B454"/>
                                    </svg>
                                    <span class="pl-1">{{ response.rating }}.0</span>
                                </div>
                            </div>

                            <p class="my-2 indent-4 hyphens-auto text-gray-secondary text-sm">{{ response.text }}</p>
                            <div class="mt-4 text-xs text-end opacity-45">
                                {{ moment(response.created_at).fromNow() }}
                            </div>
                        </div>
                    </div>
                </swiper-slide>
            </swiper>
        </section>

        <p v-if="$page.props.flash.type === 'success' && $page.props.flash.message"
           class="w-full text-center text-green-600 bg-green-300 font-medium p-2 my-4">
            {{ $page.props.flash.message }}
        </p>
        <section class="flex flex-col justify-center">
            <div class="bg-gray-primary w-1/2 text-gray-text px-5 py-5 border border-gold-primary">
                <div class="flex items-center">
                    <span class="block w-full border-b border-gold-primary"></span>
                    <h2 class="text-xl font-bold px-2 uppercase tracking-wider whitespace-nowrap">Залишити
                        відгук</h2>
                    <span class="block w-full border-b border-gold-primary"></span>
                </div>
                <form class="py-5 px-5" @submit.prevent="submitResponse">
                    <div class="flex flex-col">
                        <label for="name" class="font-bold opacity-65">Ім'я</label>
                        <input v-model="responseForm.name"
                               class="bg-transparent border-2 focus:border-gray-400 focus:ring-offset-0 focus:ring-0 placeholder:font-medium"
                               name="name" type="text" placeholder="Введіть ім'я" required>
                        <p v-if="responseForm.errors.name"
                           class="text-sm tracking-wide text-red-400">{{ responseForm.errors.name }}</p>
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="response" class="font-bold opacity-65">Відгук</label>
                        <textarea v-model="responseForm.response"
                                  class="bg-transparent border-2 focus:border-gray-400 focus:ring-offset-0 focus:ring-0 placeholder:font-medium resize-y"
                                  name="response" placeholder="Введіть комент" required/>
                        <p v-if="responseForm.errors.response"
                           class="text-sm tracking-wide text-red-400">{{ responseForm.errors.response }}</p>
                    </div>

                    <div class="my-5 flex items-center gap-x-5">
                        <div class="flex flex-row-reverse justify-end items-center gap-x-1">
                            <template v-for="i in 5" :key="i">
                                <input :id="'star-'+i" type="radio"
                                       class="peer -ms-5 size-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                                       name="rating" :value="5-i+1" v-model="responseForm.rating">
                                <label :for="'star-'+i"
                                       class="peer-checked:text-yellow-500 peer-hover:text-yellow-600 text-gray-400 pointer-events-none">
                                    <svg class="flex-shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16"
                                         height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                </label>
                            </template>
                        </div>
                        <span>{{ responseForm.rating }}/5</span>
                    </div>

                    <button class="px-8 py-2 bg-[#D17C24] uppercase font-bold tracking-wide hover:opacity-85"
                            type="submit">
                        Надіслати
                    </button>
                </form>
            </div>
        </section>
    </article>
</template>

<script setup>
import {Swiper, SwiperSlide} from 'swiper/vue';
import {Autoplay, Navigation} from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import {computed, reactive, ref, watch} from "vue";
import {useForm, usePage} from "@inertiajs/vue3";
import moment from 'moment';
import ImageViewer from '@/Components/other/ImageViewer.vue'

const props = defineProps({
    data: {
        type: Object,
        required: true
    }
})

const imageView = reactive({
    show: ref(false),
    src: ref('')
})

const responseForm = useForm({
    employee_id: props.data?.id,
    name: ref(''),
    response: ref(''),
    rating: ref(1)
})

const responses = computed(() => {
    return props.data?.responses;
})

watch(
    () => usePage().props.flash.message,
    (value) => {
        if (value) {
            setTimeout(() => {
                usePage().props.flash.message = ''
            }, 4000)
        }
    }
)

const showImage = (src) => {
    imageView.show = true
    imageView.src = src
}

function submitResponse() {
    responseForm.post(route('response.create'), {
        onSuccess: () => {
            responses.value.push()
            responseForm.reset()
        }
    })
}
</script>

