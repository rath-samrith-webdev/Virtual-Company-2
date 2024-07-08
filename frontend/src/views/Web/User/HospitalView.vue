<template>
  <WebLayout>
    <HospitalAddressCard></HospitalAddressCard>
    <HospitalInformation></HospitalInformation>
    <HospitalService></HospitalService>
    <HospitalVideo></HospitalVideo>
  </WebLayout>
</template>
<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import HospitalAddressCard from '@/Components/Hospitals/HospitalAddressCard.vue'
import HospitalInformation from '@/Components/Hospitals/HospitalInformation.vue';
import HospitalService from '@/Components/Hospitals/HospitalService.vue';
import HospitalVideo from '@/Components/Hospitals/HospitalVideo.vue';
</script>

<style scoped></style>