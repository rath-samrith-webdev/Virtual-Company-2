<script setup lang="ts">
const showTable= true
const tableData = [
  {
    name: 'Rith Sreynang',
    doctor: 'phal him',
    department: 'Health centre',
    phone_number: '012023334',
    date: '2016-05-02',
    time: '12:08:30',
    age: '29',
    sex: 'Male'
  },
  {
    name: 'Radit THY',
    doctor: 'phal him',
    department: 'Health centre',
    phone_number: '012023334',
    date: '2016-05-02',
    time: '12:08:30',
    age: '29',
    sex: 'Male'
  },
  {
    name: 'Radit THY',
    doctor: 'phal him',
    department: 'Health centre',
    phone_number: '012023334',
    date: '2016-05-02',
    time: '12:08:30',
    age: '29',
    sex: 'Male'
  }
]

function closePopover() {
  $refs.popover.hide()
}
</script>
<template>
  <div>
    <div class="appointment">
      <h1>My Appointments</h1>
    </div>
    <el-table v-if="showTable" :data="tableData" height="450" style="width: 100%" class="mt-3">
      <el-table-column prop="name" label="Name" width="180" />
      <el-table-column prop="date" label="Date" />
      <el-table-column prop="age" label="Age" />
      <el-table-column label="Action">
        <template #default="scope">
          <el-popover placement="right" :width="700" trigger="click">
            <div class="card-header">
              <h3>Appointment Details</h3>
            </div>
            <div class="card-body">
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
</template>
<style scoped>
.appointment {
  height: 8vh;
  background: #32B4E3;
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
  background-color: #32B4E3;
  color: white;
  padding: 10px;
}

.card-body {
  padding: 16px;
  line-height: 1.6;
}
</style>
  