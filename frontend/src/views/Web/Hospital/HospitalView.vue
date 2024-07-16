<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import { Picture } from '@element-plus/icons-vue'
import AboutTabs from '@/Components/Hospital/AboutTabs.vue'
import DoctorTabs from '@/Components/Hospital/DoctorTabs.vue'
import ServiceTab from '@/Components/Hospital/ServiceTab.vue'
import CardDepartment from '@/Components/Hospital/CardDepartment.vue'
import { onMounted, ref } from 'vue'
import type { UploadProps } from 'element-plus'
import { hospitalDetailStore } from '@/stores/hospital-detail'
import { useAuthStore } from '@/stores/auth-store'
import axiosInstance from '@/plugins/axios'
const details = hospitalDetailStore()
const userStore = useAuthStore()
const visible = ref(false)
const departments: any[] = [
  {
    id: 1,
    name: 'Obstetrics & Gynecology department',
    description:
      'We provide the all kind of treatment from the preventive care to the critical treatment including diagnostic, comprehensive health screenings, as well as antenatal care and child delivery for expectant mothers.'
  }
]
const doctors: any[] = [
  {
    id: 1,
    name: 'Obstetrics ',
    description: 'We are'
  }
]
const newDep = ref({
  name: '',
  details: '',
  image: null
})
const isEdit = ref(false)
const removeDoc = (id: any) => {
  console.log('removed ', id)
}
const updateDoc = (id: any) => {
  console.log('updated', id)
}
const updateDepartment = (id: number) => {
  console.log('updateDepartment ', id)
}
const removeDepartment = async (id: number) => {
  try {
    const { data } = await axiosInstance.get(`/departments/delete/${id}`)
    console.log(data)
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
  newDep.value.image = uploadFile.raw
  console.log(uploadFile.raw)
}
const addDepartment = async () => {
  console.log(newDep.value)
  try {
    const newDepartment = newDep.value
    const { data } = await axiosInstance.post('/departments/create', newDepartment)
    console.log(data)
  } catch (error) {
    console.log(error)
  }
}
let categories: any[] = []
const fetchCategories = async () => {
  try {
    const { data } = await axiosInstance.get('/categories/list')
    console.log(data)
    categories = data.data
  } catch (err) {
    console.log(err)
  }
}
let formData = ref({})
const fetchDetail = () => {
  details.fetchHospitalDetail(userStore.hospital.id)
  formData.value = details.hospitalDetail
}
const onSubmit = async () => {
  isEdit.value = false
  const formData = new FormData()
  formData.append('name', details.hospitalDetail.name)
  formData.append('category_id', details.hospitalDetail.category.id)
  formData.append('open_time', details.hospitalDetail.open_time)
  formData.append('close_time', details.hospitalDetail.close_time)
  formData.append('village', details.hospitalDetail.village)
  formData.append('commune', details.hospitalDetail.commune)
  formData.append('district', details.hospitalDetail.district)
  formData.append('province', details.hospitalDetail.province)
  try {
    const { data } = await axiosInstance.put(`/hospitals/update/${userStore.hospital.id}`, formData)
    console.log(data)
  } catch (err) {
    console.log(err)
  }
  fetchDetail()
}
const previewImage = ref('')
const isUpload = ref(false)
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
onMounted(() => {
  fetchCategories()
  fetchDetail()
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

        <el-dialog v-model="isEdit" title="Edit Hospital" width="800">
          <el-form label-position="top">
            <el-input type="hidden" v-model="details.hospitalDetail.id" />
            <el-form-item label="Name">
              <el-input type="text" v-model="details.hospitalDetail.name" />
            </el-form-item>
            <el-form-item label="Category">
              <el-select v-model="details.hospitalDetail.category.id">
                <el-option
                  v-for="category in categories"
                  :key="category.id"
                  :value="category.id"
                  :label="category.name"
                />
              </el-select>
            </el-form-item>
            <el-form-item label="Working hours">
              <el-col :span="11">
                <el-time-picker
                  v-model="details.hospitalDetail.open_time"
                  placeholder="Pick a time"
                  style="width: 100%"
                  value-format="HH:mm"
                />
              </el-col>
              <el-col :span="2" class="text-center">
                <span class="text-gray-500">-</span>
              </el-col>
              <el-col :span="11">
                <el-time-picker
                  v-model="details.hospitalDetail.close_time"
                  placeholder="Pick a time"
                  style="width: 100%"
                  value-format="HH:mm"
                />
              </el-col>
              <el-col :span="6">
                <el-form-item label="Village">
                  <el-input type="text" v-model="details.hospitalDetail.village" />
                </el-form-item>
              </el-col>
              <el-col :span="6">
                <el-form-item label="Commune">
                  <el-input v-model="details.hospitalDetail.commune" type="text" />
                </el-form-item>
              </el-col>
              <el-col :span="6">
                <el-form-item label="District">
                  <el-input type="text" v-model="details.hospitalDetail.district" />
                </el-form-item>
              </el-col>
              <el-col :span="6">
                <el-form-item label="Province">
                  <el-input type="text" v-model="details.hospitalDetail.province" />
                </el-form-item>
              </el-col>
            </el-form-item>
          </el-form>
          <template #footer>
            <div class="dialog-footer">
              <el-button @click="isEdit = false">Cancel</el-button>
              <el-button type="primary" @click="onSubmit"> Submit </el-button>
            </div>
          </template>
        </el-dialog>
        <AboutTabs
          :hospital="details.hospitalDetail"
          @edit-hospital="isEdit = true"
          @save-hospital="isEdit = false"
        />
      </el-tab-pane>
      <el-tab-pane label="Department">
        <el-button @click="visible = true">Add New Department</el-button>
        <el-dialog v-model="visible" title="Add new department" width="800">
          <el-form label-position="top">
            <el-form-item label="Department Name">
              <el-input v-model="newDep.name" type="text" />
            </el-form-item>
            <el-form-item label="Department Description">
              <el-input v-model="newDep.details" type="textarea" />
            </el-form-item>
            <el-form-item label="Department Image">
              <el-upload
                style="width: 100%"
                class="upload-demo"
                drag
                accept="image/*"
                @change="handlePictureCardPreview"
              >
                <el-icon class="el-icon--upload"><upload-filled /></el-icon>
                <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
                <template #tip>
                  <div class="el-upload__tip">jpg/png files with a size less than 500kb</div>
                </template>
              </el-upload>
            </el-form-item>
            <el-button @click="addDepartment">Submit</el-button>
          </el-form>
        </el-dialog>
        <CardDepartment
          v-for="dep in departments"
          :key="dep.id"
          :department="dep"
          @update="updateDepartment(dep.id)"
          @remove="removeDepartment(dep.id)"
        />
      </el-tab-pane>
      <el-tab-pane label="Doctor">
        <el-row gutter="20">
          <DoctorTabs
            v-for="doc in doctors"
            :key="doc.id"
            :doctor="doc"
            @update="updateDoc(doc.id)"
            @remove="removeDoc(doc.id)"
          />
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
  border: 1px solid #32b4e3;
  color: rgb(0, 0, 0);
}
</style>
