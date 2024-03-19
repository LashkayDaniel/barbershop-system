<script setup>
import {onMounted, ref} from 'vue';
import {usePage} from '@inertiajs/vue3';
import NavLink from '@/Components/dashboard/NavLink.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const showingNavigationDropdown = ref(false);
const showConfig = ref(false)

const isAdmin = usePage().props.auth.isAdmin

const isDark = ref();

function toggleDarkMode() {
    isDark.value = !isDark.value;
    localStorage.setItem("darkMode", isDark.value);
    console.log(isDark.value)
    setDarkMode(isDark.value)
}

function setDarkMode(value) {
    if (value) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
}

onMounted(() => {
    isDark.value = localStorage.getItem('darkMode') === 'true';
    setDarkMode(isDark.value)
})

</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-300 dark:bg-gray-700">

            <aside
                class="bg-white dark:bg-gray-500 dark:border-none shadow-sm -translate-x-80 fixed inset-0 z-50 my-4 ml-4 h-[calc(100vh-32px)] w-72 rounded-xl transition-transform duration-300 xl:translate-x-0 border border-blue-gray-100">
                <div class="relative"><h6
                    class="block antialiased tracking-normal flex justify-center font-sans text-base p-2 border-b border-gold-primary bg-gray-200 dark:bg-gray-800 rounded-t-lg font-semibold leading-relaxed text-blue-gray-900">
                    <img src="/img/logo.svg" alt="logo" class="size-[70px]">
                </h6>
                </div>
                <div class="m-4">
                    <ul class="mb-4 flex flex-col gap-1">
                        <li v-if="isAdmin">
                            <NavLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')">
                                <div
                                    class="align-middle select-none font-sans font-bold text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-blue-gray-500 active:bg-blue-gray-500/30 w-full flex items-center gap-4 px-4 capitalize"
                                    :class="{'bg-gradient-to-tr from-gold-secondary to-[#A28160FF] opacity-85 dark:from-gray-900 dark:to-gray-700 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 active:opacity-[0.85]':$page.url.startsWith('/a/dashboard')}"
                                    style="position: relative; overflow: hidden;">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         aria-hidden="true" class="w-5 h-5 text-inherit">
                                        <path
                                            d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z"></path>
                                        <path
                                            d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z"></path>
                                    </svg>
                                    <p class="antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                                        Dashboard</p>
                                </div>
                            </NavLink>
                        </li>
                        <li v-else>
                            <NavLink :href="route('employee.dashboard')"
                                     :active="route().current('employee.dashboard')">
                                <div
                                    class="align-middle select-none font-sans font-bold text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-blue-gray-500 active:bg-blue-gray-500/30 w-full flex items-center gap-4 px-4 capitalize"
                                    :class="{'bg-gradient-to-tr from-gold-secondary to-[#A28160FF] opacity-85 dark:from-gray-900 dark:to-gray-700 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 active:opacity-[0.85]':$page.url.startsWith('/e/dashboard')}"
                                    style="position: relative; overflow: hidden;">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         aria-hidden="true" class="w-5 h-5 text-inherit">
                                        <path
                                            d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z"></path>
                                        <path
                                            d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z"></path>
                                    </svg>
                                    <p class="antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                                        Dashboard</p>
                                </div>
                            </NavLink>
                        </li>

                        <li v-if="isAdmin">
                            <NavLink :href="route('landing.index')" :active="route().current('landing.index')">
                                <div
                                    class="align-middle select-none font-sans font-bold text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-blue-gray-500 active:bg-blue-gray-500/30 w-full flex items-center gap-4 px-4 capitalize"
                                    :class="{'bg-gradient-to-tr from-gold-secondary to-[#A28160FF] opacity-85 dark:from-gray-900 dark:to-gray-700 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 active:opacity-[0.85]':route().current('landing.index')}"
                                    style="position: relative; overflow: hidden;">

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605"/>
                                    </svg>

                                    <p class="antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                                        Landing</p>
                                </div>
                            </NavLink>
                        </li>
                        <li v-if="!isAdmin">
                            <NavLink :href="route('services.index')" :active="route().current('services.index')">
                                <div
                                    class="align-middle select-none font-sans font-bold text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-blue-gray-500 active:bg-blue-gray-500/30 w-full flex items-center gap-4 px-4 capitalize"
                                    :class="{'bg-gradient-to-tr from-gold-secondary to-[#A28160FF] opacity-85 dark:from-gray-900 dark:to-gray-700 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 active:opacity-[0.85]':route().current('services.index')}"
                                    style="position: relative; overflow: hidden;">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                              d="M2.625 6.75a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0A.75.75 0 0 1 8.25 6h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75ZM2.625 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0ZM7.5 12a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12A.75.75 0 0 1 7.5 12Zm-4.875 5.25a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75Z"
                                              clip-rule="evenodd"/>
                                    </svg>

                                    <p class="antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                                        Services</p>
                                </div>
                            </NavLink>
                        </li>
                        <li v-else>
                            <NavLink :href="route('admin.services.index')"
                                     :active="route().current('admin.services.index')">
                                <div
                                    class="align-middle select-none font-sans font-bold text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-blue-gray-500 active:bg-blue-gray-500/30 w-full flex items-center gap-4 px-4 capitalize"
                                    :class="{'bg-gradient-to-tr from-gold-secondary to-[#A28160FF] opacity-85 dark:from-gray-900 dark:to-gray-700 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 active:opacity-[0.85]':route().current('admin.services.index')}"
                                    style="position: relative; overflow: hidden;">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                              d="M2.625 6.75a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0A.75.75 0 0 1 8.25 6h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75ZM2.625 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0ZM7.5 12a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12A.75.75 0 0 1 7.5 12Zm-4.875 5.25a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75Z"
                                              clip-rule="evenodd"/>
                                    </svg>

                                    <p class="antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                                        admin Services</p>
                                </div>
                            </NavLink>
                        </li>
                    </ul>
                </div>
            </aside>

            <div class="p-4 xl:ml-80">
                <nav
                    class="block w-full max-w-full bg-transparent text-white shadow-none rounded-xl transition-all px-0 py-1">
                    <div class="flex flex-col-reverse justify-between gap-6 md:flex-row md:items-center">
                        <div class="capitalize">
                            <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-gray-700 dark:text-gray-400 text-xl leading-tight">
                                <slot name="header"/>
                            </h6>
                        </div>
                        <div class="inline-flex items-center">
                            <div class="relative inline-block w-8 h-4 cursor-pointer rounded-full bg-gray-500">
                                <input id="navbar-fixed"
                                       @click="toggleDarkMode"
                                       :checked="isDark"
                                       type="checkbox"
                                       class="peer sr-only"
                                       value="false">
                                <label for="navbar-fixed"
                                       class="bg-white w-5 h-5 border border-blue-gray-100 rounded-full shadow-md absolute top-2/4 -left-1 -translate-y-2/4 peer-checked:translate-x-full transition-all duration-300 cursor-pointer before:content[''] before:block before:bg-blue-gray-500 before:w-10 before:h-10 before:rounded-full before:absolute before:top-2/4 before:left-2/4 before:-translate-y-2/4 before:-translate-x-2/4 before:transition-opacity before:opacity-0 hover:before:opacity-10 peer-checked:border-gray-900 peer-checked:before:bg-gray-900">
                                    <div
                                        class="inline-block top-2/4 left-2/4 -translate-x-2/4 -translate-y-2/4 p-5 rounded-full"></div>
                                </label>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <!-- Settings Dropdown -->
                                <div class="ms-3 relative">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                                >
                                                    {{ $page.props.auth.user.name }}
                                                    <svg
                                                        class="ms-2 -me-0.5 h-4 w-4"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"
                                                        />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <DropdownLink :href="route('profile.edit')"> Profile</DropdownLink>
                                            <DropdownLink :href="route('logout')" method="post" as="button">
                                                Log Out
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <aside
                    :class="[{'translate-x-0':showConfig},{'translate-x-96':!showConfig}]"
                    class="fixed top-0 right-0 z-50 h-screen w-96 bg-white px-2.5 shadow-lg transition-transform duration-300">
                    <div class="flex items-start justify-between px-6 pt-8 pb-6">
                        <div><h5
                            class="block antialiased tracking-normal font-sans text-xl font-semibold leading-snug text-blue-gray-900">
                            Dashboard Configurator</h5></div>
                        <button
                            @click="showConfig=false"
                            class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30"
                            type="button"><span
                            class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2"><svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                            stroke="currentColor" aria-hidden="true" class="h-5 w-5"><path stroke-linecap="round"
                                                                                           stroke-linejoin="round"
                                                                                           d="M6 18L18 6M6 6l12 12"></path></svg></span>
                        </button>
                    </div>
                </aside>
                <button
                    @click="showConfig=!showConfig"
                    class="align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-12 max-w-[48px] h-12 max-h-[48px] text-sm bg-white text-blue-gray-900 shadow-md hover:shadow-lg hover:shadow-blue-gray-500/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none fixed bottom-8 right-8 z-40 rounded-full shadow-blue-gray-900/10"
                    type="button"><span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2"><svg
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                    class="h-5 w-5"><path fill-rule="evenodd"
                                          d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 00-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 00-2.282.819l-.922 1.597a1.875 1.875 0 00.432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 000 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 00-.432 2.385l.922 1.597a1.875 1.875 0 002.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 002.28-.819l.923-1.597a1.875 1.875 0 00-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 000-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 00-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 00-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 00-1.85-1.567h-1.843zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z"
                                          clip-rule="evenodd"></path></svg></span></button>

                <main>
                    <slot></slot>
                </main>
            </div>

        </div>
    </div>
</template>
