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
  Search,
  Service,
  SuitcaseLine,
  User,
  View
} from '@element-plus/icons-vue'
import FooterLayout from '@/Components/FooterLayout.vue'

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
    <div class="first-landing d-flex justify-content-center mt-4 ml-20">
      <div class="d-flex flex-column mt-10">
        <div class="w-50 px-4 d-flex flex-column justify-content-between gap-3">
          <div class="mt-3">
            <h3 style="font-size: 40px; font-weight: bold">Welcome to,</h3>
            <h1 class="d-flex" style="font-size: 120px; font-weight: bold">
              <span class="text-#32B4E3 font-bold">C</span>are
              <span class="text-#32B4E3 font-bold">F</span>inder!
            </h1>
          </div>
        </div>
        <div class="d-flex justify-content-start mt-10 ml-5">
          <el-card class="rounded-50% bg-card">
            <img src="@/assets/image/Telegram.png" class="card-img" alt="" />
          </el-card>
          <el-card class="rounded-50% bg-card d-flex flex-column align-items-center">
            <img src="@/assets/image/linkeding.png" class="card-img" alt="" />
          </el-card>
          <el-card class="rounded-50% bg-card d-flex flex-column align-items-center">
            <img src="@/assets/image/instagram.png" class="card-img" alt="" />
          </el-card>
          <el-card class="rounded-50% bg-card d-flex flex-column align-items-center">
            <img src="@/assets/image/gmail.png" class="card-img" alt="" />
          </el-card>
        </div>
        <!-- buttun to get start with rout link to login -->
        <div class="m-4 mt-4">
          <router-link to="/login" class="btn py-1 rounded font-semibold text-white log-in">
            <button class="animated-button">
              <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
              </svg>
              <span class="text">Get Start!</span>
              <span class="circle"></span>
              <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
              </svg>
            </button>
          </router-link>
        </div>
      </div>
      <div class="ml-25">
        <img class="landing-image" src="@/assets/Doctors/Doctor 2.png" alt="" />
      </div>
    </div>
  </WebLayout>
  <el-row class="state bg-#32B4E3 py-4 mt-40">
    <el-col :span="8">
      <el-statistic title="Daily active users" :value="268500" class="custom-statistic" />
    </el-col>
    <el-col :span="8">
      <el-statistic title="Total Hospital User" :value="outputValue" class="custom-statistic" />
    </el-col>
    <el-col :span="8">
      <el-statistic title="Feedback number" :value="outputFeedBack" class="custom-statistic">
        <template #suffix>
          <el-icon style="vertical-align: -0.125em">
            <ChatLineRound />
          </el-icon>
        </template>
      </el-statistic>
    </el-col>
  </el-row>
  <el-container class="d-flex flex-column align-items-center mt-lg-60 mt-40">
    <el-row class="d-flex justify-content-center py-4">
      <h1 class="text-center font-bold">
        <span class="text-#32B4E3 font-bold">O</span>ur
        <span class="text-#32B4E3 font-bold">T</span>eam
        <p>Ours team build the system Care Finder</p>
      </h1>
    </el-row>
    <!-- ======================================================= -->
    <!-- member-building -->
    <!-- ======================================================= -->
    <div class="members-building d-flex flex-wrap">
      <el-container
        class="container-fluid​ flex-wrap px-20 d-flex flex-column align-items-center mt-20"
      >
        <div
          class="container inner d-flex flex-wrap justify-content-center align-items-start mt-10 gap-1"
        >
          <!-- member-1 -->
          <el-card style="width: 300px" class="d-flex card-member flex-column align-items-center">
            <div class="rounded-50% d-flex justify-content-center">
              <img src="@/assets/members/Phal.jpg" alt="" class="img-fluid w-75 card-img" />
            </div>
            <el-row class="d-flex justify-content-center mt-4">
              <span class="font-bold role-team">UX/UI MANAGER</span>
            </el-row>
            <el-row class="d-flex justify-content-center mt-2">
              <h3 class="text-#32B4E3 text-center">Ms. Phal Him</h3>
            </el-row>
            <el-row class="d-flex justify-content-center mt-2">
              <span>Responsible for design the system, website interface and easy to use.</span>
            </el-row>
            <el-row class="d-flex justify-content-center gap-3 mt-3">
              <el-tooltip class="box-item" effect="dark" content="LinkedIn" placement="top-start">
                <el-avatar
                  shape="circle"
                  :src="'https://cdn1.iconfinder.com/data/icons/logotypes/32/circle-linkedin-512.png'"
                ></el-avatar>
              </el-tooltip>
              <el-tooltip class="box-item" effect="dark" content="Gmail" placement="top-start">
                <el-avatar
                  shape="circle"
                  class="social-media-contact"
                  :src="'https://cdn-icons-png.freepik.com/512/6711/6711567.png'"
                ></el-avatar>
              </el-tooltip>
              <el-tooltip class="box-item" effect="dark" content="Instagram" placement="top-start">
                <el-avatar
                  shape="circle"
                  :src="'https://banner2.cleanpng.com/20200525/hhx/transparent-instagram-logo-icon-5ecc25c4860dd5.0946990115904373165491.jpg'"
                ></el-avatar>
              </el-tooltip>
              <el-tooltip class="box-item" effect="dark" content="Github" placement="top-start">
                <el-avatar
                  shape="circle"
                  :src="'https://static-00.iconduck.com/assets.00/github-icon-512x512-n39zyshv.png'"
                  class="bg-white"
                ></el-avatar>
              </el-tooltip>
            </el-row>
          </el-card>
          <!-- member-2 -->
          <el-card style="width: 300px" class="d-flex card-member flex-column align-items-center">
            <div class="rounded-50% d-flex justify-content-center">
              <img src="@/assets/members/Rath.jpg" alt="" class="img-fluid w-75 card-img" />
            </div>
            <el-row class="d-flex justify-content-center mt-4">
              <span class="font-bold role-team">SRUM MASTER</span>
            </el-row>
            <el-row class="d-flex justify-content-center mt-2">
              <h3 class="text-#32B4E3 text-center">Mr. Rath Samrath</h3>
            </el-row>
            <el-row class="d-flex justify-content-center mt-2">
              <span>Responsible for lead the team, devide tasks to members, lead the project.</span>
            </el-row>
            <el-row class="d-flex justify-content-center gap-3 mt-3">
              <el-tooltip class="box-item" effect="dark" content="LinkedIn" placement="top-start">
                <el-avatar
                  shape="circle"
                  :src="'https://cdn1.iconfinder.com/data/icons/logotypes/32/circle-linkedin-512.png'"
                ></el-avatar>
              </el-tooltip>
              <el-tooltip class="box-item" effect="dark" content="Gmail" placement="top-start">
                <el-avatar
                  shape="circle"
                  class="social-media-contact"
                  :src="'https://cdn-icons-png.freepik.com/512/6711/6711567.png'"
                ></el-avatar>
              </el-tooltip>
              <el-tooltip class="box-item" effect="dark" content="Instagram" placement="top-start">
                <el-avatar
                  shape="circle"
                  :src="'https://banner2.cleanpng.com/20200525/hhx/transparent-instagram-logo-icon-5ecc25c4860dd5.0946990115904373165491.jpg'"
                ></el-avatar>
              </el-tooltip>
              <el-tooltip class="box-item" effect="dark" content="Github" placement="top-start">
                <el-avatar
                  shape="circle"
                  :src="'https://static-00.iconduck.com/assets.00/github-icon-512x512-n39zyshv.png'"
                  class="bg-white"
                ></el-avatar>
              </el-tooltip>
            </el-row>
          </el-card>
          <!-- member-3 -->
          <el-card style="width: 300px" class="d-flex card-member flex-column align-items-center">
            <div class="rounded-50% d-flex justify-content-center">
              <img src="@/assets/members/Radit.jpg" alt="" class="img-fluid w-75 card-img" />
            </div>
            <el-row class="d-flex justify-content-center mt-4">
              <span class="font-bold role-team">DEVOPS MANAGER</span>
            </el-row>
            <el-row class="d-flex justify-content-center mt-2">
              <h3 class="text-#32B4E3 text-center">Mr. Radit Thy</h3>
            </el-row>
            <el-row class="d-flex justify-content-center mt-2">
              <span>Responsible for hosting the website, make website hosting security.</span>
            </el-row>
            <el-row class="d-flex justify-content-center gap-3 mt-3">
              <el-tooltip class="box-item" effect="dark" content="LinkedIn" placement="top-start">
                <el-avatar
                  shape="circle"
                  :src="'https://cdn1.iconfinder.com/data/icons/logotypes/32/circle-linkedin-512.png'"
                ></el-avatar>
              </el-tooltip>
              <el-tooltip class="box-item" effect="dark" content="Gmail" placement="top-start">
                <el-avatar
                  shape="circle"
                  class="social-media-contact"
                  :src="'https://cdn-icons-png.freepik.com/512/6711/6711567.png'"
                ></el-avatar>
              </el-tooltip>
              <el-tooltip class="box-item" effect="dark" content="Instagram" placement="top-start">
                <el-avatar
                  shape="circle"
                  :src="'https://banner2.cleanpng.com/20200525/hhx/transparent-instagram-logo-icon-5ecc25c4860dd5.0946990115904373165491.jpg'"
                ></el-avatar>
              </el-tooltip>
              <el-tooltip class="box-item" effect="dark" content="Github" placement="top-start">
                <el-avatar
                  shape="circle"
                  :src="'https://static-00.iconduck.com/assets.00/github-icon-512x512-n39zyshv.png'"
                  class="bg-white"
                ></el-avatar>
              </el-tooltip>
            </el-row>
          </el-card>
          <!-- member-4 -->
          <el-card style="width: 300px" class="d-flex card-member flex-column align-items-center">
            <div class="rounded-50% d-flex justify-content-center">
              <img src="@/assets/members/Sreynang.jpg" alt="" class="img-fluid w-75 card-img" />
            </div>
            <el-row class="d-flex justify-content-center mt-4">
              <span class="font-bold role-team">DATABASES MANAGER</span>
            </el-row>
            <el-row class="d-flex justify-content-center mt-2">
              <h3 class="text-#32B4E3 text-center">Ms. Sreynang Rith</h3>
            </el-row>
            <el-row class="d-flex justify-content-center mt-2">
              <span
                >Responsible for design the databases, relationship of data and preprere data.</span
              >
            </el-row>
            <el-row class="d-flex justify-content-center gap-3 mt-3">
              <el-tooltip class="box-item" effect="dark" content="LinkedIn" placement="top-start">
                <el-avatar
                  shape="circle"
                  :src="'https://cdn1.iconfinder.com/data/icons/logotypes/32/circle-linkedin-512.png'"
                ></el-avatar>
              </el-tooltip>
              <el-tooltip class="box-item" effect="dark" content="Gmail" placement="top-start">
                <el-avatar
                  shape="circle"
                  class="social-media-contact"
                  :src="'https://cdn-icons-png.freepik.com/512/6711/6711567.png'"
                ></el-avatar>
              </el-tooltip>
              <el-tooltip class="box-item" effect="dark" content="Instagram" placement="top-start">
                <el-avatar
                  shape="circle"
                  :src="'https://banner2.cleanpng.com/20200525/hhx/transparent-instagram-logo-icon-5ecc25c4860dd5.0946990115904373165491.jpg'"
                ></el-avatar>
              </el-tooltip>
              <el-tooltip class="box-item" effect="dark" content="Github" placement="top-start">
                <el-avatar
                  shape="circle"
                  :src="'https://static-00.iconduck.com/assets.00/github-icon-512x512-n39zyshv.png'"
                  class="bg-white"
                ></el-avatar>
              </el-tooltip>
            </el-row>
          </el-card>
          <!-- member-5 -->
          <el-card style="width: 300px" class="d-flex card-member flex-column align-items-center">
            <div class="rounded-50% d-flex justify-content-center">
              <img src="@/assets/members/Bour.jpg" alt="" class="img-fluid w-75 card-img" />
            </div>
            <el-row class="d-flex justify-content-center mt-4">
              <span class="font-bold role-team">QA MANAGER</span>
            </el-row>
            <el-row class="d-flex justify-content-center mt-2">
              <h3 class="text-#32B4E3 text-center">Mr. Bour Klan</h3>
            </el-row>
            <el-row class="d-flex justify-content-center mt-2">
              <span>Responsible for testing the system make usre smoothly without bug.</span>
            </el-row>
            <el-row class="d-flex justify-content-center gap-3 mt-3">
              <el-tooltip class="box-item" effect="dark" content="LinkedIn" placement="top-start">
                <el-avatar
                  shape="circle"
                  :src="'https://cdn1.iconfinder.com/data/icons/logotypes/32/circle-linkedin-512.png'"
                ></el-avatar>
              </el-tooltip>
              <el-tooltip class="box-item" effect="dark" content="Gmail" placement="top-start">
                <el-avatar
                  shape="circle"
                  class="social-media-contact"
                  :src="'https://cdn-icons-png.freepik.com/512/6711/6711567.png'"
                ></el-avatar>
              </el-tooltip>
              <el-tooltip class="box-item" effect="dark" content="Instagram" placement="top-start">
                <el-avatar
                  shape="circle"
                  :src="'https://banner2.cleanpng.com/20200525/hhx/transparent-instagram-logo-icon-5ecc25c4860dd5.0946990115904373165491.jpg'"
                ></el-avatar>
              </el-tooltip>
              <el-tooltip class="box-item" effect="dark" content="Github" placement="top-start">
                <el-avatar
                  shape="circle"
                  :src="'https://static-00.iconduck.com/assets.00/github-icon-512x512-n39zyshv.png'"
                  class="bg-white"
                ></el-avatar>
              </el-tooltip>
            </el-row>
          </el-card>
          <!-- member-6 -->
          <el-card style="width: 300px" class="d-flex card-member flex-column align-items-center">
            <div class="rounded-50% d-flex justify-content-center">
              <img src="@/assets/members/Leysreng.jpg" alt="" class="img-fluid w-75 card-img" />
            </div>
            <el-row class="d-flex justify-content-center mt-4">
              <span class="font-bold role-team">CODE QUALITY MANAGER</span>
            </el-row>
            <el-row class="d-flex justify-content-center mt-2">
              <h3 class="text-#32B4E3 text-center">Ms. Leysreng Ol</h3>
            </el-row>
            <el-row class="d-flex justify-content-center mt-2">
              <span>Responsible for make clearn code, flow smoothly and faster.</span>
            </el-row>
            <el-row class="d-flex justify-content-center gap-3 mt-3">
              <el-tooltip class="box-item" effect="dark" content="LinkedIn" placement="top-start">
                <el-avatar
                  shape="circle"
                  :src="'https://cdn1.iconfinder.com/data/icons/logotypes/32/circle-linkedin-512.png'"
                ></el-avatar>
              </el-tooltip>
              <el-tooltip class="box-item" effect="dark" content="Gmail" placement="top-start">
                <el-avatar
                  shape="circle"
                  class="social-media-contact"
                  :src="'https://cdn-icons-png.freepik.com/512/6711/6711567.png'"
                ></el-avatar>
              </el-tooltip>
              <el-tooltip class="box-item" effect="dark" content="Instagram" placement="top-start">
                <el-avatar
                  shape="circle"
                  :src="'https://banner2.cleanpng.com/20200525/hhx/transparent-instagram-logo-icon-5ecc25c4860dd5.0946990115904373165491.jpg'"
                ></el-avatar>
              </el-tooltip>
              <el-tooltip class="box-item" effect="dark" content="Github" placement="top-start">
                <el-avatar
                  shape="circle"
                  :src="'https://static-00.iconduck.com/assets.00/github-icon-512x512-n39zyshv.png'"
                  class="bg-white"
                ></el-avatar>
              </el-tooltip>
            </el-row>
          </el-card>
        </div>
      </el-container>
    </div>
  </el-container>
  <el-container class="px2 d-flex flex-column mt-10">
    <el-row class="d-flex justify-content-around mt-3 gap-3 p-5">
      <el-col :span="5" class="d-flex flex-column justify-content-between align-items-center mb-3">
        <div class="text-center">
          <img class="w-150" src="@/assets/image/hospital-icon.png" alt="image" />
        </div>
      </el-col>
      <el-col :span="7" class="d-flex flex-column justify-start align-items-start mt-5">
        <div>
          <h1 class="text-center" style="font-size: 90px; font-weight: bold">
            <span class="text-#32B4E3 font-bold">H</span>ospital
            <span class="text-#32B4E3 font-bold">S</span>upport
          </h1>
          <el-timeline class="mt-4">
            <el-timeline-item class="text-start" style="font-size: 18px; font-weight: bold"
              >Bring a good book. Have a book you've.
            </el-timeline-item>
            <el-timeline-item class="text-start" style="font-size: 18px; font-weight: bold"
              >If your diet allows, ask for your favorite.
            </el-timeline-item>
            <el-timeline-item class="text-start" style="font-size: 18px; font-weight: bold"
              >to get through for a while but never.
            </el-timeline-item>
            <el-timeline-item class="text-start" style="font-size: 18px; font-weight: bold"
              >Hospitals and Private health Hospitals.
            </el-timeline-item>
            <el-timeline-item class="text-start" style="font-size: 18px; font-weight: bold"
              >Surround yourself with positive people.
            </el-timeline-item>
            <el-timeline-item class="text-start" style="font-size: 18px; font-weight: bold"
              >Display pictures of your family and friends.
            </el-timeline-item>
          </el-timeline>
        </div>
      </el-col>
    </el-row>
  </el-container>
  <el-container class="container-fluid value px-20 d-flex flex-column align-items-center mt-20">
    <div class="container inner d-flex justify-content-center gap-lg-5 align-items-start mt-135">
      <el-card style="width: 230px" class="d-flex card-item flex-column align-items-center">
        <div class="d-flex justify-content-center">
          <el-avatar class="bg-white" :size="80">
            <FirstAidKit style="color: #32b4e3; font-size: 10px" />
          </el-avatar>
        </div>
        <h3 class="mt-2">Mission</h3>
        <p>To serve and enrich the quality of life of patients suffering</p>
      </el-card>
      <el-card style="width: 230px" class="d-flex card-item flex-column align-items-center">
        <div class="d-flex justify-content-center">
          <el-avatar class="bg-white" :size="80">
            <View style="color: #32b4e3; font-size: 10px" />
          </el-avatar>
        </div>
        <h3>Vision</h3>
        <p>Our people strive to work wholeheartedly, think positively</p>
      </el-card>
      <el-card style="width: 230px" class="d-flex card-item flex-column align-items-center">
        <div class="d-flex justify-content-center">
          <el-avatar class="bg-white" :size="80">
            <SuitcaseLine style="color: #32b4e3; font-size: 10px" />
          </el-avatar>
        </div>
        <h3 class="mt-2">Value</h3>
        <p>Premier patient-centered tertiary healthcare institution in East</p>
      </el-card>
      <el-card style="width: 230px" class="d-flex card-item flex-column align-items-center">
        <div class="d-flex justify-content-center">
          <el-avatar class="bg-white" :size="80">
            <Service style="color: #32b4e3; font-size: 10px" />
          </el-avatar>
        </div>
        <h3 class="mt-2">Service</h3>
        <p>We establish and operate an emergency medical center to provide</p>
      </el-card>
    </div>
  </el-container>
  <FooterLayout />
</template>
<style scoped>
.bg-card {
  width: 80px;
}
.bg-card:hover {
  background-color: #32b4e3;
}

.card-img {
  border-radius: 0 20% 20% 0%;
}

.footer {
  height: 40vh;
}

.state {
  color: white;
}

.head-img {
  position: absolute;
  top: -30px;
  right: 150px;
  z-index: 1;
}

.bg-card img {
  width: 100%;
}

.el-col {
  text-align: center;
}

.value {
  height: 120vh;
  background-image: url('@/assets/image/value_image.png');
  background-size: cover;
  background-repeat: no-repeat;
}

.inner {
  height: 100%;
}

.el-statistic {
  --el-statistic-content-color: #ffffff;
  --el-statistic-content-font-size: 45px;
  --el-statistic-title-font-size: 25px;
  --el-statistic-content-font-weight: bold;
}

.w-25 img {
  width: 400px;
}
.members-card {
  background: white;
  width: 50%;
  height: 65vh;
  border-radius: 0% 5% 5% 0%;
}
.members-card:hover {
  transition: 0.3s;
  background-color: #32b4e3;
  color: white;
}
.role-team {
  color: gray;
}
.members {
  background-color: #f3f3f4;
  width: 100%;
  height: 170vh;
}
/* member-building */
.members-building {
  background-color: #f3f3f4;
  width: 100%;
  height: 170vh;
}
.card-member {
  text-align: center;
  background-color: #ffffff;
  border: none;
  height: 65vh;
  border-radius: 5px;
}
/* .card-member:hover {
  transition: 0.3s;
  background-color: #32b4e3;
  color: white;
} */

.el-card {
  margin: 4px;
}
.landing-image {
  width: 95%;
}

/* btn get start style */
.animated-button {
  position: relative;
  display: flex;
  align-items: center;
  gap: 4px;
  padding: 10px 36px;
  border: 4px solid;
  border-color: transparent;
  font-size: 16px;
  background-color: inherit;
  border-radius: 100px;
  font-weight: 600;
  color: #32b4e3;
  box-shadow: 0 0 0 2px #32b4e3;
  cursor: pointer;
  overflow: hidden;
  transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
}

.animated-button svg {
  position: absolute;
  width: 24px;
  fill: #32b4e3;
  z-index: 9;
  transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
}

.animated-button .arr-1 {
  right: 16px;
}

.animated-button .arr-2 {
  left: -25%;
}

.animated-button .circle {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 20px;
  height: 20px;
  background-color: #32b4e3;
  border-radius: 50%;
  opacity: 0;
  transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
}

.animated-button .text {
  position: relative;
  z-index: 1;
  transform: translateX(-12px);
  transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
}

.animated-button:hover {
  box-shadow: 0 0 0 12px transparent;
  color: white;
  border-radius: 12px;
}

.animated-button:hover .arr-1 {
  right: -25%;
}

.animated-button:hover .arr-2 {
  left: 16px;
}

.animated-button:hover .text {
  transform: translateX(12px);
}

.animated-button:hover svg {
  fill: white;
}

.animated-button:active {
  scale: 0.95;
  box-shadow: 0 0 0 4px #32b4e3;
}

.animated-button:hover .circle {
  width: 220px;
  height: 220px;
  opacity: 1;
}
</style>
