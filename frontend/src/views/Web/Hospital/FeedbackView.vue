<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue';
import { ref } from 'vue';
import axiosInstance from '@/plugins/axios';
import { onMounted } from 'vue'

const showTable = ref(true);
const tableData = ref([]);
async function fetchFeedback() {
  try {
    const { data } = await axiosInstance.get('/feedbacks/list')
    data.data.forEach((feedback) => {
      tableData.value.push(feedback)
    })
  } catch (error) {
    console.error(error)
  }
}
fetchFeedback()
onMounted(() => {
  console.log(tableData)
})
const textarea = ref('');

// Function to show details popover
function showDetails(row: any) {
  // Implement your logic to show details here
  console.log('Showing details for:', row);
}

// Handle the warning button click
function handleWarningClick(event: Event) {
  event.stopPropagation(); // Prevent event propagation
  // Implement your logic for the warning button click
  console.log('Warning button clicked');
}
</script>

<template>
  <WebLayout>
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
        <el-table-column prop="content" label="Content" width="310" />

        <!-- From Column -->
        <el-table-column prop="from" label="From" width="250">
          <template #default="scope">
            <strong>{{ scope.row.user.full_name }}</strong>
          </template>
        </el-table-column>

        <!-- To Column -->
        <el-table-column prop="to" label="To" width="250" />

        <!-- Star Column -->
        <el-table-column label="Star" width="180">
          <template #default="scope">
            <el-rate v-model="scope.row.star" disabled text-color="#ff9900" />
          </template>
        </el-table-column>

        <!-- Action Column -->
        <el-table-column label="Action">
          <template #default="scope">
            <el-popover placement="right" width="600" trigger="click">
              <div class="card-body">
                <el-input v-model="textarea" style="width: 540px; border: none;" :rows="5" type="textarea"
                  placeholder="Please input"></el-input>
                <div class="button">
                  <el-button type="primary" @click="handleWarningClick">Send</el-button>
                </div>
              </div>
              <template #reference>
                <el-button size="small">Reply</el-button>
              </template>
            </el-popover>
          </template>
        </el-table-column>
      </el-table>
    </div>
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
