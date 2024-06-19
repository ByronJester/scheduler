<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Table from '@/Components/Table.vue';
</script>

<template>
    <Head title="Maintenance" />

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
            <div class="bg-white shadow-md rounded-lg">
            <!-- Tabs -->
            <div class="flex">
                <button
                v-for="(tab, index) in tabs"
                :key="index"
                @click="activeTab = tab"
                :class="['py-2 px-4 font-semibold', activeTab === tab ? 'bg-gray-500 text-white' : 'text-black']"
                class="mr-2"
                >
                {{ tab }}
                </button>
            </div>

            <!-- Content -->
            <div class="p-4 w-full h-[75vh]">
                <div v-if="activeTab === 'Room Schedule'">
                </div>
            </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    data() {
        return {
            tabs: ['Room Schedule', 'Teacher Schedule', 'Section Schedule'],
        };
    },
    methods: {

    },

    mounted() {
    },
    props: {
        // teacherSchedules: {
        //     type: Array,
        //     required: true,
        //     default: () => []
        // },
        // roomSchedules: {
        //     type: Array,
        //     required: true,
        //     default: () => []
        // },
        // teachers: {
        //     type: Array,
        //     required: true,
        //     default: () => []
        // }
    },
};
</script>

<style>
/* Custom styles for tooltip */
.arrow-up {
  position: absolute;
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  border-width: 5px;
  border-style: solid;
  border-color: transparent transparent gray transparent;
}
</style>



