<script setup lang="ts">
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue';
import WebLayout from '@/Components/Layouts/WebLayout.vue';

const tableData = [
    {
        id: 1,
        patient: 'Serious',
        date: '2024-12-04',
        status: 'Emergency',
    },
    {
        id: 2,
        patient: 'Serious',
        date: '2024-12-04',
        status: 'Emergency',
    },
    {
        id: 3,
        patient: 'Serious',
        date: '2024-12-04',
        status: 'Emergency',
    },
    {
        id: 4,
        patient: 'Serious',
        date: '2024-12-04',
        status: 'Emergency',
    },
    {
        id: 4,
        patient: 'Serious',
        date: '2024-12-04',
        status: 'Emergency',
    }, {
        id: 4,
        patient: 'Serious',
        date: '2024-12-04',
        status: 'Emergency',
    }, {
        id: 4,
        patient: 'Serious',
        date: '2024-12-04',
        status: 'Emergency',
    }, {
        id: 4,
        patient: 'Serious',
        date: '2024-12-04',
        status: 'Emergency',
    }, {
        id: 4,
        patient: 'Serious',
        date: '2024-12-04',
        status: 'Emergency',
    },


]
</script>

<template>
    <WebLayout>
        <div class="title">
            <h1>Appointment Today</h1>
        </div>
        <div class="teble">
            <el-table :data="tableData" style="width: 100%">
                <el-table-column prop="id" label="ID" width="230" />
                <el-table-column prop="patient" label="Patient" width="350" />
                <el-table-column prop="date" label="Date" width="350" />
                <el-table-column prop="status" label="Status" width="350" />
                <el-table-column label="Action">
                    <template v-slot="scope">
                        <el-button type="primary" plain @click="handleClick(scope.row)">Detail</el-button>
                    </template>
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
