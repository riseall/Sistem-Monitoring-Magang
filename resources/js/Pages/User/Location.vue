<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { computed, onMounted, ref } from 'vue';
import VueGoogleMaps from '@fawmi/vue-google-maps';

//Location
const latitude = ref<number | null>(null);
const longitude = ref<number | null>(null);
const placeName = ref<string | null>(null);

const getLocation = () => {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(position => {
            latitude.value = position.coords.latitude;
            longitude.value = position.coords.longitude;
            getPlaceName();
        });
    } else {
        console.error("Geolocation tidak didukung di perangkat ini.");
    }
};

const getPlaceName = () => {
    // Ganti 'YOUR_API_KEY' dengan kunci API Geocoding Anda.
    const apiKey = 'AIzaSyAONJyXFBJ_0w9CXdp6JgtWxtjMlPovaHA';
    const geocodingUrl = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude.value},${longitude.value}&key=${apiKey}`;

    axios.get(geocodingUrl)
        .then(response => {
            if (response.data.results.length > 0) {
                placeName.value = response.data.results[0].formatted_address;
            } else {
                placeName.value = "Nama tempat tidak ditemukan.";
            }
        })
        .catch(error => {
            console.error("Terjadi kesalahan saat mengambil nama tempat:", error);
            placeName.value = "Gagal mengambil nama tempat.";
        });
};

const googleMapsLink = computed(() => {
    if (latitude.value !== null && longitude.value !== null) {
        // Mengganti 'YOUR_API_KEY' dengan kunci API Geocoding Anda.
        const apiKey = 'AIzaSyAONJyXFBJ_0w9CXdp6JgtWxtjMlPovaHA';

        // Membuat tautan ke Google Maps dengan koordinat GPS
        return `https://www.google.com/maps/search/?api=1&query=${latitude.value},${longitude.value}&key=${apiKey}`;
    } else {
        return '';
    }
});

onMounted(() => {
    getLocation();
});

</script>
<template>
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
                <h1 class="font-semibold">Lokasi Terdekat</h1>
            </div>
        </header>

        <main class="m-4">
            <p>Lokasi GPS Anda:</p>
            <p>Latitude: {{ latitude }}</p>
            <p>Longitude: {{ longitude }}</p>
            <GmapMap :center="{ lat: latitude, lng: longitude }" :zoom="10" map-type-id="terrain"
                style="width: 100vw; height: 20rem" :options="{
                    zoomControl: true,
                    mapTypeControl: true,
                    scaleControl: true,
                    streetViewControl: true,
                    rotateControl: true,
                    fullscreenControl: true
                }" />
        </main>
    </div>
</template>