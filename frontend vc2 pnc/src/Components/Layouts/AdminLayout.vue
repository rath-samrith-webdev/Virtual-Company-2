<!-- src/App.vue -->
<template>
  <HeaderMenu />
  <div class="md:px-50 pt-10 h-full">
    <div class="rounded-lg h-full">
      <slot />
    </div>
  </div>
</template>

<script setup lang="ts">
import HeaderMenu from '@/Components/HeaderMenu.vue'
</script>
