<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import { Calendar, UploadFilled } from '@element-plus/icons-vue'
import AboutTabs from '@/Components/Hospital/AboutTabs.vue'
import ServiceTab from '@/Components/Hospital/ServiceTab.vue'
import CardDepartment from '@/Components/Hospital/CardDepartment.vue'
import { onMounted, ref } from 'vue'
import type { UploadProps } from 'element-plus'
import axiosInstance from '@/plugins/axios'
import {useDoctorStore} from '@/stores/doctor-store'
import {hospitalDetailStore} from "@/stores/hospital-detail";
import {useAuthStore} from "@/stores/auth-store";
const visible=ref(false)
const store=useDoctorStore()
const details = hospitalDetailStore()
const userStore = useAuthStore()

const newDep=ref({
  name:'',
  details:'',
  image:'null'
})
const isEdit=ref(false)
const updateDepartment=(id:number)=>{
  console.log('updateDepartment ', id)
}
const removeDepartment = async (id:number)=>{
  try{
    const {data}=await axiosInstance.get(`/departments/delete/${id}`)
    console.log(data)
  }catch(e){
    console.error(e)
  }
}
const removeService=(id:number)=>{
  console.log('remove serve ',id)
}
const updateService = (id:number)=>{
  console.log('updateService ', id)
}
const handlePictureCardPreview: UploadProps['onPreview'] = (uploadFile) => {
  newDep.value.image=uploadFile.raw;
  console.log(uploadFile.raw)
}
const addDepartment= async()=>{
  console.log(newDep.value)
  try {
    const newDepartment = newDep.value
    const {data}=await axiosInstance.post('/departments/create',newDepartment)
    console.log(data)
  }catch(error){
    console.log(error)
  }
}
let formData = ref({})
const fetchDetail = () => {
  details.fetchHospitalDetail(userStore.hospital.id)
  formData.value = details.hospitalDetail
}
const previewImage = ref('')
const selectFile = () => {
  document.getElementById('hospital-cover').click()
}
const getFile = async () => {
  let file = document.getElementById('hospital-cover').files[0]
  try {
    const { data } = await axiosInstance.post('/hospitals/uploadCover', {
      image: file,
      hospital_id: userStore.hospital.id
    })
    console.log(data)
  } catch (err) {
    console.log(err)
  }
  fetchDetail()
}
onMounted(()=>{
  store.fetchDoctors()
  fetchDetail()
})
</script>
<template>
  <WebLayout>
    <el-tabs type="border-card" stretch class="demo-tabs">
      <el-tab-pane>
        <template #label>
        <span class="custom-tabs-label " >
          <span class="fw-bold ">Information</span>
        </span>
        </template>
        <div style="height: 500px">
          <el-avatar
              @click="selectFile"
              shape="square"
              style="width: 100%; height: 100%"
              :fit="'cover'"
              :src="details.hospitalDetail.cover_image"
              v-if="details.hospitalDetail.cover_image !== 'No Cover'"
          />
          <el-avatar
              v-else
              @click="selectFile"
              shape="square"
              style="width: 100%; height: 100%"
              :fit="'cover'"
              :src="previewImage"
          >
          </el-avatar>
          <input hidden type="file" id="hospital-cover" @change="getFile" />
        </div>
        <AboutTabs :hospital="details.hospitalDetail" @edit-hospital="isEdit=true" :isEdit="isEdit" @save-hospital="isEdit=false"/>
      </el-tab-pane>
      <el-tab-pane label="Department">
        <el-button @click="visible=true">Add New Department</el-button>
        <el-dialog v-model="visible" title="Add new department" width="800">
          <el-form label-position="top">
            <el-form-item label="Department Name">
              <el-input v-model="newDep.name" type="text"/>
            </el-form-item>
            <el-form-item label="Department Description">
              <el-input v-model="newDep.details" type="textarea"/>
            </el-form-item>
            <el-form-item label="Department Image">
              <el-upload style="width: 100%" class="upload-demo" drag accept="image/*" @change="handlePictureCardPreview">
                <el-icon class="el-icon--upload"><upload-filled /></el-icon>
                <div class="el-upload__text">
                  Drop file here or <em>click to upload</em>
                </div>
                <template #tip>
                  <div class="el-upload__tip">
                    jpg/png files with a size less than 500kb
                  </div>
                </template>
              </el-upload>
            </el-form-item>
            <el-button @click="addDepartment">Submit</el-button>
          </el-form>
        </el-dialog>
        <CardDepartment v-for="dep in details.hospitalDetail.department" :key="dep.id" :department="dep" @update="updateDepartment(dep.id)" @remove="removeDepartment(dep.id)"/>
      </el-tab-pane>
      <el-tab-pane label="Service">
        <ServiceTab @remove="removeService(id)" @update="updateService(id)" />
      </el-tab-pane>
    </el-tabs>
  </WebLayout>
</template>
<style>
.image {
  width: 100%;
  height: 150vh;
  object-fit: cover;
  margin-top: -33%;
}
.btn {
  padding: 10px 20px;
  border-radius: 15px;
  border: 1px solid #32B4E3;
  color: rgb(0, 0, 0);
}
</style>