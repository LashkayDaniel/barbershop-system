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
            <Create v-if="modal.hasCreate" :services="allServices"/>
            <Edit v-if="modal.hasEdit" :service="editableService"/>
        </Modal>

        <div class="max-w-xl mx-auto">

            <section class="my-2 border border-gray-500 rounded-lg">
                <div class="flex justify-between p-4 border-b border-gray-500 items-center">
                    <h2 class=" font-bold text-2xl tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-sky-400">
                        Available services</h2>
                    <button
                        class="text-sky-200 font-bold bg-sky-500 p-2 px-4 rounded-full hover:bg-sky-600 transition-all"
                        type="button"
                        @click="showModal('create')">
                        + Create new
                    </button>
                </div>

                <ul class="gap-x-2 mt-2 divide-y divide-gray-600">
                    <li v-if="allServices.length===0"
                        class="w-full text-center py-2">
                        <span class="text-center text-sm tracking-wide dark:text-gray-400">Empty list</span>
                    </li>
                    <li v-else
                        class="px-4 py-2 flex text-gray-400 justify-between"
                        v-for="service in allServices">
                        <div :class="{'opacity-35':!service.is_available}">
                            <h3 class="font-bold text-gray-300">{{ service.name }}
                                <span v-show="!service.is_available"
                                      class="font-normal text-sm text-yellow-500">(Disabled)</span>
                            </h3>
                            <p class="text-sm">{{ service.description }}</p>
                        </div>
                        <div class="flex gap-x-2">
                            <button type="button" :title="service.is_available ? 'Приховати' : 'Зробити доступним'"
                                    @click="changeServiceAvailable(service)"
                                    class="hover:opacity-50 transition-all">
                                <svg v-if="!service.is_available"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>

                                <svg v-else
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/>
                                </svg>
                            </button>
                            <button type="button"
                                    title="Змінити"
                                    @click="updateService(service)"
                                    class="hover:opacity-50 transition-all">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                </svg>
                            </button>
                            <button type="button"
                                    title="Видалити"
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
import Create from '@/Pages/Admin/Service/Partials/Create.vue'
import Edit from '@/Pages/Admin/Service/Partials/Edit.vue'
import {reactive, ref} from "vue";

defineProps({
    allServices: {
        type: Array,
        required: true
    },
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

function changeServiceAvailable(service) {
    console.log(service.id)
    router.patch(route('admin.services.changeAvailable', service.id))
}

function deleteService(service) {
    if (confirm('You really want to delete service: ' + service.name)) {
        router.delete(route('admin.services.delete', service.id))
    }
}
</script>
