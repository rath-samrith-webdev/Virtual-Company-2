<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  props: {
    title: {
      type: String,
      required: true
    }
  },
  emits: ['update', 'remove'],
  data() {
    return {
      services: [
        {
          id: 1,
          name: 'General Check-up',
          image: 'https://cdn-icons-png.flaticon.com/512/2764/2764537.png'
        },
        {
          id: 2,
          name: 'Emergency & Trauma',
          image: 'https://cdn-icons-png.freepik.com/512/4434/4434351.png'
        },
        {
          id: 3,
          name: 'Heart',
          image: 'https://cdn-icons-png.freepik.com/512/1216/1216774.png'
        },
        {
          id: 4,
          name: 'GI center',
          image:'https://icons.veryicon.com/png/o/healthcate-medical/department/gastroenterology-department.png'
            
        },
        {
          id: 5,
          name: 'Bone',
          image: 'https://cdn-icons-png.flaticon.com/512/1263/1263506.png'
        },
        {
          id: 6,
          name: 'Urology',
          image: 'https://cdn-icons-png.flaticon.com/512/6642/6642814.png'
        },
        {
          id: 7,
          name: 'Children',
          image: 'https://cdn-icons-png.flaticon.com/256/13024/13024944.png'
        },
        {
          id: 8,
          name: 'ICU',
          image: 'https://cdn-icons-png.flaticon.com/512/9733/9733765.png'
        },
        {
          id: 9,
          name: 'Women',
          image: 'https://cdn-icons-png.flaticon.com/512/4721/4721796.png'
        }
      ]
    }
  }
})
</script>

<template>
  <div class="group-card mt-5 mb-5 container d-flex flex-wrap justify-content-evenly">
    <div class="card card-service p-2 m-5 border border-info border-4 rounded-3"  style="width: 21rem" v-for="(service, index) in services" :key="index">
      <img :src="service.image" class="card-img-top w-75 align-self-center mb-2" alt="..." />
      <div class="card-body">
        <h3 class="card-title text-center">{{ service.name }}</h3>
        <div class="d-flex justify-content-sm-between mt-3">
          <button class="btn btn-info text-light fw-bold " @click="$emit('update', service)">Update</button>
          <button class="btn btn-warning text-light fw-bold  " @click="$emit('remove', service)">Remove</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
/* Add your styles here */
</style>