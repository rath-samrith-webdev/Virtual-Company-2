<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import { ref } from 'vue'
import { useTransition } from '@vueuse/core'
import { ChatLineRound, Male } from '@element-plus/icons-vue'

const source = ref(0)
const outputValue = useTransition(source, {
  duration: 1500,
})
source.value = 172000
</script>

<template>
  <WebLayout>
    <el-row class="bg-warning py-3">
      <el-col :span="6">
        <el-statistic title="Messages" :value="268500" />
      </el-col>
      <el-col :span="6">
        <el-statistic :value="138">
          <template #title>
            <div style="display: inline-flex; align-items: center">
              Ratio of men to women
              <el-icon style="margin-left: 4px" :size="12">
                <Male />
              </el-icon>
            </div>
          </template>
          <template #suffix>/100</template>
        </el-statistic>
      </el-col>
      <el-col :span="6">
        <el-statistic title="Appointments" :value="outputValue" />
      </el-col>
      <el-col :span="6">
        <el-statistic title="Feedbacks" :value="562">
          <template #suffix>
            <el-icon style="vertical-align: -0.125em">
              <ChatLineRound />
            </el-icon>
          </template>
        </el-statistic>
      </el-col>
    </el-row>
  </WebLayout>
</template>

<style scoped>
.el-col {
  text-align: center;
}
.el-statistic {
  --el-statistic-title-color: white;
  --el-statistic-content-color: #fff;
  --el-statistic-content-font-size: 15px;
  --el-statistic-title-font-size: 15px;
  --el-statistic-content-font-weight: bold;
}
</style>