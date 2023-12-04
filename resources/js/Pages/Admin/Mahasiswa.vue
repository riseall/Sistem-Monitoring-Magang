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
import { onMounted } from 'vue';

const isOpen = ref(false)
const isEdit = ref(false)

const closeModal = () => (isOpen.value = false)
const openModal = () => (isOpen.value = true)
const editOpen = (id: string) => {
    isEdit.value = true
    const selectedMahasiswa = mahasiswa.value.find((item) => {
        return item.id === id
    })
    formData.value.id = selectedMahasiswa?.id ?? '-'
    formData.value.foto = selectedMahasiswa?.foto ?? ''
    formData.value.nama = selectedMahasiswa?.nama ?? ''
    formData.value.nim = selectedMahasiswa?.nim ?? ''
    formData.value.kelas = selectedMahasiswa?.kelas ?? ''
    formData.value.telepon = selectedMahasiswa?.telepon ?? ''
    formData.value.email = selectedMahasiswa?.email ?? ''
    formData.value.alamat = selectedMahasiswa?.alamat ?? ''

}
const editClose = () => {
    isEdit.value = false
    formData.value = {
        id: '',
        foto: '',
        nama: '',
        nim: '',
        kelas: '',
        telepon: '',
        email: '',
        alamat: ''
    }
}

type Response = {
    message: string,
    data: Mahasiswa[]
}

type Mahasiswa = {
    id: string,
    foto: string,
    nama: string,
    nim: string,
    kelas: string,
    telepon: string,
    email: string,
    alamat: string
}

const mahasiswa = ref<Mahasiswa[]>([]);

const getMhs = async () => {
    await axios.get<Response>('api/mahasiswa')
        .then(result => {
            console.log(result)
            mahasiswa.value = result.data.data
        });
}

const formData: Ref<Mahasiswa> = ref({
    id: '',
    foto: '',
    nama: '',
    nim: '',
    kelas: '',
    telepon: '',
    email: '',
    alamat: ''
});

const fileInput = ref<HTMLInputElement | null>(null);
let selectedFile: File | null = null;

const handleFileChange = () => {
    if (fileInput.value) {
        selectedFile = fileInput.value.files![0];
    }
}

const postData = async (event: Event) => {
    event.preventDefault();

    const form = new FormData();
    form.append('nama', formData.value.nama);
    form.append('nim', formData.value.nim);
    form.append('kelas', formData.value.kelas);
    form.append('telepon', formData.value.telepon);
    form.append('email', formData.value.email);
    form.append('alamat', formData.value.alamat);
    try {

        if (selectedFile) {
            form.append('foto', selectedFile);
        }

        const response = await axios.post('api/mahasiswa', form, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        });
        // response sukses
        console.log('Berhasil Menambahkan Data', response.data);
        alert(response.data.message);
        isOpen.value = false;
        getMhs()
    } catch (error) {
        // response error
        console.error('Post gagal:', error);
    }
}

// Function to handle updating Mahasiswa data
const updateData = async () => {
    const form = new FormData();
    form.append('_method', 'PUT');
    form.append('nama', formData.value.nama);
    form.append('nim', formData.value.nim);
    form.append('kelas', formData.value.kelas);
    form.append('telepon', formData.value.telepon);
    form.append('email', formData.value.email);
    form.append('alamat', formData.value.alamat);

    try {
        if (selectedFile) {
            form.append('foto', selectedFile);
        }

        const response = await axios.post(`api/mahasiswa/${formData.value.id}`, form, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        });

        // Handle the update response
        console.log('Berhasil Memperbarui Data', response.data);
        alert(response.data.message);
        isEdit.value = false;
        getMhs();
        // You may also need to update the `mahasiswa` list if you're maintaining a list of students
    } catch (error) {
        console.error('Update gagal:', error);
    }
};


const isConfirmDialog = ref(false);
isConfirmDialog.value = false;

const deleteUser = async (id: string) => {
    try {
        const response = await axios.delete(`api/mahasiswa/${id}`);

        // Handle the response here if needed
        console.log(response.data.message);
        alert(response.data.message);
    } catch (error) {
        // Handle errors here
        console.error('Error making DELETE request:', error);
    }
};

onMounted(() => {
    getMhs()
});

</script>
<template>
    <Head title="Mahasiswa" />

    <Sidebar>
        <div class="container block bg-white border border-gray-100 shadow-md shadow-black/5 rounded-lg p-6 overflow-auto">
            <div class="flex justify-between mb-4 items-start-start">
                <h3 class="text-lg font-semibold text-left">Data Mahasiswa</h3>
                <BlueButton @click="openModal">Tambah Data</BlueButton>
            </div>
            <div class="container overflow-x-auto rounded-lg">
                <!-- Table Mahasiswa -->
                <table class="w-full align-middle border border-collapse">
                    <thead class="text-left text-gray-100 bg-gray-700 sticky top-0 rounded-lg">
                        <tr class="table-row">
                            <th class="th-items">No</th>
                            <th class="th-items">Foto</th>
                            <th class="th-items">Nama</th>
                            <th class="th-items">NIM</th>
                            <th class="th-items">Kelas</th>
                            <th class="th-items">Telepon</th>
                            <th class="th-items">Email</th>
                            <th class="th-items">Alamat</th>
                            <th class="th-items">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="odd:bg-gray-50" v-for="(Item, index) in mahasiswa" :key="Item.id">
                            <td class="td-items">{{ index + 1 }}.</td>
                            <td class="td-items">
                                <img :src="Item.foto ?? `/foto_mahasiswa/pas_foto_kosong.png`"
                                    class="w-14 h-14 rounded-full object-contain">
                            </td>
                            <td class="td-items">{{ Item.nama }}</td>
                            <td class="td-items">{{ Item.nim }}</td>
                            <td class="td-items">{{ Item.kelas }}</td>
                            <td class="td-items">{{ Item.telepon }}</td>
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
                <!-- End Table Mahasiswa -->
            </div>
        </div>

        <!-- Dialog Tambah Data -->
        <ModalDialog :is-open="isOpen" @close="closeModal">
            <template v-slot:jdlDialog>Tambah Data Mahasiswa</template>
            <template v-slot:btn>
                <BtnTutup @click="closeModal" />
            </template>
            <div class="flex-auto px-4 lg:px-10 py-10 pb-0">
                <form @submit.prevent="postData">
                    <div class="flex flex-wrap mt-3">
                        <InputForm>
                            <template v-slot:title>Nama</template>
                            <template v-slot:input>
                                <input type="text" v-model="formData.nama" placeholder="Nama" class="input-form" />
                            </template>
                        </InputForm>

                        <InputForm>
                            <template v-slot:title>NIM</template>
                            <template v-slot:input>
                                <input type="text" v-model="formData.nim" placeholder="Nim" class="input-form" />
                            </template>
                        </InputForm>

                        <InputForm>
                            <template v-slot:title>Kelas</template>
                            <template v-slot:input>
                                <input type="text" v-model="formData.kelas" placeholder="Kelas" class="input-form" />
                            </template>
                        </InputForm>

                        <InputForm>
                            <template v-slot:title>Telepon</template>
                            <template v-slot:input>
                                <input type="text" v-model="formData.telepon" placeholder="Telepon" class="input-form" />
                            </template>
                        </InputForm>

                        <InputForm>
                            <template v-slot:title>Email</template>
                            <template v-slot:input>
                                <input type="email" v-model="formData.email" placeholder="Email"
                                    class="peer invalid:ring-pink-600 input-form" />
                                <p class="mt-2 invisible peer-invalid:visible text-pink-600 text-sm">
                                    Masukkan alamat email yang valid.
                                </p>
                            </template>
                        </InputForm>
                    </div>

                    <hr class="mt-2 border-b-1 border-blueGray-300" />

                    <div class="flex flex-wrap mt-5">
                        <div class="w-full lg:w-12/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                    htmlFor="grid-password">
                                    Foto
                                </label>
                                <input type="file" ref="fileInput" @change="handleFileChange"
                                    class="input-form file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" />
                            </div>
                        </div>
                    </div>

                    <hr class="mt-6 border-b-1 border-blueGray-300" />

                    <div class="flex flex-wrap mt-5">
                        <div class="w-full lg:w-12/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                    htmlFor="grid-password">
                                    Alamat
                                </label>
                                <textarea type="text" v-model="formData.alamat" placeholder="Alamat"
                                    class="input-form"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-t mb-0 px-6 py-6">
                        <div class="text-center flex justify-end">
                            <BlueButton @click="postData, closeModal" type="submit" class="mr-2">Simpan</BlueButton>
                            <RedButton @click="closeModal">Batal</RedButton>
                        </div>
                    </div>
                </form>
            </div>
        </ModalDialog>
        <!-- End dialog tambah data -->

        <!-- Dialog Edit Data -->
        <ModalDialog :is-open="isEdit">
            <template v-slot:jdlDialog>Edit Data Mahasiswa</template>
            <template v-slot:btn>
                <BtnTutup @click="editClose" />
            </template>
            <div class="flex-auto px-4 lg:px-10 py-10 pb-0">
                <form @submit.prevent="updateData">
                    <div class="flex flex-wrap mt-3">
                        <InputForm>
                            <template v-slot:title>Nama</template>
                            <template v-slot:input>
                                <input type="text" v-model="formData.nama" placeholder="Nama" class="input-form" />
                            </template>
                        </InputForm>

                        <InputForm>
                            <template v-slot:title>NIM</template>
                            <template v-slot:input>
                                <input type="text" v-model="formData.nim" placeholder="Nim" class="input-form" />
                            </template>
                        </InputForm>

                        <InputForm>
                            <template v-slot:title>Kelas</template>
                            <template v-slot:input>
                                <input type="text" v-model="formData.kelas" placeholder="Kelas" class="input-form" />
                            </template>
                        </InputForm>

                        <InputForm>
                            <template v-slot:title>Telepon</template>
                            <template v-slot:input>
                                <input type="text" v-model="formData.telepon" placeholder="Telepon" class="input-form" />
                            </template>
                        </InputForm>

                        <InputForm>
                            <template v-slot:title>Email</template>
                            <template v-slot:input>
                                <input type="email" v-model="formData.email" placeholder="Email"
                                    class="peer invalid:ring-pink-600 input-form" />
                                <p class="mt-2 invisible peer-invalid:visible text-pink-600 text-sm">
                                    Masukkan alamat email yang valid.
                                </p>
                            </template>
                        </InputForm>
                    </div>

                    <hr class="mt-2 border-b-1 border-blueGray-300" />

                    <div class="flex flex-wrap mt-5">
                        <div class="w-full lg:w-12/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                    htmlFor="grid-password">
                                    Foto
                                </label>
                                <input type="file" ref="fileInput" @change="handleFileChange"
                                    class="input-form file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" />
                            </div>
                        </div>
                    </div>

                    <hr class="mt-6 border-b-1 border-blueGray-300" />

                    <div class="flex flex-wrap mt-5">
                        <div class="w-full lg:w-12/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                    htmlFor="grid-password">
                                    Alamat
                                </label>
                                <textarea type="text" v-model="formData.alamat" placeholder="Alamat"
                                    class="input-form"></textarea>
                            </div>
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