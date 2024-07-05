<script setup lang="ts">
import { onMounted, ref } from 'vue';
import WebLayout from '@/Components/Layouts/WebLayout.vue';
import axiosInstance from '@/plugins/axios';


const doctors=ref([]);
const dialogTableVisible = ref(false);
const formData = ref({
  name: '',
  email: '',
  phone: ''
});

async function fetchDoctors(){
  try {
    const {data}=await axiosInstance.get('/doctors/list')
    data.data.forEach((doc)=>{
      doctors.value.push(doc)
    })
  }catch (e) {
    console.error(e);
  }
}
const handleSubmit = () => {
  // Handle form submission logic here (e.g., API call, validation, etc.)
  console.log('Form submitted', formData.value);
  // Close the dialog after successful submission
  dialogTableVisible.value = false;
};
onMounted(()=>{
  fetchDoctors()
})
</script>

<template>
  <WebLayout>
      <el-button style="margin-bottom:20px;" plain @click="dialogTableVisible = true">Add Doctor</el-button>

      <el-dialog v-model="dialogTableVisible" title="Add New Doctor" width="800">
        <el-form :model="formData" label-position="top" label-width="120px">
          <el-form-item label="Name">
            <el-input v-model="formData.name" /> 
          </el-form-item>
          <el-form-item label="Email">
            <el-input v-model="formData.email" />
          </el-form-item>
          <el-form-item label="Phone Number">
            <el-input v-model="formData.phone" />
          </el-form-item>
        </el-form>
        <el-button type="primary" @click="handleSubmit">Create</el-button>
      </el-dialog>
      <!-- Your existing doctor card -->
      <el-container>
        <el-card v-for="(doctor,index) in doctors" :key="index" style="width: 300px" shadow="hover" class="d-flex flex-column align-items-center members-card">
          <div class="rounded-50% d-flex justify-content-center">
            <el-avatar v-if="doctor.profile!=='No profile'" shape="square" :size="250" :src="doctor.profile" />
            <el-avatar v-if="doctor.profile=='No profile'" shape="square" :size="250" src="https://cube.elemecdn.com/9/c2/f0ee8a3c7c9638a54940382568c9dpng.png" />
          </div>
          <el-row class="d-flex justify-content-center mt-4">
            <h3 class="text-#FCB22D text-center">{{doctor.first_name}} {{doctor.last_name }}</h3>
          </el-row>
          <el-row class="d-flex justify-content-center mt-2">
            <span class="font-bold role-team"> {{doctor.email}}</span>
          </el-row>
          <el-row class="d-flex justify-content-center mt-2">
            <span>{{doctor.phone}}</span>
          </el-row>
          <div class="button">
            <el-button>Edit</el-button>
            <el-button type="danger" plain>Delete</el-button>
          </div>
        </el-card>
      </el-container>
  </WebLayout>
</template>

<style scoped>
.button {
  margin-top: 10px;
  display: flex;
  flex-direction: row;
  gap: 85px;
}
</style>
