<template>
  <WebLayout>
    <div class="container">
      <div class="card-header">
        <h1 class="text-color-#32B4E3 font-size" style="font-size: 50px; font-weight: bold">
          Hospital Details
        </h1>
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
            <span class="title-hospital text-color-#ffff">Royal Phnom Penh Hospital</span>
            <el-divider />
          </div>
          <div class="information mb-4">
            <div><strong>Open: Monday-Sunday 24/7</strong></div>
            <div>
              <strong
                >Location: BP 511, Phum Tropeang Chhuk (Borey Sorla) Sangtak, Street 371, Phnom
                Penh</strong
              >
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
        </div>
      </div>
      <!-- ======================================================= -->
      <!-- comment information-->
      <!-- ======================================================= -->
      <div class="container-information">
        <el-tabs v-model="activeName" class="demo-tabs" @tab-click="handleClick">
          <el-tab-pane class="" label="Comments and Feedback" name="first">
            <div class="main-comment">
              <h5 class="mt-4 text-color-#32B4E3">Comments there to our hospital!</h5>
              <div class="comment-form mt-1">
                <el-form
                  class="form-comment mt-4"
                  :model="form"
                  label-width="auto"
                  style="max-width: 2000px"
                >
                  <el-form-item class="hello">
                    <el-input
                      v-model="form.desc"
                      type="text"
                      placeholder="Write your comment here!"
                      class="custom-input"
                    />
                  </el-form-item>
                  <el-form-item>
                    <el-button type="#ffff" class="text-color-#ffff btn-comment" @click="onSubmit"
                      >Submit</el-button
                    >
                    <el-button type="warning">Cancel</el-button>
                  </el-form-item>
                </el-form>
              </div>
              <div class="demo-collapse mt-4">
                <el-collapse v-model="activeNames" @change="handleChange">
                  <el-collapse-item title="Show All the Comments" name="1">
                    <div
                      class="comment-container p-3 mt-3"
                      v-for="comment in comments"
                      :key="comment.id"
                    >
                      <div class="comment-left d-flex flex-column p-2">
                        <div class="demo-type">
                          <el-avatar :size="70">
                            <img :src="comment.avatar" />
                          </el-avatar>
                        </div>
                      </div>
                      <div class="comment-right p-2">
                        <div class="information">
                          <div>
                            <p>
                              <strong>{{ comment.name }}</strong> . <span>{{ comment.time }}</span>
                            </p>
                          </div>
                          <div>
                            <p>{{ comment.content }}</p>
                          </div>
                          <div>
                            <el-rate
                              v-model="comment.value"
                              disabled
                              show-score
                              text-color="#ff9900"
                              score-template="{value} points"
                            />
                          </div>
                          <div class="mt-2">
                            <el-button
                              v-for="button in buttons"
                              :key="button.text"
                              :type="button.type"
                              text
                              bg
                            >
                              {{ button.text }}
                            </el-button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </el-collapse-item>
                </el-collapse>
              </div>
            </div>
          </el-tab-pane>
          <el-tab-pane label="Hospital Doctors" name="second">
            <div class="d-flex align-item-center text-align-center DT">
              <h4 class="mt-4 text-color-#32B4E3">Our Doctor In Hostpital</h4>
            </div>
            <div class="doctor-container d-flex flex-wrap gap-4">
              <div
                class="doctor-members d-flex flex-column justity-content-center p-2"
                v-for="doctor in doctors"
                :key="doctor.id"
              >
                <div class="demo-type mt-2">
                  <el-avatar :size="100">
                    <img :src="doctor.avatar" />
                  </el-avatar>
                </div>
                <h4 class="text-color-#32B4E3">{{doctor.name}}</h4>
                <h6>{{doctor.role}}</h6>
                <el-row class="d-flex justify-content-center gap-3 mt-3">
                  <el-tooltip
                    class="box-item"
                    effect="dark"
                    content="LinkedIn"
                    placement="top-start"
                  >
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
                  <el-tooltip
                    class="box-item"
                    effect="dark"
                    content="Instagram"
                    placement="top-start"
                  >
                    <el-avatar
                      shape="circle"
                      :src="'https://banner2.cleanpng.com/20200525/hhx/transparent-instagram-logo-icon-5ecc25c4860dd5.0946990115904373165491.jpg'"
                    ></el-avatar>
                  </el-tooltip>
                </el-row>
              </div>
            </div>
          </el-tab-pane>
          <el-tab-pane label="Hospital Departments" name="third" class="mt-4">
            <el-table :data="tableData" height="250" style="width: 100%">
              <el-table-column prop="id" label="Department ID" width="180" />
              <el-table-column prop="departmentName" label="Department Name" width="880" />
            </el-table>
          </el-tab-pane>
          <el-tab-pane label="Hospital Calendar" name="fourth">
            <el-calendar ref="calendar">
              <template #header="{ date }">
                <span>Custom header content</span>
                <span>{{ date }}</span>
                <el-button-group>
                  <el-button size="small" @click="selectDate('prev-year')">
                    Previous Year
                  </el-button>
                  <el-button size="small" @click="selectDate('prev-month')">
                    Previous Month
                  </el-button>
                  <el-button size="small" @click="selectDate('today')">Today</el-button>
                  <el-button size="small" @click="selectDate('next-month')"> Next Month </el-button>
                  <el-button size="small" @click="selectDate('next-year')"> Next Year </el-button>
                </el-button-group>
              </template>
            </el-calendar>
          </el-tab-pane>
          <el-tab-pane label="Hospital Contact" name="five">Comments and Feedback</el-tab-pane>
          <el-tab-pane label="Hospital Location " name="six">Location Hospital</el-tab-pane>
        </el-tabs>
      </div>
    </div>
  </WebLayout>
</template>

<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import { ref, reactive } from 'vue'
import { ElMessage } from 'element-plus'
import { Calendar } from '@element-plus/icons-vue/dist/types'

const dialogFormVisible = ref(false)
const form = reactive({
  fullname: '',
  phone_number: '',
  age: '',
  gender: '',
  department: '',
  doctor: '',
  date: '',
  time: ''
})

const buttons = [
  {
    text: 'Reply',
    type: 'primary'
  },
  {
    text: 'Like',
    type: 'warning'
  }
]
const formRules = reactive({
  fullname: [{ required: true, message: 'Please enter your full name', trigger: 'blur' }],
  phone_number: [{ required: true, message: 'Please enter your phone number', trigger: 'blur' }],
  age: [{ required: true, message: 'Please enter your age', trigger: 'blur' }],
  gender: [{ required: true, message: 'Please select your gender', trigger: 'change' }],
  department: [{ required: true, message: 'Please select a department', trigger: 'change' }],
  doctor: [{ required: true, message: 'Please select a doctor', trigger: 'change' }],
  date: [{ required: true, message: 'Please select an appointment date', trigger: 'change' }],
  time: [{ required: true, message: 'Please select an appointment time', trigger: 'change' }]
})

const comments = [
  {
    id: 1,
    name: 'Florida',
    time: '30 min ago',
    content: 'To highlight a number or a group of numbers...',
    avatar:
      'https://dl.memuplay.com/new_market/img/com.vicman.newprofilepic.icon.2022-06-07-21-33-07.png',
    value: 4.5
  },
  {
    id: 2,
    name: 'Radit Thy',
    time: '1h ago',
    content: 'To highlight a number or a group of numbers...',
    avatar:
      'https://media.licdn.com/dms/image/D5603AQGCCYbUstS9xg/profile-displayphoto-shrink_400_400/0/1718211706383?e=1724889600&v=beta&t=AsGCwsdVHSL4a9JCH2ucQwk3JNZtcsX9KymwXSkAKYk',
    value: 4.2
  },
  {
    id: 3,
    name: 'Rath Samrath',
    time: '1 day ago',
    content: 'To highlight a number or a group of numbers...',
    avatar:
      'https://media.licdn.com/dms/image/D5603AQFJJOAM6AAM-Q/profile-displayphoto-shrink_400_400/0/1704010367613?e=1724889600&v=beta&t=lT_OdIqbG4SCKpu95R71jbp9ZqEGVhglDVTitXqp7GA',
    value: 4.8
  }
]
const doctors = [
  {
    id: 1,
    name: 'Florida',
    role: '30 min ago',
    avatar:
      'https://dl.memuplay.com/new_market/img/com.vicman.newprofilepic.icon.2022-06-07-21-33-07.png',
    value: 4.5
  },
  {
    id: 2,
    name: 'Radit Thy',
    role: '30 min ago',
    avatar:
      'https://media.licdn.com/dms/image/D5603AQGCCYbUstS9xg/profile-displayphoto-shrink_400_400/0/1718211706383?e=1724889600&v=beta&t=AsGCwsdVHSL4a9JCH2ucQwk3JNZtcsX9KymwXSkAKYk',
    value: 4.2
  },
  {
    id: 3,
    name: 'Rath Samrath',
    role: '30 min ago',
    avatar:
      'https://media.licdn.com/dms/image/D5603AQFJJOAM6AAM-Q/profile-displayphoto-shrink_400_400/0/1704010367613?e=1724889600&v=beta&t=lT_OdIqbG4SCKpu95R71jbp9ZqEGVhglDVTitXqp7GA',
    value: 4.8
  },
  {
    id: 4,
    name: 'Rath Samrath',
    role: '30 min ago',
    avatar:
      'https://media.licdn.com/dms/image/D5603AQFJJOAM6AAM-Q/profile-displayphoto-shrink_400_400/0/1704010367613?e=1724889600&v=beta&t=lT_OdIqbG4SCKpu95R71jbp9ZqEGVhglDVTitXqp7GA',
    value: 4.8
  },
  {
    id: 5,
    name: 'Rath Samrath',
    role: '30 min ago',
    avatar:
      'https://media.licdn.com/dms/image/D5603AQFJJOAM6AAM-Q/profile-displayphoto-shrink_400_400/0/1704010367613?e=1724889600&v=beta&t=lT_OdIqbG4SCKpu95R71jbp9ZqEGVhglDVTitXqp7GA',
    value: 4.8
  },
  {
    id: 6,
    name: 'Rath Samrath',
    role: '30 min ago',
    avatar:
      'https://media.licdn.com/dms/image/D5603AQFJJOAM6AAM-Q/profile-displayphoto-shrink_400_400/0/1704010367613?e=1724889600&v=beta&t=lT_OdIqbG4SCKpu95R71jbp9ZqEGVhglDVTitXqp7GA',
    value: 4.8
  }
]

const tableData = [
  {
    id: '1',
    departmentName: 'Executive and VVIP Wards.'
  },
  {
    id: '2',
    departmentName: 'Intensive Care Unit.'
  },
  {
    id: '3',
    departmentName: 'Medical and Surgical Ward.'
  },
  {
    id: '4',
    departmentName: 'Maternity Ward.'
  },
  {
    id: '5',
    departmentName: 'Neonatal ICU.'
  },
  {
    id: '6',
    departmentName: 'Paediatric Ward.'
  },
  {
    id: '7',
    departmentName: 'Tom'
  }
]

const onSubmit = () => {
  // Logic for form submission can be added here
  ElMessage.success('Form submitted successfully!')
  console.log('hello')
}

// Calendar
import type { CalendarDateType, CalendarInstance } from 'element-plus'

const calendar = ref<CalendarInstance>()
const selectDate = (val: CalendarDateType) => {
  if (!calendar.value) return
  calendar.value.selectDate(val)
}
</script>

<style scoped>
.container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-top: 50px;
}

.card-container {
  width: 100%;
  height: 80vh;
  display: flex;
  margin-top: 20px;
  border-radius: 20px;
}

.comment-container {
  background: linear-gradient(to right, rgba(249, 249, 249, 0.8), rgba(239, 234, 234, 0.2));
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 2px 4px rgba(0, 0, 0, 0.06);
  height: 30vh;
  display: flex;
}

.card-left,
.card-right {
  width: 50%;
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
  background: #32b4e3;
  display: flex;
  flex-direction: column;
  padding: 60px;
}

.card-header {
  width: 100%;
  height: 20%;
  display: flex;
  justify-content: center;
}

.title-hospital {
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

.item {
  margin-top: 10px;
  margin-right: 30px;
}

.demo-collapse {
  width: 100%;
}

.form-comment {
  width: 100%;
  margin: 0 auto;
}

.comment-form {
  width: 100%;
  height: 23vh;
  background: linear-gradient(to right, rgba(249, 249, 249, 0.8));
  box-shadow: 0 4px 6px rgba(167, 167, 167, 0.1), 0 2px 4px rgba(255, 255, 255, 0.06);
}

.main-comment {
  width: 100%;
  /* box-shadow: 0 4px 6px rgba(167, 167, 167, 0.1), 0 2px 4px rgba(255, 255, 255, 0.06); */
}
.custom-input {
  font-size: 1rem;
  background: #32b4e3;
  /* padding: 1px; */
  border-radius: 20px;
  height: 8vh;
}
.btn-comment {
  background: #32b4e3;
  color: white;
}

/* tabs setting */
.demo-tabs > .el-tabs__content {
  padding: 32px;
  color: #6b778c;
  font-size: 32px;
  font-weight: 600;
}
.demo-tabs {
  padding: 32px;
  color: #6b778c;
  font-size: 32px;
  font-weight: 600;
}
.container-information {
  width: 100%;
  box-shadow: 0 4px 6px rgba(167, 167, 167, 0.1), 0 2px 4px rgba(255, 255, 255, 0.06);
}
.demo-tabs .el-tabs__item {
  background: #000;
  font-size: 50px;
  padding: 30px;
}
/* Doctor setting */
.doctor-container {
  /* height: 40vh; */
  display: flex;
  margin-top: 20px;
}
.doctor-members {
  background: whitesmoke;
  display: flex;
  align-items: center;
  border-radius: 10px;
  width: 18%;
  height: 40vh;
}
.DT {
  text-align: center;
  display: flex;
  justify-content: center;
}
</style>

