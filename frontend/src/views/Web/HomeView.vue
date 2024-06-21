<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import { ref } from 'vue'
import { useTransition } from '@vueuse/core'
import { ChatLineRound, Male } from '@element-plus/icons-vue'
const source = ref(0)
const feedbacks=ref(0)
const outputValue = useTransition(source, {
  duration: 1500,
})
const outputFeedBack = useTransition(feedbacks, {
  duration: 1500,
})
source.value = 172000
feedbacks.value=512
</script>
<template>
  <WebLayout>
    <div class="mt-lg-5 d-flex justify-between px-4 py-lg-5-6 h-75 py-10 m-auto">
      <div class="w-50 px-4 d-flex flex-column justify-content-between gap-3">
        <div class="mt-3">
          <h3 style="font-size: 50px;font-weight: bold">Welcome to,</h3>
          <h1 style="font-size: 100px;font-weight: bold"><span class="text-#FCB22D font-bold">C</span>are <span class="text-#32B4E3 font-bold">F</span>inder! </h1>
        </div>
        <div class="d-flex justify-content-between mt-lg-3">
          <el-card class="rounded-50% bg-card">
            <img src="@/assets/image/linkeding.png" class="card-img" alt="">
          </el-card>
          <el-card class="rounded-50% bg-card d-flex flex-column align-items-center">
            <img src="@/assets/image/gmail.png" class="card-img" alt="">
          </el-card>
          <el-card class="rounded-50% bg-card d-flex flex-column align-items-center">
            <img src="@/assets/image/instagram.png" class="card-img" alt="">
          </el-card>
        </div>
      </div>
      <div class="w-25 d-flex justify-content-around">
        <img src="@/assets/image/doctor.png" alt="">
      </div>
    </div>
  </WebLayout>
  <el-row class="state bg-warning py-4">
    <el-col :span="8">
      <el-statistic  title="Daily active users" :value="268500" />
    </el-col>
    <el-col :span="8">
      <el-statistic title="Total Hospital User" :value="outputValue" />
    </el-col>
    <el-col :span="8" >
      <el-statistic title="Feedback number" :value="outputFeedBack">
        <template #suffix>
          <el-icon style="vertical-align: -0.125em">
            <ChatLineRound />
          </el-icon>
        </template>
      </el-statistic>
    </el-col>
  </el-row>
</template>
<style scoped>
.bg-card{
  width: 80px;
  background-color: #FCB22D;
}
.state{
  color: white;
}
.bg-card img{
  width: 100%;
}
.el-col {
  text-align: center;
}
.el-statistic {
  --el-statistic-title-color: white;
  --el-statistic-content-color: #32B4E3;
  --el-statistic-content-font-size: 20px;
  --el-statistic-title-font-size: 20px;
  --el-statistic-content-font-weight: bold;
}
.w-25 img{
  width: 400px;
}
</style>