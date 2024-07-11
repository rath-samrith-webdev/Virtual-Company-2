<template>
  <WebLayout v-if="userStore.hospital!='No hospital'">
    <div>
      <div class="appointment">
        <h1>Customers' Appointment</h1>
      </div>
      <el-table v-if="showTable" :data="store.appointments" height="450" style="width: 100%" class="mt-3">
        <!-- Profile Column -->
        <el-table-column label="Profile" width="120">
          <template #default="scope">
            <el-avatar :src="scope.row.user.profile"></el-avatar>
          </template>
        </el-table-column>

        <!-- Name Column -->
        <el-table-column label="Name" width="180">
          <template #default="scope">
            <strong>{{ scope.row.user.first_name }} {{ scope.row.user.last_name }}</strong>
          </template>
        </el-table-column>

        <!-- Date Column -->
        <el-table-column prop="appointment_date" label="Date" />

        <!-- Age Column -->
        <el-table-column prop="hospital" label="Hospital" />
        <!--Status Column-->
        <el-table-column prop="status" label="Status" :filters="[
        { text: 'Confirmed', value: 'Confirmed' },
        { text: 'Pending', value: 'Pending' },
        { text: 'Denied', value: 'Denied' },
      ]" :filter-method="filterTag" filter-placement="bottom-end">
          <template #default="scope">
            <el-tag
              :type="scope.row.status === 'Confirmed' ? 'success' : 'Pending' ? 'warning' : 'danger'"
              disable-transitions
            >{{ scope.row.status }}
            </el-tag>
          </template>
        </el-table-column>
        <el-table-column prop="hospital_status" label="Hospital Confirmation" :filters="[
        { text: 'Confirmed', value: 'Confirmed' },
        { text: 'Pending', value: 'Pending' },
        { text: 'Denied', value: 'Denied' },
      ]" :filter-method="filterTag" filter-placement="bottom-end">
          <template #default="scope">
            <el-tag
              :type="scope.row.hospital_status === 'Confirmed' ? 'success' : 'Pending' ? 'warning' : 'danger'"
              disable-transitions
            >{{ scope.row.hospital_status }}
            </el-tag>
          </template>
        </el-table-column>
        <!-- Tag Column -->
        <el-table-column label="Action">
          <template #default="scope">
            <el-button plain @click="showDetails(scope.row)">
              Details
            </el-button>
            <el-dialog v-model="outerVisible" title="Appointment Details" width="600">
              <p><b>Name:</b> {{ currentAppointment.user.first_name }}</p>
              <p><b>Doctor:</b> {{ currentAppointment.doctor.first_name }}</p>
              <p><b>Hospital:</b> {{ currentAppointment.hospital }}</p>
              <p><b>Phone Number:</b> {{ currentAppointment.user.phone_number }}</p>
              <p><b>Date:</b> {{ currentAppointment.appointment_date }}</p>
              <p><b>Time:</b> {{ currentAppointment.appointment_time }}</p>
              <p><b>Room No:</b></p>
              <p><b>Status:</b> {{ currentAppointment.status }}</p>
              <p><b>Gender:</b> {{ currentAppointment.user.gender }}</p>
              <el-dialog
                v-model="innerVisible"
                width="300"
                title="Confirm Appointment"
                append-to-body>
                <span>This is the inner Dialog</span>
                <div class="el-dialog__footer">
                  <el-button @click="innerVisible = false">Cancel</el-button>
                  <el-button type="primary" @click="ConfirmAppointment(scope.row.id)">
                    Confirm
                  </el-button>
                </div>
              </el-dialog>
              <template #footer>
                <div class="dialog-footer">
                  <el-button @click="outerVisible = false">Cancel</el-button>
                  <el-button type="primary" @click="innerVisible = true">
                    Confirm Appointment
                  </el-button>
                </div>
              </template>
            </el-dialog>
          </template>
        </el-table-column>
      </el-table>
    </div>
  </WebLayout>
  <WebLayout v-else>
    <h4>You have no hospital</h4>
  </WebLayout>
</template>
<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import { onMounted, ref, watch } from 'vue'
import { hospitalAppointmentListStore } from '@/stores/hospital-appointment-list'
import { ElNotification } from 'element-plus'
import { useAuthStore } from '@/stores/auth-store'

const userStore = useAuthStore()
const store = hospitalAppointmentListStore()
const showTable = true
const outerVisible = ref(false)
const innerVisible = ref(false)
let currentAppointment = {}
// Function to show details popover
const ConfirmAppointment = (id: any) => {
  innerVisible.value = false
  store.confirmAppointment(id)
}
const fetchAppointments = () => {
  store.fetchAppointments()
}
const open2 = (title: string, message: any, type: string) => {
  ElNotification({
    title: title,
    message: message,
    type: type
  })
}
watch(() => store.message, () => {
  if (store.message.success) {
    open2('Appointment Confirmed', store.message.message, 'success')
  } else {
    open2('Appointment Confirmed', store.message.message, 'success')
  }
})
onMounted(() => {
  if (userStore.hospital != 'No hospital') {
    fetchAppointments()
  }
})

interface User {
  status: string
}

const filterTag = (value: string, row: User) => {
  return row.status === value
}
const showDetails = (row) => {
  outerVisible.value = true
  currentAppointment = row
}
</script>

<style scoped>
.appointment {
  height: 8vh;
  background: #32b4e3;
  color: white;
  text-align: center;
}

.mt-3 {
  margin-top: 1rem;
}

.detail-card {
  width: 400px;
}

.card-header {
  font-weight: bold;
  text-align: center;
  background-color: #32b4e3;
  color: white;
  padding: 10px;
}

.card-body {
  padding: 16px;
  line-height: 1.6;
}

.profile-container {
  display: flex;
  justify-content: center;
  margin-bottom: 16px;
}

.detail-image {
  width: 100px;
  height: 100px;
  border-radius: 50%;
}

.card-body p {
  text-align: left;
  margin: 0;
}
</style>
