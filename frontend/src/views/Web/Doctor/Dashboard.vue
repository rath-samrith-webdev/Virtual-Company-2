<script setup lang="ts">
import { computed } from 'vue';
import { ref, onMounted } from 'vue';
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue';
import WebLayout from '@/Components/Layouts/WebLayout.vue';
import axiosInstance from '@/plugins/axios';
import { data } from '@maptiler/sdk';
import { date } from 'yup';

const urls = [
  'https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/calendar-circle-blue-512.png',
  'https://cdn2.iconfinder.com/data/icons/health-care-rounded-9/512/xxx026-512.png',
  'https://cdn-icons-png.flaticon.com/256/11672/11672657.png'
];



const centerDialogVisible = ref(false);
const appointmentToday = ref([]);
const appointmentData = ref([]);

const fetchAppointmentsToday = async () => {
  try {
    const response = await axiosInstance.get('/appointments/today');
    console.log(response)
    if (response.data.success) {
      appointmentToday.value = response.data.data;
    } else {
      console.error('Failed to fetch appointments for today');
    }
  } catch (error) {
    console.error('Error fetching appointments for today:', error);
  }
};
const fetchAppointmentSummary = async () => {
  try {
    const response = await axiosInstance.get('/appointments/summary');
    console.log(response)
    if (response.data.success) {
      appointmentData.value = response.data.data;
    } else {
      console.error('Failed to fetch appointments for today');
    }
  } catch (error) {
    console.error('Error fetching appointments for today:', error);
  }
};

onMounted(() => {
  fetchAppointmentsToday();
  fetchAppointmentSummary()
});
</script>

<template>
  <WebLayout>
    <div class="container">
      <el-card style="width: 350px; height: 35vh; align-items: center; text-align: center; justify-content: center; ">
        <el-image style="width: 130px;" :src="urls[0]" lazy />
        <template #footer>Appointment Today : {{ appointmentData.today }}</template>
      </el-card>

      <el-card style="width: 350px; height: 35vh; align-items: center; text-align: center; justify-content: center;">
        <el-image style="width: 130px;" :src="urls[2]" lazy />
        <template #footer>Missed : {{ appointmentData.missing }}</template>
      </el-card>

      <el-card style="width: 350px; height: 35vh; align-items: center; text-align: center; justify-content: center;">
        <el-image style="width: 130px;" :src="urls[1]" lazy />
        <template #footer>Confirmed : {{ appointmentData.confirmed }} </template>
      </el-card>
    </div>
    <div class="body">
      <h1>Today</h1>
      <div class="teble">
        <el-table :data="appointmentToday" style="width: 100%">
          <el-table-column prop="id" label="ID" width="170">
            <template #default="scope">
              <p>{{ scope.row.id }}</p>
            </template>
          </el-table-column>
          <el-table-column prop="user" label="Patient" width="250">
            <template #default="scope">
              <p>{{ scope.row.user.first_name }}</p>
            </template>
          </el-table-column>
          <el-table-column prop="date" label="Date" width="300">
            <template #default="scope">
              <p>{{ scope.row.appointment_date }}</p>
            </template>
          </el-table-column>
          <el-table-column prop="status" label="Status" width="300">
            <template #default="scope">
              <p>{{ scope.row.status }}</p>
            </template>
          </el-table-column>
          <el-table-column prop="doctor_status" label="My response" width="300">
            <template #default="scope">
              <p>{{ scope.row.doctor_status }}</p>
            </template>
          </el-table-column>
          <el-table-column label="Action">
            <template #default="scope">
              <el-button plain @click="centerDialogVisible = true">Detail</el-button>
              <el-dialog v-model="centerDialogVisible" title="Appointment Detail" width="30%" center>
                <div class="dialog-body">
                  <p>Patient : {{ scope.row.user.first_name }}</p>
                  <p>Date : {{ scope.row.appointment_date }}</p>
                  <p>Status : {{ scope.row.status }}</p>
                  <p>My response : {{ scope.row.doctor_status }}</p>
                </div>
                <template #footer>
                  <div class="dialog-footer">
                    <el-button @click="centerDialogVisible = false">Cancel</el-button>
                    <el-button type="primary" @click="centerDialogVisible = false">
                      Confirm
                    </el-button>
                  </div>
                </template>
              </el-dialog>
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
