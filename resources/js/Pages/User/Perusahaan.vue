<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import InputForm from '@/Components/Form/InputForm.vue';
import BlueButton from '@/Components/UI/BlueButton.vue';
import axios from 'axios';
import { ref } from 'vue';

const form = ref({
    id: '',
    nama: '',
    email: '',
    alamat: ''
})

const post = (async () => {
    await axios.post('api/perusahaan', form.value)
        .then(res => {
            console.log(res);
        })
})
</script>
<template>
    <Head title="Magang" />

    <div class="min-h-screen font-montserrat bg-zinc-100">
        <header class="h-14 p-2 flex flex-col justify-end bg-white shadow-lg">
            <div class="flex items-center justify-between">
                <Link href="user.setting" class="flex text-sm text-sky-600 hover:text-sky-400">
                <FontAwesomeIcon icon="fa-solid fa-chevron-left" class="text-lg" />
                </Link>
                <h1 class="flex justify-center flex-grow font-semibold">Perusahaan</h1>
            </div>
        </header>
        <div class="py-8 p-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-md rounded-lg">
                    <div class="flex justify-center m-2 mb-6">
                        <h1 class="font-bold">Informasi Perusahaan</h1>
                    </div>
                    <form @submit.prevent="post">
                        <div class="flex flex-wrap mt-4">
                            <InputForm>
                                <template v-slot:title>Nama</template>
                                <template v-slot:input>
                                    <input type="text" placeholder="Nama" class="input-form" />
                                </template>
                            </InputForm>

                            <InputForm>
                                <template v-slot:title>Email</template>
                                <template v-slot:input>
                                    <input type="text" placeholder="Email" class="input-form" />
                                </template>
                            </InputForm>

                            <InputForm>
                                <template v-slot:title>Alamat</template>
                                <template v-slot:input>
                                    <input type="text" placeholder="Alamat" class="input-form" />
                                </template>
                            </InputForm>

                            <!--  <InputForm>
                                <template v-slot:title>Website</template>
                                <template v-slot:input>
                                    <input type="text" placeholder="Website" class="input-form" />
                                </template>
                            </InputForm> -->
                        </div>
                        <div class="rounded-t mb-0 px- py-3">
                            <div class="text-center flex justify-end">
                                <BlueButton @click="post" type="submit" class="mr-2">Tambah</BlueButton>
                                <!-- <RedButton @click="closeModal">Batal</RedButton> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
