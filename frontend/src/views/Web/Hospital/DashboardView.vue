<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import Chart from 'chart.js/auto'
import { computed, onMounted, ref,h } from 'vue'
import { CircleCheck, Close } from '@element-plus/icons-vue/global'
import { ElNotification } from 'element-plus'

const tableData: User[] = [
  {
    id: 1,
    date: '2016-05-02',
    name: 'wangxiaohu',
    status: 'Accepted',
    address: 'No. 189, Grove St, Los Angeles'
  },
  {
    id: 2,
    date: '2016-05-04',
    name: 'wangxiaohu',
    status: 'Accepted',
    address: 'No. 189, Grove St, Los Angeles'
  },
  {
    id: 3,
    date: '2016-05-01',
    name: 'wangxiaohu',
    status: 'Accepted',
    address: 'No. 189, Grove St, Los Angeles',
    children: [
      {
        id: 31,
        date: '2016-05-01',
        name: 'wangxiaohu',
        address: 'No. 189, Grove St, Los Angeles'
      },
      {
        id: 32,
        date: '2016-05-01',
        name: 'wangxiaohu',
        address: 'No. 189, Grove St, Los Angeles'
      }
    ]
  },
  {
    id: 4,
    date: '2016-05-03',
    name: 'wangxiaohu',
    status: 'Rejected',
    address: 'No. 189, Grove St, Los Angeles'
  }
]
const data = {
  labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
  datasets: [{
    label: 'Total Appointment',
    data: [65, 59, 80, 81, 26, 55, 40, 81, 26, 55, 40, 50],
    fill: true,
    borderColor: 'rgb(75, 192, 192)'
  }]
}
const data2 = {
  labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
  datasets: [{
    label: 'Total Appointment',
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
        to: 0,
        loop: true
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
const config2 = {
  type: 'bar',
  data: data2,
  options: {
    animations: {
      tension: {
        duration: 1000,
        easing: 'linear',
        from: 1,
        to: 0,
        loop: true
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

interface User {
  date: string
  name: string
  address: string
  status:string
}
const open4 = () => {
  ElNotification({
    title: 'Appointment Rejection',
    type: 'success',
    message: h('i', { style: 'color: green' }, 'Rejected Successfully'),
  })
}
const open = () => {
  ElNotification({
    title: 'Appointment Rejection',
    type: 'success',
    message: h('i', { style: 'color: green' }, 'Accepted Successfully'),
  })
}
const search = ref('')
const filterTableData = computed(() =>
  tableData.filter(
    (data) =>
      !search.value ||
      data.name.toLowerCase().includes(search.value.toLowerCase())
  ),
)
const handleEdit = (index: number, row: User) => {
  console.log(index, row)
  row.status='Accepted'
  open()
}
const handleDelete = (index: number, row: User) => {
  console.log(index, row)
  row.status='Rejected'
  open4()
}
onMounted(() => {
  const ctx = document.getElementById('chartOne')
  const ctx2 = document.getElementById('chartTwo')
  new Chart(ctx, config)
  new Chart(ctx2, config2)
})
</script>

<template>
  <WebLayout>
    <div class="bg-warning py-2">
      <h1 class="text-center text-white">Dashboard</h1>
    </div>
    <div class="flex flex-wrap mt-6">
      <div class="w-full lg:w-1/2 pr-0 lg:pr-2">
        <p class="text-xl pb-3 flex items-center">
          <i class="fas fa-plus mr-3"></i> Monthly Reports
        </p>
        <div class="p-6 bg-white">
          <canvas id="chartOne" width="400" height="200"></canvas>
        </div>
      </div>
      <div class="w-full lg:w-1/2 pl-0 lg:pl-2 mt-12 lg:mt-0">
        <p class="text-xl pb-3 flex items-center">
          <i class="fas fa-check mr-3"></i> Resolved Reports
        </p>
        <div class="p-6 bg-white">
          <canvas id="chartTwo" width="400" height="200"></canvas>
        </div>
      </div>
    </div>
    <div class="px-2">
      <el-table :data="filterTableData" style="width: 100%">
        <el-table-column label="Date" prop="date" />
        <el-table-column label="Name" prop="name" >
          <template #default="avatar">
            <div class="d-flex align-items-center gap-4">
              <el-avatar src="https://media.licdn.com/dms/image/C5603AQEy_W2B5osjlQ/profile-displayphoto-shrink_800_800/0/1610784133410?e=1724889600&v=beta&t=CA6qUP_8mLjqs-qd1ZtXt0UEdfIOeCl0MQkuFVWYw2Y"></el-avatar>
              {{avatar.row.name}}
            </div>
          </template>
        </el-table-column>
        <el-table-column label="Status" prop="status">
          <template #default="scope">
            <el-tag
              :type="scope.row.status === 'Accepted' ? 'success' : 'danger'"
              disable-transitions
            >{{ scope.row.status }}
            </el-tag
            >
          </template>
        </el-table-column>
        <el-table-column align="right">
          <template #header>
            <el-input v-model="search" size="small" placeholder="Type to search" />
          </template>
          <template #default="scope">
            <el-button size="small" @click="handleEdit(scope.$index, scope.row)">
              <el-tooltip class="box-item" effect="dark" content="Accept" placement="top-start">
                <el-icon :size="15">
                  <CircleCheck />
                </el-icon>
              </el-tooltip>
            </el-button>
            <el-button
              size="small"
              type="danger"
              @click="handleDelete(scope.$index, scope.row)"
            >
              <el-tooltip class="box-item" effect="dark" content="Reject" placement="top-start">
                <el-icon :size="15">
                  <Close />
                </el-icon>
              </el-tooltip>
            </el-button>
          </template>
        </el-table-column>
      </el-table>
    </div>
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

