<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import {ref, onMounted} from 'vue'
import {hospitalAppointmentListStore} from '@/stores/hospital-appointment-list'
import {hospitalDetailStore} from '@/stores/hospital-detail'
import axiosInstance from "@/plugins/axios";

const store = hospitalAppointmentListStore()
const hospital = hospitalDetailStore()
const appointment = ref({
  id: '',
  patient: '',
  date: '',
  status: ''
})
const centerDialogVisible = ref(false)
const innerVisible = ref(false)
const confirmData = ref({
  appointment_id: '',
  appointment_end: '',
  room_id: ''
})
let data = {}
const alertAppointmentPopup = (id: any, doc_id: any) => {
  confirmData.value.appointment_id = id
  hospital.fetchHospitalDetail(doc_id)
  centerDialogVisible.value = false
  innerVisible.value = true
}
const confirmAppointment = async () => {
  innerVisible.value = false
  const formData = new FormData()
  formData.append('appointment_end', confirmData.value.appointment_end)
  formData.append('room_id', confirmData.value.room_id)
  formData.append('status', 'Confirmed')
  try{
    const {data}= await axiosInstance.put(`/appointments/update-status/${confirmData.value.appointment_id}`, formData)
    console.log(data)
  }catch(error){
    console.log(error)
  }
  store.fetchAppointments()
}
const showDetails = (row: any) => {
  data = row
  centerDialogVisible.value = true
}

onMounted(() => {
  store.fetchAppointments()
})
</script>

<template>
  <WebLayout>
    <el-dialog v-model="centerDialogVisible" title="Appointment Detail" width="30%" center>
      <div class="dialog-body">
        <p>Patient : {{ data.user.first_name }}</p>
        <p>Date : {{ data.appointment_date }}</p>
        <p>Status : {{ data.status }}</p>
        <p>My response : {{ data.doctor_status }}</p>
      </div>
      <el-dialog
          v-model="innerVisible"
          width="300"
          title="Confirm Appointment"
          append-to-body
      >
        <el-form label-position="top">
          <el-form-item label="Appointment End Date">
            <el-date-picker v-model="confirmData.appointment_end" class="w-100" value-format="YYYY-MM-DD"/>
          </el-form-item>
          <el-form-item label="Please assign a room">
            <el-select v-model="confirmData.room_id">
              <el-option
                  v-for="hosp in hospital.hospitalDetail.rooms"
                  :value="hosp.id"
                  :label="hosp.name"
                  :key="hosp.id"
              />
            </el-select>
          </el-form-item>
        </el-form>
        <div class="el-dialog__footer">
          <el-button @click="innerVisible = false">Cancel</el-button>
          <el-button type="primary" @click="confirmAppointment"> Confirm</el-button>
        </div>
      </el-dialog>
      <template #footer>
        <div class="dialog-footer">
          <el-button @click="centerDialogVisible = false">Cancel</el-button>
          <el-button
              type="primary"
              @click="alertAppointmentPopup(data.id, data.doctor.hospital_id)"
          >
            Confirm
          </el-button>
        </div>
      </template>
    </el-dialog>
    <div class="title">
      <h1>Appointment Today</h1>
    </div>
    <el-table :data="store.appointments" style="width: 100%">
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
          <el-button plain @click="showDetails(scope.row)">Detail</el-button>
        </template>
      </el-table-column>
    </el-table>
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
