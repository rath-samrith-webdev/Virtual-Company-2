<script setup lang="ts">
import axiosInstance from '@/plugins/axios'
import { onMounted, reactive, ref, watch } from 'vue'
import { useAuthStore } from '@/stores/auth-store'
import { CirclePlus, Close, Delete, EditPen, View } from '@element-plus/icons-vue'
import { ElNotification } from 'element-plus'
import { hospitalAppointmentListStore } from '@/stores/hospital-appointment-list'
const appointment = hospitalAppointmentListStore()
let visible = ref(false)
let currentAppointment = {}
let doctorData = ref([])
let doctorEditData = ref([])
let hospital = ref([])
const dialogTableVisible = ref(false)
const dialogEditVisible = ref(false)
const store = useAuthStore()

const form = reactive({
  first_name: store.user.first_name,
  last_name: store.user.last_name,
  user_id: store.user.id,
  hospital_id: '',
  doctor_id: '',
  title: '',
  date1: '',
  date2: ''
})
let formEdit = reactive({
  id: '',
  first_name: '',
  last_name: '',
  user_id: store.user.id,
  hospital_id: '',
  doctor_id: '',
  title: '',
  date1: '',
  date2: ''
})
async function fetchHospitals() {
  try {
    const { data } = await axiosInstance.get('/hospitals/list')
    data.data.forEach((hosp) => {
      hospital.value.push(hosp)
    })
  } catch (error) {
    console.log(error)
  }
}
const openEditDialog = (row: any) => {
  console.log(row)
  dialogEditVisible.value = true
  formEdit.id = row.id
  formEdit.first_name = row.user.first_name
  formEdit.last_name = row.user.last_name
  formEdit.hospital_id = row.doctor.hospital_id
  formEdit.doctor_id = row.doctor.id
  formEdit.title = row.title
  formEdit.date1 = row.appointment_date
  formEdit.date2 = row.appointment_time
  formEdit.user_id = row.user.id
}
const open2 = (title: string, message: string, type: string) => {
  ElNotification({
    title: title,
    message: message,
    type: type
  })
}
async function fetchDoctors(hospital_id: any, docData: any[]) {
  console.log(hospital_id)
  try {
    const { data } = await axiosInstance.get(`/hospitals/show/${hospital_id}`)
    data.data.doctors.forEach((doctor) => {
      docData.value.push(doctor)
      console.log(doctor)
    })
  } catch (error) {
    console.log(error)
  }
}

const onSubmit = async () => {
  dialogTableVisible.value = false
  const formData = {
    user_id: form.user_id,
    appointment_date: form.date1,
    appointment_time: form.date2,
    hospital_id: form.hospital_id,
    title: form.title,
    doctor_id: form.doctor_id
  }
  try {
    const { data } = await axiosInstance.post('/appointments/create', formData)
    console.log(data)
  } catch (error) {
    console.log(error)
  }
}

const deleteAppointment = async (row: any) => {
  const id = row.id
  try {
    const { data } = await axiosInstance.delete(`/appointments/delete/${id}`)
    if (data.success == true) {
      open2('Appointment', data.message, 'success')
    } else {
      open2('Appointment', data.message, 'warning')
    }
  } catch (error) {
    console.log(error)
  }
  appointment.fetchAppointments()
}

const onUpdate = async () => {
  dialogEditVisible.value = false
  const formData = new FormData()
  formData.append('user_id', formEdit.user_id)
  formData.append('appointment_date', formEdit.date1)
  formData.append('appointment_time', formEdit.date2)
  formData.append('hospital_id', formEdit.hospital_id)
  formData.append('title', formEdit.title)
  formData.append('doctor_id', formEdit.doctor_id)
  try {
    const { data } = await axiosInstance.put(`/appointments/update/${formEdit.id}`, formData)
    console.log(data)
    if (data.success == true) {
      open2('Appointment', data.message, 'success')
    } else {
      open2('Appointment', data.message, 'warning')
    }
  } catch (error) {
    console.log(error)
  }
}
function cancelAppointment(row) {
  appointment.cancelAppointment(row.id)
  if (appointment.message.success == true) {
    open2('Appointment', appointment.message.message, 'success')
  } else {
    open2('Appointment', appointment.message.message, 'warning')
  }
}
function openDialog(row) {
  visible.value = true
  currentAppointment = row
}
function closeDialog() {
  visible.value = false
}
onMounted(() => {
  fetchHospitals()
  appointment.fetchAppointments()
})
watch(
  () => form.hospital_id,
  () => {
    fetchDoctors(form.hospital_id, doctorData)
  }
)
watch(
  () => formEdit.hospital_id,
  () => {
    fetchDoctors(formEdit.hospital_id, doctorEditData)
  }
)
</script>

<template>
  <div>
    <div class="appointment">
      <h1>Appointment</h1>
    </div>
    <div class="mt-2 p-1">
      <el-button plain @click="dialogTableVisible = true">
        <el-icon><CirclePlus /></el-icon>
        Make Appointment
      </el-button>
    </div>

    <!--    Edit Appointment Form-->

    <el-dialog v-model="dialogEditVisible" title="Edit appointment" width="800">
      <el-form :model="formEdit" label-position="top" label-width="auto" style="max-width: 800px">
        <el-input type="hidden" v-model="formEdit.user_id" />
        <el-input type="hidden" v-model="formEdit.id" />
        <el-form-item>
          <el-col :span="11">
            <el-form-item label="First name">
              <el-input v-model="formEdit.first_name" />
            </el-form-item>
          </el-col>
          <el-col :span="2" class="text-center">
            <span class="text-gray-500">-</span>
          </el-col>
          <el-col :span="11">
            <el-form-item label="Last name">
              <el-input v-model="formEdit.last_name" />
            </el-form-item>
          </el-col>
        </el-form-item>
        <el-form-item label="Appointment Title">
          <el-input v-model="formEdit.title" />
        </el-form-item>
        <el-form-item label="Select a hospital">
          <el-select v-model="formEdit.hospital_id" placeholder="Select Hospital">
            <el-option
              v-for="item in hospital"
              :key="item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </el-form-item>
        <el-form-item label="Select a Doctor">
          <el-select v-model="formEdit.doctor_id" placeholder="Select Doctor">
            <el-option
              v-for="item in doctorEditData"
              :key="item.id"
              :label="item.first_name + ' ' + item.last_name"
              :value="item.id"
            />
          </el-select>
        </el-form-item>
        <el-form-item label="Activity time">
          <el-col :span="11">
            <el-date-picker
              v-model="formEdit.date1"
              type="date"
              placeholder="Pick a date"
              format="YYYY/MM/DD"
              value-format="YYYY-MM-DD"
              style="width: 100%"
            />
          </el-col>
          <el-col :span="2" class="text-center">
            <span class="text-gray-500">-</span>
          </el-col>
          <el-col :span="11">
            <el-time-picker
              v-model="formEdit.date2"
              placeholder="Pick a time"
              style="width: 100%"
              value-format="HH:mm"
            />
          </el-col>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onUpdate">Update</el-button>
          <el-button>Cancel</el-button>
        </el-form-item>
      </el-form>
    </el-dialog>

    <!--Make Appointment Form-->

    <el-dialog v-model="dialogTableVisible" title="Make an appointment" width="800">
      <el-form :model="form" label-position="top" label-width="auto" style="max-width: 800px">
        <el-input hidden v-model="form.user_id" />
        <el-form-item>
          <el-col :span="11">
            <el-form-item label="First name">
              <el-input v-model="form.first_name" />
            </el-form-item>
          </el-col>
          <el-col :span="2" class="text-center">
            <span class="text-gray-500">-</span>
          </el-col>
          <el-col :span="11">
            <el-form-item label="Last name">
              <el-input v-model="form.last_name" />
            </el-form-item>
          </el-col>
        </el-form-item>
        <el-form-item label="Appointment Title">
          <el-input v-model="form.title" />
        </el-form-item>
        <el-form-item label="Select a hospital">
          <el-select v-model="form.hospital_id" placeholder="Please select a hospital">
            <el-option
              v-for="item in hospital"
              :key="item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </el-form-item>
        <el-form-item label="Select a Doctor">
          <el-select v-model="form.doctor_id" placeholder="Please select a doctor">
            <el-option
              v-for="item in doctorData"
              :key="item.id"
              :label="item.first_name + ' ' + item.last_name"
              :value="item.id"
            />
          </el-select>
        </el-form-item>
        <el-form-item label="Activity time">
          <el-col :span="11">
            <el-date-picker
              v-model="form.date1"
              type="date"
              placeholder="Pick a date"
              format="YYYY/MM/DD"
              value-format="YYYY-MM-DD"
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
              value-format="HH:mm"
            />
          </el-col>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSubmit">Create</el-button>
          <el-button>Cancel</el-button>
        </el-form-item>
      </el-form>
    </el-dialog>
    <el-table :data="appointment.appointments" height="450" style="width: 100%" class="mt-3">
      <el-table-column prop="user.name" label="Name" width="180" class="heading" />
      <el-table-column prop="hospital" label="Hospital" width="180" />
      <el-table-column prop="appointment_date" label="Date" />
      <el-table-column prop="status" label="Status">
        <template #default="scope">
          <el-tag v-if="scope.row.status == 'Canceled'" type="primary">{{
            scope.row.status
          }}</el-tag>
          <el-tag v-if="scope.row.status == 'Confirmed'" type="success">{{
            scope.row.status
          }}</el-tag>
          <el-tag v-if="scope.row.status == 'Pending'" type="info">{{ scope.row.status }}</el-tag>
          <el-tag v-if="scope.row.status == 'Missing'" type="warning">{{
            scope.row.status
          }}</el-tag>
          <el-tag v-if="scope.row.status == 'Rejected'" type="danger">{{
            scope.row.status
          }}</el-tag>
        </template>
      </el-table-column>
      <el-table-column label="Action">
        <template #default="scope">
          <el-button plain @click="openEditDialog(scope.row)">
            <el-icon>
              <EditPen />
            </el-icon>
          </el-button>
          <el-button plain @click="openDialog(scope.row)">
            <el-icon>
              <View />
            </el-icon>
          </el-button>
          <el-button plain @click="cancelAppointment(scope.row)">
            <el-icon>
              <Close />
            </el-icon>
          </el-button>
          <el-button plain @click="deleteAppointment(scope.row)">
            <el-icon>
              <Delete />
            </el-icon>
          </el-button>
        </template>
      </el-table-column>
    </el-table>
    <el-dialog v-model="visible" :show-close="false" width="500">
      <div class="card-body">
        <p><b>Name:</b> {{ currentAppointment.user.name }}</p>
        <p><b>Doctor:</b> {{ currentAppointment.doctor.name }}</p>
        <p><b>Hospital:</b> {{ currentAppointment.hospital }}</p>
        <p><b>Phone Number:</b> {{ currentAppointment.user.phone_number }}</p>
        <p><b>Date:</b> {{ currentAppointment.appointment_date }}</p>
        <p><b>Time:</b> {{ currentAppointment.appointment_time }}</p>
        <p><b>Room No:</b> {{ currentAppointment.room.name }}</p>
        <p><b>Status:</b> {{ currentAppointment.status }}</p>
        <p><b>Gender:</b> {{ currentAppointment.user.gender }}</p>
      </div>
      <template #header="{ titleId, titleClass }">
        <div class="my-header">
          <h2 :id="titleId" :class="titleClass">Appointment Details</h2>
        </div>
      </template>
      <div class="buttonClose">
        <el-button type="danger" @click="closeDialog"> Close </el-button>
      </div>
    </el-dialog>
  </div>
</template>
<style scoped>
.appointment {
  height: 8vh;
  background: #32b4e3;
  color: white;
  text-align: center;
}
.my-header {
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #32b4e3;
  height: 5vh;
  border-radius: 5px;
}
.my-header h2 {
  text-align: center;
  color: white;
}

.el-dialog {
  background: #32b4e3;
}
.buttonClose .el-button {
  margin-left: 400px;
  background: orange;
}
</style>
