<script setup lang="ts">
import { onMounted, ref } from 'vue';
import WebLayout from '@/Components/Layouts/WebLayout.vue';
import axiosInstance from '@/plugins/axios';

const doctors = ref([]);
const dialogTableVisible = ref(false);
const editDialogVisible = ref(false);
const formData = ref({
  id: null,
  first_name: '',
  last_name: '',
  name: '',
  email: '',
  phone: ''
});
const isEditing = ref(false);

async function fetchDoctors() {
  try {
    const { data } = await axiosInstance.get('/doctors/list');
    doctors.value = data.data;
    console.log(data.data);
    
  } catch (e) {
    console.error(e);
  }
}

const handleSubmit = async () => {
  const doctorData = {
    name: formData.value.name,
    email: formData.value.email,
    phone: formData.value.phone
  };

  try {
    if (isEditing.value) {
      const { data } = await axiosInstance.put(`/doctors/update/${formData.value.id}`, doctorData);
      const index = doctors.value.findIndex(doctor => doctor.id === formData.value.id);
      doctors.value[index] = data.data;
    } else {
      const { data } = await axiosInstance.post('/doctors/create', doctorData);
      doctors.value.push(data.data);
    }
    dialogTableVisible.value = false;
    editDialogVisible.value = false;
  } catch (e) {
    console.error(e);
  }
};

const editDoctor = (doctor) => {
  formData.value = { ...doctor };
  isEditing.value = true;
  editDialogVisible.value = true;
};

const deleteDoctor = async (doctorId) => {
  try {
    await axiosInstance.delete(`/doctors/delete/${doctorId}`);
    doctors.value = doctors.value.filter(doctor => doctor.id !== doctorId);
  } catch (e) {
    console.error(e);
  }
};

onMounted(() => {
  fetchDoctors();
});
</script>

<template>
  <WebLayout>
      <el-button style="margin-bottom:20px;" plain @click="dialogTableVisible = true">Add Doctor</el-button>

      <el-dialog v-model="dialogTableVisible" title="Add New Doctor" width="800">
        <el-form :model="formData" label-position="top" label-width="120px">
          <div class="flex">
            <el-col :span="11">
              <el-form-item label="First name">
                <el-input v-model="formData.first_name" style="width: 100%"/>
              </el-form-item>
            </el-col>
            <el-col :span="2" class="text-center">
              <span class="text-gray-500">-</span>
            </el-col>
            <el-col :span="11">
              <el-form-item label="Last name">
                <el-input v-model="formData.last_name" style="width: 100%"/>
              </el-form-item>
            </el-col>
          </div>
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
      <el-dialog v-model="editDialogVisible" title="Edit Doctor" width="800">
      <el-form :model="formData" label-position="top" label-width="120px">
        <div class="flex">
          <el-col :span="11">
            <el-form-item label="First name">
              <el-input v-model="formData.first_name" style="width: 100%"/>
            </el-form-item>
          </el-col>
          <el-col :span="2" class="text-center">
            <span class="text-gray-500">-</span>
          </el-col>
          <el-col :span="11">
            <el-form-item label="Last name">
              <el-input v-model="formData.last_name" style="width: 100%"/>
            </el-form-item>
          </el-col>
        </div>
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
        <el-button type="primary" @click="handleSubmit">Update</el-button>
    </el-dialog>
      <!-- Your existing doctor card -->
      <el-container>
        <el-card v-for="(doctor,index) in doctors" :key="index" style="width: 300px" shadow="hover" class="d-flex flex-column align-items-center members-card">
          <div class="rounded-50% d-flex justify-content-center">
            <el-avatar v-if="doctor.profile!=='No profile'" shape="square" :size="250" :src="doctor.profile" />
            <el-avatar v-else shape="square" :size="250" src="https://cube.elemecdn.com/9/c2/f0ee8a3c7c9638a54940382568c9dpng.png" />
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
            <el-button @click="editDoctor(doctor)">Edit</el-button>
            <el-button type="danger" plain @click="() => deleteDoctor(doctor.id)">Delete</el-button>
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

.members-card {
  margin-right: 20px; /* Space between each card */
}
</style>
