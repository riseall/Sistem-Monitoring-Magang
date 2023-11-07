<script setup lang="ts">
import NavbarBottom from '@/Components/User/NavbarBottom.vue';
import axios from 'axios';
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';

const absenMasuk = ref();
axios.get('api/absenMasuk')
    .then(result => {
        console.log(result)
        absenMasuk.value = result.data.data
    })

const absenKeluar = ref();
axios.get('api/absenKeluar')
    .then(result => {
        console.log(result)
        absenKeluar.value = result.data.data
    })
</script>
<template>
    <NavbarBottom>

        <Head title="History" />

        <header class="h-14 flex items-end justify-center p-2 bg-white shadow-lg sticky top-0 z-10">
            <h1 class="font-semibold">Riwayat Absensi</h1>
        </header>

        <main class="m-4">
            <div class="grid gap-5 relative lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1">
                <div v-for="Item in absenMasuk" class="bg-white rounded-md shadow-lg p-4  border border-gray-300">
                    <div class="flex py-2 items-center">
                        <div class="p-2 rounded-full mr-5 bg-amber-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-8 h-8 text-amber-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                        </div>
                        <div class="text-sm">
                            <h1 class="font-semibold">{{ Item.hari }}</h1>
                            <span class="text-xs">{{ Item.tanggal }}</span>
                        </div>
                    </div>
                    <hr class="border my-2">
                    <div class="flex items-center justify-between p-2 pb-0">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                                stroke="currentColor" class="w-5 h-5 text-green-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                            <span class="text-sm ml-2">{{ Item.waktu }}</span>
                        </div>
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                                stroke="currentColor" class="w-5 h-5 text-rose-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                            <span class="text-sm ml-2"></span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </NavbarBottom>
</template>