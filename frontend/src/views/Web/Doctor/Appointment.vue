<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import axiosInstance from '@/plugins/axios'
import { ref, onMounted } from 'vue'
import { hospitalAppointmentListStore } from '@/stores/hospital-appointment-list'
import { hospitalDetailStore } from '@/stores/hospital-detail'
const store=hospitalAppointmentListStore()
const hospital=hospitalDetailStore()
const appointments = ref([])
const appointment = ref({
  id: '',
  patient: '',
  date: '',
  status: ''
})
const centerDialogVisible= ref(false)
const innerVisible=ref(false)
const rooms=[]
const confirmData=ref({
  'appointment_id':'',
  'room_name':''
})
const alertAppointmentPopup=(id:any,doc_id:any)=>{
  confirmData.value.appointment_id=id;
  hospital.fetchHospitalDetail(doc_id)
  innerVisible.value = true
}
const confirmAppointment= ()=>{
  innerVisible.value = false
  store.confirmAppointment(confirmData.value.appointment_id)
}

async function fetchAppointment() {
  try {
    const { data } = await axiosInstance.get('/appointments/list')
    appointments.value = data.data
    console.log(data.data)

  } catch (e) {
    console.error(e)
  }
}
onMounted(() => {
  fetchAppointment()
})
</script>

<template>
  <WebLayout>
    <div class="title">
      <h1>Appointment Today</h1>
    </div>
    <el-table :data="appointments" style="width: 100%">
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
            <el-dialog
              v-model="innerVisible"
              width="300"
              title="Confirm Appointment"
              append-to-body>
              <el-form>
                <el-select v-model="confirmData.room_name">
                  <el-option v-for="hosp in hospital.hospitalDetail.rooms" :value="hosp.name" :key="hosp">{{hosp.name}}</el-option>
                </el-select>
              </el-form>
              <div class="el-dialog__footer">
                <el-button @click="innerVisible = false">Cancel</el-button>
                <el-button type="primary" @click="confirmAppointment">
                  Confirm
                </el-button>
              </div>
            </el-dialog>
            <template #footer>
              <div class="dialog-footer">
                <el-button @click="centerDialogVisible = false">Cancel</el-button>
                <el-button type="primary" @click="alertAppointmentPopup(scope.row.id,scope.row.doctor.hospital_id)">
                  Confirm
                </el-button>
              </div>
            </template>
          </el-dialog>
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
