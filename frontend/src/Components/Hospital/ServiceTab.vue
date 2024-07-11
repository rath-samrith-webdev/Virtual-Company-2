<script lang="ts">
import { defineComponent } from 'vue'
export default defineComponent({
  props:{
    title:{
      type:Object
    }
  },
  emits: ['update','remove'],
})
</script>

<template>
  <el-col :span="5">
    <el-card class="doctor">
      <el-avatar shape="square" style="width: 100%;height: 49%;" src="https://cdn.corporatefinanceinstitute.com/assets/professional-corporation.jpeg"/>
      <h4 class="text-center mt-2">General Checkup</h4>
      <div class="d-flex justify-content-sm-between">
        <el-button style="background: #32B4E3; color: white;" @click="$emit('update')">Update</el-button>
        <el-button style="background: #FCB22D; color: white;" @click="$emit('remove')">Remove</el-button>
      </div>
    </el-card>
  </el-col>
</template>

<style scoped>

</style>