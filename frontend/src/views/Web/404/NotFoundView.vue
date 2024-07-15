<script setup lang="ts">
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import axiosInstance from '@/plugins/axios'
import { ref, onMounted } from 'vue'

const appointments = ref([])
const appointment = ref({
  id: '',
  patient: '',
  date: '',
  status: ''
})

async function fectAppointment() {
  try {
    const { data } = await axiosInstance.get('/appointments/list')
    appointments.value = data.data
    console.log(data.data)
  } catch (e) {
    console.error(e)
  }
}

onMounted(() => {
  fectAppointment()
})
</script>

<template>
  <WebLayout>
    <div class="notFound">
      <div class="text">
        <h1>404</h1>
        <p><b>Sorry, the page not found</b></p>
        <p>The link you followed probably broken or the page has been removed.</p>
      </div>
      <div class="img">
        <img
          src="https://static.vecteezy.com/system/resources/previews/013/429/498/non_2x/male-doctor-in-standing-pose-flat-design-free-vector.jpg"
          alt=""
        />
      </div>
    </div>
  </WebLayout>
</template>
<style>
.notFound{
    display: flex;
    justify-content: center;
    align-items: center;
}
.text h1{
    font-size: 10rem;
    font-weight: 600;

}
.text{
    text-align: center;
}
.img img{
    width: 450px;
    height: 450px;
    margin-top: 50px;
    margin-left: 50px;
    object-fit: cover;
 
}
</style>
