<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import Chart from 'chart.js/auto'
import { computed, h, onMounted, ref } from 'vue'
import { Message, Plus,StarFilled,Star } from '@element-plus/icons-vue/global'
import { ElNotification } from 'element-plus'

let dialogOverflowVisible = ref(false)
const tableData: User[] = [
  {
    id: 1,
    date: '2016-05-02',
    name: 'wangxiaohu',
    status: 'Accepted',
    star:5,
    address: 'No. 189, Grove St, Los Angeles'
  },
  {
    id: 2,
    date: '2016-05-04',
    name: 'wangxiaohu',
    status: 'Accepted',
    star:5,
    address: 'No. 189, Grove St, Los Angeles'
  },
  {
    id: 3,
    date: '2016-05-01',
    name: 'wangxiaohu',
    status: 'Accepted',
    star:4,
    address: 'No. 189, Grove St, Los Angeles'
  },
  {
    id: 4,
    date: '2016-05-03',
    name: 'wangxiaohu',
    status: 'Rejected',
    star:3,
    address: 'No. 189, Grove St, Los Angeles'
  }
]
const data = {
  labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
  datasets: [{
    label: 'Total Appointments',
    data: [65, 59, 80, 81, 26, 55, 40, 81, 26, 55, 40, 50],
    fill: true,
    borderColor: 'rgb(75, 192, 192)'
  }]
}
const data2 = {
  labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
  datasets: [{
    label: 'Total Feedback',
    data: [65, 59, 80, 81, 26, 55, 40, 81, 26, 55, 40, 50],
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
const config = {
  type: 'line',
  data: data,
  options: {
    animations: {
      tension: {
        duration: 1000,
        easing: 'linear',
        from: 1,
        to: 0
      }
    },
    scales: {
      y: { // defining min and max so hiding the dataset does not change scale range
        min: 0,
        max: 100
      }
    }
  }
}
let delayed
const config2 = {
  type: 'bar',
  data: data2,
  options: {
    animation: {
      onComplete: () => {
        delayed = true
      },
      delay: (context) => {
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

const open4 = () => {
  ElNotification({
    title: 'Appointment Rejection',
    type: 'success',
    message: h('i', { style: 'color: green' }, 'Rejected Successfully')
  })
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
  tableData.filter(
    (data) =>
      !search.value ||
      data.name.toLowerCase().includes(search.value.toLowerCase())
  )
)
const handleEdit = (index: number, row: User) => {
  console.log(index, row.id)
  dialogOverflowVisible.value = true
  replyFeedback.value.rate_id = row.id
}
const replyFeedback = ref({
  rate_id: '',
  content: ''
})
const sentReply = () => {
  dialogOverflowVisible.value = false
  if (replyFeedback.value.content === '') {
    open()
  }
}
onMounted(() => {
  const feedBack = document.getElementById('chartOne')
  const appointments = document.getElementById('chartTwo')
  new Chart(feedBack, config)
  new Chart(appointments, config2)
})
</script>

<template>
  <WebLayout>
    <div class="bg-warning py-2">
      <h1 class="text-center text-white">Dashboard</h1>
    </div>
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
                src="https://media.licdn.com/dms/image/C5603AQEy_W2B5osjlQ/profile-displayphoto-shrink_800_800/0/1610784133410?e=1724889600&v=beta&t=CA6qUP_8mLjqs-qd1ZtXt0UEdfIOeCl0MQkuFVWYw2Y"></el-avatar>
              {{ avatar.row.name }}
            </div>
          </template>
        </el-table-column>
        <el-table-column label="Content" prop="status" />
        <el-table-column label="Stars" prop="star">
          <template #default="star">
            <div v-if="star.row.star===5" class="d-flex align-items-center gap-2">
              <el-icon v-for="item in star.row.star" :key="item"><StarFilled /></el-icon>
            </div>
            <div v-if="star.row.star<5" class="d-flex align-items-center gap-2">
              <el-icon v-for="item in star.row.star" :key="item"><StarFilled /></el-icon>
              <el-icon v-for="item in 5-star.row.star" :key="item"><Star /></el-icon>
            </div>
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
</template>
<style scoped>
.el-col {
  text-align: center;
}

.el-statistic {
  --el-statistic-title-color: black;
  --el-statistic-content-color: #000;
  --el-statistic-content-font-size: 20px;
  --el-statistic-title-font-size: 20px;
  --el-statistic-content-font-weight: bold;
}
</style>

