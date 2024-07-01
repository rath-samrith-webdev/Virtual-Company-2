<template>
  <div>
    <div class="appointment">
      <h1>Appointment</h1>
    </div>
    <el-table v-if="showTable" :data="tableData" height="450" style="width: 100%" class="mt-3">
      <el-table-column prop="name" label="Name" width="180" />
      <el-table-column prop="date" label="Date" />
      <el-table-column prop="age" label="Age" />

      <el-table-column label="Tag">
        <template #default="scope">
          <el-button plain @click="openDialog(scope.row)">
            Details
          </el-button>
        </template>
      </el-table-column>
    </el-table>
    <el-dialog v-model="visible" :show-close="false" width="500">
      <div class="card-body">
        <p><b>Name:</b> {{ currentAppointment.name }}</p>
        <p><b>Doctor:</b> {{ currentAppointment.doctor }}</p>
        <p><b>Department:</b> {{ currentAppointment.department }}</p>
        <p><b>Phone Number:</b> {{ currentAppointment.phone_number }}</p>
        <p><b>Date:</b> {{ currentAppointment.date }}</p>
        <p><b>Time:</b> {{ currentAppointment.time }}</p>
        <p><b>Age:</b> {{ currentAppointment.age }}</p>
        <p><b>Gender:</b> {{ currentAppointment.sex }}</p>
      </div>
      <template #header="{ close, titleId, titleClass }">
        <div class="my-header">
          <h2 :id="titleId" :class="titleClass">
            Appointment Details
          </h2>
        </div>
      </template>
      <div class="buttonClose">
         <el-button type="danger" @click="closeDialog">
            Close
        </el-button>
      </div>
       
    </el-dialog>
  </div>
</template>

<script>
export default {
  name: 'AppointmentTable',
  data() {
    return {
      showTable: true,
      visible: false,
      currentAppointment: {},
      tableData: [
        {
          name: 'Rith Sreynang',
          doctor: 'phal him',
          department: 'Health centre',
          phone_number: '012023334',
          date: '2016-05-02',
          time: '12:08:30',
          age: '29',
          sex: 'Male',
        },
        {
          name: 'Radit THY',
          doctor: 'phal him',
          department: 'Health centre',
          phone_number: '012023334',
          date: '2016-05-02',
          time: '12:08:30',
          age: '29',
          sex: 'Male',
        },
        {
          name: 'Radit THY',
          doctor: 'phal him',
          department: 'Health centre',
          phone_number: '012023334',
          date: '2016-05-02',
          time: '12:08:30',
          age: '29',
          sex: 'Male',
        },
      ],
    };
  },
  methods: {
    openDialog(row) {
      this.currentAppointment = row;
      this.visible = true;
    },
    closeDialog() {
      this.visible = false;
    },
  },
};
</script>

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
.buttonClose{
  margin-left: 400px;
}
</style>
