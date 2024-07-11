<script setup lang="ts">
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue';
import WebLayout from '@/Components/Layouts/WebLayout.vue';
import axiosInstance from '@/plugins/axios';
import { ref, onMounted } from 'vue';

const appointments = ref([]);
const appointment = ref({
    id: '',
    patient: '',
    date: '',
    status: '',
});


async function fectAppointment() {
    try {
        const { data } = await axiosInstance.get('/appointments/list');
        appointments.value = data.data;
        console.log(data.data);

    } catch (e) {
        console.error(e);
    }
}

onMounted(() => {
    fectAppointment();
});
</script>

<template>
    <WebLayout>
        <div class="title">
            <h1>Appointment Today</h1>
        </div>
        <div class="teble">
            <el-table :data="appointments" style="width: 100%">
                <el-table-column prop="id" label="ID" width="230" />
                <el-table-column prop="user" label="Patient" width="350">
                    <template #default="scope">
                        <p>{{ scope.row.user.first_name }}</p>
                    </template>
                </el-table-column>
                <el-table-column prop="date" label="Date" width="350">
                    <template #default="scope">
                        <p>{{ scope.row.appointment_date }}</p>
                    </template>
                </el-table-column>
                <el-table-column prop="status" label="Status" width="350" />
                <el-table-column label="Action">
                    <el-button type="button">Detail</el-button>
                </el-table-column>
            </el-table>
        </div>
    </WebLayout>
</template>

<style>
/* .table {
    margin-top: 20px;
} */
h1 {
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
}

.title {
    text-align: center;
    background-color: skyblue;
    height: 8vh;
}
</style>
