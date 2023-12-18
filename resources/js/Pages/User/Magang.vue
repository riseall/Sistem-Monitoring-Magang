<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import InputForm from '@/Components/Form/InputForm.vue';
import BlueButton from '@/Components/UI/BlueButton.vue';
</script>
<template>
    <Head title="Magang" />

    <div class="min-h-screen font-montserrat bg-zinc-100">
        <header class="h-14 p-2 flex flex-col justify-end bg-white shadow-lg">
            <div class="flex items-center justify-between">
                <Link href="user.setting" class="flex text-sm text-sky-600 hover:text-sky-400">
                <FontAwesomeIcon icon="fa-solid fa-chevron-left" class="text-lg" />
                </Link>
                <h1 class="flex justify-center flex-grow font-semibold">Data Magang</h1>
            </div>
        </header>
        <div class="py-8 p-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white/50 dark:bg-gray-800 shadow-md rounded-lg">
                    <form @submit.prevent="">
                        <div class="flex flex-wrap mt-3">
                            <InputForm>
                                <template v-slot:title>Nama</template>
                                <template v-slot:input>
                                    <input type="text" placeholder="Nama" class="input-form" />
                                </template>
                            </InputForm>

                            <InputForm>
                                <template v-slot:title>NIM</template>
                                <template v-slot:input>
                                    <input type="text" placeholder="Nim" class="input-form" />
                                </template>
                            </InputForm>

                            <InputForm>
                                <template v-slot:title>Kelas</template>
                                <template v-slot:input>
                                    <input type="text" placeholder="Kelas" class="input-form" />
                                </template>
                            </InputForm>

                            <InputForm>
                                <template v-slot:title>Perusahaan</template>
                                <template v-slot:input>
                                    <input type="text" placeholder="Perusahaan" class="input-form" />
                                </template>
                            </InputForm>

                            <InputForm>
                                <template v-slot:title>Periode</template>
                                <template v-slot:input>
                                    <input type="text" placeholder="Periode" class="input-form" />
                                </template>
                            </InputForm>

                            <InputForm>
                                <template v-slot:title>Posisi</template>
                                <template v-slot:input>
                                    <input type="text" placeholder="Posisi" class="input-form" />
                                </template>
                            </InputForm>

                            <InputForm>
                                <template v-slot:title>Dosen Pembimbing</template>
                                <template v-slot:input>
                                    <input type="text" placeholder="Dosen Pembimbing" class="input-form" />
                                </template>
                            </InputForm>

                            <InputForm>
                                <template v-slot:title>Judul Laporan</template>
                                <template v-slot:input>
                                    <input type="text" placeholder="Judul Laporan" class="input-form" />
                                </template>
                            </InputForm>
                        </div>

                        <div class="rounded-t mb-0 px-6 py-6">
                            <div class="text-center flex justify-end">
                                <BlueButton @click="" type="submit" class="mr-2">Simpan</BlueButton>
                                <!-- <RedButton @click="closeModal">Batal</RedButton> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
