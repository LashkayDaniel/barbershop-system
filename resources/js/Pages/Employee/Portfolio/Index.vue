<template>
    <Head title="Portfolio"/>

    <AuthenticatedLayout>
        <template #header>
            Портфоліо
        </template>
        <FadeInAnimation>
            <p v-if="$page.props.flash.type === 'success' && $page.props.flash.message"
               class="w-full text-center text-green-600 bg-green-300 font-medium p-2 my-4">
                {{ $page.props.flash.message }}
            </p>

            <p v-if="$page.props.flash.type === 'error' && $page.props.flash.message"
               class="w-full text-center text-red-600 bg-red-300 font-medium p-2 my-4">
                {{ $page.props.flash.message }}
            </p>
        </FadeInAnimation>
        <article class="flex flex-col gap-y-8">
            <div class="flex gap-x-5">
                <div
                    class="border border-gray-300 dark:border-gray-500 max-w-[300px] rounded-lg mt-4 bg-gray-100 dark:bg-inherit">
                    <div class="border-b p-2 border-gray-300 dark:border-gray-500 flex items-center justify-between">
                        <h2 class="uppercase font-bold text-gold-secondary dark:text-gray-300 text-xl p-2 tracking-wide">
                            Avatar
                        </h2>
                        <fade-in-animation>
                            <button v-if="uploadAvatarForm.url"
                                    @click="uploadAvatar"
                                    class="bg-sky-500 font-bold px-4 py-1 text-sky-200 rounded-full tracking-wide hover:bg-sky-600 transition-all duration-200">
                                Зберегти
                            </button>
                        </fade-in-animation>
                    </div>

                    <div class="group grow h-72 my-2 mx-4 transition-all duration-200">
                        <img v-if="uploadAvatarForm.url"
                             :src="uploadAvatarForm.url" class="mx-auto max-w-full max-h-full bg-contain" alt="avatar"
                             loading="lazy">

                        <img v-else-if="avatar!==null"
                             :src="avatar" class="mx-auto max-w-full max-h-full bg-contain" alt="avatar"
                             loading="lazy">

                        <div v-else
                             class="relative w-full h-full bg-slate-200 opacity-25 z-50">
                            <div class="absolute top-1/3 left-1/2 -translate-x-[50%]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="size-10 mx-auto">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m15 11.25-3-3m0 0-3 3m3-3v7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="text-xl opacity-50">Upload avatar</h3>
                            </div>
                        </div>
                    </div>
                    <div class="w-full items-center flex p-2">
                        <label class="block ml-4">
                            <span class="sr-only">Upload new</span>
                            <input type="file"
                                   ref="fileAvatarInput"
                                   @input="handleAvatarUpload"
                                   accept=".png, .jpeg, .jpg"
                                   class="block w-full text-sm text-slate-500 transition-all duration-300 cursor-pointer
                                   file:mr-4 file:py-2 file:px-4
                                   file:rounded-full file:border-0
                                   file:text-sm file:font-semibold
                                   file:bg-sky-300 file:text-sky-700
                                   hover:file:bg-sky-400"/>
                        </label>
                        <button v-if="uploadAvatarForm.url"
                                @click="clearFileAvatarInput">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor"
                                 class="w-6 h-6 ml-2 text-red-400 hover:text-red-500 transition-all duration-200">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div class="px-2">
                        <p v-if="chooseAvatarError" class="text-red-500 text-sm">
                            {{ chooseAvatarError }}
                        </p>
                        <p v-if="uploadAvatarForm.errors" class="text-red-500 text-sm">
                            {{ uploadAvatarForm.errors.avatar }}
                        </p>
                    </div>
                </div>

                <div
                    class="grow border border-gray-300 dark:border-gray-500 rounded-lg mt-4 flex flex-col bg-gray-100 dark:bg-inherit">
                    <div class="border-b p-2 border-gray-300 dark:border-gray-500 flex items-center justify-between">
                        <h2 class="uppercase font-bold text-gold-secondary dark:text-gray-300 w-full text-center text-xl p-2 tracking-wide">
                            Про вас
                        </h2>
                        <fade-in-animation>
                            <button v-if="descriptionForm.isDirty"
                                    @click="saveDescription"
                                    class="bg-sky-500 font-bold px-4 py-1 text-sky-200 rounded-full tracking-wide hover:bg-sky-600 transition-all duration-200">
                                Зберегти
                            </button>
                        </fade-in-animation>
                    </div>
                    <div class="p-3 h-full flex flex-col">
                        <textarea
                            v-model="descriptionForm.text"
                            class="resize-none rounded-lg text-gray-400 focus:border-sky-400 opacity-45 focus:opacity-100 w-full transition-all duration-200 h-full">
                        </textarea>
                        <p class="w-full text-red-500 text-sm px-2">{{ descriptionForm.errors.text }}</p>
                    </div>
                </div>
            </div>

            <div class="flex-1">
                <Gallery ref="gallery"
                         :gallery-images="galleryImages"
                         title="Роботи"
                         @upload-gallery-image="uploadGalleryImage"
                         @delete-image="deleteImage"/>
            </div>
        </article>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Gallery from '@/Components/other/Gallery.vue';
import FadeInAnimation from '@/Components/animations/FadeIn.vue';
import {Head, router, useForm, usePage} from '@inertiajs/vue3';
import {ref, watch} from "vue";

const props = defineProps({
    galleryImages: {
        required: true
    },
    avatar: {
        required: true,
        default: null
    },
    description: {
        type: String,
        required: true,
        default: ''
    }
})

const descriptionForm = useForm({
    text: props.description
})

function saveDescription() {
    descriptionForm.post(route('portfolio.description'))
}

//
const uploadAvatarForm = useForm({
    url: '',
    src: ''
})
const fileAvatarInput = ref(null);
const chooseAvatarError = ref('');

function handleAvatarUpload(event) {
    const file = event.target.files[0];
    const imageExtensions = ['png', 'jpeg', 'jpg']
    chooseAvatarError.value = ''

    if (file) {
        const fileName = file.name.toLowerCase();
        if (imageExtensions.some(ext => fileName.endsWith(ext))) {
            uploadAvatarForm.url = URL.createObjectURL(file);
            uploadAvatarForm.src = file;
        } else {
            event.target.value = null;
            chooseAvatarError.value = 'Виберіть правильний формат (.png, .jpeg, .jpg)'
        }
    }
}

function clearFileAvatarInput() {
    fileAvatarInput.value.value = ''
    uploadAvatarForm.url = ''
    uploadAvatarForm.src = ''
}

function uploadAvatar() {
    router.post(route('portfolio.avatar'), {avatar: uploadAvatarForm.src}, {
        onSuccess: () => {
            clearFileAvatarInput()
        }
    })
}

//
const gallery = ref(null)
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

function uploadGalleryImage(imageSrc) {
    router.post(route('portfolio.create'), {image: imageSrc}, {
        onSuccess: () => {
            gallery.value.clearFileImageInput();
        }
    })
}

function deleteImage(image) {
    if (confirm('Ви впевнені, що бажаєте видалити зображення?')) {
        router.delete(route('portfolio.delete', image.id))
    }
}

</script>
