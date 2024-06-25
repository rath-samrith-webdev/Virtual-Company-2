<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import { ref } from 'vue'
import { useTransition } from '@vueuse/core'
import {
  ChatLineRound,
  DataAnalysis,
  FirstAidKit,
  Location,
  Memo,
  Position,
  Search,
  Service,
  SuitcaseLine,
  User,
  View
} from '@element-plus/icons-vue'

const source = ref(0)
const feedbacks = ref(0)
const outputValue = useTransition(source, {
  duration: 1500
})
const outputFeedBack = useTransition(feedbacks, {
  duration: 1500
})
source.value = 172000
feedbacks.value = 512
</script>

<template>
  <WebLayout>
    <div class="container">
      <div class="card-header">
        <h1>Hospital Details</h1>
      </div>
      <!-- ======================================================= -->
      <!-- hospital details -->
      <!-- ======================================================= -->
      <div class="card-container">
        <div class="card-left">
          <img src="@/assets/image/hospital1.png" alt="image" />
        </div>
        <div class="card-right">
          <div class="title">
            <span>Royal Phnom Penh Hospital</span>
            <el-divider />
          </div>
          <div class="information mb-4">
            <div>
              <strong>Open: Monday-Sunday 24/7</strong>
            </div>
            <div>
              <strong>
                Location: BP 511, Phum Tropeang Chhuk (Borey Sorla) Sangtak, Street 371, Phnom Penh
              </strong>
            </div>
          </div>
          <div class="rate mb-4">
            <el-rate
              size="large"
              v-model="value"
              disabled
              show-score
              text-color="#ff9900"
              score-template="{value} points"
            />
            <el-divider />
          </div>
          <div class="contact-information">
            <div class="mb-4 mt-1">
              <el-button type="primary">Contact</el-button>
              <el-button type="success">Booking</el-button>
              <el-button type="warning">Location</el-button>
            </div>
          </div>
        </div>
      </div>
      <!-- ======================================================= -->
      <!-- information comment -->
      <!-- ======================================================= -->
      <div class="comment-container">
        <div class="comment-left">
          <div class="demo-type">
            <!-- Avatar with dynamic source -->
            <el-avatar :size="90" :src="avatarUrl">
              <img :src="avatarUrl" />
            </el-avatar>
          </div>
        </div>
        <div class="comment-right">
          <div class="information mb-4">
            <div>
              <strong>
                Location: BP 511, Phum Tropeang Chhuk (Borey Sorla) Sangtak, Street 371, Phnom Penh
              </strong>
            </div>
          </div>
        </div>
      </div>
    </div>
  </WebLayout>
</template>

<style scoped>
.container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-top: 50px;
}
.card-container {
  width: 90%;
  height: 100vh;
  display: flex;
  /* flex-direction: column; */
  margin-top: 20px;
  border-radius: 20px;
}
.comment-container {
  background: linear-gradient(to right, rgba(252, 178, 45, 0.8), rgba(249, 125, 0, 0.2));
  margin: 10px;
  border-radius: 8px;
  margin-top: 20px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 2px 4px rgba(0, 0, 0, 0.06);
  width: 90%;
  height: 13vh;
  display: flex;
  /* flex-direction: column; */
  margin-top: 60px;
}
.card-left,
.card-right {
  width: 50%;
}
.comment-left,
.comment-right {
  /* width: 30%; */
}
.card-left img {
  height: 100%;
}
.card-left {
  background: #878484;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.card-right {
  background: #fcb22d;
  display: flex;
  flex-direction: column;
  padding: 60px;
}
.card-header {
  /* background: #fcb22d; */
  width: 100%;
  height: 20%;
  display: flex;
  justify-content: center;
}
span {
  font-size: 70px;
  font-weight: bold;
}
.title {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-bottom: 20px;
}
</style>

