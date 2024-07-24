<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import {UploadFilled} from '@element-plus/icons-vue'
import AboutTabs from '@/Components/Hospital/AboutTabs.vue'
import ServiceTab from '@/Components/Hospital/ServiceTab.vue'
import CardDepartment from '@/Components/Hospital/CardDepartment.vue'
import {onMounted, ref} from 'vue'
import type {UploadProps} from 'element-plus'
import axiosInstance from '@/plugins/axios'
import {useDoctorStore} from '@/stores/doctor-store'
import {hospitalDetailStore} from "@/stores/hospital-detail";
import {useAuthStore} from "@/stores/auth-store";
import NoHospitalSet from '@/Components/Hospitals/NoHospitalSet.vue'
import {provinces} from '@/province/province'
import {districts} from '@/province/district'
import {communes} from '@/province/commune'

const visible = ref(false)
const store = useDoctorStore()
const details = hospitalDetailStore()
const userStore = useAuthStore()
const commune = ref([])
const district = ref([])
const province = provinces
const id = ref('')
const editVisible = ref(false)
const newDep = ref({
  name: '',
  details: '',
  image: 'null'
})
const editData = ref({
  name: '',
  details: '',
  image: 'null'
})
const dialogVisible = ref(false)
const filterDistrict = (id: any) => {
  district.value = districts.filter(district => district.province_id === id)
}
const filterCommune = (id: any) => {
  commune.value = communes.filter(commune => commune.district_id === id)
}
const setLatLng = (commune: any) => {
  submissionFrom.value.latitude = commune.geodata.lat
  submissionFrom.value.longitude = commune.geodata.lng
}
const updateDepartment = (dep: any) => {
  editVisible.value = true
  id.value = dep.id
  editData.value = dep
}
const removeDepartment = async (id: number) => {
  try {
    const {data} = await axiosInstance.delete(`/departments/delete/${id}`)
    console.log(data)
    fetchDetail()
  } catch (e) {
    console.error(e)
  }
}
const removeService = (id: number) => {
  console.log('remove serve ', id)
}
const updateService = (id: number) => {
  console.log('updateService ', id)
}
const handlePictureCardPreview: UploadProps['onPreview'] = (uploadFile) => {
  newDep.value.image = uploadFile.raw;
  editData.value.image = uploadFile.raw;
  console.log(uploadFile.raw)
}
const addDepartment = async () => {
  console.log(newDep.value)
  try {
    visible.value = false
    const newDepartment = newDep.value
    const {data} = await axiosInstance.post('/departments/create', newDepartment)
    if (data.succces) {
      alert('Succeeded')
    }
    fetchDetail()
  } catch (error) {
    console.log(error)
  }
}
const updateDep = async () => {
  try {
    editVisible.value = false
    const newDepartment = editData.value
    const {data} = await axiosInstance.post(`/departments/update/${id.value}`, newDepartment)
    fetchDetail()
    console.log(data.success)
  } catch (error) {
    console.log(error)
  }
}
const submissionFrom = ref({
  name: '',
  category_id: '',
  street_address: '',
  village: '',
  commune: '',
  district: '',
  province: '',
  latitude: '',
  longitude: '',
  open_time: '',
  close_time: '',
  phone_number: '',
  vision: '',
  mission: ''
})
const openEditForm = () => {
  dialogVisible.value = true
  submissionFrom.value.name = details.hospitalDetail.name
  submissionFrom.value.category_id = details.hospitalDetail.category.id
  submissionFrom.value.street_address = details.hospitalDetail.street_address
  submissionFrom.value.village = details.hospitalDetail.village
  submissionFrom.value.commune = details.hospitalDetail.commune !== 'Not set yet' ? details.hospitalDetail.commune : ''
  submissionFrom.value.district = details.hospitalDetail.district
  submissionFrom.value.province = details.hospitalDetail.province
  submissionFrom.value.latitude = details.hospitalDetail.latitude
  submissionFrom.value.longitude = details.hospitalDetail.longitude
  submissionFrom.value.open_time = details.hospitalDetail.open_time
  submissionFrom.value.close_time = details.hospitalDetail.close_time
  submissionFrom.value.vision = details.hospitalDetail.vision
  submissionFrom.value.mission = details.hospitalDetail.mission
}
const categories = ref([])
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
    const {data} = await axiosInstance.post('/hospitals/uploadCover', {
      image: file,
      hospital_id: userStore.hospital.id
    })
    console.log(data)
  } catch (err) {
    console.log(err)
  }
  fetchDetail()
}
const fetchCategory = async () => {
  try {
    const {data} = await axiosInstance.get('/categories/list')
    categories.value = data.data
    console.log(data.data)
  } catch (error) {
    console.log(error)
  }
}
const submitForm = async () => {
  const updataData = new FormData()
  updataData.append('name', submissionFrom.value.name)
  updataData.append('category_id', submissionFrom.value.category_id)
  updataData.append('street_address', submissionFrom.value.street_address)
  updataData.append('village', submissionFrom.value.village)
  updataData.append('commune', submissionFrom.value.commune)
  updataData.append('district', submissionFrom.value.district)
  updataData.append('province', submissionFrom.value.province)
  updataData.append('latitude', submissionFrom.value.latitude)
  updataData.append('longitude', submissionFrom.value.longitude)
  updataData.append('open_time', submissionFrom.value.open_time)
  updataData.append('close_time', submissionFrom.value.close_time)
  updataData.append('mission', submissionFrom.value.mission)
  updataData.append('vision', submissionFrom.value.vision)
  try {
    dialogVisible.value = false
    const {data} = await axiosInstance.put(`/hospitals/update/${details.hospitalDetail.id}`, updataData)
    console.log(data.success)
    fetchDetail()
  } catch (error) {
    console.log(error)
  }
}
onMounted(() => {
  store.fetchDoctors()
  fetchCategory()
  fetchDetail()
})
</script>
<template>
  <WebLayout v-if="userStore.hospital!='No hospital'">
    <el-dialog v-model="dialogVisible" title="Edit hospital" width="700">
      <el-form label-position="top">
        <el-form-item label="Name">
          <el-input v-model="submissionFrom.name" type="text"/>
        </el-form-item>
        <el-form-item label="Category">
          <el-select v-model="submissionFrom.category_id">
            <el-option v-for="category in categories" :value="category.id" :label="category.name"
                       :key="category.id"/>
          </el-select>
        </el-form-item>
        <el-form-item label="Working hours">
          <el-col :span="11">
            <el-time-picker
                placeholder="Pick a open time"
                style="width: 100%"
                v-model="submissionFrom.open_time"
                value-format="HH:mm"
            />
          </el-col>
          <el-col :span="2" class="text-center">
            <span class="text-gray-500">-</span>
          </el-col>
          <el-col :span="11">
            <el-time-picker
                placeholder="Pick a close time"
                v-model="submissionFrom.close_time"
                value-format="HH:mm"
                style="width: 100%"
            />
          </el-col>
          <el-col :span="6">
            <el-form-item label="Province">
              <el-select v-model="submissionFrom.province">
                <el-option v-for="pro in province" @click="filterDistrict(pro.id)" :key="pro" :value="pro.name_en"
                           :label="pro.name_en"/>
              </el-select>
            </el-form-item>
          </el-col>
          <el-col :span="6">
            <el-form-item label="District">
              <el-select v-model="submissionFrom.district">
                <el-option v-for="pro in district" :key="pro" @click="filterCommune(pro.id)" :value="pro.name_en"
                           :label="pro.name_en"/>
              </el-select>
            </el-form-item>
          </el-col>
          <el-col :span="6">
            <el-form-item label="Commune">
              <el-select v-model="submissionFrom.commune">
                <el-option v-for="pro in commune" @click="setLatLng(pro)" :key="pro" :value="pro.name_en"
                           :label="pro.name_en"/>
              </el-select>
            </el-form-item>
          </el-col>
          <el-col :span="6">
            <el-form-item label="Village">
              <el-input v-model="submissionFrom.village" type="text"/>
            </el-form-item>
          </el-col>
          <el-col :span="6">
            <el-form-item label="Street Address">
              <el-input v-model="submissionFrom.street_address" type="text"/>
            </el-form-item>
          </el-col>
        </el-form-item>
        <el-form-item label="Vision and mission">
          <el-col :span="12">
            <el-form-item label="Vision">
              <el-input type="textarea" v-model="submissionFrom.vision"/>
            </el-form-item>
          </el-col>
          <el-col :span="12">
            <el-form-item label="Vision">
              <el-input type="textarea" v-model="submissionFrom.mission"/>
            </el-form-item>
          </el-col>
        </el-form-item>
      </el-form>
      <template #footer>
        <div class="dialog-footer">
          <el-button @click="dialogVisible=false">Cancel</el-button>
          <el-button type="primary" @click="submitForm">
            Submit
          </el-button>
        </div>
      </template>
    </el-dialog>
    <el-tabs type="border-card" stretch class="demo-tabs">
      <el-tab-pane>
        <template #label>
        <span class="custom-tabs-label ">
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
          <input hidden type="file" id="hospital-cover" @change="getFile"/>
        </div>
        <AboutTabs :hospital="details.hospitalDetail" @edit-hospital="openEditForm"/>
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
              <el-upload style="width: 100%" class="upload-demo" drag accept="image/*"
                         @change="handlePictureCardPreview">
                <el-icon class="el-icon--upload">
                  <upload-filled/>
                </el-icon>
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
        <el-dialog v-model="editVisible" title="Add new department" width="800">
          <el-form label-position="top">
            <el-form-item label="Department Name">
              <el-input v-model="editData.name" type="text"/>
            </el-form-item>
            <el-form-item label="Department Description">
              <el-input v-model="editData.details" type="textarea"/>
            </el-form-item>
            <el-form-item label="Department Image">
              <el-upload style="width: 100%" class="upload-demo" drag accept="image/*"
                         @change="handlePictureCardPreview">
                <el-icon class="el-icon--upload">
                  <upload-filled/>
                </el-icon>
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
            <el-button @click="updateDep">Submit</el-button>
          </el-form>
        </el-dialog>
        <CardDepartment v-for="dep in details.hospitalDetail.department" :key="dep.id" :department="dep"
                        @update="updateDepartment(dep)" @remove="removeDepartment(dep.id)"/>
      </el-tab-pane>
      <el-tab-pane label="Service">
        <ServiceTab @remove="removeService(id)" @update="updateService(id)"/>
      </el-tab-pane>
    </el-tabs>
  </WebLayout>
  <WebLayout v-else>
    <NoHospitalSet/>
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