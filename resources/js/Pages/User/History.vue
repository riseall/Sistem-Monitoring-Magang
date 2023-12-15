<script setup lang="ts">
import NavbarBottom from '@/Components/User/NavbarBottom.vue';
import axios from 'axios';
import { onMounted, ref, } from 'vue';
import { Head } from '@inertiajs/vue3';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

const absenMasuk = ref();
const getMsk = (() => {
    axios.get(`api/masukk`)
        .then(result => {
            console.log(result)
            absenMasuk.value = result.data.data
        })
})


const absenKeluar = ref();
const getKlr = (() => {
    axios.get('api/keluarr')
        .then(result => {
            console.log(result)
            absenKeluar.value = result.data.data
        })
})

onMounted(() => {
    getMsk();
    getKlr();
});
</script>
<template>
    <Head title="History" />

    <NavbarBottom>
        <header class="h-14 flex items-end justify-center p-2 bg-white shadow-lg sticky top-0 z-10">
            <h1 class="font-semibold">Riwayat Absensi</h1>
        </header>

        <main class="m-5">
            <div class="grid gap-5 relative lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1">
                <div v-for="Item in absenMasuk"
                    class="bg-gradient-to-br from-green-600 via-green-500 to-green-400  rounded-xl shadow-lg overflow-hidden p-4 border border-gray-300">
                    <div class="flex p-2 px-3 items-center">
                        <div class="p-3 rounded-full mr-5 bg-green-300/50 ">
                            <FontAwesomeIcon icon="fa-solid fa-arrow-right-to-bracket"
                                class="mx-[0.15rem] text-2xl text-white" />
                        </div>
                        <div class="flex flex-col text-sm text-white">
                            <h1 class="font-semibold">Absen Masuk</h1>
                            <span class="text-xs">{{ Item.hari }}, {{ Item.tanggal }}</span>
                            <span class="text-xs">{{ Item.waktu }}</span>
                        </div>
                    </div>
                </div>
                <div v-for="Item in absenKeluar"
                    class="bg-gradient-to-br from-red-600 via-red-500 to-red-400 rounded-xl shadow-lg overflow-hidden p-4 border border-gray-300">
                    <div class="flex p-2 px-3 items-center">
                        <div class="p-3 rounded-full mr-5 bg-red-300/50 ">
                            <FontAwesomeIcon icon="fa-solid fa-arrow-right-from-bracket"
                                class="mx-[0.15rem] text-2xl text-white" />
                        </div>
                        <div class="flex flex-col text-sm text-white">
                            <h1 class="font-semibold">Absen Keluar</h1>
                            <span class="text-xs">{{ Item.hari_out }}, {{ Item.tanggal_out }}</span>
                            <span class="text-xs">{{ Item.waktu_out }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </NavbarBottom>
</template>