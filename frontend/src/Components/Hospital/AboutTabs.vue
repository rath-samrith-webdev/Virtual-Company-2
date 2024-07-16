<script lang="ts">
import { Avatar, Clock, Location, Phone } from '@element-plus/icons-vue'
import { defineComponent } from 'vue'
export default defineComponent({
  components: { Location, Phone, Clock, Avatar },
  props: {
    hospital: {
      type: Object,
      required: true
    },
    isEdit: {
      type: Boolean
    }
  },
  emits: ['edit-hospital']
})
</script>
<template>
  <div class="pt-3">
    <el-button @click="$emit('edit-hospital')">Edit</el-button>
  </div>
  <div class="form p-3 h-75">
    <div class="d-flex gap-1">
      <div class="d-flex justify-content-between" style="width: 25%">
        <el-icon :size="30"><Avatar /></el-icon>
        <h3 class="text-start">Hospital Name:</h3>
      </div>
      <div class="flex-1" v-if="!isEdit">
        <h3 class="ml-4">{{ hospital.name }}</h3>
      </div>
    </div>
    <div class="d-flex gap-1">
      <div class="d-flex justify-content-between" style="width: 25%">
        <el-icon :size="30"><Clock /></el-icon>
        <h3 class="text-start">Working Hours:</h3>
      </div>
      <div class="flex-1" v-if="!isEdit">
        <h3 class="ml-4">{{ hospital.open_time }} /{{ hospital.close_time }}</h3>
      </div>
    </div>
    <div class="d-flex gap-1">
      <div class="d-flex justify-content-between" style="width: 25%">
        <el-icon :size="30"><Phone /></el-icon>
        <h3 class="text-start">Phone Number:</h3>
      </div>
      <div class="flex-1" v-if="!isEdit">
        <h3 class="ml-4">Some phone</h3>
      </div>
    </div>
    <div class="d-flex gap-1">
      <div class="d-flex justify-content-between" style="width: 25%">
        <el-icon :size="30"><Location /></el-icon>
        <h3 class="text-start">Address:</h3>
      </div>
      <div class="flex-1" v-if="!isEdit">
        <h3 class="ml-4">{{ hospital.street }}</h3>
      </div>
    </div>
  </div>
  <div class="p-3">
    <h1 class="text-center">Our Vision</h1>
    <p class="text-center">
      Royal Phnom Penh Hospital (RPH) is place that provides excellent care of the highest standards
      of international quality to promote trust and satisfaction to Cambodians, expatriates and
      tourists.
    </p>
  </div>
  <div class="p-3">
    <h1 class="text-center">Our Mission</h1>
    <p class="text-center">
      Royal Phnom Penh Hospital (RPH) is place that provides excellent care of the highest standards
      of international quality to promote trust and satisfaction to Cambodians, expatriates and
      tourists.
    </p>
  </div>
</template>

<style scoped></style>
