<template>
  <WebLayout>
    <div>
      <div class="appointment">
        <h1>Customers' Appointment</h1>
      </div>
      <el-table v-if="showTable" :data="tableData" height="450" style="width: 100%" class="mt-3">
        <!-- Profile Column -->
        <el-table-column label="Profile" width="120">
          <template #default="scope">
            <img :src="scope.row.profile" alt="Profile Image" style="width: 50px; height: 50px; border-radius: 50%;"
                 @click="showDetails(scope.row)">
          </template>
        </el-table-column>

        <!-- Name Column -->
        <el-table-column prop="name" label="Name" width="180" />

        <!-- Date Column -->
        <el-table-column prop="date" label="Date" />

        <!-- Age Column -->
        <el-table-column prop="age" label="Age" />
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
        <!-- Tag Column -->
        <el-table-column label="Action">
          <template #default="scope">
            <el-popover placement="right" :width="700" trigger="click">
              <div class="card-header">
                <h3>Appointment Details</h3>
              </div>
              <div class="card-body">
                <div class="profile-container">
                  <img :src="scope.row.profile" alt="Profile Image" class="detail-image">
                </div>
                <p><b>Name:</b> {{ scope.row.name }}</p>
                <p><b>Doctor:</b> {{ scope.row.doctor }}</p>
                <p><b>Department:</b> {{ scope.row.department }}</p>
                <p><b>Phone Number:</b> {{ scope.row.phone_number }}</p>
                <p><b>Date:</b> {{ scope.row.date }}</p>
                <p><b>Time:</b> {{ scope.row.time }}</p>
                <p><b>Age:</b> {{ scope.row.age }}</p>
                <p><b>Gender:</b> {{ scope.row.sex }}</p>
              </div>
              <template #reference>
                <el-button size="small">Details</el-button>
              </template>
            </el-popover>
          </template>
        </el-table-column>
      </el-table>
    </div>
  </WebLayout>
</template>

<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import { onMounted } from 'vue'

const showTable = true
const tableData = [
  {
    profile: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRXJA32WU4rBpx7maglqeEtt3ot1tPIRWptxA&s',
    name: 'Rith Sreynang',
    doctor: 'phal him',
    department: 'Health centre',
    phone_number: '012023334',
    date: '2016-05-02',
    time: '12:08:30',
    age: '29',
    sex: 'Male',
    status: 'Confirmed'
  },
  {
    profile: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRXJA32WU4rBpx7maglqeEtt3ot1tPIRWptxA&s',
    name: 'Radit THY',
    doctor: 'phal him',
    department: 'Health centre',
    phone_number: '012023334',
    date: '2016-05-02',
    time: '12:08:30',
    age: '29',
    sex: 'Male',
    status: 'Pending'
  },
  {
    profile: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRXJA32WU4rBpx7maglqeEtt3ot1tPIRWptxA&s',
    name: 'Radit THY',
    doctor: 'phal him',
    department: 'Health centre',
    phone_number: '012023334',
    date: '2016-05-02',
    time: '12:08:30',
    age: '29',
    sex: 'Male',
    status: 'Denied'
  }
]

// Function to show details popover
function showDetails(row: any) {
  // Implement your logic to show details here
  console.log('Showing details for:', row)
}

onMounted(() => {
  // Function to close popover
  function closePopover() {
    $refs.popover.hide()
  }
})
interface User {
  date: string
  name: string
  address: string
  status: string
}
const filterTag = (value: string, row: User) => {
  return row.status === value
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
