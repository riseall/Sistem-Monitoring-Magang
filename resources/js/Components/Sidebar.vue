<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const showDropDown = ref(false);
const showSide = ref(true);

function toggleSidebar() {
    showSide.value = !showSide.value
}

function toggleDrop() {
    showDropDown.value = !showDropDown.value
}
</script>
<template>
    <aside class="relative flex min-h-screen font-montserrat">
        <!-- Sidebar -->
        <div class="bg-gray-900 shadow-lg text-gray-100 w-64 space-y-6 px-2 py-4 md:relative md:-translate-x-0 transform transition duration-200 ease-in-out"
            :class="{ 'relative -translate-x-0': toggleSidebar }" v-show="showSide">
            <Link href="dashboard" class="flex items-center space-x-2 px-4">
            <span class="text-xl font-extrabold text-gray-100">InternshipMonitor</span>
            </Link>
            <nav>
                <Link href="dashboard" class="nav-item group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span class="text-white group-hover:text-gray-400">Dashboard</span>
                </Link>
                <Link href="mahasiswa" class="nav-item group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                <span class="text-white group-hover:text-gray-400">Mahasiswa</span>
                </Link>
                <Link href="perusahaan" class="nav-item group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                </svg>
                <span class="text-white group-hover:text-gray-400">Perusahaan</span>
                </Link>
                <Link href="absensi" class="nav-item group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                </svg>
                <span class="text-white group-hover:text-gray-400">Absensi</span>
                </Link>
            </nav>
        </div>
        <!-- Main content -->
        <div class="flex flex-col w-full h-screen overflow-auto bg-gray-100 ">
            <!-- Header -->
            <div class="bg-white border shadow-lg px-2 py-4 sticky top-0 z-10">
                <div class="bg-white flex items-center justify-between px-5 z-10">
                    <!-- Hamburger Menu -->
                    <button @click="toggleSidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <!-- User -->
                    <div class="">
                        <div class="flex items-center space-x-4" @click="toggleDrop">
                            <img class="w-10 h-10 rounded-full border-2 border-gray-50 bg-black" src="">
                            <div class="font-semibold dark:text-white text-left">
                                <span class="inline-flex flex-col rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center border border-transparent text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                        <!-- {{ $page.props.auth.user.name }} -->

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Admin</span>
                                </span>
                            </div>
                        </div>
                        <div v-show="showDropDown"
                            class="absolute right-[10px] z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 block text-left text-sm leading-5 text-gray-700 dark:text-gray-300">
                            <Link :href="route('profile.edit')" class="drop-item" role="menuitem" tabindex="-1"
                                id="menu-item-0">
                            Profile
                            </Link>
                            <Link :href="route('logout')" method="post" as="button" class="drop-item" role="menuitem"
                                tabindex="-1" id="menu-item-0">
                            Log Out
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content -->
            <div class="p-8 min-h-[calc(100vh-(5rem-6px))] bg-gray-100 max-w-full">
                <slot />
            </div>
        </div>
    </aside>
</template>
<style>
.nav-item {
    @apply flex text-sm items-center justify-start space-x-2 py-3 px-7 hover:bg-gray-950 rounded-md hover:text-gray-400 active:bg-gray-800 focus:ring-1 focus:ring-gray-300 transition duration-200
}

.drop-item {
    @apply w-full text-left text-gray-700 block px-3 py-1 text-sm hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out
}
</style>