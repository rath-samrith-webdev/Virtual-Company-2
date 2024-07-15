<script setup lang="ts">
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import axiosInstance from '@/plugins/axios'
import { ref, onMounted } from 'vue'
</script>

<template>

  <div class="notFound">
    <div class="img">
      <img
        src="https://st2.depositphotos.com/35665196/42770/v/450/depositphotos_427705096-stock-illustration-tired-overworked-doctor-nurses-sleeping.jpg"
        alt=""
      />
    </div>
    <el-button type="primary" plain>Come back</el-button>
    <div class="text">
      <h1>404</h1>
      <p><b>Sorry, the page not found</b></p>
      <p>The link you followed probably broken or the page has been removed.</p>
    </div>
  </div>
</template>
<style>
.notFound {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
.text h1 {
  font-size: 10rem;
  font-weight: 600;
}
.text {
  text-align: center;
}
.img img {
  width: 500px;
  height: 250px;
  margin-top: 50px;
  margin-left: 50px;
  object-fit: cover;
}
.el-button {
  margin-top: 20px;
  margin-left: 50px;
}
</style>
