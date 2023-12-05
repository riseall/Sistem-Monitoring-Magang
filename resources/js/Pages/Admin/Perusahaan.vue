<script setup lang="ts">
import Sidebar from '@/Components/Sidebar.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { Ref, ref } from 'vue';
import BlueButton from '@/Components/UI/BlueButton.vue';
import RedButton from '@/Components/UI/RedButton.vue';
import ConfirmDialog from '@/Components/UI/ConfirmDialog.vue';
import ModalDialog from '@/Components/ModalDialog.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import BtnTutup from '@/Components/UI/BtnTutup.vue';
import BtnEdit from '@/Components/UI/BtnEdit.vue';
import BtnDelete from '@/Components/UI/BtnDelete.vue';
import { fromUnixTime } from 'date-fns';

const isOpen = ref(false)
const isEdit = ref(false)

const closeModal = () => (isOpen.value = false)
const openModal = () => (isOpen.value = true)
const editOpen = (id: string) => {
    isEdit.value = true
    const selectedPerusahaan = perusahaan.value.find((item) => {
        return item.id === id
    })
    formData.value.id = selectedPerusahaan?.id ?? '-'
    formData.value.nama = selectedPerusahaan?.nama ?? ''
    formData.value.email = selectedPerusahaan?.email ?? ''
    formData.value.alamat = selectedPerusahaan?.alamat ?? ''
}

const editClose = () => {
    isEdit.value = false
    formData.value = {
        id: '',
        nama: '',
        email: '',
        alamat: ''
    }
}

type Response = {
    message: string,
    data: Perusahaan[]
}

type Perusahaan = {
    id: string,
    nama: string,
    email: string,
    alamat: string
}

const perusahaan = ref<Perusahaan[]>([]);
axios.get<Response>('api/perusahaan')
    .then(result => {
        console.log(result)
        perusahaan.value = result.data.data
    })

const formData: Ref<Perusahaan> = ref({
    id: '',
    nama: '',
    email: '',
    alamat: ''
});

const postData = async (event: Event) => {
    event.preventDefault();

    const form = new FormData();
    form.append('nama', formData.value.nama);
    form.append('email', formData.value.email);
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

// Function to handle updating perusahaan data
const updateData = async () => {
    const form = new FormData();
    form.append('nama', formData.value.nama);
    form.append('email', formData.value.email)
    form.append('alamat', formData.value.alamat);

    try{
        const response = await axios.put(`api/perusahaan/${formData.value.id}`, form, {
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
                            <th class="th-items">No</th>
                            <th class="th-items">Nama Perusahaan</th>
                            <th class="th-items">Email Perusahaan</th>
                            <th class="th-items">Alamat Perusahaan</th>
                            <th class="th-items">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="even:bg-gray-50" v-for="(Item, index) in perusahaan" :key="Item.id">
                            <td class="td-items">{{ index + 1 }}</td>
                            <td class="td-items">{{ Item.nama }}</td>
                            <td class="td-items">{{ Item.email }}</td>
                            <td class="td-items">{{ Item.alamat }}</td>
                            <td class="p-3 text-white">
                                <div class="flex items-center space-x-2">
                                    <BtnEdit @click="editOpen(Item.id)" />
                                    <BtnDelete @click="deleteUser(Item.id)" />
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- End Table Perusahaan -->
            </div>
        </div>

        <!--dialog tambah data-->
        <ModalDialog :is-open="isOpen" @close="closeModal">
            <template v-slot:jdlDialog>Tambah Data Perusahaan</template>
            <template v-slot:btn>
                <BtnTutup @click="closeModal" />
            </template>
            <div class="flex-auto px-4 lg:px-10 py-10 pb-0">
                <form @submit.prevent="postData">
                    <div class="flex flex-wrap mt-3">
                        <InputForm>
                            <template v-slot:title>Nama Perusahaan</template>
                            <template v-slot:input>
                                <input type="text" v-model="formData.nama" placeholder="Nama" class="input-form" />
                            </template>
                        </InputForm>
                    </div>

                    <div class="flex flex-wrap mt-3">
                        <InputForm>
                            <template v-slot:title>Email Perusahaan</template>
                            <template v-slot:input>
                                <input type="text" v-model="formData.email" placeholder="Email" class="input-form" />
                            </template>
                        </InputForm>
                    </div>

                        <hr class="mt-6 border-b-1 border-blueGray-300" />

                        <div class="flex flex-wrap mt-5">
                        <InputForm>
                            <template v-slot:title>Alamat Perusahaan</template>
                            <template v-slot:input>
                                <textarea type="text" v-model="formData.alamat" placeholder="Alamat"
                                    class="input-form"></textarea>
                            </template>
                        </InputForm>
                    </div>
                    <div class="rounded-t mb-0 px-6 py-6">
                        <div class="text-center flex justify-end">
                            <BlueButton @click="postData, closeModal" type="submit" class="mr-2">Simpan</BlueButton>
                            <RedButton @click="closeModal">Batal</RedButton>
                        </div>
                    </div>
                </Form>
            </div>    

        </ModalDialog>
        <!-- End dialog tambah data -->

        <!-- Dialog Edit Data -->
        <ModalDialog :is-open="isEdit">
            <template v-slot:jdlDialog>Edit Data Perusahaan</template>
            <template v-slot:btn>
                <BtnTutup @click="editClose" />
            </template>
            <div class="flex-auto px-4 lg:px-10 py-10 pb-0">
                <form @submit.prevent="updateData">
                    <div class="flex flex-wrap mt-3">
                        <InputForm>
                            <template v-slot:title>Nama Perusahaan</template>
                            <template v-slot:input>
                                <input type="text" v-model="formData.nama" placeholder="Nama" class="input-form" />
                            </template>
                        </InputForm>
                    </div>

                    <div class="flex flex-wrap mt-3">
                        <InputForm>
                            <template v-slot:title>Email Perusahaan</template>
                            <template v-slot:input>
                                <input type="text" v-model="formData.email" placeholder="Email" class="input-form" />
                            </template>
                        </InputForm>
                    </div>

                    <hr class="mt-6 border-b-1 border-blueGray-300" />

                    <div class="flex flex-wrap mt-5">
                        <InputForm>
                            <template v-slot:title>Alamat Perusahaan</template>
                            <template v-slot:input>
                                <textarea type="text" v-model="formData.alamat" placeholder="Alamat"
                                    class="input-form"></textarea>
                            </template>
                        </InputForm>
                    </div>
                    <div class="rounded-t mb-0 px-6 py-6">
                        <div class="text-center flex justify-end">
                            <BlueButton @click="updateData" class="mr-2">Simpan</BlueButton>
                            <RedButton @click="editClose">Batal</RedButton>
                        </div>
                    </div>
                </form>
            </div>
        </ModalDialog>
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