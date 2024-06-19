<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Table from '@/Components/Table.vue';
</script>

<template>
    <Head title="Teachers Schedule" />

    <AuthenticatedLayout>
        <div class="flex justify-center items-center h-screen w-full">
            <div class="bg-white p-4 w-[500px] h-auto flex flex-col rounded-sm mt-[-15vw]">
                <div class="w-full my-1">
                    <p class="text-2xl" v-if="schedule == null">
                        Create Teacher's Schedule
                    </p>

                    <p class="text-2xl" v-else>
                        Edit Teacher's Schedule
                    </p>
                </div>

                <div class="w-full my-1">
                    <label>Teacher:</label>
                    <select id="selectOption" v-model="form.user_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        <option value="">Please Select Teacher</option>
                        <option v-for="teacher in teachers" :key="teacher.id" :value="teacher.id">{{ teacher.name }}</option>
                    </select>
                </div>

                <div class="w-full my-1">
                    <label>Day:</label>
                    <select id="selectOption" v-model="form.day" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        <option value="">Please Select Day</option>
                        <option v-for="day in days" :key="day" :value="day">{{ day }}</option>
                    </select>
                </div>

                <div class="w-full my-2 flex flex-row">
                    <div class="w-full mx-1">
                        <label>Start Time</label><br>
                        <input type="time" v-model="form.start_time" class="w-full rounded-md"></input>

                    </div>

                    <div class="w-full mx-1">
                        <label>End Time:</label><br>
                        <input type="time" v-model="form.end_time" class="w-full rounded-md"></input>
                    </div>
                </div>

                <div class="w-full my-1">
                    <label>Class:</label><br>
                    <input type="text" v-model="form.class" class="w-full rounded-md"></input>
                </div>

                <div class="w-full mt-5">
                    <button class="bg-cyan-500 w-full py-2 rounded-md text-white"
                        @click="submitSchedule()"
                    >
                        Submit
                    </button>
                </div>

                <div class="w-full mt-2">
                    <button class="bg-rose-300 w-full py-2 rounded-md text-white"
                        @click="$inertia.get('/maintenance');"
                    >
                        Back
                    </button>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    data() {
        return {
            form: {
                id: '',
                user_id: '',
                day: '',
                start_time: '',
                end_time: '',
                class: ''
            }
        }

    },
    methods: {
        submitSchedule() {
            // console.log(this.form)
            if(this.schedule == null) {
                this.$inertia.post('/maintenance/teacher-schedule/store', this.form);
            } else {
                this.$inertia.post('/maintenance/teacher-schedule/update', this.form);
            }

        }
    },
    mounted(){
        if(this.schedule) {
            this.form = Object.assign({}, this.schedule)
        }
    },
    props: {
        teachers: {
            type: Array,
            required: true,
            default: () => []
        },
        days: {
            type: Array,
            required: true,
            default: () => []
        },
        schedule: {
            type: Object,
            required: false,
            default: () => null
        }
    },
};
</script>



