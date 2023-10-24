<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <div class="h-screen font-montserrat bg-zinc-200">
        <header class="h-16 p-2 flex flex-col bg-white shadow-lg">
            <Link href="user.dashboard" class="flex text-sm text-sky-600 hover:text-sky-500">
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
    </div>
</template>