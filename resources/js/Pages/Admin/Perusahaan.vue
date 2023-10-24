<script setup lang="ts">
import Sidebar from '@/Components/Sidebar.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { Ref, computed, ref } from 'vue';
import BlueButton from '@/Components/UI/BlueButton.vue';
import RedButton from '@/Components/UI/RedButton.vue';
import ConfirmDialog from '@/Components/UI/ConfirmDialog.vue';

import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import BtnEdit from '@/Components/UI/BtnEdit.vue';
import BtnDelete from '@/Components/UI/BtnDelete.vue';

const isOpen = ref(false)
const isEdit = ref(false)

const closeModal = () => (isOpen.value = false)
const openModal = () => (isOpen.value = true)
const editClose = () => (isEdit.value = false)
const editOpen = () => (isEdit.value = true)

type Response = {
    message: string,
    data: Perusahaan[]
}

type Perusahaan = {
    nama: string,
    alamat: string
}

const perusahaan = ref();
axios.get<Response>('api/perusahaan')
    .then(result => {
        console.log(result)
        perusahaan.value = result.data.data
    })

const formData: Ref<Perusahaan> = ref({
    nama: '',
    alamat: ''
});

const postData = async (event: Event) => {
    event.preventDefault();

    const form = new FormData();
    form.append('nama', formData.value.nama);
    form.append('alamat', formData.value.alamat);

    try {
        const response = await axios.post('api/perusahaan', form, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        });
        // response sukses
        console.log('Berhasil Menambahkan Data', response.data);
        alert(response.data.message);
        isOpen.value = false;
    } catch (error) {
        // response error
        console.error('Post gagal:', error);
    }
}

const isConfirmDialog = ref(false);
isConfirmDialog.value = false;

const deleteUser = async (id: number) => {
    try {
        const response = await axios.delete(`api/perusahaan/${id}`);

        // Handle the response here if needed
        console.log(response.data.message);
        alert(response.data.message);
    } catch (error) {
        // Handle errors here
        console.error('Error making DELETE request:', error);
    }
};


</script>
<template>
    <head title="Perusahaan"></head>
    <Sidebar>
        <div class="container block bg-white border border-gray-100 shadow-md shadow-black/5 rounded-lg p-6 overflow-auto">
            <div class="flex justify-between mb-4 items-start-start">
                <h3 class="text-xl font-bold text-left">Data Perusahaan</h3>
                <BlueButton @click="openModal">Tambah Data</BlueButton>
            </div>
            <div class="container overflow-x-auto rounded-lg">
                <!-- Table Perusahaan -->
                <table class="w-full align-middle border border-collapse">
                    <thead class="text-left text-slate-800 bg-gray-100 sticky top-0 rounded-lg">
                        <tr class="table-row">
                            <th class="th-items">Nama Perusahaan</th>
                            <th class="th-items">Alamat Perusahaan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="even:bg-gray-50" v-for="(Item, index) in perusahaan" :key="Item.id">
                            <td class="td-items">{{ index + 1 }}</td>
                            <td class="td-items">{{ Item.nama }}</td>
                            <td class="td-items">{{ Item.alamat }}</td>
                            <td class="p-3 text-white">
                                <div class="flex items-center space-x-2">
                                    <BtnEdit @click="editOpen" />
                                    <BtnDelete @click="deleteUser(Item.id)" />
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- End Table Perusahaan -->
            </div>
        </div>

        <TransitionRoot appear :show="isOpen" as="template">
            <Dialog as="div" @close="closeModal" class="relative z-10">
                <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                    leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-black bg-opacity-50" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center p-4 text-center">
                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95">
                            <DialogPanel
                                class="w-full lg:max-w-3xl md:max-w-lg sm:max-w-md transform overflow-hidden rounded-2xl bg-gray-100 p-6 text-left align-middle shadow-xl transition-all">
                                <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                                    Tambah Data Perusahaan
                                </DialogTitle>
                                <div class="flex-auto px-4 lg:px-10 py-10 pb-0">
                                    <form @submit.prevent="postData">
                                        <div class="flex flex-wrap mt-3">
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 required:border-red-500">
                                                        Nama Perusahaan
                                                    </label>
                                                    <input type="text" v-model="formData.nama" placeholder="Nama"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="mt-6 border-b-1 border-blueGray-300" />

                                        <div class="flex flex-wrap mt-5">
                                            <div class="w-full lg:w-12/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2 after:content-['*'] after:ml-0.5 after:text-red-500">
                                                        Alamat Perusahaan
                                                    </label>
                                                    <textarea type="text" v-model="formData.alamat" placeholder="Alamat"
                                                        class="border-0 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rounded-t mb-0 px-6 py-6">
                                            <div class="text-center flex justify-end">
                                                <BlueButton @click="postData, closeModal" type="submit" class="mr-2">Simpan
                                                </BlueButton>
                                                <RedButton @click="closeModal">Batal</RedButton>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
        <!-- End dialog tambah data -->

                <!-- Dialog Edit Data -->
                <TransitionRoot appear :show="isEdit" as="template">
            <Dialog as="div" @close="editClose" class="relative z-10">
                <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                    leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-black bg-opacity-50" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center p-4 text-center">
                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95">
                            <DialogPanel
                                class="w-full lg:max-w-3xl md:max-w-lg sm:max-w-md transform overflow-hidden rounded-2xl bg-gray-100 p-6 text-left align-middle shadow-xl transition-all">
                                <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                                    Edit Data Perusahaan
                                </DialogTitle>
                                <div class="flex-auto px-4 lg:px-10 py-10 pb-0">
                                    <form>
                                        <div class="flex flex-wrap mt-3">
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                                        Nama Perusahaan
                                                    </label>
                                                    <input type="text"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="mt-6 border-b-1 border-blueGray-300" />

                                        <div class="flex flex-wrap mt-5">
                                            <div class="w-full lg:w-12/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                                        Alamat Perusahaan
                                                    </label>
                                                    <textarea type="text"
                                                        class="border-0 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rounded-t mb-0 px-6 py-6">
                                            <div class="text-center flex justify-end">
                                                <BlueButton class="mr-2">Simpan</BlueButton>
                                                <RedButton @click="editClose">Batal</RedButton>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
        <!-- End Dialog Edit Data -->

        <ConfirmDialog v-if="isConfirmDialog">
        <template v-slot:title>Konfirmasi</template>
            <template v-slot:message>Apakah anda yakin akan menghapus data?</template>
            <template v-slot:button>
                <RedButton class="mx-1 mr-2">Ya</RedButton>
                <BlueButton>Batal</BlueButton>
            </template>
        </ConfirmDialog>
    </Sidebar>
</template>
<style>
.th-items {
    @apply p-2 text-[13px] font-medium border
}

.td-items {
    @apply p-3 text-gray-600 text-sm font-normal ml-2 truncate
}
</style>