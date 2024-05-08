<template>
    <ImageViewer
        :src="imageView.src"
        :show="imageView.show"
        @close="imageView.show = !imageView.show">
    </ImageViewer>

    <div class="border border-gray-300 dark:border-gray-500 rounded-lg mt-4 bg-gray-100 dark:bg-inherit">
        <div class="flex justify-between items-center border-b p-2 border-gray-300 dark:border-gray-500">
            <div class="flex items-center">
                <h2 class="uppercase font-bold text-gold-secondary dark:text-gray-300 text-xl p-2 tracking-wide">
                    {{ title }}
                </h2>
            </div>
            <div class="flex gap-x-2 pr-4">
                <span id="pagination"></span>
                <button id="gallery-btn-prev" title="previous">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor"
                         class="size-6 transition-all duration-200 text-gold-secondary dark:text-sky-200 hover:text-gold-primary dark:hover:text-sky-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5"/>
                    </svg>
                </button>
                <button id="gallery-btn-next" title="next">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor"
                         class="size-6 transition-all duration-200 text-gold-secondary dark:text-sky-200 hover:text-gold-primary dark:hover:text-sky-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5"/>
                    </svg>
                </button>
            </div>
        </div>
        <div v-if="galleryImages.length>0"
             class="h-[300px] p-2 mt-4 border-b border-gray-300 dark:border-gray-500">
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
                             :src="image?.url || image" :alt="'gallery image '+index"
                             loading="lazy">
                        <button @click.stop="deleteImage(image)"
                                title="delete image"
                                class="z-20 md:hidden block group-hover:block absolute top-0 right-0 bg-red-400 px-2 rounded-bl-lg hover:bg-red-500">
                            Видалити
                        </button>
                    </div>
                </swiper-slide>
            </swiper>
        </div>
        <p v-else class="text-sm text-gray-400 p-2">Empty gallery list. Add new images...</p>
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
            <h3 class="text-gold-secondary dark:text-gray-300">Preview:</h3>
            <img :src="uploadImgForm.uploadedImgUrl" alt="img">
            <p v-if="uploadImgForm.errors" class="text-red-500 text-sm">
                {{ uploadImgForm.errors.image }}
            </p>
            <button @click="uploadGalleryImage"
                    class="bg-sky-500 font-bold px-4 py-1 text-sky-200 mt-2 rounded-full tracking-wide hover:bg-sky-600 transition-all duration-200">
                Додати
            </button>
        </div>
    </div>
</template>

<script setup>
import {Swiper, SwiperSlide} from 'swiper/vue';
import {Autoplay, Navigation, Pagination} from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import ImageViewer from '@/Components/other/ImageViewer.vue'
import {reactive, ref} from "vue";
import {useForm} from "@inertiajs/vue3";


const props = defineProps({
    galleryImages: {
        required: true
    },
    title: {
        type: String,
        default: 'Gallery'
    }
})

const emit = defineEmits(['uploadGalleryImage', 'deleteImage'])
defineExpose({
    clearFileImageInput
})

const imageView = reactive({
    show: ref(false),
    src: ref('')
})

const uploadImgForm = useForm({
    uploadedImgUrl: '',
    uploadedImgSrc: ''
})
const fileImageInput = ref(null);
const chooseImageError = ref('');

const showImage = (image) => {
    imageView.show = true
    imageView.src = image.url !== undefined ? image.url : image
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
    emit('uploadGalleryImage', uploadImgForm.uploadedImgSrc)
}

function deleteImage(image) {
    emit('deleteImage', image)
}

</script>
