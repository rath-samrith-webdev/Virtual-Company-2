<template>
  <WebLayout>
    <HospitalDiscount></HospitalDiscount>
    <CardTopHospital></CardTopHospital>
    <CategoryView></CategoryView>
    <HospitalAddressCard></HospitalAddressCard>
  </WebLayout>
</template>
<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import HospitalAddressCard from '@/Components/Hospitals/HospitalAddressCard.vue'
import CardTopHospital from '@/Components/Users/CardTopHospital/CardTopHospital.vue';
import CategoryView from '@/Components/Hospitals/CategoryView.vue';
import HospitalDiscount from '@/Components/Hospitals/HospitalDiscount.vue';
</script>
<style scoped></style>