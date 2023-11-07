<script setup lang="ts">
import Sidebar from '@/Components/Sidebar.vue';
import axios from 'axios';
import { ref, computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import BtnDelete from '@/Components/UI/BtnDelete.vue';

interface AbsenItem {
    id: string;
    foto: string;
    hari: string;
    tanggal: string;
    waktu: string;
    lokasi: string;
    id_out: string;
    foto_out: string;
    hari_out: string;
    tanggal_out: string;
    waktu_out: string;
    lokasi_out: string;
}

const absenMasuk = ref<AbsenItem[]>([]);
const absenKeluar = ref<AbsenItem[]>([]);
const itemsPerPage = 5;
const currentPage = ref(1);
const currentPage_out = ref(1);

/* Get Data Absen Masuk */
axios.get('api/absenMasuk')
    .then(result => {
        absenMasuk.value = result.data.data;
    });


const totalItems = computed(() => absenMasuk.value.length);
const totalPages = computed(() => Math.ceil(totalItems.value / itemsPerPage));

const displayedItems = computed(() => {
    const startIndex = (currentPage.value - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    return absenMasuk.value.slice(startIndex, endIndex);
});


const nextPage = () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
    }
};

const previousPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--;
    }
};

/* Get Data Absen Keluar */
axios.get('api/absenKeluar')
    .then(result => {
        absenKeluar.value = result.data.data;
    });

const totalItems_out = computed(() => absenKeluar.value.length);
const totalPages_out = computed(() => Math.ceil(totalItems_out.value / itemsPerPage));

const displayedItems_out = computed(() => {
    const startIndex = (currentPage_out.value - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    return absenKeluar.value.slice(startIndex, endIndex);
});

const nextPage_out = () => {
    if (currentPage_out.value < totalPages_out.value) {
        currentPage_out.value++;
    }
};

const previousPage_out = () => {
    if (currentPage_out.value > 1) {
        currentPage_out.value--;
    }
};
</script>
<template>
    <Head title="Absensi" />
    <Sidebar>
        <!-- Data Absen Masuk -->
        <div class="container block bg-white border border-gray-100 shadow-md shadow-black/5 rounded-lg p-6 overflow-auto">
            <div class="flex justify-between mb-4 items-start-start">
                <h3 class="text-lg font-semibold text-left">Data Absen Masuk</h3>
            </div>
            <div class="container overflow-x-auto rounded-lg">
                <table class="w-full align-middle border border-collapse">
                    <thead class="text-left text-gray-100 bg-emerald-500 sticky top-0">
                        <tr class="table-row">
                            <th class="th-items">No</th>
                            <th class="th-items">Foto</th>
                            <th class="th-items">Hari</th>
                            <th class="th-items">Tanggal</th>
                            <th class="th-items">Waktu Absen</th>
                            <th class="th-items">Lokasi Absen</th>
                            <th class="th-items">Hapus</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="odd:bg-gray-50" v-for="(Item, index) in displayedItems" :key="Item.id">
                            <td class="td-items">{{ (currentPage - 1) * itemsPerPage + index + 1 }}.</td>
                            <td class="rounded-lg">
                                <img :src="Item.foto" class="w-12 h-12 object-contain">
                            </td>
                            <td class="td-items">{{ Item.hari }}</td>
                            <td class="td-items">{{ Item.tanggal }}</td>
                            <td class="td-items">{{ Item.waktu }}</td>
                            <td class="td-items">
                                <a :href="Item.lokasi" target="_blank" class="flex text-sky-400 hover:text-sky-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                    Lokasi
                                </a>
                            </td>
                            <td class="td-items">
                                <BtnDelete />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Pagination -->
                <div class="mt-4 mb-2 flex flex-col">
                    <p class="text-sm font-bold">Jumlah Data : {{ totalItems }}</p>
                    <div class="space-x-2">
                        <button @click="previousPage" :disabled="currentPage === 1"
                            class="bg-sky-500 text-white text-xs p-1 rounded-lg px-2 hover:bg-sky-600 hover:text-gray-200">
                            Previous</button>
                        <button @click="nextPage" :disabled="currentPage === totalPages"
                            class="bg-sky-500 text-white text-xs p-1 rounded-lg px-2 hover:bg-sky-600 hover:text-gray-200">Next
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Absen Keluar -->
        <div
            class="container block my-10 mb-20 bg-white border border-gray-100 shadow-md shadow-black/5 rounded-lg p-6 overflow-auto">
            <div class="flex justify-between mb-4 items-start-start">
                <h3 class="text-lg font-semibold text-left">Data Absen Keluar</h3>
            </div>
            <div class="container overflow-x-auto rounded-lg">
                <table class="w-full align-middle border border-collapse">
                    <thead class="text-left text-gray-100 bg-emerald-500 sticky top-0">
                        <tr class="table-row">
                            <th class="th-items">No</th>
                            <th class="th-items">Foto</th>
                            <th class="th-items">Hari</th>
                            <th class="th-items">Tanggal</th>
                            <th class="th-items">Waktu Absen</th>
                            <th class="th-items">Lokasi Absen</th>
                            <th class="th-items">Hapus</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="odd:bg-gray-50" v-for="(Item, index) in displayedItems_out" :key="Item.id_out">
                            <td class="td-items">{{ (currentPage_out - 1) * itemsPerPage + index + 1 }}.</td>
                            <td class="rounded-lg">
                                <img :src="Item.foto_out" class="w-12 h-12 object-contain">
                            </td>
                            <td class="td-items">{{ Item.hari_out }}</td>
                            <td class="td-items">{{ Item.tanggal_out }}</td>
                            <td class="td-items">{{ Item.waktu_out }}</td>
                            <td class="td-items">
                                <a :href="Item.lokasi_out" target="_blank" class="flex text-sky-400 hover:text-sky-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                    Lokasi
                                </a>
                            </td>
                            <td class="td-items">
                                <BtnDelete />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Pagination -->
                <div class="mt-4 mb-2 flex flex-col">
                    <p class="text-sm font-bold">Jumlah Data : {{ totalItems_out }}</p>
                    <div class="space-x-2">
                        <button @click="previousPage_out" :disabled="currentPage_out === 1"
                            class="bg-sky-500 text-white text-xs p-1 rounded-lg px-2 hover:bg-sky-600 hover:text-gray-200">
                            Previous</button>
                        <button @click="nextPage_out" :disabled="currentPage_out === totalPages_out"
                            class="bg-sky-500 text-white text-xs p-1 rounded-lg px-2 hover:bg-sky-600 hover:text-gray-200">Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </Sidebar>
</template>