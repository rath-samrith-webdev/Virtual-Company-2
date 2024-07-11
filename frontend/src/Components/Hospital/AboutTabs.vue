<script lang="ts">
import { Avatar, Clock, Location, Phone } from '@element-plus/icons-vue'
import {defineComponent} from 'vue'
export default defineComponent({
  components: { Location, Phone, Clock, Avatar },
  props:{
    hospital:{
      type:Object
    },
    isEdit:{
      type:Boolean,
    }
  },
  emits: ['edit-hospital','save-hospital'],
})
</script>
<template>
  <div class="pt-3">
    <el-button v-show="!isEdit" @click="$emit('edit-hospital')">Edit</el-button>
    <el-button v-show="isEdit" @click="$emit('save-hospital')">Save</el-button>
  </div>
  <div class="d-flex justify-content-around">
    <p>
      Royal Phnom Penh hospital International hospital affiliated with Bangkok Hospital. Boasts top facilities,
      Expensive.
    </p>
  </div>
  <div class="form p-3 h-75">
    <el-form>
      <div class="d-flex gap-1">
        <div class="d-flex justify-content-between" style="width: 25%">
          <el-icon :size="30"><Avatar/></el-icon>
          <h3 class="text-start">Hospital Name: </h3>
        </div>
        <div class="flex-1" v-if="!isEdit">
          <h3 class="ml-4" >Some name</h3>
        </div>
        <el-form-item v-show="isEdit" class="flex-1">
          <el-input type="text"/>
        </el-form-item>
      </div>
      <div class="d-flex gap-1">
        <div class="d-flex justify-content-between" style="width: 25%">
          <el-icon :size="30"><Clock/></el-icon>
          <h3 class="text-start">Working Hours: </h3>
        </div>
        <div class="flex-1" v-if="!isEdit">
          <h3 class="ml-4" >Some working hours</h3>
        </div>
        <el-form-item v-show="isEdit" class="flex-1">
          <el-input type="text"/>
        </el-form-item>
      </div>
      <div class="d-flex gap-1">
        <div class="d-flex justify-content-between" style="width: 25%">
          <el-icon :size="30"><Phone/></el-icon>
          <h3 class="text-start">Phone Number: </h3>
        </div>
        <div class="flex-1" v-if="!isEdit">
          <h3 class="ml-4" >Some phone</h3>
        </div>
        <el-form-item v-show="isEdit" class="flex-1">
          <el-input type="text"/>
        </el-form-item>
      </div>
      <div class="d-flex gap-1">
        <div class="d-flex justify-content-between" style="width: 25%">
          <el-icon :size="30"><Location/></el-icon>
          <h3 class="text-start">Address: </h3>
        </div>
        <div class="flex-1" v-if="!isEdit">
          <h3 class="ml-4" >Some address</h3>
        </div>
        <el-form-item v-show="isEdit" class="flex-1">
          <el-input type="text"/>
        </el-form-item>
      </div>
    </el-form>
  </div>
  <div class="p-3">
    <h1 class="text-center">Our Vision</h1>
    <p class="text-center">Royal Phnom Penh Hospital (RPH) is place that provides excellent care of the highest standards of international quality to promote trust and satisfaction to Cambodians, expatriates and tourists.</p>
  </div>
  <div class="p-3">
    <h1 class="text-center">Our Mission</h1>
    <p class="text-center">Royal Phnom Penh Hospital (RPH) is place that provides excellent care of the highest standards of international quality to promote trust and satisfaction to Cambodians, expatriates and tourists.</p>
  </div>
</template>

<style scoped>

</style>