<script setup lang='ts'>
import axiosInstance from '@/plugins/axios';
import { onMounted,reactive, ref } from 'vue'
import { useAuthStore } from '@/stores/auth-store'
const showTable= true
let visible= ref(false)
let currentAppointment= {}
let tableData= ref([])
let hospital= ref([])
const dialogTableVisible = ref(false)
const store = useAuthStore()
const form = reactive({
  first_name: store.user.first_name,
  last_name: store.user.last_name,
  user_id: store.user.id,
  hospital_id:'',
  date1: '',
  date2: '',
  delivery: false,
  type: [],
  resource: '',
  desc: '',
})
async function fetchData() {
  try {
    const { data } = await axiosInstance.get('/appointments/list');
    console.log(data.data);
    data.data.forEach((appointment)=>{
      tableData.value.push(appointment);
    })
  } catch (error) {
    console.log(error);
  }
}
async function fetchDoctor() {
  try {
    const { data } = await axiosInstance.get('/hospitals/list');
    data.data.forEach((hosp)=>{
      hospital.value.push(hosp);
    })
  } catch (error) {
    console.log(error);
  }
}
const onSubmit = () => {
  const data={
    'first_name':form.first_name,
    'last_name':form.last_name,
    'user_id':form.user_id,
    "hospital_id":form.hospital_id,
  }
  console.log(data)
}
function openDialog(row) {
  visible.value = true;
  currentAppointment = row;
}
function closeDialog() {
  visible.value = false;
}
onMounted(()=>{
  fetchData();
  fetchDoctor();
})
</script>

<template>
  <div>
    <div class="appointment">
      <h1>Appointment</h1>
    </div>
    <el-button plain @click="dialogTableVisible = true">
      Open a Form nested Dialog
    </el-button>
    <el-dialog v-model="dialogTableVisible" title="Shipping address" width="800">
      <el-form :model="form" label-position="top" label-width="auto" style="max-width: 800px">
        <el-input hidden v-model="form.user_id" />
        <el-form-item>
          <el-col :span="11">
            <el-form-item label="Activity name">
              <el-input v-model="form.first_name" />
            </el-form-item>
          </el-col>
          <el-col :span="2" class="text-center">
            <span class="text-gray-500">-</span>
          </el-col>
          <el-col :span="11">
            <el-form-item label="Activity name">
              <el-input v-model="form.last_name" />
            </el-form-item>
          </el-col>
        </el-form-item>
        <el-form-item label="Activity zone">
          <el-select v-model="form.hospital_id" placeholder="please select your zone">
            <el-option v-for="item in hospital" :key="item.id" :label="item.name" :value="item.id" />
          </el-select>
        </el-form-item>
        <el-form-item label="Activity time">
          <el-col :span="11">
            <el-date-picker
              v-model="form.date1"
              type="date"
              placeholder="Pick a date"
              style="width: 100%"
            />
          </el-col>
          <el-col :span="2" class="text-center">
            <span class="text-gray-500">-</span>
          </el-col>
          <el-col :span="11">
            <el-time-picker
              v-model="form.date2"
              placeholder="Pick a time"
              style="width: 100%"
            />
          </el-col>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSubmit">Create</el-button>
          <el-button>Cancel</el-button>
        </el-form-item>
      </el-form>
    </el-dialog>
    <el-table v-if="showTable" :data="tableData" height="450" style="width: 100%" class="mt-3">
      <el-table-column prop="user.name" label="Name" width="180" class="heading"/>
      <el-table-column prop="hospital" label="Department" width="180" />
      <el-table-column prop="appointment_date" label="Date" />
      <el-table-column label="Action">
        <template #default="scope">
          <el-button plain @click="openDialog(scope.row)">
            Details
          </el-button>
          <el-button plain >
            Cancel
          </el-button>
        </template>
      </el-table-column>
    </el-table>
    <el-dialog v-model="visible" :show-close="false" width="500">
      <div class="card-body">
        <p><b>Name:</b> {{ currentAppointment.user.name }}</p>
        <p><b>Doctor:</b> {{ currentAppointment.user.doctor }}</p>
        <p><b>Department:</b> {{ currentAppointment.hospital }}</p>
        <p><b>Phone Number:</b> {{ currentAppointment.user.phone_number }}</p>
        <p><b>Date:</b> {{ currentAppointment.appointment_date }}</p>
        <p><b>Time:</b> {{ currentAppointment.user.time }}</p>
        <p><b>Age:</b> {{ currentAppointment.user.age }}</p>
        <p><b>Gender:</b> {{ currentAppointment.user.gender }}</p>
      </div>
      <template #header="{ close, titleId, titleClass }">
        <div class="my-header">
          <h2 :id="titleId" :class="titleClass">
            Appointment Details
          </h2>
        </div>
      </template>
      <div class="buttonClose" >
         <el-button type="danger" @click="closeDialog">
            Close
        </el-button>
      </div>
    </el-dialog>
  </div>
</template>
<style scoped>
.appointment {
  height: 8vh;
  background: #32B4E3;
  color: white;
  text-align: center;
}
.my-header{
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #32B4E3;
  height: 5vh;
  border-radius: 5px;

}
.my-header h2{
  text-align: center;
  color: white;

}

.el-dialog{
  background: #32B4E3;
}
.buttonClose .el-button{
  margin-left: 400px;
  background: orange;
}
</style>
