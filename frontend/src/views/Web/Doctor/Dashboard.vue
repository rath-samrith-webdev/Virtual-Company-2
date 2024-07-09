<script setup lang="ts">
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue';
import WebLayout from '@/Components/Layouts/WebLayout.vue';

const urls = [
  'https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/calendar-circle-blue-512.png',
  'https://cdn2.iconfinder.com/data/icons/health-care-rounded-9/512/xxx026-512.png',
  'https://cdn-icons-png.flaticon.com/256/11672/11672657.png'
];



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
  

]
</script>

<template>
  <WebLayout>
    <div class="container">
      <el-card style="width: 350px; height: 35vh; align-items: center; text-align: center; justify-content: center; ">
        <el-image style="width: 130px;" :src="urls[0]" lazy />
        <template #footer>App Today</template>
      </el-card>

      <el-card style="width: 350px; height: 35vh; align-items: center; text-align: center; justify-content: center;">
        <el-image style="width: 130px;" :src="urls[2]" lazy />
        <template #footer>Missed</template>
      </el-card>

      <el-card style="width: 350px; height: 35vh; align-items: center; text-align: center; justify-content: center;">
        <el-image style="width: 130px;" :src="urls[1]" lazy />
        <template #footer>calendar </template>
      </el-card>
    </div>
    <div class="body">
      <h1>Today</h1>
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
    </div>
  </WebLayout>
</template>

<style scoped>
.container {
  margin-top: 30px;
  margin-left: 120px;
  display: flex;
  flex-wrap: wrap;
  gap: 60px;
}

h1 {
  text-align: center;
  margin-top: 40px;
  color: whitesmoke;
}

.body {
  background: skyblue;
  height: 8vh;
}
</style>
