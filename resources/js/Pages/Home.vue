<script setup>
import {Head} from '@inertiajs/vue3';
import {Swiper, SwiperSlide} from 'swiper/vue';
import {Autoplay, Navigation} from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import {onMounted, ref} from "vue";

const showBtnToUp = ref(false);

const scrollToUp = () => {
    window.scrollTo({
        top: 0,
        left: 0,
        behavior: 'smooth',
    });
}

onMounted(() => {
    window.addEventListener("scroll", () => {
        let scroll = window.scrollY;
        showBtnToUp.value = scroll > 350;
    });
});


</script>

<template>
    <Head title="Home"/>

    <transition name="fade">
        <button v-if="showBtnToUp"
                @click="scrollToUp"
                class="fixed bottom-5 right-10 z-50 bg-gold-secondary size-12 items-center hover:scale-125 transition-all duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor"
                 class="w-8 h-8 m-auto text-gold-primary">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 18.75 7.5-7.5 7.5 7.5"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 7.5-7.5 7.5 7.5"/>
            </svg>
        </button>
    </transition>

    <header class="w-full h-screen relative">
        <nav class="z-50 text-gray-400 w-full py-2 flex justify-between text-gray-text items-center">
            <div class="pl-10 z-50">
                <img src="/img/logo.svg" class="size-20" alt="logo">
            </div>
            <ul class="flex border-b border-gray-light pl-8 pr-10 mr-2">
                <li class="uppercase font-bold tracking-widest text-sm hover:-translate-y-1 hover:translate-x-1 hover:opacity-70 transition-all cursor-pointer px-4 py-2">
                    <a href="#">Головна</a>
                </li>
                <li class="uppercase font-bold tracking-widest text-sm hover:-translate-y-1 hover:translate-x-1 hover:opacity-70 transition-all cursor-pointer px-4 py-2">
                    <a href="#services">Послуги</a>
                </li>
                <li class="uppercase font-bold tracking-widest text-sm hover:-translate-y-1 hover:translate-x-1 hover:opacity-70 transition-all cursor-pointer px-4 py-2">
                    <a href="#masters">Майстри</a>
                </li>
                <li class="uppercase font-bold tracking-widest text-sm hover:-translate-y-1 hover:translate-x-1 hover:opacity-70 transition-all cursor-pointer px-4 py-2">
                    <a href="#gallery">Галерея</a>
                </li>
            </ul>
        </nav>

        <div class="z-0 absolute top-0 left-0 w-2/5 h-3/4 bg-gray-primary"></div>
        <div class="z-0 absolute bottom-0 right-0 w-2/5 h-3/5 bg-gray-primary"></div>
        <div class="z-10 absolute left-0 right-0 bottom-0 pb-6 flex justify-center items-center">
            <h1 class="uppercase select-none text-gray-text tracking-[.4rem] font-bold text-5xl max-w-[700px] absolute left-40 -top-5">
                Створіть свій стиль разом з нами!
            </h1>

            <div class="flex items-center absolute -top-14 ">
                <span class="block w-24 border-b border-gold-primary"></span>
                <button
                    class="absolute left-[calc(100%-15px)] hover:left-[calc(100%-5px)] hover:border-2 transition-all duration-200 uppercase border border-gold-primary text-gray-text font-semibold tracking-widest px-6 py-2 ">
                    <a href="#reservation">
                        Записатися
                    </a>
                </button>
            </div>

            <div class="bg-slate-200 bg-contain overflow-hidden">
                <img class="w-full" src="/img/1.png" alt="main image">
            </div>
            <img class="self-end mb-10 -translate-x-[45%]" src="/img/dots.svg" alt="dots">
        </div>

    </header>


    <main class="w-4/5 mx-auto my-5 ">
        <article id="services">
            <header class="flex items-start gap-x-4 -translate-x-10 mt-24 pt-5">
                <span class="block w-28 border-b border-gold-primary translate-y-5"></span>
                <div class="">
                    <h2 class="uppercase text-gray-text text-4xl font-bold tracking-wide">Наші послуги</h2>
                    <p class="text-gray-secondary text-bold tracking-wide">
                        Відкрийте для себе асортимент послуг, які відтворять ваш стиль та
                        додадуть вам впевненості</p>
                </div>
            </header>

            <section class="relative bg-gray-primary w-3/5 mx-auto m-10 p-20 flex flex-col gap-y-5">
                <div class="absolute top-0 right-0 bg-body w-32 h-20 translate-x-16 -translate-y-10 rotate-45"></div>
                <div class="absolute bottom-0 left-0 bg-body w-40 h-20 -translate-x-16 translate-y-8 rotate-45">
                </div>

                <div class="">
                    <div class="flex items-center gap-x-5">
                        <h3 class="whitespace-nowrap inline-block uppercase text-gray-text text-xl font-bold tracking-widest">
                            Чоловіча
                            стрижка</h3>
                        <span class="block w-full border-b-2 border-gold-primary"></span>
                        <span class="text-gold-primary font-black text-xl">$20</span>
                    </div>
                    <p class="text-gray-secondary text-bold tracking-wide w-4/6">Виключно для чоловіків, які хочуть
                        виглядити
                        брутально та модно</p>
                </div>

                <div class="">
                    <div class="flex items-center gap-x-5">
                        <h3 class="whitespace-nowrap inline-block uppercase text-gray-text text-xl font-bold tracking-widest">
                            Чоловіча
                            стрижка</h3>
                        <span class="block w-full border-b-2 border-gold-primary"></span>
                        <span class="text-gold-primary font-black text-xl">$20</span>
                    </div>
                    <p class="text-gray-secondary text-bold tracking-wide w-4/6">Виключно для чоловіків, які хочуть
                        виглядити
                        брутально та модно</p>
                </div>

                <div class="">
                    <div class="flex items-center gap-x-5">
                        <h3 class="whitespace-nowrap inline-block uppercase text-gray-text text-xl font-bold tracking-widest">
                            Чоловіча
                            стрижка</h3>
                        <span class="block w-full border-b-2 border-gold-primary"></span>
                        <span class="text-gold-primary font-black text-xl">$20</span>
                    </div>
                    <p class="text-gray-secondary text-bold tracking-wide w-4/6">Виключно для чоловіків, які хочуть
                        виглядити
                        брутально та модно</p>
                </div>

                <div class="">
                    <div class="flex items-center gap-x-5">
                        <h3 class="whitespace-nowrap inline-block uppercase text-gray-text text-xl font-bold tracking-widest">
                            Чоловіча
                            стрижка</h3>
                        <span class="block w-full border-b-2 border-gold-primary"></span>
                        <span class="text-gold-primary font-black text-xl">$20</span>
                    </div>
                    <p class="text-gray-secondary text-bold tracking-wide w-4/6">Виключно для чоловіків, які хочуть
                        виглядити
                        брутально та модно</p>
                </div>

                <div class="">
                    <div class="flex items-center gap-x-5">
                        <h3 class="whitespace-nowrap inline-block uppercase text-gray-text text-xl font-bold tracking-widest">
                            Чоловіча
                            стрижка</h3>
                        <span class="block w-full border-b-2 border-gold-primary"></span>
                        <span class="text-gold-primary font-black text-xl">$20</span>
                    </div>
                    <p class="text-gray-secondary text-bold tracking-wide w-4/6">Виключно для чоловіків, які хочуть
                        виглядити
                        брутально та модно</p>
                </div>

                <div class="">
                    <div class="flex items-center gap-x-5">
                        <h3 class="whitespace-nowrap inline-block uppercase text-gray-text text-xl font-bold tracking-widest">
                            Чоловіча
                            стрижка</h3>
                        <span class="block w-full border-b-2 border-gold-primary"></span>
                        <span class="text-gold-primary font-black text-xl">$20</span>
                    </div>
                    <p class="text-gray-secondary text-bold tracking-wide w-4/6">Виключно для чоловіків, які хочуть
                        виглядити
                        брутально та модно</p>
                </div>
            </section>
        </article>


        <article id="masters">
            <header class="flex items-start gap-x-4 -translate-x-10 mt-24 pt-5">
                <span class="block w-28 border-b border-gold-primary translate-y-5"></span>
                <div class="">
                    <h2 class="uppercase text-gray-text text-4xl font-bold tracking-wide">Наші майстри</h2>
                    <p class="text-gray-secondary text-bold tracking-wide">
                        Володарі мистецтва барберингу, які створять ваш неповторний образ</p>
                </div>
            </header>

            <section class="w-full h-80 my-8">
                <swiper class="h-full grid grid-cols-2 grid-rows-1 gap-x-4"
                        :slides-per-view="2"
                        :loop="true"
                        :space-between="10"
                        :navigation="{
                                nextEl: '#masters-btn-next',
                                prevEl: '#masters-btn-prev'
                            }"
                        :modules="[Navigation, Autoplay]"
                        :autoplay="{delay:4000}"
                >
                    <swiper-slide>
                        <div class="bg-gray-primary flex">
                            <div class="w-2/5 bg-gold-secondary">
                                <img src="/img/7.webp" class="h-full m-auto object-cover" alt="">
                            </div>
                            <div class="flex flex-1 flex-col">
                                <div class="flex justify-end">
                                    <div
                                        class="text-center px-4 border-2 border-gold-secondary bg-[#363434]">
                                        <b class="text-gray-text tracking-wide font-bold">5.0</b>
                                        <div class="flex flex-row justify-center items-center">
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 text-center text-gray-text mb-10">
                                    <h3 class="text-2xl tracking-widest font-extrabold uppercase mt-5">John
                                        Smith</h3>
                                    <span class="text-gray-secondary font-medium tracking-wide">barber</span>
                                    <p class="w-4/5 mx-auto mt-5 line-clamp-4 tracking-wide">Lorem ipsum dolor sit amet,
                                        consectetur
                                        adipisicing elit. Debitis doloribus, laborum!
                                        Adipisci asperiores beatae consequuntur deleniti distinctio, dolor error labore
                                        minima mollitia necessitatibus nemo nisi nulla praesentium quaerat saepe
                                        suscipit.</p>
                                </div>
                                <div class="flex justify-end">
                                    <button
                                        class="text-gold-secondary font-semibold tracking-widest px-5 py-2 hover:text-[#C3A371] transition-all duration-200">
                                        Детальніше
                                    </button>
                                </div>
                            </div>
                        </div>
                    </swiper-slide>
                    <swiper-slide>
                        <div class="bg-gray-primary flex">
                            <div class="w-2/5 bg-gold-secondary">
                                <img src="/img/7.webp" class="h-full m-auto object-cover" alt="">
                            </div>
                            <div class="flex flex-1 flex-col">
                                <div class="flex justify-end">
                                    <div
                                        class="text-center px-4 border-2 border-gold-secondary bg-[#363434]">
                                        <b class="text-gray-text tracking-wide font-bold">5.0</b>
                                        <div class="flex flex-row justify-center items-center">
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 text-center text-gray-text mb-10">
                                    <h3 class="text-2xl tracking-widest font-extrabold uppercase mt-5">John
                                        Smith</h3>
                                    <span class="text-gray-secondary font-medium tracking-wide">barber</span>
                                    <p class="w-4/5 mx-auto mt-5 line-clamp-4 tracking-wide">Lorem ipsum dolor sit amet,
                                        consectetur
                                        adipisicing elit. Debitis doloribus, laborum!
                                        Adipisci asperiores beatae consequuntur deleniti distinctio, dolor error labore
                                        minima mollitia necessitatibus nemo nisi nulla praesentium quaerat saepe
                                        suscipit.</p>
                                </div>
                                <div class="flex justify-end">
                                    <button
                                        class="text-gold-secondary font-semibold tracking-widest px-5 py-2 hover:text-[#C3A371] transition-all duration-200">
                                        Детальніше
                                    </button>
                                </div>
                            </div>
                        </div>
                    </swiper-slide>
                    <swiper-slide>
                        <div class="bg-gray-primary flex">
                            <div class="w-2/5 bg-gold-secondary">
                                <img src="/img/7.webp" class="h-full m-auto object-cover" alt="">
                            </div>
                            <div class="flex flex-1 flex-col">
                                <div class="flex justify-end">
                                    <div
                                        class="text-center px-4 border-2 border-gold-secondary bg-[#363434]">
                                        <b class="text-gray-text tracking-wide font-bold">5.0</b>
                                        <div class="flex flex-row justify-center items-center">
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 text-center text-gray-text mb-10">
                                    <h3 class="text-2xl tracking-widest font-extrabold uppercase mt-5">John
                                        Smith</h3>
                                    <span class="text-gray-secondary font-medium tracking-wide">barber</span>
                                    <p class="w-4/5 mx-auto mt-5 line-clamp-4 tracking-wide">Lorem ipsum dolor sit amet,
                                        consectetur
                                        adipisicing elit. Debitis doloribus, laborum!
                                        Adipisci asperiores beatae consequuntur deleniti distinctio, dolor error labore
                                        minima mollitia necessitatibus nemo nisi nulla praesentium quaerat saepe
                                        suscipit.</p>
                                </div>
                                <div class="flex justify-end">
                                    <button
                                        class="text-gold-secondary font-semibold tracking-widest px-5 py-2 hover:text-[#C3A371] transition-all duration-200">
                                        Детальніше
                                    </button>
                                </div>
                            </div>
                        </div>
                    </swiper-slide>
                    <swiper-slide>
                        <div class="bg-gray-primary flex">
                            <div class="w-2/5 bg-gold-secondary">
                                <img src="/img/7.webp" class="h-full m-auto object-cover" alt="">
                            </div>
                            <div class="flex flex-1 flex-col">
                                <div class="flex justify-end">
                                    <div
                                        class="text-center px-4 border-2 border-gold-secondary bg-[#363434]">
                                        <b class="text-gray-text tracking-wide font-bold">5.0</b>
                                        <div class="flex flex-row justify-center items-center">
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 text-center text-gray-text mb-10">
                                    <h3 class="text-2xl tracking-widest font-extrabold uppercase mt-5">John
                                        Smith</h3>
                                    <span class="text-gray-secondary font-medium tracking-wide">barber</span>
                                    <p class="w-4/5 mx-auto mt-5 line-clamp-4 tracking-wide">Lorem ipsum dolor sit amet,
                                        consectetur
                                        adipisicing elit. Debitis doloribus, laborum!
                                        Adipisci asperiores beatae consequuntur deleniti distinctio, dolor error labore
                                        minima mollitia necessitatibus nemo nisi nulla praesentium quaerat saepe
                                        suscipit.</p>
                                </div>
                                <div class="flex justify-end">
                                    <button
                                        class="text-gold-secondary font-semibold tracking-widest px-5 py-2 hover:text-[#C3A371] transition-all duration-200">
                                        Детальніше
                                    </button>
                                </div>
                            </div>
                        </div>
                    </swiper-slide>
                    <swiper-slide>
                        <div class="bg-gray-primary flex">
                            <div class="w-2/5 bg-gold-secondary">
                                <img src="/img/7.webp" class="h-full m-auto object-cover" alt="">
                            </div>
                            <div class="flex flex-1 flex-col">
                                <div class="flex justify-end">
                                    <div
                                        class="text-center px-4 border-2 border-gold-secondary bg-[#363434]">
                                        <b class="text-gray-text tracking-wide font-bold">5.0</b>
                                        <div class="flex flex-row justify-center items-center">
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 text-center text-gray-text mb-10">
                                    <h3 class="text-2xl tracking-widest font-extrabold uppercase mt-5">John
                                        Smith</h3>
                                    <span class="text-gray-secondary font-medium tracking-wide">barber</span>
                                    <p class="w-4/5 mx-auto mt-5 line-clamp-4 tracking-wide">Lorem ipsum dolor sit amet,
                                        consectetur
                                        adipisicing elit. Debitis doloribus, laborum!
                                        Adipisci asperiores beatae consequuntur deleniti distinctio, dolor error labore
                                        minima mollitia necessitatibus nemo nisi nulla praesentium quaerat saepe
                                        suscipit.</p>
                                </div>
                                <div class="flex justify-end">
                                    <button
                                        class="text-gold-secondary font-semibold tracking-widest px-5 py-2 hover:text-[#C3A371] transition-all duration-200">
                                        Детальніше
                                    </button>
                                </div>
                            </div>
                        </div>
                    </swiper-slide>
                    <swiper-slide>
                        <div class="bg-gray-primary flex">
                            <div class="w-2/5 bg-gold-secondary">
                                <img src="/img/7.webp" class="h-full m-auto object-cover" alt="">
                            </div>
                            <div class="flex flex-1 flex-col">
                                <div class="flex justify-end">
                                    <div
                                        class="text-center px-4 border-2 border-gold-secondary bg-[#363434]">
                                        <b class="text-gray-text tracking-wide font-bold">5.0</b>
                                        <div class="flex flex-row justify-center items-center">
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 text-center text-gray-text mb-10">
                                    <h3 class="text-2xl tracking-widest font-extrabold uppercase mt-5">John
                                        Smith</h3>
                                    <span class="text-gray-secondary font-medium tracking-wide">barber</span>
                                    <p class="w-4/5 mx-auto mt-5 line-clamp-4 tracking-wide">Lorem ipsum dolor sit amet,
                                        consectetur
                                        adipisicing elit. Debitis doloribus, laborum!
                                        Adipisci asperiores beatae consequuntur deleniti distinctio, dolor error labore
                                        minima mollitia necessitatibus nemo nisi nulla praesentium quaerat saepe
                                        suscipit.</p>
                                </div>
                                <div class="flex justify-end">
                                    <button
                                        class="text-gold-secondary font-semibold tracking-widest px-5 py-2 hover:text-[#C3A371] transition-all duration-200">
                                        Детальніше
                                    </button>
                                </div>
                            </div>
                        </div>
                    </swiper-slide>
                    <swiper-slide>
                        <div class="bg-gray-primary flex">
                            <div class="w-2/5 bg-gold-secondary">
                                <img src="/img/7.webp" class="h-full m-auto object-cover" alt="">
                            </div>
                            <div class="flex flex-1 flex-col">
                                <div class="flex justify-end">
                                    <div
                                        class="text-center px-4 border-2 border-gold-secondary bg-[#363434]">
                                        <b class="text-gray-text tracking-wide font-bold">5.0</b>
                                        <div class="flex flex-row justify-center items-center">
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 text-center text-gray-text mb-10">
                                    <h3 class="text-2xl tracking-widest font-extrabold uppercase mt-5">John
                                        Smith</h3>
                                    <span class="text-gray-secondary font-medium tracking-wide">barber</span>
                                    <p class="w-4/5 mx-auto mt-5 line-clamp-4 tracking-wide">Lorem ipsum dolor sit amet,
                                        consectetur
                                        adipisicing elit. Debitis doloribus, laborum!
                                        Adipisci asperiores beatae consequuntur deleniti distinctio, dolor error labore
                                        minima mollitia necessitatibus nemo nisi nulla praesentium quaerat saepe
                                        suscipit.</p>
                                </div>
                                <div class="flex justify-end">
                                    <button
                                        class="text-gold-secondary font-semibold tracking-widest px-5 py-2 hover:text-[#C3A371] transition-all duration-200">
                                        Детальніше
                                    </button>
                                </div>
                            </div>
                        </div>
                    </swiper-slide>
                    <swiper-slide>
                        <div class="bg-gray-primary flex">
                            <div class="w-2/5 bg-gold-secondary">
                                <img src="/img/7.webp" class="h-full m-auto object-cover" alt="">
                            </div>
                            <div class="flex flex-1 flex-col">
                                <div class="flex justify-end">
                                    <div
                                        class="text-center px-4 border-2 border-gold-secondary bg-[#363434]">
                                        <b class="text-gray-text tracking-wide font-bold">5.0</b>
                                        <div class="flex flex-row justify-center items-center">
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                            <svg width="15" height="15" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.69515 0L6.81772 3.45492H10.4504L7.51151 5.59017L8.63408 9.04508L5.69515 6.90983L2.75623 9.04508L3.8788 5.59017L0.93987 3.45492H4.57258L5.69515 0Z"
                                                    fill="#E5B454"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 text-center text-gray-text mb-10">
                                    <h3 class="text-2xl tracking-widest font-extrabold uppercase mt-5">John
                                        Smith</h3>
                                    <span class="text-gray-secondary font-medium tracking-wide">barber</span>
                                    <p class="w-4/5 mx-auto mt-5 line-clamp-4 tracking-wide">Lorem ipsum dolor sit amet,
                                        consectetur
                                        adipisicing elit. Debitis doloribus, laborum!
                                        Adipisci asperiores beatae consequuntur deleniti distinctio, dolor error labore
                                        minima mollitia necessitatibus nemo nisi nulla praesentium quaerat saepe
                                        suscipit.</p>
                                </div>
                                <div class="flex justify-end">
                                    <button
                                        class="text-gold-secondary font-semibold tracking-widest px-5 py-2 hover:text-[#C3A371] transition-all duration-200">
                                        Детальніше
                                    </button>
                                </div>
                            </div>
                        </div>
                    </swiper-slide>
                </swiper>
                <div class="flex justify-end items-center gap-x-2 mt-4 px-4">
                    <div id="masters-btn-prev"
                         class="cursor-pointer hover:opacity-70 hover:-translate-x-2 duration-300 transition-all">
                        <svg
                            class="rotate-180 "
                            width="78" height="16" viewBox="0 0 78 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M77.398 8.70711C77.7885 8.31658 77.7885 7.68342 77.398 7.29289L71.034 0.928932C70.6435 0.538408 70.0103 0.538408 69.6198 0.928932C69.2293 1.31946 69.2293 1.95262 69.6198 2.34315L75.2766 8L69.6198 13.6569C69.2293 14.0474 69.2293 14.6805 69.6198 15.0711C70.0103 15.4616 70.6435 15.4616 71.034 15.0711L77.398 8.70711ZM0.763367 9H76.6908V7H0.763367V9Z"
                                fill="#9C846E"/>
                        </svg>
                    </div>
                    <div id="masters-btn-next"
                         class="cursor-pointer hover:opacity-70 hover:translate-x-2 duration-300 transition-all">
                        <svg
                            width="78"
                            height="16"
                            viewBox="0 0 78 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M77.398 8.70711C77.7885 8.31658 77.7885 7.68342 77.398 7.29289L71.034 0.928932C70.6435 0.538408 70.0103 0.538408 69.6198 0.928932C69.2293 1.31946 69.2293 1.95262 69.6198 2.34315L75.2766 8L69.6198 13.6569C69.2293 14.0474 69.2293 14.6805 69.6198 15.0711C70.0103 15.4616 70.6435 15.4616 71.034 15.0711L77.398 8.70711ZM0.763367 9H76.6908V7H0.763367V9Z"
                                fill="#9C846E"/>
                        </svg>
                    </div>
                </div>
            </section>
        </article>


        <article id="gallery">
            <header class="flex items-start gap-x-4 -translate-x-10 mt-24 pt-5">
                <span class="block w-28 border-b border-gold-primary translate-y-5"></span>
                <div class="">
                    <h2 class="uppercase text-gray-text text-4xl font-bold tracking-wide">Галерея</h2>
                    <!--                    <p class="text-gray-secondary text-bold tracking-wide">-->
                    <!--                        Відкрийте для себе асортимент послуг, які відтворять ваш стиль та-->
                    <!--                        додадуть вам впевненості</p>-->
                </div>
            </header>

            <section class="w-full my-8 h-[500px]">
                <swiper class="flex w-full h-full gap-x-2"
                        :slides-per-view="3"
                        :loop="true"
                        :centeredSlides="true"
                        :space-between="10"
                        :navigation="{
                                nextEl: '#gallery-btn-next',
                                prevEl: '#gallery-btn-prev'
                            }"
                        :modules="[Navigation, Autoplay]"
                        :autoplay="{delay:4000}"

                >
                    <swiper-slide v-for="i in 10" class="flex items-center">
                        <div
                            class="grow h-full cursor-pointer transition-all duration-200 hover:translate-x-1 hover:-translate-y-2">
                            <img v-if="i%2===0"
                                 class="select-none mx-auto object-cover h-full"
                                 src="/img/1.png" alt=""
                                 loading="lazy">
                            <img v-else class="select-none mx-auto object-cover h-full"
                                 src="/img/7.webp" alt=""
                                 loading="lazy">
                        </div>
                    </swiper-slide>
                </swiper>

                <div class="flex justify-center items-center gap-x-2 mt-4 px-4">
                    <div id="gallery-btn-prev"
                         class="cursor-pointer hover:opacity-70 hover:-translate-x-2 duration-300 transition-all">
                        <svg
                            class="rotate-180 "
                            width="78" height="16" viewBox="0 0 78 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M77.398 8.70711C77.7885 8.31658 77.7885 7.68342 77.398 7.29289L71.034 0.928932C70.6435 0.538408 70.0103 0.538408 69.6198 0.928932C69.2293 1.31946 69.2293 1.95262 69.6198 2.34315L75.2766 8L69.6198 13.6569C69.2293 14.0474 69.2293 14.6805 69.6198 15.0711C70.0103 15.4616 70.6435 15.4616 71.034 15.0711L77.398 8.70711ZM0.763367 9H76.6908V7H0.763367V9Z"
                                fill="#9C846E"/>
                        </svg>
                    </div>
                    <div id="gallery-btn-next"
                         class="cursor-pointer hover:opacity-70 hover:translate-x-2 duration-300 transition-all">
                        <svg
                            width="78"
                            height="16"
                            viewBox="0 0 78 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M77.398 8.70711C77.7885 8.31658 77.7885 7.68342 77.398 7.29289L71.034 0.928932C70.6435 0.538408 70.0103 0.538408 69.6198 0.928932C69.2293 1.31946 69.2293 1.95262 69.6198 2.34315L75.2766 8L69.6198 13.6569C69.2293 14.0474 69.2293 14.6805 69.6198 15.0711C70.0103 15.4616 70.6435 15.4616 71.034 15.0711L77.398 8.70711ZM0.763367 9H76.6908V7H0.763367V9Z"
                                fill="#9C846E"/>
                        </svg>
                    </div>

                </div>
            </section>
        </article>


        <article id="reservation" class="p-8 mt-20 relative">
            <div class="absolute right-0 top-0">
                <img src="/img/dots.svg" alt="dots" class="select-none">
            </div>
            <div class="bg-gray-primary flex">
                <img class="select-none object-contain h-full w-1/2" src="/img/7.webp" alt="reservation">
                <div class="flex flex-col">
                    <header class="flex items-start gap-x-4 -translate-x-10 mt-24 pt-5">
                        <span class="block w-28 border-b border-gold-primary translate-y-5"></span>
                        <div class="">
                            <h2 class="uppercase text-gray-text text-4xl font-bold tracking-widest">Бронювання</h2>
                            <p class="text-gray-secondary text-bold tracking-widest">
                                Саме час втілювати свої ідеї в реальність</p>
                        </div>
                    </header>
                    <div class="m-10 px-12 w-full flex flex-col items-start gap-y-4">
                        <label class="relative block cursor-pointer w-full">
                            <span class="sr-only">Master</span>
                            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                               <img src="/img/master_icon.svg" alt="master icon" class="size-10">
                            </span>
                            <input
                                class="placeholder:text-[#757575] placeholder:font-semibold placeholder:tracking-widest block bg-transparent w-full border border-[#939393] py-4 pl-16 pr-4 text-lg focus:outline-none focus:ring-offset-0 focus:ring-0"
                                placeholder="Виберіть майстра" type="text" name="search"/>
                        </label>

                        <div class="border-2 border-[#939393] p-3 flex items-center cursor-pointer w-full">
                            <img src="/img/date_icon.svg" alt="date icon" class="size-8">
                            <p class="ml-5 font-semibold text-[#757575] tracking-widest text-lg">Виберіть дату</p>
                        </div>

                        <div class="border-2 border-[#939393] p-3 flex items-center cursor-pointer w-full">
                            <img src="/img/time_icon.svg" alt="date icon" class="size-8">
                            <p class="ml-5 font-semibold text-[#757575] tracking-widest text-lg">Виберіть час</p>
                        </div>

                        <button
                            class="px-10 py-2 mt-10 uppercase tracking-wider text-gray-text font-bold text-lg bg-[#B27536]">
                            Далі
                        </button>
                    </div>
                </div>
            </div>
        </article>

        <article class="mt-10">
            <hr class="h-0.5 bg-gold-secondary border-0 rounded-full">
            <div class="w-full h-40 flex py-5 px-2 text-gray-secondary">
                <div class="basis-1/3 text-[#D09C65]">
                    <img src="/img/logo.svg" alt="logo">
                </div>
                <div class="grow mt-2">
                    <h3 class="uppercase mb-2 font-bold tracking-widest text-gray-text">Графік</h3>
                    <p class="tracking-wide">ПН-ПТ</p>
                    <p class="tracking-wide">9:00 - 19:00</p>
                </div>
                <div class="grow mt-2">
                    <h3 class="uppercase mb-2 font-bold tracking-widest text-gray-text">Адреса</h3>
                    <p class="tracking-wide">вул. Шевченка, 45, Ужгород</p>
                </div>
                <div class="grow mt-2">
                    <h3 class="uppercase mb-2 font-bold tracking-widest text-gray-text text-center">Соцмережі</h3>
                    <div class="flex gap-x-3 justify-center">
                        <a href="https://facebook.com/" target="_blank">
                            <svg class="hover:opacity-70 transition-all"
                                 width="25" height="25" viewBox="0 0 25 25" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.5 2H4.5C3.12 2 2 3.12 2 4.5V20.5C2 21.88 3.12 23 4.5 23H20.5C21.88 23 23 21.88 23 20.5V4.5C23 3.12 21.88 2 20.5 2ZM18.5 9.5H17.5C16.43 9.5 16 9.75 16 10.5V12H18.5L18 14.5H16V22H13.5V14.5H11.5V12H13.5V10.5C13.5 8.5 14.5 7 16.5 7C17.95 7 18.5 7.5 18.5 7.5V9.5Z"
                                    fill="#D29D65"/>
                            </svg>
                        </a>

                        <a href="https://www.instagram.com" target="_blank">
                            <svg class="hover:opacity-70 transition-all"
                                 width="25" height="25" viewBox="0 0 25 25" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 1.5C4.41624 1.5 1.5 4.41624 1.5 8V17C1.5 20.5838 4.41624 23.5 8 23.5H17C20.5838 23.5 23.5 20.5838 23.5 17V8C23.5 4.41624 20.5838 1.5 17 1.5H8ZM8 2.5H17C20.0432 2.5 22.5 4.95676 22.5 8V17C22.5 20.0432 20.0432 22.5 17 22.5H8C4.95676 22.5 2.5 20.0432 2.5 17V8C2.5 4.95676 4.95676 2.5 8 2.5ZM18.5 5.5C17.9477 5.5 17.5 5.94771 17.5 6.5C17.5 7.05229 17.9477 7.5 18.5 7.5C19.0523 7.5 19.5 7.05229 19.5 6.5C19.5 5.94771 19.0523 5.5 18.5 5.5ZM12.5 7C9.46836 7 7 9.46836 7 12.5C7 15.5316 9.46836 18 12.5 18C15.5316 18 18 15.5316 18 12.5C18 9.46836 15.5316 7 12.5 7ZM12.5 8C14.9912 8 17 10.0088 17 12.5C17 14.9912 14.9912 17 12.5 17C10.0088 17 8 14.9912 8 12.5C8 10.0088 10.0088 8 12.5 8Z"
                                    fill="#D29D65"/>
                            </svg>
                        </a>

                        <a href="https://twitter.com" target="_blank">
                            <svg class="hover:opacity-70 transition-all"
                                 width="25" height="25" viewBox="0 0 25 25" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_58_141)">
                                    <path
                                        d="M17.1094 2.73438C14.1191 2.73438 11.6875 5.16601 11.6875 8.15625C11.6875 8.33594 11.7324 8.51172 11.75 8.6875C8.05273 8.33398 4.7832 6.55274 2.5625 3.82812C2.45898 3.69727 2.29883 3.62695 2.13086 3.63867C1.96484 3.65039 1.8164 3.74609 1.73437 3.89062C1.26758 4.69336 0.999997 5.61719 0.999997 6.60938C0.999997 7.81054 1.42969 8.91015 2.09375 9.8125C1.96484 9.75586 1.82422 9.72461 1.70312 9.65625C1.54883 9.57422 1.36328 9.57812 1.21289 9.66797C1.0625 9.75781 0.970697 9.91993 0.968747 10.0938V10.1562C0.968747 11.998 1.92187 13.5977 3.32812 14.5781C3.3125 14.5762 3.29687 14.582 3.28125 14.5781C3.10937 14.5488 2.93554 14.6094 2.82031 14.7402C2.70508 14.8711 2.66797 15.0527 2.71875 15.2188C3.27735 16.9551 4.70313 18.2812 6.46875 18.7656C5.0625 19.6016 3.43164 20.0938 1.67188 20.0938C1.29102 20.0938 0.925782 20.0742 0.562502 20.0312C0.328127 20 0.103517 20.1367 0.0253922 20.3594C-0.0546878 20.582 0.0332072 20.8301 0.234377 20.9531C2.49024 22.4004 5.16797 23.25 8.04688 23.25C12.7129 23.25 16.3731 21.3008 18.8281 18.5156C21.2832 15.7305 22.5625 12.1133 22.5625 8.73438C22.5625 8.59179 22.5508 8.45312 22.5469 8.3125C23.4629 7.61133 24.2813 6.78906 24.9219 5.82812C25.0488 5.64258 25.0352 5.39453 24.8887 5.22265C24.7441 5.05078 24.5 4.99804 24.2969 5.09375C24.0391 5.20899 23.7383 5.22071 23.4688 5.3125C23.8242 4.83789 24.1289 4.32617 24.3125 3.75C24.375 3.55273 24.3066 3.33594 24.1445 3.20703C23.9824 3.08008 23.7559 3.06445 23.5781 3.17188C22.7246 3.67773 21.7793 4.03321 20.7813 4.25C19.8125 3.34375 18.5371 2.73438 17.1094 2.73438ZM17.1094 3.73438C18.3848 3.73438 19.5371 4.27929 20.3438 5.14062C20.4648 5.26562 20.6426 5.31836 20.8125 5.28125C21.4648 5.15234 22.084 4.96289 22.6875 4.71875C22.3398 5.1875 21.9102 5.58789 21.4062 5.89062C21.1777 6.00196 21.0703 6.26562 21.1543 6.50586C21.2363 6.74414 21.4863 6.88281 21.7344 6.82812C22.2344 6.76758 22.6797 6.56446 23.1562 6.4375C22.7285 6.90039 22.2598 7.31836 21.75 7.6875C21.6113 7.78906 21.5352 7.95312 21.5469 8.125C21.5547 8.32812 21.5625 8.52929 21.5625 8.73438C21.5625 11.8594 20.3633 15.252 18.0781 17.8438C15.793 20.4355 12.4375 22.25 8.04687 22.25C6.05273 22.25 4.16992 21.8086 2.46875 21.0312C4.57812 20.8691 6.52344 20.123 8.09375 18.8906C8.25781 18.7598 8.32226 18.541 8.25586 18.3418C8.18945 18.1426 8.00586 18.0059 7.79687 18C6.14844 17.9707 4.76758 17.0117 4.03125 15.6562C4.05859 15.6562 4.08203 15.6562 4.10937 15.6562C4.60351 15.6562 5.09179 15.5938 5.54687 15.4688C5.76562 15.4043 5.91601 15.2012 5.9082 14.9727C5.90039 14.7441 5.73828 14.5488 5.51562 14.5C3.73633 14.1406 2.40234 12.6914 2.09375 10.8906C2.59765 11.0645 3.11328 11.2012 3.67187 11.2188C3.90039 11.2324 4.10742 11.0898 4.17773 10.873C4.24805 10.6562 4.16211 10.418 3.96875 10.2969C2.78125 9.50196 2 8.14844 2 6.60938C2 6.03906 2.14844 5.51562 2.34375 5.01562C4.84375 7.75976 8.34375 9.58203 12.2969 9.78125C12.4531 9.78906 12.6055 9.72461 12.707 9.60547C12.8086 9.48437 12.8477 9.32422 12.8125 9.17188C12.7363 8.84765 12.6875 8.5039 12.6875 8.15625C12.6875 5.70703 14.6602 3.73438 17.1094 3.73438Z"
                                        fill="#D29D65"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_58_141">
                                        <rect width="25" height="25" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </article>
    </main>


    <footer class="text-center text-gray-text p-2 bg-gray-light">Copyright © {{ new Date().getFullYear() }}</footer>


</template>


<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>

