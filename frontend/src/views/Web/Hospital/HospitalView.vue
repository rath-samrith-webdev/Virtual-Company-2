<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import { Calendar, UploadFilled } from '@element-plus/icons-vue'
import AboutTabs from '@/Components/Hospital/AboutTabs.vue'
import DoctorTabs from '@/Components/Hospital/DoctorTabs.vue'
import ServiceTab from '@/Components/Hospital/ServiceTab.vue'
import CardDepartment from '@/Components/Hospital/CardDepartment.vue'
import { onMounted, ref } from 'vue'
import type { UploadProps } from 'element-plus'
import axiosInstance from '@/plugins/axios'
import {useDoctorStore} from '@/stores/doctor-store'
import axios from "axios";
const visible=ref(false)
const store=useDoctorStore()
const departments:any[]= [
  {
    id:1,
    name:'Obstetrics & Gynecology department',
    description:'We provide the all kind of treatment from the preventive care to the critical treatment including diagnostic, comprehensive health screenings, as well as antenatal care and child delivery for expectant mothers.'
  }
]

const newDep=ref({
  name:'',
  details:'',
  image:'null'
})
const isEdit=ref(false)
const removeDoc = (id) => {
  store.deleteDoctor(id)
}
const editData=ref({})
const updateDoc = (doc) => {
  isEdit.value = true
  editData.value=doc
  console.log(doc); 
}
const updateData=()=>{
  store.updateDoctor(editData.value.id,editData.value)
}
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
onMounted(()=>{
  store.fetchDoctors()
})
</script>
<template>
  <WebLayout>
    <el-tabs type="border-card" stretch class="demo-tabs">
      <el-tab-pane>
        <template #label>
        <span class="custom-tabs-label">
          <el-icon><calendar /></el-icon>
          <span>Information</span>
        </span>
        </template>
        <div style="height: 55%">
          <el-avatar shape="square" style="width: 100%; height: 100%;"  :fit="'cover'" src="https://teacarchitect.com/wp-content/uploads/2021/09/Royal-Phnom-Penh-Hospital.jpg"/>
        </div>
        <AboutTabs @edit-hospital="isEdit=true" :isEdit="isEdit" @save-hospital="isEdit=false"/>
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
        <CardDepartment v-for="dep in departments" :key="dep.id" :department="dep" @update="updateDepartment(dep.id)" @remove="removeDepartment(dep.id)"/>
      </el-tab-pane>
      <el-tab-pane label="Doctor">
        <el-row gutter="20">
          <DoctorTabs v-for="doc in store.doctors" :key="doc.id" :doctor="doc" @update="updateDoc(doc)" @remove="removeDoc(doc.id)" :isEdit="isEdit" :editData="editData" @updateDoctor="updateData"/>
        </el-row>
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