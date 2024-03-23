<template>
    <Head title="Landing config"/>

    <AuthenticatedLayout>
        <template #header>
            Landing
        </template>

        <ImageViewer
            :src="imageView.src"
            :show="imageView.show"
            @close="imageView.show = !imageView.show">
        </ImageViewer>

        <div class="w-full">
            <p v-if="$page.props.flash.type === 'success' && $page.props.flash.message"
               class="w-full text-center text-green-600 bg-green-300 font-medium p-2 my-4">
                {{ $page.props.flash.message }}
            </p>

            <p v-if="$page.props.flash.type === 'error' && $page.props.flash.message"
               class="w-full text-center text-red-600 bg-red-300 font-medium p-2 my-4">
                {{ $page.props.flash.message }}
            </p>

            <p v-if="form.hasErrors"
               class="w-full text-center text-red-600 bg-red-300 font-medium p-2 my-4">
                {{ form.errors.logo }}
                {{ form.errors.address }}
                {{ form.errors.schedule }}
                {{ form.errors.socials }}
            </p>

            <PrimaryButton v-if="form.isDirty"
                           @click="savePageInfo()"
                           class="my-2 px-6 py-2 transition-all">Save
            </PrimaryButton>

            <div class="w-full flex gap-x-2">
                <div class="flex-1 border border-gray-500 rounded-lg p-2">
                    <h3 class="uppercase font-bold text-gray-400 text-center tracking-wide border-b border-gray-600 mb-2">
                        Logo
                    </h3>
                    <textarea
                        v-model="form.svgIcon"
                        class="w-full opacity-85 rounded-lg resize-none"
                        placeholder="Input svg icon"></textarea>

                    <div class="p-2">
                        <span v-html="form.svgIcon"/>
                    </div>

                </div>
                <div class="border border-gray-500 rounded-lg p-2">
                    <h3 class="uppercase font-bold text-gray-400 text-center tracking-wide border-b border-gray-600 mb-2">
                        Address</h3>
                    <TextInput v-model="form.address"
                               class="w-full"/>


                </div>
                <div class="border border-gray-500 rounded-lg p-2">
                    <h3 class="uppercase font-bold text-gray-400 text-center tracking-wide border-b border-gray-600 mb-2">
                        Schedule</h3>
                    <TextInput v-model="form.schedule"
                               placeholder="Input schedule"
                               class="w-full"/>
                </div>
                <div class="flex-1 border border-gray-500 rounded-lg p-2">
                    <h3 class="uppercase font-bold text-gray-400 text-center tracking-wide border-b border-gray-600 mb-2">
                        Socials</h3>
                    <TextInput v-model="form.socials.instagram"
                               placeholder="Instagram"
                               class="w-full"/>
                    <TextInput v-model="form.socials.facebook"
                               placeholder="Facebook"
                               class="w-full my-2"/>
                    <TextInput v-model="form.socials.twitter"
                               placeholder="Twitter"
                               class="w-full"/>
                </div>
            </div>
            <div class="border border-gray-500 rounded-lg mt-4">
                <div class="flex justify-between items-center border-b p-2 border-gray-600">
                    <div class="flex items-center">
                        <h2 class="uppercase font-bold text-gray-300 text-xl p-2 tracking-wide">
                            Gallery</h2>


                    </div>
                    <div class="flex gap-x-2 pr-4">
                        <span id="pagination"></span>
                        <button id="gallery-btn-prev" title="previous">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor"
                                 class="size-6 transition-all duration-200 text-sky-200 hover:text-sky-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5"/>
                            </svg>
                        </button>
                        <button id="gallery-btn-next" title="next">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor"
                                 class="size-6 transition-all duration-200 text-sky-200 hover:text-sky-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="h-[300px] p-2 mt-4 border-b border-gray-600">
                    <swiper class="flex w-full h-full gap-x-2"
                            :slides-per-view="5"
                            :slides-per-group="5"
                            :space-between="3"
                            :navigation="{
                                nextEl: '#gallery-btn-next',
                                prevEl: '#gallery-btn-prev'
                            }"
                            :modules="[Navigation, Autoplay,Pagination]"
                            :pagination="{
                                el: '#pagination',
                                type: 'fraction',
                                }"
                    >
                        <swiper-slide v-for="(image,index) in galleryImages"
                                      :key="index"
                                      class="flex items-center">
                            <div @click="showImage(image)"
                                 class="group grow border h-full cursor-pointer transition-all duration-200 z-10">
                                <img class="relative select-none mx-auto object-cover h-full"
                                     :src="image" :alt="'gallery image '+index"
                                     loading="lazy">
                                <button @click.stop="deleteImage(image)"
                                        title="delete image"
                                        class="z-20 md:hidden block group-hover:block absolute top-0 right-0 bg-red-400 px-2 rounded-bl-lg hover:bg-red-500">
                                    Delete
                                </button>
                            </div>
                        </swiper-slide>
                    </swiper>
                </div>
                <div class="w-full items-center flex p-4">
                    <label class="block ml-4">
                        <span class="sr-only">Upload new</span>
                        <input type="file"
                               ref="fileImageInput"
                               @input="handleImageUpload"
                               accept=".png, .jpeg"
                               class="block w-full text-sm text-slate-500 transition-all duration-300 cursor-pointer
                                   file:mr-4 file:py-2 file:px-4
                                   file:rounded-full file:border-0
                                   file:text-sm file:font-semibold
                                   file:bg-sky-300 file:text-sky-700
                                   hover:file:bg-sky-400"/>
                    </label>
                    <button v-if="uploadImgForm.uploadedImgUrl"
                            @click="clearFileImageInput">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor"
                             class="w-6 h-6 ml-2 text-red-400 hover:text-red-500 transition-all duration-200">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <span v-if="chooseImageError" class="text-red-500 text-sm">
                        {{ chooseImageError }}
                    </span>
                </div>

                <div class="p-2 max-w-[400px]" v-if="uploadImgForm.uploadedImgUrl">
                    <h3 class="text-gray-300">Preview:</h3>
                    <img :src="uploadImgForm.uploadedImgUrl" alt="img">
                    <p v-if="uploadImgForm.errors" class="text-red-500 text-sm">
                        {{ uploadImgForm.errors.image }}
                    </p>
                    <button @click="uploadGalleryImage"
                            class="bg-sky-500 font-bold px-4 py-1 text-sky-200 mt-2 rounded-full tracking-wide hover:bg-sky-600 transition-all duration-200">
                        Add image
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {Swiper, SwiperSlide} from 'swiper/vue';
import {Autoplay, Navigation, Pagination} from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import ImageViewer from '@/Components/other/ImageViewer.vue'
import {Head, router, useForm, usePage} from '@inertiajs/vue3';
import {computed, reactive, ref, watch} from "vue";

const props = defineProps({
    pageData: {
        type: Object,
        required: true,
        default: {}
    },
})
const imageView = reactive({
    show: ref(false),
    src: ref('')
})

const galleryImages = computed(() => {
    return JSON.parse(props.pageData?.gallery)
})

const parseSocials = computed(() => {
    return props.pageData?.socials.split('|').map(i => i.trim())
})

const [instagram, facebook, twitter] = parseSocials.value;

const form = useForm({
    svgIcon: props.pageData?.logo,
    address: props.pageData?.address,
    schedule: props.pageData?.schedule,
    socials: reactive({
        instagram,
        facebook,
        twitter
    })
});

const uploadImgForm = useForm({
    uploadedImgUrl: '',
    uploadedImgSrc: ''
})
const fileImageInput = ref(null);
const chooseImageError = ref('');

watch(
    () => usePage().props.flash.message,
    (value) => {
        if (value) {
            setTimeout(() => {
                usePage().props.flash.message = ''
            }, 2000)
        }
    }
)

function savePageInfo() {
    form.transform((data) => ({
        logo: data.svgIcon,
        address: data.address,
        schedule: data.schedule,
        socials: Object.values(form.socials).join(' | ')
    }))
        .patch(route('landing.update'))
}

const showImage = (src) => {
    imageView.show = true
    imageView.src = src
}

function handleImageUpload(event) {
    const file = event.target.files[0];
    const imageExtensions = ['png', 'jpeg', 'jpg']
    chooseImageError.value = ''

    if (file) {
        const fileName = file.name.toLowerCase();
        if (imageExtensions.some(ext => fileName.endsWith(ext))) {
            uploadImgForm.uploadedImgUrl = URL.createObjectURL(file);
            uploadImgForm.uploadedImgSrc = file;
        } else {
            event.target.value = null;
            chooseImageError.value = 'Choose correct format (.png, .jpeg, .jpg)'
        }
    }
}

function clearFileImageInput() {
    fileImageInput.value.value = ''
    uploadImgForm.uploadedImgUrl = ''
    uploadImgForm.uploadedImgSrc = ''
}

function uploadGalleryImage() {
    uploadImgForm
        .transform((data) => ({
            image: data.uploadedImgSrc
        }))
        .post(route('landing.imageUpload'), {
            onSuccess: () => {
                clearFileImageInput()
            }
        })
}

function deleteImage(imagePath) {
    const imageName = imagePath.trim().split('/').reverse()[0]
    if (confirm(`You really want delete image: ${imageName}`)) {
        router.delete(route('landing.imageDelete', {image_name: imageName}))
    }
}

</script>
