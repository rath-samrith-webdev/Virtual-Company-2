<script lang="ts">
import { defineComponent } from 'vue'
import { Operation } from '@element-plus/icons-vue'

export default defineComponent({
  components: { Operation },
  props: {
    department: {
      required: true,
      type: Object
    }
  },
  emits: ['update', 'remove']
})
</script>
<template>
  <div class="card d-flex flex-row m-5 border border-3 border-info">
    <img
      src="https://png.pngtree.com/png-vector/20221206/ourmid/pngtree-midwife-or-doctor-with-newborn-concept-png-image_6511706.png"
      alt="" width="150" height="150">
    <div class="card-body mt-3">
      <h4>{{ department.name }}</h4>
      <p>{{ department.description }}</p>
      <div class="d-flex justify-content-sm-between mt-3">
      <button class="btn btn-info text-light fw-bold " @click="$emit('update', service)">Update</button>
      <button class="btn btn-warning text-light fw-bold  " @click="$emit('remove', service)">Remove</button>
    </div>
    </div>
    <!-- <el-menu>
      <el-sub-menu>
        <template #title>Manage</template>
        <el-menu-item index="1-1" class="primary" @click="$emit('update')">Update</el-menu-item>
        <el-menu-item index="1-2" class="danger" @click="$emit('remove')">Remove</el-menu-item>
      </el-sub-menu>
    </el-menu> -->
    
  </div>
</template>