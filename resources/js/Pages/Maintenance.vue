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
                    <div class="w-full py-5">
                        <button class="float-right bg-cyan-300 px-4 py-2 rounded-md text-xs capitalize"
                            @click="downloadRoomCsv"
                        >
                            <i class="fa-solid fa-download"></i> Download Format
                        </button>

                        <input type="file" ref="roomFileInput" style="display: none" @change="roomFileChange">

                        <button class="float-right bg-cyan-300 px-4 py-2 rounded-md text-xs mx-1 capitalize"
                            @click="openFileRoomInput"
                        >
                            <i class="fa-solid fa-upload"></i> Upload CSV
                        </button>

                        <button class="float-right bg-cyan-300 px-4 py-2 rounded-md text-xs capitalize"
                            @click="addRoomSched()"
                        >
                            <i class="fa-solid fa-plus"></i> Add Schedule
                        </button>
                    </div>

                    <div class="w-full">
                        <Table :headers="roomSchedulesTableHeader" :rows="roomSchedules"  :hasActions="true"
                            @edit="handleEditRoomSchedule" @delete="handleTeacherDeleteSchedule"
                        />
                    </div>
                </div>


                <div v-if="activeTab === 'Teacher Schedule'" class="w-full">
                    <div class="w-full py-5">
                        <button class="float-right bg-cyan-300 px-4 py-2 rounded-md text-xs capitalize"
                            @click="downloadTeacherCsv"
                        >
                            <i class="fa-solid fa-download"></i> Download Format
                        </button>

                        <input type="file" ref="teacherFileInput" style="display: none" @change="teacherFileChange">

                        <button class="float-right bg-cyan-300 px-4 py-2 rounded-md text-xs mx-1 capitalize"
                            @click="openFileTeacherInput"
                        >
                            <i class="fa-solid fa-upload"></i> Upload CSV
                        </button>

                        <button class="float-right bg-cyan-300 px-4 py-2 rounded-md text-xs capitalize" @click="addTeacherSched()">
                            <i class="fa-solid fa-plus"></i> Add Schedule
                        </button>
                    </div>

                    <div class="w-full">
                        <Table :headers="teacherSchedulesTableHeader" :rows="teacherSchedules"  :hasActions="true"
                            @edit="handleEditTeacherSchedule" @delete="handleRoomDeleteSchedule"
                        />
                    </div>

                </div>

                <div v-if="activeTab === 'Users List'">
                    <Table :headers="teachersTableHeader" :rows="teachers"  :hasActions="false"
                            @edit="handleEditTeacherSchedule" @delete="handleRoomDeleteSchedule"
                        />
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
            tabs: ['Room Schedule', 'Teacher Schedule', 'Users List'],
            activeTab: 'Room Schedule',
            teacherSchedulesTableHeader: [
                { key: 'user_id', label: 'Teacher ID' },
                { key: 'teacher', label: 'Teacher' },
                { key: 'day', label: 'Day' },
                { key: 'start_time', label: 'Start Time' },
                { key: 'end_time', label: 'End Time' },
                { key: 'class', label: 'Class' },
            ],
            roomSchedulesTableHeader: [
                { key: 'user_id', label: 'Teacher ID' },
                { key: 'teacher', label: 'Teacher' },
                { key: 'name', label: 'Name' },
                { key: 'start_time', label: 'Start Time' },
                { key: 'end_time', label: 'End Time' },
                { key: 'class', label: 'Class' },
            ],
            teachersTableHeader: [
                { key: 'id', label: 'ID' },
                { key: 'name', label: 'Name' },
                { key: 'email', label: 'Email' },
                { key: 'role', label: 'User Type' },
            ]
        };
    },
    methods: {
        addTeacherSched(){
            this.$inertia.visit('/maintenance/teacher-schedule/create')
        },
        addRoomSched(){
            this.$inertia.visit('/maintenance/room-schedule/create')
        },
        handleEditTeacherSchedule(id) {
            // Handle edit action, e.g., show edit form/dialog
            this.$inertia.visit(`/maintenance/teacher-schedule/${id}/edit`)
        },
        handleTeacherDeleteSchedule(id) {
            // Handle delete action, e.g., show confirmation dialog
            console.log('Delete action clicked for row with id:', id);
        },
        handleEditRoomSchedule(id) {
            // Handle edit action, e.g., show edit form/dialog
            this.$inertia.visit(`/maintenance/room-schedule/${id}/edit`)
        },
        handleRoomDeleteSchedule(id) {
            // Handle delete action, e.g., show confirmation dialog
            console.log('Delete action clicked for row with id:', id);
        },
        downloadRoomCsv(){
            const csvFilePath = '/csv/room_schedule_format.csv';

            // Fetch the file as a blob
            fetch(csvFilePath)
                .then(response => response.blob())
                .then(blob => {
                    // Create a URL for the blob
                    const url = window.URL.createObjectURL(new Blob([blob]));

                    // Create a link element and click it to trigger the download
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'room_schedule_format.csv');
                    document.body.appendChild(link);
                    link.click();

                    // Clean up
                    link.parentNode.removeChild(link);
                    window.URL.revokeObjectURL(url);
                })
                .catch(error => {
                    console.error('Error fetching the file:', error);
                });
        },
        downloadTeacherCsv(){
            const csvFilePath = '/csv/teacher_schedule_format.csv';

            // Fetch the file as a blob
            fetch(csvFilePath)
                .then(response => response.blob())
                .then(blob => {
                    // Create a URL for the blob
                    const url = window.URL.createObjectURL(new Blob([blob]));

                    // Create a link element and click it to trigger the download
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'teacher_schedule_format.csv');
                    document.body.appendChild(link);
                    link.click();

                    // Clean up
                    link.parentNode.removeChild(link);
                    window.URL.revokeObjectURL(url);
                })
                .catch(error => {
                    console.error('Error fetching the file:', error);
                });
        },
        openFileRoomInput(){
            this.$refs.roomFileInput.click();
        },
        roomFileChange(event) {
            const file = event.target.files[0];

            if (file) {
                this.uploadFile(file, 'room');
                // console.log(file)
            }
        },
        openFileTeacherInput(){
            this.$refs.teacherFileInput.click();
        },
        teacherFileChange(event) {
            const file = event.target.files[0];

            if (file) {
                this.uploadFile(file, 'teacher');
                // console.log(file)
            }
        },
        uploadFile(file, type) {
            // Handle file upload logic, e.g., send to backend
            const formData = new FormData();
            formData.append('csvFile', file);
            formData.append('type', type);

            this.$inertia.post('/upload-csv', formData);

            // // Example using fetch to send the file to a Laravel endpoint
            // fetch(route('csv.upload'), {
            //     method: 'POST',
            //     body: formData
            // })
            // .then(response => {
            //     if (!response.ok) {
            //     throw new Error('Network response was not ok');
            //     }
            //     return response.json();
            // })
            // .then(data => {
            //     // Handle successful upload response
            //     console.log('File uploaded successfully:', data);
            //     // Optionally, perform any other actions upon successful upload
            // })
            // .catch(error => {
            //     console.error('Error uploading file:', error);
            //     // Handle error scenarios
            // });
        }


    },

    mounted() {
    },
    props: {
        teacherSchedules: {
            type: Array,
            required: true,
            default: () => []
        },
        roomSchedules: {
            type: Array,
            required: true,
            default: () => []
        },
        teachers: {
            type: Array,
            required: true,
            default: () => []
        }
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



