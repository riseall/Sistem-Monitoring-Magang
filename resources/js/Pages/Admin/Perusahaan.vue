<script setup lang="ts">
import Sidebar from '@/Components/Sidebar.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { Ref, computed, ref, watch } from 'vue';
import BlueButton from '@/Components/UI/BlueButton.vue';
import RedButton from '@/Components/UI/RedButton.vue';
import ModalDialog from '@/Components/ModalDialog.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import BtnTutup from '@/Components/UI/BtnTutup.vue';
import BtnEdit from '@/Components/UI/BtnEdit.vue';
import BtnDelete from '@/Components/UI/BtnDelete.vue';
import { onMounted } from 'vue';
import { AxiosError } from 'axios';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import Swal from 'sweetalert2';

const isOpen = ref(false)
const isEdit = ref(false)

const closeModal = () => (isOpen.value = false)
const openModal = () => {
    isOpen.value = true
    errors.value = '';
}
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

const errors = ref();
const itemsPerPage = 5;
const currentPage = ref(1);

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
//get data perusahaan
const getPrs = async () => {
    await axios.get<Response>('api/perusahaan', { params: { keywords: keywords.value } })
        .then(result => {
            console.log(result)
            perusahaan.value = result.data.data
        });
}
const totalItems = computed(() => perusahaan.value.length);
const totalPages = computed(() => Math.ceil(totalItems.value / itemsPerPage));

const displayedItems = computed(() => {
    const startIndex = (currentPage.value - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    return perusahaan.value.slice(startIndex, endIndex);
});

const visPageNum = computed(() => {
    let pageNum = []
    if (totalPages.value <= 7) {
        for (let i = 1; i <= totalPages.value; i++) {
            pageNum.push(i);
        }
    } else {
        if (currentPage.value <= 4) {
            pageNum = [1, 2, 3, 4, 5, '....', totalPages.value];
        } else if (currentPage.value >= totalPages.value - 3) {
            pageNum = [1, '....', totalPages.value - 4, totalPages.value - 3, totalPages.value - 2, totalPages.value - 1, totalPages.value]
        } else {
            pageNum = [1, '....', currentPage.value, currentPage.value + 1, '....', totalPages.value]
        }
    }
    return pageNum;
});

const changePage = (page: number) => {
    if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page
    }
}

//handle search item
const keywords = ref(null);
const results = ref<Perusahaan[]>([]);

watch(keywords, () => {
    getPrs();
})

//Handle untuk manambahkan data
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
        const response = await axios.post('api/perusahaan', form);
        // response sukses
        console.log('Berhasil Menambahkan Data', response.data);
        Swal.fire({
            title: "Yeayy!",
            text: "Berhasil Menambahkan Data.",
            icon: "success"
        })
        isOpen.value = false;
        formData.value = {
            id: '',
            nama: '',
            email: '',
            alamat: ''
        }
        getPrs()
    } catch (error: unknown) {
        // response error
        // response error
        if (error instanceof AxiosError) {
            errors.value = error.response?.data.errors;
        }
        console.error('Post gagal:', error);
    }
}

// Function to handle updating perusahaan data
const updateData = async () => {
 const data = {
   nama: formData.value.nama,
   email: formData.value.email,
   alamat: formData.value.alamat
 };

 try {
     const response = await axios({
         method: 'put',
         url: `api/perusahaan/${formData.value.id}`,
         data: data,
         headers: {
             'Content-Type': 'application/json',
         },
         
     });

     // Handle the update response
     console.log('Berhasil Memperbarui Data', response.data);
     Swal.fire({
            title: "Yeayy!",
            text: "Berhasil Memperbarui Data.",
            icon: "success"
        });
     alert(response.data.message);
     isEdit.value = false;
     getPrs();

 } catch (error) {
     console.error('Update gagal:', error);
 }
};

const isConfirmDialog = ref(false);
isConfirmDialog.value = false;

//handle untuk menghapus data
const deleteUser = (id: string) => {
    try {
        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                const response = axios.delete(`api/perusahaan/${id}`);
                getPrs();
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });
            }
        });
    } catch (error) {
        // Handle errors here
        console.error('Error making DELETE request:', error);
    }
};
onMounted(() => {
    getPrs();
});

</script>
<template>
    <head title="Perusahaan"></head>

    <Sidebar>
        <div class="container block bg-white border border-gray-100 shadow-md shadow-black/5 rounded-lg p-6 overflow-auto">
            <h3 class="text-lg font-semibold text-left">Data Perusahaan</h3>
            <div class="flex justify-between mb-4 mt-3 items-start-start">
                <div>
                    <input type="text" class="rounded-lg text-xs p-[0.3 rem]" v-model="keywords" placeholder="Search">
                    <ul v-if="results.length > 0">
                        <li v-for="result in results" :key="result.id" v-text="result.nama, result.email, result.alamat"></li>
                    </ul>
                </div>
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
                        <tr class="odd:bg-gray-50" v-for="(Item, index) in displayedItems" :key="Item.id">
                            <td class="td-items">{{ (currentPage - 1) * itemsPerPage + index + 1 }}.</td>
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
                <div class="py-2">
                    <nav class="block">
                        <p class="text-xs text-gray-700 font-semibold">Jumlah Data : {{ totalItems }}</p>
                        <ul class="flex pl-0 rounded list-none flex-wrap justify-center">
                            <li>
                                <a href="#" @click="changePage(currentPage - 1)" :disabled="(currentPage === 1)"
                                    class="first:ml-0 text-xs font-semibold flex w-8 h-8 mx-1 p-0 rounded-full items-center justify-center leading-tight relative border border-solid border-sky-500 bg-white text-sky-500 hover:bg-sky-300 hover:text-white">
                                    <FontAwesomeIcon icon="fas fa-chevron-left -ml-px" />
                                </a>
                            </li>
                            <li v-for="Items in visPageNum" :key="Items"
                                :class="{ active: currentPage == Items || Items === '....' }">
                                <a href="#" @click="changePage(Number(Items))"
                                    class="first:ml-0 text-xs font-semibold flex w-8 h-8 mx-1 p-0 rounded-full items-center justify-center leading-tight relative border border-solid border-sky-500 text-sky-400 focus:text-white focus:bg-sky-300 hover:bg-sky-300 hover:text-white">
                                    {{ Items }}
                                </a>
                            </li>
                            <li>
                                <a href="#" @click="changePage(currentPage + 1)" :disabled="(currentPage === 1)"
                                    class="first:ml-0 text-xs font-semibold flex w-8 h-8 mx-1 p-0 rounded-full items-center justify-center leading-tight relative border border-solid border-sky-500 bg-white text-sky-500 hover:bg-sky-300 hover:text-white">
                                    <FontAwesomeIcon icon="fas fa-chevron-right -ml-px" />
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
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
                                <div class="text-red-400 text-sm" v-if="errors?.nama">{{ errors.nama[0] }}</div>
                            </template>
                        </InputForm>

                        <InputForm>
                            <template v-slot:title>Email</template>
                            <template v-slot:input>
                                <input type="email" v-model="formData.email" placeholder="Email"
                                    class="peer invalid:ring-pink-600 input-form" />
                                <div class="text-red-400 text-sm" v-if="errors?.email">{{ errors.email[0] }}</div>
                                <p class="mt-2 invisible peer-invalid:visible text-pink-600 text-sm">
                                    Masukkan alamat email yang valid.
                                </p>
                            </template>
                        </InputForm>
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
                                <div class="text-red-400 text-sm" v-if="errors?.alamat">{{ errors.alamat[0] }}</div>
                            </div>
                        </div>
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
    </Sidebar>
</template>