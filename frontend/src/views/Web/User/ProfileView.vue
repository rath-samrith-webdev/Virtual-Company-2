<script setup lang="ts">
// eslint-disable-next-line no-redeclare
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import { ref } from 'vue'
import { useAuthStore } from '@/stores/auth-store'
import { ElMessageBox } from 'element-plus'
import axiosInstance from '@/plugins/axios'

const dialogVisible = ref(false)
let previewImage = ref('')
const store = useAuthStore()
// Upload image handling
let avatarUrl = ref('https://newprofilepicapp.com/wp-content/uploads/2024/02/New-Profile-Pic-App.webp')
const selectFile = () => {
  dialogVisible.value = true
}
const handleClose = (done: () => void) => {
  ElMessageBox.confirm('Are you sure to close this dialog?')
    .then(() => {
      done()
    })
    .catch(() => {
      // catch error
    })
}
const selectUploadFie = () => {
  document.getElementById('inputFile').click()
}
let file: any
const getData = (e) => {
  file = e.target.files[0]
  if (file) {
    const reader = new FileReader()
    reader.onload = (e) => {
      previewImage.value = e.target.result
    }
    reader.readAsDataURL(file)
  }
}
const uploadFile = async () => {
  const formData = { 'image': file }
  try {
    const { data } = await axiosInstance.post('/profileUpload', formData)
    console.log(data)
  } catch (error) {
    console.log(error)
  }
}
const activeName = 'first'
</script>
<template>
  <WebLayout>
    <el-dialog
      v-model="dialogVisible"
      title="Profile Upload"
      width="350"
      :before-close="handleClose"
    >
      <div class="demo-type d-flex flex-column align-items-center">
        <el-avatar @click="selectUploadFie" :size="150">
          <img v-if="previewImage" :src="previewImage" alt="" />
          <img v-else src="https://cube.elemecdn.com/3/7c/3ea6beec64369c2642b92c6726f1epng.png" alt="" />
          <input type="file" @change="getData" width="100" id="inputFile" hidden>
        </el-avatar>
      </div>
      <template #footer>
        <div class="dialog-footer flex justify-between">
          <el-button @click="dialogVisible = false">Cancel</el-button>
          <el-button type="primary" @click="uploadFile">
            Confirm
          </el-button>
        </div>
      </template>
    </el-dialog>
    <el-tabs v-model="activeName" type="border-card" class="main-card-border">
      <el-tab-pane label="Personal Information" class="tabs" name="first">
        <el-container class="flex flex-col">
          <div class="demo-type">
            <el-avatar v-if="store.user.profile!=='No profile'" :size="150" :src="store.user.profile"
                       @click="selectFile">
              <img :src="avatarUrl" alt="" />
            </el-avatar>
            <el-avatar v-else :size="150" src="https://cube.elemecdn.com/3/7c/3ea6beec64369c2642b92c6726f1epng.png" @click="selectFile"></el-avatar>
          </div>
          <el-descriptions title="General Information" :column="3" :size="size" border class="margin-top">
            <el-descriptions-item label="First Name">{{ store.user.first_name }}</el-descriptions-item>
            <el-descriptions-item label="Last Name">{{ store.user.last_name }}</el-descriptions-item>
            <el-descriptions-item label="Gender">{{store.user.gender}}</el-descriptions-item>
            <el-descriptions-item label="Date of Birth">{{ store.user.date_of_birth }}</el-descriptions-item>
            <el-descriptions-item label="Email">{{ store.user.email }}</el-descriptions-item>
            <el-descriptions-item label="Phone Number">{{ store.user.phone }}</el-descriptions-item>
          </el-descriptions>
          <el-descriptions title="Address" :column="3" :size="size" border class="margin-top">
            <el-descriptions-item label="Village">Phom Penh</el-descriptions-item>
            <el-descriptions-item label="Street">#371</el-descriptions-item>
            <el-descriptions-item label="Commune">O bek kaom</el-descriptions-item>
            <el-descriptions-item label="District">Sen Sok</el-descriptions-item>
            <el-descriptions-item label="Province">Phom Phenh</el-descriptions-item>
            <el-descriptions-item label="City">Phom Penh</el-descriptions-item>
          </el-descriptions>
          <el-descriptions title="Others" :column="3" :size="size" border class="margin-top">
            <el-descriptions-item label="Blood Type">
              <el-tag size="small">O+</el-tag>
            </el-descriptions-item>
            <el-descriptions-item label="Age">30</el-descriptions-item>
            <el-descriptions-item label="Father's Name">Yaya</el-descriptions-item>
            <el-descriptions-item label="Mother's Name">Papa</el-descriptions-item>
          </el-descriptions>
        </el-container>
      </el-tab-pane>
      <el-tab-pane label="History" class="tabs" name="second">
        <el-container class="flex flex-col">
          <el-descriptions title="Go to hospital Angkor Tom" :column="3" :size="size" border class="margin-top">
            <el-descriptions-item label="Username">Rath</el-descriptions-item>
            <el-descriptions-item label="Telephone">123456789</el-descriptions-item>
            <el-descriptions-item label="Place">Cambodia</el-descriptions-item>
            <el-descriptions-item label="Remarks">
              <el-tag size="small">PNC</el-tag>
            </el-descriptions-item>
            <el-descriptions-item label="Address">No.1188, Wuzhong Avenue, Wuzhong District, Suzhou, Jiangsu
              Province
            </el-descriptions-item>
          </el-descriptions>
          <el-descriptions title="Go to hospital PNC" :column="3" :size="size" border class="margin-top">
            <el-descriptions-item label="Username">Rath</el-descriptions-item>
            <el-descriptions-item label="Telephone">123456789</el-descriptions-item>
            <el-descriptions-item label="Place">Cambodia</el-descriptions-item>
            <el-descriptions-item label="Remarks">
              <el-tag size="small">PNC</el-tag>
            </el-descriptions-item>
            <el-descriptions-item label="Address">No.1188, Wuzhong Avenue, Wuzhong District, Suzhou, Jiangsu
              Province
            </el-descriptions-item>
          </el-descriptions>
        </el-container>
      </el-tab-pane>
    </el-tabs>
  </WebLayout>
</template>
<style scoped>
.main-card-border {
  border: 2px solid rgba(0, 0, 0, 0.15);
  border-radius: 10px;
}

.card {
  width: 1200px;
  margin: 20px 0;
  border-radius: 8px;
}

.margin-top {
  background: linear-gradient(to right, rgba(252, 178, 45, 0.8), rgba(249, 125, 0, 0.2));
  margin: 10px;
  border-radius: 8px;
  font-size: 50px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 2px 4px rgba(0, 0, 0, 0.06);
}

span {
  font-size: 15px;
  font-weight: bold;
}

.tabs {
  padding: 20px;
}
</style>