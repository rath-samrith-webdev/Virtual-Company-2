<script lang="ts">
import { defineComponent, ref } from 'vue'
import axiosInstance from '@/plugins/axios'
import { provinces } from '@/province/province'
import { districts } from '@/province/district'
import { communes } from  '@/province/commune'
export default defineComponent({
  name: 'HospitalSet',
  data() {
    return {
      categories: [],
      province: provinces,
      district: [],
      commune:[],
      village:[],
      dialogVisible: ref(false),
      submissionFrom: {
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
        close_time: ''
      }
    }
  },
  methods: {
    async fetchCategory() {
      try {
        const { data } = await axiosInstance.get('/categories/list')
        this.categories = data.data
        console.log(data.data)
      } catch (error) {
        console.log(error)
      }
    },
    async submitForm() {
      this.dialogVisible = false
      console.log(this.submissionFrom)
      try {
        const { data } = await axiosInstance.post('/hospitals/create', this.submissionFrom)
        console.log(data.data)
        location.reload()
      } catch (error) {
        console.log(error)
      }
    },
    filterDistrict(id:any) {
      this.district = districts.filter(district => district.province_id === id)
    },
    filterCommune(id:any) {
      this.commune=communes.filter(commune => commune.district_id === id)
    },
    setLatLng(commune:any) {
      this.submissionFrom.latitude = commune.geodata.lat
      this.submissionFrom.longitude = commune.geodata.lat
      this.filterVillage(commune.id)
    }
  },
  mounted() {
    this.fetchCategory()
  }
})
</script>

<template>
  <div class="not-found-page">
    <el-container>
      <!-- Header -->
      <el-header>
        <h1>Hospital Not yet Set</h1>
      </el-header>

      <!-- Main content area -->
      <el-main>
        <el-card class="content-card">
          <h2>Oops! It looks like you have not set up your hospital yet.</h2>
          <p>Please Set up one and let the every one knows you</p>
          <p>Please click here to set up</p>
          <el-button type="primary" @click="dialogVisible=true">Set Up hospital</el-button>
        </el-card>
      </el-main>
      <el-dialog v-model="dialogVisible" title="Hospital Set-Up" width="800">
        <el-form label-position="top">
          <el-form-item label="Name">
            <el-input v-model="submissionFrom.name" type="text" />
          </el-form-item>
          <el-form-item label="Category">
            <el-select v-model="submissionFrom.category_id">
              <el-option v-for="category in categories" :value="category.id" :label="category.name"
                         :key="category.id" />
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
                             :label="pro.name_en" />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :span="6">
              <el-form-item label="District">
                <el-select v-model="submissionFrom.district">
                  <el-option v-for="pro in district" :key="pro" @click="filterCommune(pro.id)" :value="pro.name_en" :label="pro.name_en" />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :span="6">
              <el-form-item label="Commune">
                <el-select v-model="submissionFrom.commune">
                  <el-option v-for="pro in commune" @click="setLatLng(pro)" :key="pro" :value="pro.name_en" :label="pro.name_en" />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :span="6">
              <el-form-item label="Village">
                <el-input v-model="submissionFrom.village" type="text" />
              </el-form-item>
            </el-col>
            <el-col :span="6">
              <el-form-item label="Street Address">
                <el-input v-model="submissionFrom.street_address" type="text" />
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
    </el-container>
  </div>
</template>
<style scoped>
.not-found-page {
  margin: 20px;
  text-align: center;
}

.content-card {
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
}
</style>