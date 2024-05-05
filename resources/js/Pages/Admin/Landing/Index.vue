<template>
    <Head title="Landing config"/>

    <AuthenticatedLayout>
        <template #header>
            Landing
        </template>

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
                               placeholder="Input address"
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
            <Gallery ref="gallery"
                     :gallery-images="galleryImages"
                     @upload-gallery-image="uploadGalleryImage"
                     @delete-image="deleteImage"/>
        </div>
    </AuthenticatedLayout>

</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Gallery from '@/Components/other/Gallery.vue';
import {Head, router, useForm, usePage} from '@inertiajs/vue3';
import {computed, reactive, ref, watch} from "vue";

const props = defineProps({
    pageData: {
        type: Object,
        required: true,
        default: {}
    },
})

const galleryImages = computed(() => {
    const gallery = props.pageData?.gallery;
    if (!gallery) {
        return []
    }
    return JSON.parse(props.pageData?.gallery)
})

const parseSocials = computed(() => {
    const socials = props.pageData?.socials;
    if (!socials) {
        return []
    }
    return props.pageData?.socials.split('|').map(i => i.trim())
})

const [instagram, facebook, twitter] = parseSocials.value;

const gallery = ref(null)


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

function uploadGalleryImage(imageSrc) {
    router.post(route('landing.imageUpload'), {image: imageSrc}, {
        onSuccess: () => {
            gallery.value.clearFileImageInput();
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
