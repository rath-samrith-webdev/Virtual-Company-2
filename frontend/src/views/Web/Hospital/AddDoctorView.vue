<script setup lang="ts">
import { onMounted, ref } from 'vue'
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import NoHospitalSet from '@/Components/Hospitals/NoHospitalSet.vue'
import axiosInstance from '@/plugins/axios'
import { useAuthStore } from '@/stores/auth-store'
const store = useAuthStore()
const doctors = ref([])
const dialogTableVisible = ref(false)
const editDialogVisible = ref(false)
const userStore = useAuthStore()
const formData = ref({
  id: null,
  first_name: '',
  last_name: '',
  name: '',
  gender: '',
  email: '',
  password: '',
  phone: ''
})
const isEditing = ref(false)

async function fetchDoctors() {
  try {
    const { data } = await axiosInstance.get('/doctors/list')
    doctors.value = data.data
    console.log(data.data)
  } catch (e) {
    console.error(e)
  }
}

const handleSubmit = async () => {
  const doctorData = new FormData()
  doctorData.append('first_name', formData.value.first_name)
  doctorData.append('last_name', formData.value.last_name)
  doctorData.append('name', formData.value.name)
  doctorData.append('gender', formData.value.gender)
  doctorData.append('email', formData.value.email)
  doctorData.append('password', formData.value.password)
  doctorData.append('phone', formData.value.phone)
  doctorData.append('hospital_id', userStore.hospital.id) // Assuming hospital_id is a prop in the user store
  console.log(doctorData)
  console.log(formData)

  try {
    if (isEditing.value) {
      const { data } = await axiosInstance.put(`/doctors/update/${formData.value.id}`, doctorData)
      const index = doctors.value.findIndex((doctor) => doctor.id === formData.value.id)
      doctors.value[index] = data.data
    } else {
      const { data } = await axiosInstance.post('/doctors/create', doctorData)
      doctors.value.push(data.data)
    }
    dialogTableVisible.value = false
    editDialogVisible.value = false
  } catch (e) {
    console.error(e)
  }
}
const editDoctor = (doctor) => {
  formData.value = { ...doctor } // Copies all properties of the selected doctor to formData
  isEditing.value = true // Sets editing mode to true
  editDialogVisible.value = true // Shows the edit dialog
}

const deleteDoctor = async (doctorId) => {
  try {
    await axiosInstance.delete(`/doctors/delete/${doctorId}`)
    doctors.value = doctors.value.filter((doctor) => doctor.id !== doctorId)
  } catch (e) {
    console.error(e)
  }
}

onMounted(() => {
  if (userStore.hospital != 'No hospital') {
    fetchDoctors()
  }
})
</script>

<template>
  <WebLayout v-if="store.hospital != 'No hospital'">
    <button
      style="
        border: none;
        padding: 10px;
        margin-left: 20px;
        margin-bottom: 20px;
        background: #32b4e3;
        color: white;
        font-weight: bold;
        border-radius: 10px;
      "
      plain
      @click="dialogTableVisible = true"
    >
      Add Doctor
    </button>

    <!-- ============form for add new doctor============= -->
    <el-dialog
      v-model="dialogTableVisible"
      title="Add New Doctor"
      width="800"
      style="padding: 60px"
    >
      <el-form :model="formData" label-position="top" label-width="120px">
        <div class="flex">
          <el-col :span="11">
            <el-form-item label="First name">
              <el-input v-model="formData.first_name" style="width: 100%" />
            </el-form-item>
          </el-col>
          <el-col :span="2" class="text-center">
            <span class="text-gray-500">-</span>
          </el-col>
          <el-col :span="11">
            <el-form-item label="Last name">
              <el-input v-model="formData.last_name" style="width: 100%" />
            </el-form-item>
          </el-col>
        </div>
        <el-form-item label="Name">
          <el-input v-model="formData.name" />
        </el-form-item>
        <el-form-item label="Gender">
          <el-select v-model="formData.gender" placeholder="Select Gender">
            <el-option label="Male" value="Male"></el-option>
            <el-option label="Female" value="Female"></el-option>
            <el-option label="Other" value="Other"></el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="Email">
          <el-input v-model="formData.email" />
        </el-form-item>
        <el-form-item label="Password">
          <el-input v-model="formData.password" />
        </el-form-item>
        <el-form-item label="Phone Number">
          <el-input v-model="formData.phone" />
        </el-form-item>
      </el-form>
      <button
        style="
          border: none;
          padding: 10px;
          margin-left: 40%;
          background: #32b4e3;
          color: white;
          font-weight: bold;
          border-radius: 10px;
        "
        @click="handleSubmit"
      >
        Add New Doctor
      </button>
    </el-dialog>

    <!-- ==========form for edit card doctor=========== -->

    <el-dialog
      v-model="editDialogVisible"
      title="Update information of Doctor"
      style="padding: 60px"
    >
      <el-form :model="formData" label-position="top" label-width="120px">
        <div class="flex">
          <el-col :span="11">
            <el-form-item label="First name">
              <el-input v-model="formData.first_name" style="width: 100%" />
            </el-form-item>
          </el-col>
          <el-col :span="2" class="text-center">
            <span class="text-gray-500">-</span>
          </el-col>
          <el-col :span="11">
            <el-form-item label="Last name">
              <el-input v-model="formData.last_name" style="width: 100%" />
            </el-form-item>
          </el-col>
        </div>
        <el-form-item label="Name">
          <el-input v-model="formData.name" />
        </el-form-item>
        <el-form-item label="Gender">
          <el-select v-model="formData.gender" placeholder="Select Gender">
            <el-option label="Male" value="Male"></el-option>
            <el-option label="Female" value="Female"></el-option>
            <el-option label="Other" value="Other"></el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="Email">
          <el-input v-model="formData.email" />
        </el-form-item>
        <el-form-item label="Password">
          <el-input v-model="formData.password" />
        </el-form-item>
        <el-form-item label="Phone Number">
          <el-input v-model="formData.phone" />
        </el-form-item>
      </el-form>
      <button
        style="
          border: none;
          padding: 10px;
          margin-left: 45%;
          background: #32b4e3;
          color: white;
          font-weight: bold;
          border-radius: 10px;
        "
        @click="handleSubmit"
      >
        Update
      </button>
    </el-dialog>

    <!-- =============list of Card doctor================== -->
    <el-row :gutter="20">
      <el-col :span="6" v-for="(doctor, index) in doctors" :key="index">
        <el-card style="width: 300px" shadow="hover" class="d-flex flex-column members-card m-4">
          <div>
            <img
              v-if="doctor.profile !== 'No profile'"
              shape="square"
              :size="280"
              :src="doctor.profile"
            />
            <el-avatar
              v-else
              shape="square"
              style="margin-left: 5px"
              :size="245"
              src="https://cube.elemecdn.com/9/c2/f0ee8a3c7c9638a54940382568c9dpng.png"
            />
          </div>
          <el-row class="d-flex justify-content-center mb-3 mt-3 h4">
            <span class="font-bold text-center ">{{ doctor.name }}</span>
          </el-row>
          <el-row class="d-flex justify-content-center mt-1">
            <span class="font-bold role-team"> {{ doctor.email }}</span>
          </el-row>
          <el-row class="d-flex justify-content-center mt-1">
            <span>{{ doctor.phone }}</span>
          </el-row>
          <div class="button">
            <button
              style="
                border: none;
                margin-left: 5%;
                padding: 8px;
                background: #32b4e3;
                color: white;
                font-weight: bold;
                border-radius: 10px;
              "
              @click="editDoctor(doctor)"
            >
              Update
            </button>
            <button
              style="
                border: none;
                padding: 8px;
                background: orange;
                color: white;
                font-weight: bold;
                border-radius: 10px;
              "
              plain
              @click="() => deleteDoctor(doctor.id)"
            >
              Remove
            </button>
          </div>
        </el-card>
      </el-col>
    </el-row>
  </WebLayout>
  <WebLayout v-else>
    <NoHospitalSet />
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
  margin-right: 20px;
  /* Space between each card */
}
.members-card {
  border: 5px solid #32b4e3;
  border-radius: 60px 0px 60px 0px;
}
img {
  width: 100%;
  height: 37vh;
  border-radius: 45px 0px 0px 0px;
}
</style>
