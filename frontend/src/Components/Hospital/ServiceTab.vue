<script lang="ts">
import { defineComponent, ref } from 'vue'
import { ElButton, ElDialog, ElCol, ElCard, ElAvatar } from 'element-plus'

export default defineComponent({
  components: {
    ElButton,
    ElDialog,
    ElCol,
    ElCard,
    ElAvatar
  },
  props: {
    title: {
      type: String,
      default: ''
    }
  },
  emits: ['update', 'remove'],
  setup() {
    const centerDialogVisible = ref(false)
    return {
      centerDialogVisible
    }
  }
})
</script>

<template>
  <el-button plain @click="centerDialogVisible = true"> Add service </el-button>
  <el-dialog v-model="centerDialogVisible" title="Add service" width="500" center>
    <span> It should be noted that the content will not be aligned in center by default </span>
    <template #footer>
      <div class="dialog-footer">
        <el-button @click="centerDialogVisible = false">Cancel</el-button>
        <el-button type="primary" @click="centerDialogVisible = false"> Confirm </el-button>
      </div>
    </template>
  </el-dialog>


  <el-col :span="5">
    <el-card class="doctor mt-4">
      <el-avatar
        shape="square"
        style="width: 100%; height: 49%"
        src="https://cdn.corporatefinanceinstitute.com/assets/professional-corporation.jpeg"
      />
      <h4 class="text-center mt-2">General Checkup</h4>
      <div class="d-flex justify-content-sm-between">
        <el-button style="background: #32b4e3; color: white" @click="$emit('update')"
          >Update</el-button
        >
        <el-button style="background: #fcb22d; color: white" @click="$emit('remove')"
          >Remove</el-button
        >
      </div>
    </el-card>
  </el-col>
</template>

<style scoped></style>
