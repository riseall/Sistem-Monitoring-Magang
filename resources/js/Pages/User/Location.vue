<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { Head } from '@inertiajs/vue3';

//Location
const latitude = ref<number | null>(null);
const longitude = ref<number | null>(null);
const location = ref('');
const apiKey = 'AIzaSyAONJyXFBJ_0w9CXdp6JgtWxtjMlPovaHA';

const getLocation = () => {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(position => {
            latitude.value = position.coords.latitude;
            longitude.value = position.coords.longitude;

            const googleMapsLink = `https://www.google.com/maps/search/?api=1&query=${latitude.value},${longitude.value}&key=${apiKey}`;
            location.value = googleMapsLink;
        });
    } else {
        console.error("Geolocation tidak didukung di perangkat ini.");
    }
};

onMounted(() => {
    getLocation();
});

</script>
<template>
    <Head title="Lokasi" />

    <div class="h-screen font-montserrat bg-zinc-200">
        <header class="h-16 p-2 flex flex-col bg-white shadow-lg">
            <Link href="user.dashboard" class="flex text-sm text-sky-600 hover:text-sky-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            <span>Kembali</span>
            </Link>
            <div class="flex items-end justify-center">
                <h1 class="font-semibold">Lokasi</h1>
            </div>
        </header>

        <main class="m-4">
            <div class="grid gap-5 relative lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1">
                <div class="bg-white rounded-md shadow-lg p-4 pb-0 border border-gray-300">
                    <div class="flex py-2 items-center">
                        <div class="p-2 rounded-full mr-5 bg-amber-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-8 h-8 text-amber-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </div>
                        <div class="text-sm">
                            <h1 class="font-semibold">Lokasi GPS Anda : </h1>
                            <span class="text-xs">{{ latitude }},{{ longitude }}</span>
                        </div>
                    </div>
                    <hr class="border my-2">
                    <a :href="location"
                        class="flex items-center justify-center text-sky-400 hover:text-sky-600 hover:cursor-pointer p-1 pb-3"
                        target="_blank">Lihat</a>
                </div>
            </div>
        </main>
    </div>
</template>