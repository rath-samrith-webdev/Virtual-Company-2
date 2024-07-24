<script lang="ts">
import { defineComponent, ref } from 'vue'
export default defineComponent({
  name: 'HospitalSet',
  props: {
    dialogVisible: {
      type: Boolean
    },
    isFilled:{
      type: Boolean,
    },
    province:{
      type:Array
    }
  },
  emits: ['show', 'submit', 'cancel']
})
</script>

<template>
  <div class="not-found-page">
    <el-container>
      <!-- Header -->
      <el-header>
        <h1>Hospital Not yet Set</h1>
      </el-header>

      <!-- Main content area -->
      <el-main>
        <el-card class="content-card">
          <h2>Oops! It looks like you have not set up your hospital yet.</h2>
          <p>Please Set up one and let the every one knows you</p>
          <p>Please click here to set up</p>
          <el-button type="primary" @click="$emit('show')">Set Up hospital</el-button>
        </el-card>
      </el-main>
      <el-dialog v-model="dialogVisible" title="Outer Dialog" width="800">
        <el-form label-position="top">
          <el-form-item label="Name">
            <el-input type="text" />
          </el-form-item>
          <el-form-item label="Category">
            <el-select>
              <el-option value="">Test</el-option>
            </el-select>
          </el-form-item>
          <el-form-item label="Working hours">
            <el-col :span="11">
              <el-time-picker
                placeholder="Pick a time"
                style="width: 100%"
              />
            </el-col>
            <el-col :span="2" class="text-center">
              <span class="text-gray-500">-</span>
            </el-col>
            <el-col :span="11">
              <el-time-picker
                placeholder="Pick a time"
                style="width: 100%"
              />
            </el-col>
            <el-col :span="6">
              <el-form-item label="Village">
                <el-input type="text" />
              </el-form-item>
            </el-col>
            <el-col :span="6">
              <el-form-item label="Commune">
                <el-input type="text" />
              </el-form-item>
            </el-col>
            <el-col :span="6">
              <el-form-item label="District">
                <el-input type="text" />
              </el-form-item>
            </el-col>
            <el-col :span="6">
              <el-form-item label="Province">
                <el-select>
                  <el-option>Test</el-option>
                </el-select>
              </el-form-item>
            </el-col>
          </el-form-item>
        </el-form>
        <template #footer>
          <div class="dialog-footer">
            <el-button @click="$emit('cancel')">Cancel</el-button>
            <el-button type="primary" @click="$emit('submit')">
              Submit
            </el-button>
          </div>
        </template>
      </el-dialog>
    </el-container>
  </div>
</template>
<style scoped>
.not-found-page {
  margin: 20px;
  text-align: center;
}

.content-card {
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
}
</style>