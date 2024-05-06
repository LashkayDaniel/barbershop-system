<template>
    <Head title="Services"/>

    <AuthenticatedLayout>
        <template #header>
            Services
        </template>

        <Modal
            v-model:show="modal.show"
            :maxWidth="'sm'"
            @close="modal.show = false"
            :bg-light="true"
        >
            <Add v-if="modal.hasCreate" :services="unusedServices"/>
            <Edit v-if="modal.hasEdit" :service="editableService"/>
        </Modal>

        <div class="max-w-xl mx-auto">

            <section class="my-2 border border-gray-500 rounded-lg">
                <div class="flex justify-between p-4 border-b border-gray-500 items-center">
                    <h2 class=" font-bold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-sky-400">
                        My services</h2>
                    <button
                        class="text-sky-200 font-bold bg-sky-500 p-2 px-4 rounded-full hover:bg-sky-600 transition-all"
                        type="button"
                        @click="showModal('create')">
                        + Add new
                    </button>
                </div>

                <ul class="gap-x-2 mt-2 divide-y divide-gray-600">
                    <li v-if="employeeServices.length===0"
                        class="w-full text-center py-2">
                        <span class="text-center text-sm tracking-wide dark:text-gray-400">Empty list</span>
                    </li>
                    <li v-else
                        class="px-4 py-2 flex text-gray-400 justify-between"
                        v-for="service in employeeServices">
                        <div class="flex items-center">
                            <h3 class="font-bold tracking-wide text-gray-300">
                                {{ service.name }}
                            </h3>
                            <span class="block size-1 rounded-full bg-gray-400 mx-2"></span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-4 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            {{ service?.pivot.duration }} хв
                            <span class="block size-1 rounded-full bg-gray-400 mx-2"></span>
                            {{ service?.pivot.price }}$
                        </div>
                        <div class="flex gap-x-2">
                            <button type="button"
                                    @click="updateService(service)"
                                    class="hover:opacity-50 transition-all">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                </svg>
                            </button>
                            <button type="button"
                                    @click="deleteService(service)"
                                    class="hover:opacity-50 hover:text-red-400 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                </svg>
                            </button>
                        </div>
                    </li>
                </ul>
            </section>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, router} from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue'
import Add from '@/Pages/Service/Partials/Add.vue'
import Edit from '@/Pages/Service/Partials/Edit.vue'
import {computed, onMounted, reactive, ref} from "vue";

const props = defineProps({
    allServices: {
        type: Array,
        required: true
    },
    employeeServices: {
        type: Array,
        required: true
    },
    statistics: {
        type: Object,
        required: true
    }
})

const unusedServices = computed(() => {
    return props.allServices.filter(service => !props.employeeServices.some(item => item.id === service.id))
})


const modal = reactive({
    show: ref(false),
    hasEdit: ref(false),
    hasCreate: ref(false)
})

let editableService = reactive({})

function showModal(action) {
    modal.show = true
    modal.hasCreate = action === 'create';
    modal.hasEdit = action === 'edit';
}

function updateService(service) {
    showModal('edit');
    editableService = service
}

function deleteService(service) {
    if (confirm('You really want to delete service: ' + service.name)) {
        router.delete(route('services.delete', service.id))
    }
}
</script>
