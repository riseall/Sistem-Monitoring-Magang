<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { format } from 'date-fns';
import { id } from 'date-fns/locale'; // Mengimpor bahasa Indonesia
import NavbarBottom from '@/Components/User/NavbarBottom.vue';
import Lokasi from '@/Components/User/Lokasi.vue';
import ModalDialog from '@/Components/ModalDialog.vue';
import BtnTutup from '@/Components/UI/BtnTutup.vue';
import AmberBtnVue from '@/Components/User/AmberBtn.vue';
import InputForm from '@/Components/Form/InputForm.vue';

const video = ref<HTMLVideoElement | null>(null);

const currentDay = ref('');
const currentDate = ref('');
const currentTime = ref('');

const updateTime = () => {
    const now = new Date();
    currentDay.value = format(now, 'EEEE', { locale: id });
    currentDate.value = format(now, 'd MMMM y', { locale: id });
    currentTime.value = now.toLocaleTimeString();

    setTimeout(updateTime, 1000);
};

const isOpen = ref(false);
const isClose = ref(false);

const openMasuk = () => {
    isOpen.value = true
    startCapture();
};
const closeMasuk = () => {
    isOpen.value = false
    stopCapture();
};

const openKeluar = () => {
    isClose.value = true
    startCapture();
};
const closeKeluar = () => {
    isClose.value = false
    stopCapture();
};

const startCapture = async () => {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false })
        video.value!.srcObject = stream;
        video.value!.play();
    } catch (error) {
        console.error(error);
    }
}

const stopCapture = () => {
    if (video.value && video.value.srcObject) {
        const tracks = (video.value.srcObject as MediaStream).getTracks();
        tracks.forEach((track) => track.stop());
    }
};

onMounted(() => {
    updateTime();
});

</script>
<template>
    <div class="h-screen font-montserrat bg-zinc-200">
        <div class="bg-gray-800 text-white p-6 overflow-auto">
            <div class="flex items-center justify-between">
                <div>
                    <h1>Halo!!</h1>
                    <!-- <span class="text-xl font-bold">{{ $page.props.auth.user.name }}</span> -->
                </div>
                <span class="text-sm">{{ currentTime }}</span>
            </div>
            <div
                class=" flex items-center justify-between rounded-lg mt-4 p-4 px-6 bg-gradient-to-br from-amber-500 to-amber-200">
                <div class="text-gray-900">
                    <h1 class="font-semibold">{{ currentDay }}</h1>
                    <span class="text-sm">{{ currentDate }}</span>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-10 h-10 text-gray-800/75">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                </svg>
            </div>
        </div>

        <Lokasi />

        <main class="m-4 mt-5">
            <div class="grid gap-5 relative lg:grid-cols-2 md:grid-cols-1">
                <div class="bg-white rounded-md shadow-lg flex p-4 py-5 border border-gray-300">
                    <div class="p-2 rounded-md mr-5 bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                            stroke="currentColor" class="w-6 h-6 text-green-700">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                    </div>
                    <div class="text-sm">
                        <h1 class="font-semibold">Masuk</h1>
                        <span class="text-xs">07.00</span>
                    </div>
                </div>
                <div class="bg-white rounded-md shadow-lg flex p-4 py-5 border border-gray-300">
                    <div class="p-2 rounded-md mr-5 bg-rose-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                            stroke="currentColor" class="w-6 h-6 text-rose-700">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                    </div>
                    <div class="text-sm">
                        <h1 class="font-semibold">Keluar</h1>
                        <span class="text-xs">07.00</span>
                    </div>
                </div>
            </div>
            <div class="flex justify-between mt-5 gap-5 font-semibold">
                <AmberBtnVue @click="openMasuk">
                    Absen Masuk
                </AmberBtnVue>
                <AmberBtnVue @click="openKeluar">
                    Absen Keluar
                </AmberBtnVue>
            </div>
        </main>

        <!-- Dialog Untuk Kamera Absen Masuk -->
        <ModalDialog :is-open="isOpen">
            <template v-slot:btn>
                <BtnTutup @click="closeMasuk" />
            </template>
            <video ref="video" class="mt-3 rounded-lg"></video>
            <AmberBtnVue class="mt-3 space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                </svg>
                <span>Ambil</span>
            </AmberBtnVue>
        </ModalDialog>

        <!-- Dialog Untuk Kamera Absen Keluar -->
        <ModalDialog :is-open="isClose">
            <template v-slot:btn>
                <BtnTutup @click="closeKeluar" />
            </template>
            <video ref="video" class="mt-3 rounded-lg"></video>
            <AmberBtnVue class="mt-3 space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                </svg>
                <span>Ambil</span>
            </AmberBtnVue>
        </ModalDialog>

        <NavbarBottom />

    </div>
</template>