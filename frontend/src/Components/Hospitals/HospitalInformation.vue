<template>
  <div>
    <br>
    <header>
      <div class="header">
        <div class="header_text">
          <h2><b>Take care of your body and it will take care of you.</b></h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisci ng elit. Ut et massa mi Aliquam in hendr urna, consectetur
            si uta adipiscing elit. Ut et massa mi.</p>
        </div>
        <div class="header_image_background">
        </div>
      </div>
    </header>
  </div>
</template>
<script setup lang="ts">
import { ref } from 'vue'
import { Search } from '@element-plus/icons-vue'
import axiosInstance from '@/plugins/axios'
</script>

<style scoped>
.header {
  width: 100%;
  height: 106vh;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.header_image_background {
  width: 40%;
  height: 100vh; /* You can adjust the height as needed */
  background-image: url('https://www.shriramhospitalalwar.in/assets/img/shriram/Bsc-nursing-in-india.png');
  background-size: cover;
  background-position: center;
}

.header_text {
  width: 50%;
  text-align: center;
  padding: 20px;
}

.header_text h2 {
  font-size: 60px;
}
</style>
