<template>
  <div>
    <div class="appointment">
      <h1>Appointment</h1>
    </div>
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
            cancel
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
      <div class="buttonClose">
         <el-button type="danger" @click="closeDialog">
            Close
        </el-button>
      </div>
    </el-dialog>
  </div>
</template>
<script>
import axiosInstance from '@/plugins/axios';

export default {
  name: 'AppointmentTable',
  data() {
    return {
      showTable: true,
      visible: false,
      currentAppointment: {},
      tableData: []
    };
  },
  methods: {
    async fetchData() {
      try {
        const { data } = await axiosInstance.get('/appointments/list');
        console.log(data);
        this.tableData = data.data;
      } catch (error) {
        console.log(error);
      }
    },
    openDialog(row) {
      this.currentAppointment = row;
      this.visible = true;
    },
    closeDialog() {
      this.visible = false;
    }
  },
  mounted() {
    this.fetchData();
  }
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
