<template>
    <web-layout>
      <div>
      <carousel-view></carousel-view>
      <card-top-hospital></card-top-hospital>
      <information-view></information-view>
      <serves-card></serves-card>
      <image-view></image-view>
    </div>
    </web-layout>
</template>

<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import CarouselView from '@/Components/Users/CarouselUser/UserCarousel.vue'
import CardTopHospital from '@/Components/Users/CardTopHospital/CardTopHospital.vue'
import ServesCard from '@/Components/Users/ServesCard/ServesCard.vue'
import InformationView from '@/Components/Users/Information/InformationView.vue'
import ImageView from '@/Components/Users/Images/ImageView.vue'
</script>

<style>

</style>