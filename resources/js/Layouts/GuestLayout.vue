<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center sm:pt-0"
        style="margin-top: -5rem"
    >
        <div class="">
            <Link href="/">
                <ApplicationLogo class="w-16 h-7 fill-current text-gray-500 mb-40" />
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-10 px-6 py-4 bg-gray-100 shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
