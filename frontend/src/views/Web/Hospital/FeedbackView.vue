<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue';

;
import {h, ref} from 'vue';
import axiosInstance from '@/plugins/axios';
import {onMounted} from 'vue'
import {useAuthStore} from '@/stores/auth-store'
import NoHospitalSet from '@/Components/Hospitals/NoHospitalSet.vue'
import {FeedbackList} from '@/stores/feedback-list'
import {ElNotification} from "element-plus";
import {DeleteFilled} from "@element-plus/icons-vue";

const store = useAuthStore()
const feedbackList = FeedbackList()
const showTable = ref(true);
const tableData = ref([]);

async function fetchFeedback() {
  try {
    const {data} = await axiosInstance.get('/feedbacks/list')
    data.data.forEach((feedback) => {
      tableData.value.push(feedback)
    })
  } catch (error) {
    console.error(error)
  }
}

const replyForm = ref(false)
const outerVisible = ref(false)
const openReplyFrom = () => {
  outerVisible.value = false
  replyForm.value = true
}
const replyFeedback = ref({
  rate_id: '',
  content: ''
})
const open = (title: string, type: string, message: string) => {
  ElNotification({
    title: title,
    type: type,
    message: message
  })
}
const sendReply = async () => {
  const formData = new FormData()
  formData.append('rate_id', replyFeedback.value.rate_id)
  formData.append('content', replyFeedback.value.content)
  try {
    if (replyFeedback.value.content === '') {
      replyForm.value = true
      open('Reply content', 'warning', 'Content Required')
    } else {
      replyForm.value = false
      const {data} = await axiosInstance.post('/feedback-reply/create', formData)
      open('Reply content', 'success', data.message)
    }
  } catch (e) {
    console.log(e)
  }
}
fetchFeedback()
onMounted(() => {
  console.log(tableData)
})
const removeReply = async (id: any) => {
  try {
    const {data} = await axiosInstance.delete(`/feedback-reply/delete/${id.id}`)
    await feedbackList.showFeedback(id.rate_id)
    if (data.success) {
      open('Reply content', 'success', data.message)
    } else {
      open('Reply content', 'warning', data.message)
    }
  } catch (e) {
    console.error(e)
  }
}

// Function to show details popover
function showDetails(row: any) {
  // Implement your logic to show details here
  outerVisible.value = true
  feedbackList.showFeedback(row)
  replyFeedback.value.rate_id = row
  console.log('Showing details for:', row);
}
</script>

<template>
  <WebLayout v-if="store.hospital!='No hospital'">
    <div>
      <div class="appointment">
        <h1>Feedback List</h1>
      </div>
      <el-table v-if="showTable" :data="tableData" height="550" style="width: 100%" class="mt-3">
        <!-- Profile Column -->
        <el-table-column label="Profile" width="250">
          <template #default="scope">
            <div class="profile-column">
              <el-avatar v-if="scope.row.user.profile === 'No profile'"></el-avatar>
              <el-avatar v-if="scope.row.user.profile !== 'No profile'" :src="scope.row.user.profile"></el-avatar>
              <div class="profile-info">
                <p>{{ scope.row.user.full_name }}</p>
                <!-- <p>{{ scope.row.email }}</p> -->
              </div>
            </div>
          </template>
        </el-table-column>
        <!-- Content Column -->
        <el-table-column prop="content" label="Content" width="310"/>

        <!-- From Column -->
        <el-table-column prop="from" label="From" width="250">
          <template #default="scope">
            <strong>{{ scope.row.user.full_name }}</strong>
          </template>
        </el-table-column>

        <!-- To Column -->
        <el-table-column prop="to" label="To" width="250"/>
        <!-- Star Column -->
        <el-table-column label="Star" width="180">
          <template #default="scope">
            <el-rate v-model="scope.row.star" disabled text-color="#ff9900"/>
          </template>
        </el-table-column>
        <!-- Action Column -->
        <el-table-column label="Action">
          <template #default="scope">
            <el-button plain @click="showDetails(scope.row.id)">
              See details
            </el-button>
          </template>
        </el-table-column>
      </el-table>
      <el-dialog v-model="outerVisible" title="Feedback Details" width="800">
        <el-button @click="openReplyFrom">Reply</el-button>
        <el-main>
          <div class="d-flex justify-content-between" v-for="feed in feedbackList.feedbackDetails.replies"
               :key="feed.id">
            <div>
              <h5>{{ feed.user.name }}</h5>
              <h6><b>Content:</b> {{ feed.content }}</h6>
              <small><b>Replied:</b> {{ feed.created_for }}</small>
            </div>
            <div>
              <el-tag @click="removeReply(feed)">
                <el-icon>
                  <DeleteFilled/>
                </el-icon>
              </el-tag>
            </div>
          </div>
        </el-main>
      </el-dialog>
      <el-dialog v-model="replyForm" title="Reply Feedback" width="500">
        <el-form label-position="top">
          <el-input type="hidden" v-model="replyFeedback.rate_id"/>
          <el-form-item label="Reply content">
            <el-input type="textarea" v-model="replyFeedback.content"/>
          </el-form-item>
          <el-button-group>
            <el-button @click="sendReply">Sent</el-button>
          </el-button-group>
        </el-form>
      </el-dialog>
    </div>
  </WebLayout>
  <WebLayout v-else>
    <NoHospitalSet/>
  </WebLayout>
</template>
<style scoped>
.appointment {
  height: 8vh;
  background: #32b4e3;
  color: white;
  text-align: center;
}

.button {
  margin-top: 10px;
}

.mt-3 {
  margin-top: 1rem;
}

.profile-column {
  display: flex;
  align-items: center;
  gap: 10px;
}

.profile-image {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  margin-right: 10px;
}

.profile-info {
  display: flex;
  flex-direction: column;
}

.detail-card {
  width: 400px;
}

.profile-info,
p {
  text-align: center;
  margin-top: 10px;
}

.card-header {
  color: white;
  padding: 10px;
}

.card-body {
  padding: 16px;
  line-height: 1.6;
}

.profile-container {
  display: flex;
  justify-content: center;
  margin-bottom: 16px;
}

.detail-image {
  width: 100px;
  height: 100px;
  border-radius: 50%;
}

.el-table-column {
  color: #32b4e3;
}

.card-body p {
  text-align: left;
  margin: 0;
}
</style>
