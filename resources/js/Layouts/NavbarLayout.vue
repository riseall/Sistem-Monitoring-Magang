<script setup lang="ts">
import { ref, defineProps, defineEmits } from 'vue';
import SidebarLayout from './SidebarLayout.vue';

const showDropDown = ref(false);
const props = defineProps({
    showSide: Boolean,
});

const emit = defineEmits(['toggleSidebar']);

function toggleSidebar() {
    emit('toggleSidebar');
}

function toggleDrop() {
    showDropDown.value = !showDropDown.value
}
</script>

<template>
    <div
        class="h-[50px] bg-white flex items-center justify-between px-5 w-full py-[10px] shadow-md shadow-black/5 sticky top-0 left-0 z-30">
        <!-- Hamburger Menu -->
        <div class="cursor-pointer w-[30px]" @click="toggleSidebar">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd"
                    d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z"
                    clip-rule="evenodd" />
            </svg>
        </div>
        <!-- User -->
        <div class="w-44">
            <div class="flex items-center space-x-4" @click="toggleDrop">
                <img class="w-10 h-10 rounded-full border-2 border-gray-50 bg-black" src="">
                <div class="font-semibold dark:text-white text-left">
                    <div>Rizal Nugroho</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Admin</div>
                </div>
            </div>
            <div v-show="showDropDown"
                class="absolute right-[10px] z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1">
                <div class="py-1 text-left" role="none">
                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                        id="menu-item-0">Profile</a>
                </div>
            </div>
        </div>
        <div class="h-[calc(100vh-50px)]">
            <slot />
        </div>
    </div>

    <slot />
</template>

