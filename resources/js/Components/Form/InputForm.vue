<template>
    <div class="w-full lg:w-6/12 px-4">
        <div class="relative w-full mb-3">
            <label
                class="block uppercase text-blueGray-600 text-xs font-bold mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 required:border-red-500">
                <slot name="title" />
            </label>
            <slot name="input" />
        </div>
    </div>
</template>