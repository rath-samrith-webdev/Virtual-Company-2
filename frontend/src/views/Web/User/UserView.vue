<template>
    <web-layout>
      <carousel-view></carousel-view>
      <card-top-hospital></card-top-hospital>
      <serves-card></serves-card>
      <card-address></card-address>
    </web-layout>
</template>

<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import CarouselView from '@/Components/Users/CarouselUser/UserCarousel.vue'
import CardTopHospital from '@/Components/Users/CardTopHospital/CardTopHospital.vue'
import ServesCard from '@/Components/Users/ServesCard/ServesCard.vue'
import CardAddress from '@/Components/Users/CardAddress/CardAddress.vue'
</script>

<style>

</style>