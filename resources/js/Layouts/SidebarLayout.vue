<script setup lang="ts">
import { ref } from 'vue';

const showDropDown = ref(false);
const showSide = ref(true);

function toggleSidebar() {
    showSide.value = !showSide.value;
}

function toggleDrop() {
    showDropDown.value = !showDropDown.value
}
</script>
<template>
    <div>
        <div class="flex flex-row bg-gray-100 min-h-screen w-screen">
            <!-- Sidebar -->
            <aside id="sidebar" class="bg-gray-900 text-white min-h-screen w-64 border-r" v-show="showSide">
                <div class="h-[50px] h bg-white flex justify-start items-center">
                    <div class="px-5">
                        <h1 class="text-lg text-center font-bold text-slate-800">InternshipMonitor</h1>
                    </div>
                </div>
                <ul class="flex flex-col gap-2 mt-2 p-4">
                    <li class="mb-1 group">
                        <a href="dashboard" class="nav-item">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="mb-1 group">
                        <a href="mahasiswa" class="nav-item">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            <span>Mahasiswa</span>
                        </a>
                    </li>
                    <li class="mb-1 group">
                        <a href="perusahaan" class="nav-item">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                            </svg>
                            <span>Perusahaan</span>
                        </a>
                    </li>
                    <li class="mb-1 group">
                        <a href="absensi" class="nav-item">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                            </svg>
                            <span>Absensi</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                            <p class="px-2">Laporan</p>
                        </li> -->
                </ul>
            </aside>
            <!-- end sidebar -->
            <aside class="w-full h-full">
                <div class="h-[50px] bg-white flex items-center justify-between px-5 w-full py-[10px] z-10 border-b">
                    <!-- Hamburger Menu -->
                    <div class="cursor-pointer w-[30px]" @click="toggleSidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <!-- User -->
                    <div class="w-44">
                        <div class="flex items-center space-x-4" @click="toggleDrop">
                            <img class="w-10 h-10 rounded-full border-2 border-gray-50 bg-black" src="">
                            <div class="font-semibold dark:text-white text-left">
                                <div>Rizal Nugroho</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Admin</div>
                            </div>
                        </div>
                        <div v-show="showDropDown"
                            class="absolute right-[10px] z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1">
                            <div class="py-1 text-left" role="none">
                                <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                                    id="menu-item-0">Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h-[calc(100vh-50px)]">
                    <slot />
                </div>
            </aside>
        </div>
    </div>
</template>

<style>
.nav-item {
    @apply flex text-gray-300 w-full text-sm py-2 px-4 hover:bg-gray-950 hover:text-gray-100 rounded-md cursor-pointer;
}
</style>