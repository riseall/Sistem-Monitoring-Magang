<script setup lang="ts">
import SidebarLayout from '@/Layouts/SidebarLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';

type Response = {
    message: string,
    data: Mahasiswa[]
}

type Mahasiswa = {
    id: number,
    foto: string,
    nama: string,
    nim: number,
    kelas: string,
    jenis_kelamin: string,
    telepom: number,
    email: string,
    alamat: string
}

const mahasiswa = ref();
axios.get<Response>('api/mahasiswa')
    .then(result => {
        console.log(result)
        mahasiswa.value = result.data.data
    })
</script>
<template>
    <Head title="Mahasiswa" />

    <SidebarLayout>
        <div class="m-4">
            <div class="card bg-white shadow-lg rounded-lg p-4">
                <h3 class="text-xl font-bold text-left mb-4">Data Mahasiswa</h3>
                <div class="overflow-auto rounded-lg shadow-lg h-[calc(100vh-12rem)]">
                    <table class="w-full table-auto align-middle border-b-2">
                        <thead class="text-left text-slate-800 border-b-2 border-gray-200">
                            <tr>
                                <th class="th-items">No</th>
                                <th class="th-items">Foto</th>
                                <th class="th-items">Nama</th>
                                <th class="th-items">NIM</th>
                                <th class="th-items">Kelas</th>
                                <th class="th-items">Jenis kelamin</th>
                                <th class="th-items">Telepon</th>
                                <th class="th-items">Email</th>
                                <th class="th-items">Alamat</th>
                                <th class="th-items">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr v-for="Item in mahasiswa">
                                <td class="td-items">{{ Item.id }}</td>
                                <td class="td-items">
                                    <img src="{{ Item.foto }}" alt="" srcset="">
                                </td>
                                <td class="td-items">{{ Item.nama }}</td>
                                <td class="td-items">{{ Item.nim }}</td>
                                <td class="td-items">{{ Item.kelas }}</td>
                                <td class="td-items">{{ Item.jenis_kelamin }}</td>
                                <td class="td-items">{{ Item.telepon }}</td>
                                <td class="td-items">{{ Item.email }}</td>
                                <td class="td-items">{{ Item.alamat }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </SidebarLayout>
</template>
<style>
.th-items {
    @apply p-3 text-sm font-semibold tracking-wide text-left
}

.td-items {
    @apply p-3 text-sm text-gray-700
}
</style>