<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap mt-6 w-full items-center justify-center">
            <template v-for="(link, key) in links" :key="key">
                <div
                    v-if="link.url === null"
                    class="mr-1 mb-1 px-3 py-2 leading-4 text-sm font-bold text-gray-400 border rounded-full"
                    v-html="link.label"
                />

                <Link
                    v-else
                    class="mr-1 mb-1 px-3 py-2 text-sm font-bold text-sky-200 leading-4 border rounded-full hover:bg-gray-400 transition-all focus:border-primary focus:text-primary"
                    :class="{ 'bg-gray-500 rounded-full text-white border-sky-300': link.active }"
                    :href="link.url"
                    v-html="link.label"
                />
            </template>
        </div>
    </div>
</template>

<script setup>
import {Link} from '@inertiajs/vue3';

defineProps({
    links: {
        type: Array,
        required: true
    },
})
</script>
