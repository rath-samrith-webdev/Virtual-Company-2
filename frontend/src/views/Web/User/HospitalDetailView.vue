<template>
  <WebLayout>
    <div class="container">
      <div class="card-header">
        <h1
            class="text-color-#32B4E3 font-size bg-white"
            style="font-size: 50px; font-weight: bold"
        >
          Hospital Details
        </h1>
      </div>
      <!-- ======================================================= -->
      <!-- hospital details -->
      <!-- ======================================================= -->
      <div class="card-container">
        <div class="card-left">
          <img
              v-if="store.hospitalDetail.cover_image !== 'No Cover'"
              :src="store.hospitalDetail.cover_image"
              alt="image"
          />
          <img v-else src="@/assets/image/hospital1.png" alt="image"/>
        </div>
        <div class="card-right">
          <div class="title">
            <span class="title-hospital text-color-#ffff">{{ store.hospitalDetail.name }}</span>
            <el-divider/>
          </div>
          <div class="information mb-4">
            <div>
              <p class="text-color-#ffff" style="font-size: 18px">Open: Monday-Sunday 24/7</p>
            </div>
            <div>
              <p class="text-color-#ffff" style="font-size: 18px">
                Location: {{ store.hospitalDetail.village }}, {{ store.hospitalDetail.commune }},
                {{ store.hospitalDetail.street }},
                {{ store.hospitalDetail.province }}
              </p>
            </div>
          </div>
          <div class="rate mb-4">
            <el-rate
                size="large"
                v-model="store.hospitalDetail.average_rating"
                disabled
                show-score
                text-color="#ff9900"
                score-template="{value} points"
            />
          </div>
        </div>
      </div>
      <!-- ======================================================= -->
      <!-- comment information-->
      <!-- ======================================================= -->
      <div class="container-information">
        <el-tabs v-model="activeName" stretch class="demo-tabs" @tab-click="handleClick">
          <el-tab-pane class="" label="Comments and Feedback" name="first">
            <div class="main-comment">
              <h3 class="mt-4 text-color-#32B4E3">Comments this hospital!</h3>
              <div class="comment-form mt-1">
                <el-form
                    class="form-comment mt-4"
                    :model="form"
                    label-width="auto"
                    style="max-width: 2000px"
                >
                  <el-form-item>
                    <el-input
                        v-model="form.content"
                        type="text"
                        placeholder="Write your comment here!"
                        class="custom-input"
                    />
                  </el-form-item>
                  <div class="rating mt-4">
                    <h4 class="text-color-warning">Rate this Hospital</h4>
                    <h6 class="text-color-gray">Tell others what you think.</h6>
                    <el-rate class="custom-rate" v-model="form.star" size="large" clearable/>
                  </div>
                  <el-form-item class="mt-4">
                    <el-button type="warning" class="text-color-#ffff btn-cancel">Cancel</el-button>
                    <el-button type="#ffff" class="text-color-#ffff btn-comment" @click="onSubmit"
                    >Submit
                    </el-button>
                  </el-form-item>
                </el-form>
              </div>
              <div class="demo-collapse mt-4">
                <el-collapse>
                  <el-collapse-item title="Show All the Comments" name="1">
                    <div
                        class="comment-container p-3 mt-3"
                        v-for="comment in store.hospitalDetail.feedbacks"
                        :key="comment.id"
                    >
                      <div class="comment-left d-flex flex-column p-2">
                        <div class="demo-type">
                          <el-avatar
                              v-if="comment.from.profile != 'No profile'"
                              :size="70"
                              :src="comment.from.profile"
                          ></el-avatar>
                          <el-avatar
                              v-else
                              :size="70"
                              src="https://cube.elemecdn.com/3/7c/3ea6beec64369c2642b92c6726f1epng.png"
                          ></el-avatar>
                        </div>
                      </div>
                      <div class="comment-right p-2">
                        <div class="information">
                          <div>
                            <p>
                              <strong>{{ comment.user.full_name }}</strong> .
                              <span>{{ comment.created_at }}</span>
                            </p>
                          </div>
                          <div>
                            <p>{{ comment.content }}</p>
                          </div>
                          <div>
                            <el-rate
                                v-model="comment.star"
                                disabled
                                show-score
                                text-color="#ff9900"
                                score-template="{value} stars"
                            />
                          </div>
                          <div class="mt-2">
                            <el-badge :value="comment.replies.length" class="item">
                              <el-button type="primary" @click="showReplies(comment.replies)">
                                Replies
                              </el-button>
                            </el-badge>
                            <el-button type="warning" @click="editComment(comment)">
                              Edit
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
          <el-tab-pane label="Hospital Doctors" name="second" class="main-doctor">
            <div class="d-flex align-item-center text-align-center DT">
              <h3 class="mt-4 text-color-#32B4E3">Our Doctor In Hostpital</h3>
            </div>
            <div class="doctor-container d-flex flex-wrap gap-4">
              <div
                  class="doctor-members d-flex flex-column justify-center p-2"
                  v-for="doctor in store.hospitalDetail.doctors"
                  :key="doctor.id"
              >
                <div class="demo-type mt-2">
                  <el-avatar
                      v-if="doctor.profile != 'No profile'"
                      :size="100"
                      :src="doctor.profile"
                  ></el-avatar>
                  <el-avatar
                      v-else
                      :size="100"
                      src="https://cube.elemecdn.com/3/7c/3ea6beec64369c2642b92c6726f1epng.png"
                  ></el-avatar>
                </div>
                <h4 class="text-color-#32B4E3">{{ doctor.first_name }} {{ doctor.last_name }}</h4>
                <h6>{{ doctor.role }}</h6>
                <el-row class="d-flex justify-content-center gap-3 mt-3">
                  <el-tooltip
                      class="box-item"
                      effect="dark"
                      content="LinkedIn"
                      placement="top-start"
                  >
                    <el-avatar
                        :size="35"
                        shape="circle"
                        :src="'https://cdn1.iconfinder.com/data/icons/logotypes/32/circle-linkedin-512.png'"
                    ></el-avatar>
                  </el-tooltip>
                  <el-tooltip class="box-item" effect="dark" content="Gmail" placement="top-start">
                    <el-avatar
                        :size="35"
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
                        :size="35"
                        shape="circle"
                        :src="'https://banner2.cleanpng.com/20200525/hhx/transparent-instagram-logo-icon-5ecc25c4860dd5.0946990115904373165491.jpg'"
                    ></el-avatar>
                  </el-tooltip>
                </el-row>
              </div>
            </div>
          </el-tab-pane>
          <el-tab-pane label="Hospital Departments" name="third" class="mt-4">
            <h3 class="mt-4 text-color-#32B4E3">Our Department In Hospital!</h3>
            <el-table :data="store.hospitalDetail.department" height="250" style="width: 100%">
              <el-table-column prop="id" label="Department ID" width="180"/>
              <el-table-column prop="name" label="Department Name" width="880"/>
            </el-table>
          </el-tab-pane>
          <!-- ======================================================= -->
          <!-- hospital Calendar -->
          <!-- ======================================================= -->
          <el-tab-pane label="Hospital Calendar" name="fourth">
            <el-calendar
                ref="calendar"
                class="mt-4 calendar"
                style="font-size: 18px; font-weight: bold"
            >
              <template #header="{ date }">
                <span class="text-color-#32b4e3">Calendar Hostpital</span>
                <span class="text-color-#32b4e3">{{ date }}</span>
                <el-button-group>
                  <el-button
                      size="large"
                      class="bg-#32b4e3 text-white hover:bg-#2b9dc8 transition-colors duration-300"
                      @click="selectDate('prev-year')"
                  >
                    Previous Year
                  </el-button>
                  <el-button
                      size="large"
                      class="bg-#32b4e3 text-white hover:bg-#2b9dc8 transition-colors duration-300"
                      @click="selectDate('prev-month')"
                  >
                    Previous Month
                  </el-button>
                  <el-button
                      size="large"
                      class="bg-#32b4e3 text-white hover:bg-#2b9dc8 transition-colors duration-300"
                      @click="selectDate('today')"
                  >Today
                  </el-button>
                  <el-button
                      size="large"
                      class="bg-#32b4e3 text-white hover:bg-#2b9dc8 transition-colors duration-300"
                      @click="selectDate('next-month')"
                  >
                    Next Month
                  </el-button>
                  <el-button
                      size="large"
                      class="bg-#32b4e3 text-white hover:bg-#2b9dc8 transition-colors duration-300"
                      @click="selectDate('next-year')"
                  >
                    Next Year
                  </el-button>
                </el-button-group>
              </template>
              <template #date-cell="{ data }">
                <div
                    v-for="(item, index) in textContent(data.day)"
                    :key="index"
                    @click="alertMessage(item)"
                >
                  <el-row v-if="item.user.id == user.user.id">
                    <el-col class="center">
                      <el-tag type="primary" class="tag">
                        <el-row>
                          <el-col :span="20" class="tag">
                            <span>You</span>
                          </el-col>
                        </el-row>
                      </el-tag>
                    </el-col>
                  </el-row>
                  <el-row v-else-if="item.status == 'Pending'">
                    <el-col class="center">
                      <el-tag type="warning" class="tag">
                        <el-row>
                          <el-col :span="20" class="tag">
                            <span>Booked</span>
                          </el-col>
                        </el-row>
                      </el-tag>
                    </el-col>
                  </el-row>
                  <el-row v-else>
                    <el-col class="center">
                      <el-tag type="danger" class="tag">
                        <el-row>
                          <el-col :span="20" class="tag">
                            <span>Booked</span>
                            <span>Status</span>
                          </el-col>
                        </el-row>
                      </el-tag>
                    </el-col>
                  </el-row>
                </div>
              </template>
            </el-calendar>
          </el-tab-pane>
          <el-tab-pane label="Hospital Contact" name="five">
            <div class="d-flex align-item-center text-align-center DT">
              <h3 class="mt-4 text-color-#32b4e3">Contact to Us</h3>
            </div>
            <div class="doctor-container d-flex flex-wrap gap-4">
              <div
                  class="contact-infor d-flex flex-column justity-content-center p-5"
                  v-for="contact in contacts"
                  :key="contact.id"
              >
                <div class="d-flex">
                  <el-icon class="text-color-#ffff">
                    <Phone/>
                  </el-icon>
                  <h4 class="text-color-#ffff ml-2 font-weight: bold">Contact us</h4>
                </div>
                <h6 class="text-color-#ffff mt-3">{{ store.hospitalDetail.phone_number }}</h6>
              </div>
              <div
                  class="contact-infor d-flex flex-column justity-content-center p-5"
                  v-for="location in locations"
                  :key="location.id"
              >
                <div class="d-flex">
                  <el-icon class="text-color-#ffff">
                    <Location/>
                  </el-icon>
                  <h4 class="text-color-#ffff font-weight: bold ml-2">{{ location.title }}</h4>
                </div>
                <h6 class="text-color-#ffff mt-3">{{ location.address }}</h6>
              </div>
              <div
                  class="contact-infor d-flex flex-column justity-content-center p-5"
                  v-for="hour in hours"
                  :key="hour.id"
              >
                <div class="d-flex">
                  <el-icon class="text-color-#ffff">
                    <Clock/>
                  </el-icon>
                  <h4 class="text-color-#ffff font-weight: bold ml-2">{{ hour.title }}</h4>
                </div>
                <h6 class="text-color-#ffff mt-3">{{ hour.time }}</h6>
              </div>
            </div>
          </el-tab-pane>
          <el-tab-pane label="Hospital Information " name="six">
            <div class="block text-center" m="t-4" style="height: 90vh; width: 100%">
              <h3 class="mt-4 text-color-#32b4e3">Our Hospital Information Details</h3>
              <el-carousel trigger="click" height="80vh">
                <el-carousel-item
                    v-for="hospitalInfomation in hospitalInfo"
                    :key="hospitalInfomation"
                    style="height: 600px; width: 100%"
                >
                  <img
                      :src="hospitalInfomation.image"
                      alt="Image placeholder"
                      class="image-container mt-5"
                  />
                </el-carousel-item>
              </el-carousel>
            </div>
          </el-tab-pane>
        </el-tabs>
      </div>
    </div>
    <el-dialog v-model="editActive" title="Edit Rate" width="800">
      <div class="comment-form mt-1">
        <el-form
            class="form-comment mt-4"
            :model="form"
            label-width="auto"
            style="max-width: 2000px"
        >
          <el-input v-model="editForm.id" type="hidden"/>
          <el-form-item>
            <el-input
                v-model="editForm.content"
                type="text"
                placeholder="Write your comment here!"
                class="custom-input"
            />
          </el-form-item>
          <div class="rating mt-4">
            <h4 class="text-color-warning">Rate this Hospital</h4>
            <h6 class="text-color-gray">Tell others what you think.</h6>
            <el-rate class="custom-rate" v-model="editForm.star" size="large" clearable/>
          </div>
          <el-form-item class="mt-4">
            <el-button type="warning" class="text-color-#ffff btn-cancel">Cancel</el-button>
            <el-button type="#ffff" class="text-color-#ffff btn-comment" @click="editRate"
            >Submit
            </el-button>
          </el-form-item>
        </el-form>
      </div>
    </el-dialog>
    <el-dialog v-model="outerVisible" :title="store.hospitalDetail.name" width="800">
      <template #header>
        <div class="my-header flex align-items-center gap-2">
          <el-avatar shape="square" size="25"></el-avatar>
          <h4>{{ store.hospitalDetail.name }}</h4>
        </div>
      </template>
      <el-card v-for="rep in feedBackreplies" :key="rep.id" class="mt-2">
        <div class="d-flex justify-content-between align-items-center">
          <h5>{{ rep.user.name }}</h5>
          <h6>{{ rep.created_at }}</h6>
        </div>
        <p>{{ rep.content }}</p>
        <p>{{ rep.created_for }}</p>
      </el-card>
    </el-dialog>
  </WebLayout>
</template>
<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import {ref, reactive, onMounted} from 'vue'
import {Phone, Location, Clock} from '@element-plus/icons-vue'
import {hospitalDetailStore} from '@/stores/hospital-detail'
import {type CalendarDateType, type CalendarInstance, ElMessage} from 'element-plus'
import {useAuthStore} from '@/stores/auth-store'
import {useRoute} from 'vue-router'
import axiosInstance from '@/plugins/axios'

const store = hospitalDetailStore()
const user = useAuthStore()
const route = useRoute()
//form
const form = reactive({
  hospital_id: store.hospitalDetail.id,
  user_id: user.user.id,
  content: '',
  star: ''
})
const editForm = reactive({
  id: '',
  hospital_id: route.query.id,
  user_id: user.user.id,
  content: '',
  star: ''
})
let feedBackreplies = []
const outerVisible = ref(false)
const textContent = (date) => {
  return store.appointment.filter((item) => {
    return date === item.appointment_date
  })
}
const open1 = (messages: string, type: string) => {
  ElMessage({
    message: messages,
    type: type,
    plain: true,
  })
}
const alertMessage = (message) => {
  open1(`Appointment | ${message.appointment_date}`, 'success')
}
const editRate = async () => {
  editActive.value = false
  const formData = new FormData()
  formData.append('hospital_id', route.query.id)
  formData.append('content', editForm.content)
  formData.append('star', editForm.star)
  formData.append('user_id', editForm.user_id)
  try {
    const {data} = await axiosInstance.put(`/feedbacks/update/${editForm.id}`, formData)
    console.log(data)
    store.fetchHospitalDetail(route.query.id)
  } catch (error) {
    console.log(error)
  }
}
const showReplies = (replies: any) => {
  outerVisible.value = true
  feedBackreplies = replies
}
const editComment = (comment: any) => {
  editActive.value = true
  editForm.id = comment.id
  editForm.hospital_id = route.params.id
  editForm.content = comment.content
  editForm.star = comment.star
}
const activeName = ref('first')
onMounted(() => {
  console.log(route.query.id)
  store.fetchHospitalDetail(route.query.id)
})
//contact hospital
const contacts = [
  {
    title: 'CALL US',
    phone1: '+855 123456789',
    phone2: '+855 987654321'
  }
]
//location
const locations = [
  {
    title: 'FIND US',
    address: 'BP 511, Phum Tropeang Chhuk (Borey Sorla) Sangtak, Street 371, Phnom Penh'
  }
]
//hour
const hours = [
  {
    title: 'HOURS',
    time: 'Mon-Fri 8am-8pm Sat-Sun 8am-8pm'
  }
]
// hospital information
const hospitalInfo = [
  {
    image: 'https://static-images.vnncdn.net/files/publish/2023/7/8/hospital-291.jpg'
  },
  {
    image:
        'https://images.assettype.com/fortuneindia%2F2022-04%2Fe84e75e6-468d-411e-af42-2f6341a3481b%2FGettyImages_1296010649.jpeg?rect=0,411,6698,3768&w=1250&q=60'
  },
  {
    image:
        'https://www.aamc.org/sites/default/files/styles/scale_and_crop_1200_x_666/public/d/1/3-hospitalist_patient-story.jpg__992x558_q85_crop-smart_subsampling-2_upscale.jpg?itok=HL_cR-BT'
  },
  {
    image:
        'https://m.economictimes.com/thumb/msid-105450574,width-1600,height-900,resizemode-4,imgsize-143554/rainbow-hospitals-plans-to-launch-four-new-facilities-add-270-beds-in-h2-of-fy24.jpg'
  },
  {
    image:
        'https://www.who.int/images/default-source/wpro/health-topic/hospitals/f8-11102016-my-6042.tmb-1024v.jpg?Culture=en&sfvrsn=57e1f33d_4'
  }
]
//btn submit
const onSubmit = () => {
  // Logic for form submission can be added here
  const formData = new FormData()
  formData.append('hospital_id', route.query.id)
  formData.append('user_id', user.user.id)
  formData.append('content', form.content)
  formData.append('star', form.star)
  store.submitFeedback(formData)
  store.fetchHospitalDetail(route.query.id)
}
const editActive = ref(false)
onMounted(() => {
  store.fetchHospitalDetail(route.query.id)
})
// Calendar

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
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1),
  0 2px 4px rgba(0, 0, 0, 0.06);
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
  font-size: 50px;
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
  height: 40vh;
  background: linear-gradient(to right, rgba(249, 249, 249, 0.8));
  box-shadow: 0 4px 6px rgba(167, 167, 167, 0.1),
  0 2px 4px rgba(255, 255, 255, 0.06);
}

.main-comment {
  width: 100%;
  /* box-shadow: 0 4px 6px rgba(167, 167, 167, 0.1), 0 2px 4px rgba(255, 255, 255, 0.06); */
}

.custom-input {
  font-size: 1rem;
  border-radius: 20px;
  height: 8vh;
}

.btn-comment,
.btn-cancel {
  width: 130px;
  height: 5vh;
  border-radius: 5px;
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
  box-shadow: 0 4px 6px rgba(167, 167, 167, 0.1),
  0 2px 4px rgba(255, 255, 255, 0.06);
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
  background: white;
  display: flex;
  align-items: center;
  border-radius: 10px;
  width: 18%;
  height: 40vh;
  border: 2px solid whitesmoke;
  box-shadow: 0 4px 6px rgba(167, 167, 167, 0.1),
  0 2px 4px rgba(255, 255, 255, 0.06);
}

.doctor-members:hover {
  transition: background 0.3s ease-in-out,
  color 0.3s ease-in-out;
  box-shadow: 0 4px 6px rgba(167, 167, 167, 0.1),
  0 2px 4px rgba(255, 255, 255, 0.06);
  transition: box-shadow 0.3s ease-in-out;
  transition: transform 0.9s ease-in-out;
  transform: translateY(-5px);
  transition: box-shadow 0.3s ease-in-out;
  transition: transform 0.3s ease-in-out;
}

.DT {
  text-align: center;
  display: flex;
  justify-content: center;
}

.contact-container {
  /* height: 40vh; */
  display: flex;
  margin-top: 20px;
}

.contact-infor {
  background: #32b4e3;
  display: flex;
  align-items: flex-start;
  border-radius: 10px;
  width: 32%;
  height: 25vh;
}

.contact-infor:hover {
  transition: background 0.3s ease-in-out,
  color 0.3s ease-in-out;
  box-shadow: 0 4px 6px rgba(167, 167, 167, 0.1),
  0 2px 4px rgba(255, 255, 255, 0.06);
  transition: box-shadow 0.3s ease-in-out;
  transition: transform 0.3s ease-in-out;
  transform: translateY(-5px);
}

/* calendar */
.calendar {
  border-radius: 10px;
}

/* doctor-controller */
.main-doctor {
  width: 100%;
}

/* rate controller */
.custom-rate .el-rate__item {
  font-size: 100px; /* Adjust this value to make it larger */
}

.custom-rate .el-rate__icon {
  font-size: 100px; /* Adjust this value to make it larger */
}

.custom-rate {
  font-size: 50px;
}

@media screen and (min-width: 768px) and (max-width: 1024px) {
  .modal {
  }

  /* //Comments this hospital! */
  .card-container {
    height: 100vh;
  }

  .title-hospital {
    font-size: 30px;
  }

  .card-left,
  .card-right {
    width: 100%;
    height: 70vh;
  }

  .comment-container {
    height: 34vh;
  }

  .card-left,
  .card-right {
    width: 50%;
    height: 70vh;
  }

  /* // cards in the Our Doctor In Hostpital */
  .doctor-members {
    width: 50%;
  }

  /* //calendar */
  .calendar {
    margin-top: 15px;
    margin-left: 20px;
    width: 100%;
    font-size: 19px;
  }

  /* //contact */
  .contact-infor {
    width: 100%;
  }
}

@media screen and (max-width: 767px) {
  /* //Comments this hospital! */
  .card-container {
    flex-direction: column;
    align-items: center;
  }

  .title span {
    font-size: 30px;
  }

  .card-left,
  .card-right {
    width: 100%;
    height: 65vh;
  }

  .container-information {
    margin-top: 50vh;
  }

  .comment-container {
    height: 40vh;
  }

  /* // cards in the Our Doctor In Hostpital */
  .doctor-members {
    width: 100%;
  }

  /* //Our Department In Hospital! */
  .el-button-group {
    margin-top: 15px;
    margin-left: 20px;
  }

  /* //calendar */
  .calendar {
    margin-top: 15px;
    margin-left: 20px;
    width: 100%;
    font-size: 15px;
  }

  /* //contact */
  .contact-infor {
    width: 100%;
  }
}
</style>
