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
const selectedMagang = ref<any | null>(null)

const closeModal = () => (isOpen.value = false)
const openModal = () => (isOpen.value = true)
const editOpen = (id: string) => {
    isEdit.value = true
    const selectedMagang = magang.value.find((item) => {
        return item.id === id
    })
    formData.value.id = selectedMagang?.id ?? '-'
    formData.value.nama_mahasiswa = selectedMagang?.nama_mahasiswa ?? ''
    formData.value.kelas = selectedMagang?.kelas ?? ''
    formData.value.nama_perusahaan = selectedMagang?.nama_perusahaan ?? ''
    formData.value.tanggal_magang = new Date(selectedMagang?.tanggal_magang ?? '')
    formData.value.judul_laporan = selectedMagang?.judul_laporan ?? ''
    formData.value.dosen_pembimbing = selectedMagang?.dosen_pembimbing ?? ''
    formData.value.alamat_perusahaan = selectedMagang?.alamat_perusahaan ?? ''
    formData.value.telepon_perusahaan = selectedMagang?.telepon_perusahaan ?? ''
    formData.value.email_perusahaan = selectedMagang?.email_perusahaan ?? ''
    formData.value.keterangan = selectedMagang?.keterangan ?? ''

}

const editClose = () => {
    isEdit.value = false
    formData.value = {
        id: '',
        nama_mahasiswa: '',
        kelas: '',
        nama_perusahaan: '',
        tanggal_magang: new Date(),
        judul_laporan: '',
        dosen_pembimbing: '',
        alamat_perusahaan: '',
        telepon_perusahaan: '',
        email_perusahaan: '',
        keterangan: ''
    }
}

type Response = {
    message: string,
    data: Magang[]
}

type Magang = {
    id: string,
    nama_mahasiswa: string,
    kelas: string,
    nama_perusahaan: string,
    tanggal_magang: Date,
    judul_laporan: string,
    dosen_pembimbing: string,
    alamat_perusahaan: string,
    telepon_perusahaan: string,
    email_perusahaan: string,
    keterangan: string
}

const magang = ref<Magang[]>([]);
axios.get<Response>('api/magang')
    .then(result => {
        console.log(result)
        magang.value = result.data.data
    })

const formData: Ref<Magang> = ref({
    id: '',
    nama_mahasiswa: '',
    kelas: '',
    nama_perusahaan: '',
    tanggal_magang: new Date(),
    judul_laporan: '',
    dosen_pembimbing: '',
    alamat_perusahaan: '',
    telepon_perusahaan: '',
    email_perusahaan: '',
    keterangan: '',
    additionalProperty: 0
});

const postData = async (event: Event) => {
    event.preventDefault();

    const form = new FormData();
    form.append('nama_mahasiswa', formData.value.nama_mahasiswa);
    form.append('kelas', formData.value.kelas);
    form.append('nama_perusahaan', formData.value.nama_perusahaan);
    form.append('tanggal_magang', formData.value.tanggal_magang.toISOString());
    form.append('judul_laporan', formData.value.judul_laporan);
    form.append('dosen_pembimbing', formData.value.dosen_pembimbing);
    form.append('alamat_perusahaan', JSON.stringify(formData.value.alamat_perusahaan));
    form.append('telepon_perusahaan', formData.value.telepon_perusahaan);
    form.append('email', formData.value.email_perusahaan);
    form.append('keterangan', JSON.stringify(formData.value.keterangan));

    try {
        const response = await axios.post('api/magang', form, {
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

const updateData = async () => {
    const form = new FormData();
    form.append('_method', 'PUT');
    form.append('nama_mahasiswa', formData.value.nama_mahasiswa);
    form.append('kelas', formData.value.kelas);
    form.append('nama_perusahaan', formData.value.nama_perusahaan);
    form.append('tanggal_magang', formData.value.tanggal_magang.toISOString());
    form.append('judul_laporan', formData.value.judul_laporan);
    form.append('dosen_pembimbing', formData.value.dosen_pembimbing);
    form.append('alamat_perusahaan', JSON.stringify(formData.value.alamat_perusahaan));
    form.append('telepon_perusahaan', formData.value.telepon_perusahaan);
    form.append('email', formData.value.email_perusahaan);
    form.append('keterangan', JSON.stringify(formData.value.keterangan));
    try{
        const response = await axios.put(`api/magang/${formData.value.id}`, form, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
    });

    // Handle the update response
    console.log('Berhasil Memperbarui Data', response.data);
        alert(response.data.message);
        isEdit.value = false;
        // You may also need to update the `` list if you're maintaining a list of students
    } catch (error) {
        console.error('Update gagal:', error);
    }
};

const isConfirmDialog = ref(false);
isConfirmDialog.value = false;

const deleteUser = async (id: string) => {
    try {
        const response = await axios.delete(`api/magang/${id}`);

        // Handle the response here if needed
        console.log(response.data.message);
        alert(response.data.message);
    } catch (error) {
        // Handle errors here
        console.error('Error making DELETE request:', error);
    }
};


</script>
</script>
<template>
    <Head title="Magang" />

    <Sidebar>
        <div class="container block bg-white border border-gray-100 shadow-md shadow-black/5 rounded-lg p-6 overflow-auto">
            <div class="flex justify-between mb-4 items-start-start">
                <h3 class="text-xl font-bold text-left">Data Mahasiswa</h3>
                <BlueButton @click="openModal">Tambah Data</BlueButton>
            </div>
            <div class="container overflow-x-auto rounded-lg">
                <!-- Table Mahasiswa -->
                <table class="w-full align-middle border border-collapse">
                    <thead class="text-left text-gray-100 bg-emerald-500 sticky top-0 rounded-lg">
                        <tr class="table-row">
                            <th class="th-items">No</th>
                            <th class="th-items">Nama Mahasiswa</th>
                            <th class="th-items">Kelas</th>
                            <th class="th-items">Nama Perusahaan</th>
                            <th class="th-items">Tanggal Magang</th>
                            <th class="th-items">Judul Laporan</th>
                            <th class="th-items">Dosen Pembimbing</th>
                            <th class="th-items">Alamat Perusahaan</th>
                            <th class="th-items">Telepon Perusahaan</th>
                            <th class="th-items">Email Perusahaan</th>
                            <th class="th-items">keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="odd:bg-gray-50" v-for="(Item, index) in magang" :key="Item.id">
                            <td class="td-items">{{ index + 1 }}</td>
                            <td class="td-items">{{ Item.nama_mahasiswa }}</td>
                            <td class="td-items">{{ Item.kelas }}</td>
                            <td class="td-items">{{ Item.nama_perusahaan }}</td>
                            <td class="td-items">{{ Item.tanggal_magang }}</td>
                            <td class="td-items">{{ Item.judul_laporan }}</td>
                            <td class="td-items">{{ Item.dosen_pembimbing }}</td>
                            <td class="td-items">{{ Item.alamat_perusahaan }}</td>
                            <td class="td-items">{{ Item.telepon_perusahaan }}</td>
                            <td class="td-items">{{ Item.email_perusahaan }}</td>
                            <td class="td-items">{{ Item.keterangan }}</td>
                            <td class="p-3 text-white">
                                <div class="flex items-center space-x-2">
                                    <BtnEdit @click="editOpen(Item.id)" />
                                    <BtnDelete @click="deleteUser(Item.id)" />
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- End Table Magang -->
            </div>
        </div>

        <!-- Dialog Tambah Data -->
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
                                    Tambah Data Mahasiswa
                                </DialogTitle>
                                <div class="flex-auto px-4 lg:px-10 py-10 pb-0">
                                    <form @submit.prevent="postData">
                                        <div class="flex flex-wrap mt-3">
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 required:border-red-500">
                                                        Nama mahasiswa
                                                    </label>
                                                    <input type="text" v-model="formData.nama_mahasiswa" placeholder="Nama mahasiswa"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow required:border-red-500 focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                                </div>
                                            </div>
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2 after:content-['*'] after:ml-0.5 after:text-red-500">
                                                        Kelas
                                                    </label>
                                                    <input type="text" v-model="formData.kelas" placeholder="Kelas"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                                </div>
                                            </div>
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2 after:content-['*'] after:ml-0.5 after:text-red-500">
                                                        Nama Perusahaan
                                                    </label>
                                                    <input type="text" v-model="formData.nama_perusahaan" placeholder="Nama Perusahaan"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                                </div>
                                            </div>
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2 after:content-['*'] after:ml-0.5 after:text-red-500">
                                                        Tanggal Magang
                                                    </label>
                                                    <input type="Date" v-model="formData.tanggal_magang" placeholder="Tanggal Magang"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                                </div>
                                            </div>
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2 after:content-['*'] after:ml-0.5 after:text-red-500">
                                                        Judul Laporan
                                                    </label>
                                                    <input type="text" v-model="formData.judul_laporan" placeholder="Judul Laporan"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                                </div>
                                            </div>

                                            <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2 after:content-['*'] after:ml-0.5 after:text-red-500">
                                                        Dosen Pembimbing
                                                    </label>
                                                    <input type="text" v-model="formData.dosen_pembimbing" placeholder="Dosen Pembimbing"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                                </div>
                                            </div>
                                        <div class="flex flex-wrap mt-5">
                                            <div class="w-full lg:w-12/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2 after:content-['*'] after:ml-0.5 after:text-red-500">
                                                        Alamat Perusahaan
                                                    </label>
                                                    <textarea v-model.lazy="formData.alamat_perusahaan" placeholder="Alamat Perusahaan"
                                                        class="border-0 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2 after:content-['*'] after:ml-0.5 after:text-red-500">
                                                        Telepon Perusahaan
                                                    </label>
                                                    <input type="text" v-model="formData.telepon_perusahaan" placeholder="Telepon Perusahaan"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                                </div>
                                            </div>

                                            <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2 after:content-['*'] after:ml-0.5 after:text-red-500">
                                                        Email Perusahaan
                                                    </label>
                                                    <input type="email" v-model="formData.email_perusahaan" placeholder="Email Perusahaan"
                                                        class="peer border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none invalid:ring-pink-600 focus:ring w-full ease-linear transition-all duration-150" />
                                                    <p class="mt-2 invisible peer-invalid:visible text-pink-600 text-sm">
                                                        Masukkan alamat email yang valid.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex flex-wrap mt-5">
                                            <div class="w-full lg:w-12/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2 after:content-['*'] after:ml-0.5 after:text-red-500">
                                                        keterangan
                                                    </label>
                                                    <textarea type="text" v-model="formData.keterangan" placeholder="Keterangan"
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
                                    Edit Data Mahasiswa
                                </DialogTitle>
                                <div class="flex-auto px-4 lg:px-10 py-10 pb-0">
                                    <form @submit.prevent="updateData">
                                        <div class="flex flex-wrap mt-3">
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                                        Nama Mahasiswa
                                                    </label>
                                                    <input type="text" id="nama_mahasiswa" v-model="formData.nama_mahasiswa"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                                </div>
                                            </div>
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                                        Kelas
                                                    </label>
                                                    <input type="text" v-model="formData.kelas"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                                </div>
                                            </div>
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                                        Nama Perusahaan
                                                    </label>
                                                    <input type="text" v-model="formData.nama_perusahaan"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                                </div>
                                            </div>
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                                        Tanggal Magang
                                                    </label>
                                                    <input type="Date" v-model="formData.tanggal_magang"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                                </div>
                                            </div>
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                                        Judul Laporan
                                                    </label>
                                                    <input type="text" v-model="formData.nama_perusahaan"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                                </div>
                                            </div>
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                                        Dosen Pembimbing
                                                    </label>
                                                    <input type="text" v-model="formData.dosen_pembimbing"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                                </div>
                                            </div>

                                            <hr class="mt-6 border-b-1 border-blueGray-300" />

                                            <div class="flex flex-wrap mt-5">
                                                <div class="w-full lg:w-12/12 px-4">
                                                    <div class="relative w-full mb-3">
                                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                                            Alamat Perusahaan
                                                        </label>
                                                        <textarea type="text" v-model="formData.alamat_perusahaan"
                                                            class="border-0 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                                        Telepon Perusahaan
                                                    </label>
                                                    <input type="text" v-model="formData.telepon_perusahaan"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                                </div>
                                            </div>
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                                        Email Perusahaan
                                                    </label>
                                                    <input type="email" v-model="formData.email_perusahaan"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-full lg:w-6/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                                        Keterangan
                                                    </label>
                                                    <input type="text" v-model="formData.keterangan"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                                </div>
                                            </div>

                                        <div class="rounded-t mb-0 px-6 py-6">
                                            <div class="text-center flex justify-end">
                                                <BlueButton @click="updateData" class="mr-2">Simpan</BlueButton>
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