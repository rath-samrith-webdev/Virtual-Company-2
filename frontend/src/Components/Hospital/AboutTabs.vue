<script lang="ts">
import {Avatar, Clock, Location, Phone} from '@element-plus/icons-vue'
import {defineComponent} from 'vue'

export default defineComponent({
  components: {Location, Phone, Clock, Avatar},
  props: {
    hospital: {
      type: Object
    },
  },
  emits: ['edit-hospital'],
})
</script>
<template>
  <div class="m-3">
    <button class="btn btn-info text-light fw-bold  " @click="$emit('edit-hospital')">Update</button>
  </div>
  <div class="form p-4 h-75 border border-3 border-info " style="border-radius:10px ; ">
    <div class="d-flex gap-1">
      <div class="d-flex " style="width: 25%; margin-left:10%;">
        <el-icon :size="30">
          <Avatar/>
        </el-icon>
        <h4 class="text-start ml-5">Hospital Name: </h4>
      </div>
      <div class="flex-1" style=" margin-left:-7%;">
        <h5 class="ml-4 mt-1">{{ hospital.name }}</h5>
      </div>
    </div>
    <div class="d-flex mt-2">
      <div class="d-flex  " style="width: 25%; margin-left:10%;">
        <el-icon :size="30">
          <Clock/>
        </el-icon>
        <h4 class="text-start ml-5 ">Working Hours:</h4>
      </div>
      <div class="flex-1" style=" margin-left:-7%;">
        <h5 class="ml-4 mt-1"><span style="color: teal; padding-right:5px;">Open </span> {{ hospital.open_time }}</h5>
      </div>
    </div>
    <div class="d-flex mt-2">
      <div class="d-flex " style="width: 25%; margin-left:10%;">
        <el-icon :size="30">
          <Phone/>
        </el-icon>
        <h4 class="text-start ml-5">Phone Number: </h4>
      </div>
      <div class="flex-1" style=" margin-left:-7%;">
        <h5 class="ml-4 mt-1">{{ hospital.phone_number }}</h5>
      </div>
    </div>
    <div class="d-flex mt-2">
      <div class="d-flex " style="width: 25%; margin-left:10%;">
        <el-icon :size="30">
          <Location/>
        </el-icon>
        <h4 class="text-start ml-5">Address: </h4>
      </div>
      <div class="flex-1" style=" margin-left:-7%;">
        <h5 class="ml-4 mt-1">{{ hospital.village }} Village, {{ hospital.commune }} Commune, {{ hospital.district }} District,
          {{ hospital.province }} Province</h5>
      </div>
    </div>
  </div>
  <div class="p-3 d-flex" style="margin: 5%">
    <img class="border border-info border-1"
         src="https://img.freepik.com/premium-photo/group-doctors-standing-front-hospital-room_889227-23144.jpg"
         width="450px" alt="">
    <div class="text-start " style="margin: 5%">
      <h1 class="text-info pl-5">Our Vision</h1>
      <h5 class="pl-5 mt-3">Royal Phnom Penh Hospital (RPH) is place that provides excellent care of the highest
        standards of international quality to promote trust and satisfaction to Cambodians, expatriates and
        tourists.</h5>
    </div>
  </div>
  <div class="p-3 d-flex" style="margin: 5%">
    <div class="text-start " style="margin-top: 5%">
      <h1 class="text-info pr-5">Our Mission</h1>
      <h5 class="pr-5 mt-3">We intend to be a leader in providing medical services that are recognized internationally
        by using modern technology and by efficiently administering our professional network.
        Our medical teams adhere to the highest standards and professional ethics, and are committed to continuously
        improve their services to the benefit and satisfaction of our patients.</h5>
    </div>
    <img class="border border-info border-1" src="https://uag.edu/contenido/NoxO0rnbbM/untitled-design-4_NyF.png"
         width="450px" alt="">
  </div>
  <div class="p-3 d-flex" style="margin: 5%">
    <img class="border border-info border-1"
         src="https://healthray.com/wp-content/uploads/2024/02/Best-Hospital-Contract-Management-Software.webp"
         width="450px" alt="">
    <div class="text-start " style="margin: 5%">
      <h1 class="text-info pl-5">Quality Policy</h1>
      <h5 class="pl-5 mt-3">Royal Phnom Penh Hospital shall be the medical service facilities with high standard and
        international quality, for trustworthiness and optimal satisfaction of the customers. Royal Phnom Penh Hospital
        intends to continually improve the management patient safety system and its services by emphasizing on the
        continuous quality improvement throughout the organization.</h5>
    </div>
  </div>
</template>

<style scoped></style>
