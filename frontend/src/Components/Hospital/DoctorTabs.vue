<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  props: {
    doctor: {
      type: Object
    }
  },
  emits: ['update','remove'],
})
</script>
<template>
  <el-col :span="5">
    <el-card class="doctor">
      <el-avatar shape="square" style="width: 100%;height: 49%;border-radius: 35px 0 0 0;" src="https://cdn.corporatefinanceinstitute.com/assets/professional-corporation.jpeg"/>
      <h2 class="text-center"><strong>Dr John Doe</strong></h2>
      <p class="text-center">Cardiologist</p>
      <div class="d-flex justify-content-sm-between">
        <el-button style="background: #32B4E3; color: white;" @click="$emit('update')">Update</el-button>
        <el-button style="background: #FCB22D; color: white;" @click="$emit('remove')">Remove</el-button>
      </div>
    </el-card>
  </el-col>
</template>

<style scoped>
.doctor {
  border: 5px solid #32B4E3;
  border-radius: 35px 0 25px 0;
}
</style>