<script lang="ts" setup>
import WebLayout from '@/Components/Layouts/WebLayout.vue';
import { hospitalAppointmentListStore } from '@/stores/hospital-appointment-list'
import { onMounted, ref } from 'vue'
import type { CalendarDateType, CalendarInstance } from 'element-plus'
import { useAuthStore } from '@/stores/auth-store'
const calendar = ref<CalendarInstance>()
const selectDate = (val: CalendarDateType) => {
  if (!calendar.value) return
  calendar.value.selectDate(val)
}
const store = hospitalAppointmentListStore()
const user=useAuthStore()
const textContent = (date) => {
  return store.appointments.filter((item) => {
    return date === item.appointment_date;
  });
};
const alertMessage=(message)=>{
  alert(message)
}
onMounted(()=>{
  store.fetchAppointments()
})
</script>
<template>
    <WebLayout>
      <el-calendar
        ref="calendar"
        class="mt-4 calendar"
        style="font-size: 18px; font-weight: bold"
      >
        <template #header="{ date }">
          <span class="text-color-#32b4e3">Your Calendar</span>
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
            >Today</el-button
            >
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
          <div v-for="(item, index) in textContent(data.day)" :key="index" @click="alertMessage(item)">
            <el-row v-if="item.doctor.uid==user.user.id">
              <el-col class="center">
                <el-tag type="primary" class="tag">
                  <el-row>
                    <el-col :span="20" class="tag">
                      <span>Your meeting</span>
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
                    </el-col>
                  </el-row>
                </el-tag>
              </el-col>
            </el-row>
          </div>
        </template>
      </el-calendar>
    </WebLayout>
</template>
