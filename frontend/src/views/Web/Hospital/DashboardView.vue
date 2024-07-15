<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
// import Chart from 'chart.js/auto'
import { computed, h, onMounted, ref } from 'vue'
import { Message, Plus, Warning } from '@element-plus/icons-vue/global'
import { ElNotification } from 'element-plus'
import { FeedbackList } from '@/stores/feedback-list'
import NoHospitalSet from '@/Components/Hospitals/NoHospitalSet.vue'
import { hospitalAppointmentListStore } from '@/stores/hospital-appointment-list'
import { useAuthStore } from '@/stores/auth-store'
import axiosInstance from '@/plugins/axios'
import { log } from 'util'
import axios from 'axios'
const appointmentStore=hospitalAppointmentListStore()
const store=FeedbackList()
const userStore=useAuthStore()
let dialogOverflowVisible = ref(false)
const data = {
  labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
  datasets: [{
    label: 'Total Feedback',
    data:JSON.parse(localStorage.getItem('monthlyFeedbacks')),
    fill: true,
    backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
}
const data2 = {
  labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
  datasets: [{
    label: 'Total Feedback',
    data:JSON.parse(localStorage.getItem('appointments')),
    fill: true,
    backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
}
let delayed:boolean
const config2 = {
  type: 'bar',
  data: data2,
  options: {
    animation: {
      onComplete: () => {
        delayed = true
      },
      delay: (context:any) => {
        let delay = 0
        if (context.type === 'data' && context.mode === 'default' && !delayed) {
          delay = context.dataIndex * 300 + context.datasetIndex * 100
        }
        return delay
      }
    },
    scales: {
      x: {
        stacked: true
      },
      y: {
        stacked: true
      }
    }
  }
}
const config = {
  type: 'line',
  data: data,
  options: {
    animation: {
      onComplete: () => {
        delayed = true
      },
      delay: (context:any) => {
        let delay = 0
        if (context.type === 'data' && context.mode === 'default' && !delayed) {
          delay = context.dataIndex * 300 + context.datasetIndex * 100
        }
        return delay
      }
    },
    scales: {
      x: {
        stacked: true
      },
      y: {
        stacked: true
      }
    }
  }
}

interface User {
  id: string
  date: string
  name: string
  address: string
  status: string
}

const open = () => {
  ElNotification({
    title: 'Warning',
    type: 'error',
    message: h('i', { style: 'color: red' }, 'Input field is required')
  })
}
const search = ref('')
const filterTableData = computed(() =>
  store.recentFeedbacks.filter(
    (data) =>
      !search.value ||
      data.from.first_name.toLowerCase().includes(search.value.toLowerCase()) ||
      data.from.last_name.toLowerCase().includes(search.value.toLowerCase())
  )
)
const handleEdit = (index: number, row: User) => {
  console.log(index, row.id)
  dialogOverflowVisible.value = true
  replyFeedback.value.rate_id = row.id
}
const fetchAppointmentSummary = () => {
  appointmentStore.fetchAppointmentSummary()
}
const replyFeedback = ref({
  rate_id: '',
  content: ''
})
const sentReply = async () => {
  dialogOverflowVisible.value = false
  const formData= new FormData()
  formData.append('rate_id', replyFeedback.value.rate_id)
  formData.append('content', replyFeedback.value.content)
  try {
    if (replyFeedback.value.content === '') {
      open()
    }else{
      const {data}=await axiosInstance.post('/feedback-reply/create',formData)
      console.log(data)
    }
  }catch (e){
    console.log(e)
  }
}
function fetchRecent(){
  store.fetchRecentFeedbacks()
}
function fetchFeedback(){
  store.fetchFeedback()
  store.fetchMonthlyFeedbacks()
}
function fetchMonthlyAppointment(){
  appointmentStore.fetchMonthlyAppointment()
}
const dialog=ref(false)
const setUp=()=>{
  console.log('Hello')
  dialog.value = true
}
onMounted(() => {
  if(userStore.hospital!='No hospital'){
    fetchAppointmentSummary()
    fetchRecent()
    fetchFeedback()
    fetchMonthlyAppointment()
    const feedBack = document.getElementById('chartOne')
    const appointments = document.getElementById('chartTwo')
    new Chart(appointments, config2)
    new Chart(feedBack, config)
  }
})
</script>

<template>
  <WebLayout v-if="userStore.hospital!='No hospital'">
    <div class="bg-warning py-2">
      <h1 class="text-center text-white">Dashboard</h1>
    </div>
    <el-row :gutter="16" class="mt-5 bg-body-secondary p3">
      <el-col :span="8">
        <div class="statistic-card">
          <el-statistic :value="store.allFeedback.length">
            <template #title>
              <div style="display: inline-flex; font-size: 15px; align-items: center">
                Total Feedbacks
                <el-tooltip
                  effect="dark"
                  content="Number of users who logged into the product in one day"
                  placement="top"
                >
                  <el-icon style="margin-left: 4px" :size="12">
                    <Warning />
                  </el-icon>
                </el-tooltip>
              </div>
            </template>
          </el-statistic>
        </div>
      </el-col>
      <el-col :span="8">
        <div class="statistic-card">
          <el-statistic :value="appointmentStore.appointmentSummary.pending">
            <template #title>
              <div style="display: inline-flex; font-size: 15px;align-items: center">
                Pending Appointments
                <el-tooltip
                  effect="dark"
                  content="Number of users who logged into the product in one month"
                  placement="top"
                >
                  <el-icon style="margin-left: 4px" :size="12">
                    <Warning />
                  </el-icon>
                </el-tooltip>
              </div>
            </template>
          </el-statistic>
        </div>
      </el-col>
      <el-col :span="8">
        <div class="statistic-card">
          <el-statistic :value="appointmentStore.appointmentSummary.confirm" title="New transactions today">
            <template #title>
              <div style="display: inline-flex; font-size: 15px; align-items: center">
                Confirmed Appointments
              </div>
            </template>
          </el-statistic>
        </div>
      </el-col>
    </el-row>
    <div class="flex flex-wrap mt-6">
      <div class="w-full lg:w-1/2 pr-0 lg:pr-2">
        <p class="text-xl text-center">
          <el-icon>
            <Plus />
          </el-icon>
          Total Appointments
        </p>
        <div class="p-6 bg-white">
          <canvas id="chartOne" width="400" height="200"></canvas>
        </div>
      </div>
      <div class="w-full lg:w-1/2 pl-0 lg:pl-2 mt-12 lg:mt-0">
        <p class="text-xl text-center">
          <el-icon></el-icon>
          Total Feedbacks
        </p>
        <div class="p-6 bg-white">
          <canvas id="chartTwo" width="400" height="200"></canvas>
        </div>
      </div>
    </div>
    <div class="px-2">
      <div class="p2 mt-2" style="background-color: #fcb22d">
        <h3 class="text-center text-white">Recent Feedback</h3>
      </div>
      <el-table :data="filterTableData" style="width: 100%">
        <el-table-column label="Sent by" prop="name">
          <template #default="avatar">
            <div class="d-flex align-items-center gap-4">
              <el-avatar
                :src="avatar.row.from.profile"></el-avatar>
              {{ avatar.row.from.first_name  }} {{avatar.row.from.last_name}}
            </div>
          </template>
        </el-table-column>
        <el-table-column label="Content" prop="content" />
        <el-table-column label="Stars" prop="star">
          <template #default="star">
            <el-rate
              v-model="star.row.star"
              disabled
              text-color="#ff9900"
            />
          </template>
        </el-table-column>
        <el-table-column align="right">
          <template #header>
            <el-input v-model="search" size="small" placeholder="Type user name to search" />
          </template>
          <template #default="scope">
            <el-button size="small" @click="handleEdit(scope.$index, scope.row)">
              <el-tooltip class="box-item" effect="dark" content="Reply Feedback" placement="top-start">
                <el-icon :size="15">
                  <Message />
                </el-icon>
              </el-tooltip>
            </el-button>
          </template>
        </el-table-column>
      </el-table>
    </div>
    <el-dialog
      v-model="dialogOverflowVisible"
      title="Reply Feedback"
      width="500"
      draggable
      overflow
    >
      <el-input v-model="replyFeedback.rate_id" type="hidden" name="rate_id" />
      <el-input class="el-input clearable" v-model="replyFeedback.content" name="content" />
      <template #footer>
        <div class="dialog-footer">
          <el-button @click="dialogOverflowVisible = false">Cancel</el-button>
          <el-button type="primary" @click="sentReply">
            Confirm
          </el-button>
        </div>
      </template>
    </el-dialog>
  </WebLayout>
  <WebLayout v-else>
    <NoHospitalSet :dialog-visible="dialog" @show="setUp" @cancel="dialog=false"/>
  </WebLayout>
</template>
<style scoped>
:global(h2#card-usage ~ .example .example-showcase) {
  background-color: var(--el-fill-color) !important;
}
.el-statistic {
  --el-statistic-content-font-size: 28px;
}

.statistic-card {
  height: 100%;
  padding: 20px;
  border-radius: 4px;
  background-color: var(--el-bg-color-overlay);
}

.statistic-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  font-size: 12px;
  color: var(--el-text-color-regular);
  margin-top: 16px;
}

.statistic-footer .footer-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.statistic-footer .footer-item span:last-child {
  display: inline-flex;
  align-items: center;
  margin-left: 4px;
}

.green {
  color: var(--el-color-success);
}
.red {
  color: var(--el-color-error);
}
.el-col {
  text-align: center;
}

</style>

