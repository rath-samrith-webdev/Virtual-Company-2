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
    <img v-if="department.image!=='No profile'"
        :src="department.image"
        alt="" width="150" height="150">
    <img
        v-else
        src="https://i0.wp.com/sunrisedaycamp.org/wp-content/uploads/2020/10/placeholder.png?ssl=1"
        alt="" width="150" height="150">
    <div class="card-body mt-3">
      <h4>{{ department.name }}</h4>
      <p>{{ department.description?department.description:'No description' }}</p>
      <div class="d-flex justify-content-sm-between mt-3">
      <button class="btn btn-info text-light fw-bold " @click="$emit('update', service)">Update</button>
      <button class="btn btn-warning text-light fw-bold  " @click="$emit('remove', service)">Remove</button>
    </div>
    </div>
  </div>
</template>