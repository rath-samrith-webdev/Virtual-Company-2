<template>
  <div class="mt-2">
    <el-carousel v-if="promotions.length>0" autoplay height="400px">
      <el-carousel-item v-for="item in promotions" :key="item.id">
        <el-image v-if="item.image!='No cover'" :src="item.image" fit="cover"/>
        <el-image v-else src="https://i0.wp.com/sunrisedaycamp.org/wp-content/uploads/2020/10/placeholder.png?ssl=1" fit="cover"/>
      </el-carousel-item>
    </el-carousel>
  </div>
</template>
<script lang="ts">
import axiosInstance from "@/plugins/axios";

export default {
  name: 'CarouselComponent',
  data() {
    return {
      currentImage: 1,
      promotions: [],
    };
  },
  mounted() {
    this.fetchPromotions()
    this.startCarousel();
  },
  methods: {
    startCarousel() {
      setInterval(() => {
        this.currentImage = this.currentImage < this.totalImages ? this.currentImage + 1 : 1;
      }, 6000);
    },
    async fetchPromotions() {
      try {
        const {data} = await axiosInstance.get('/hospitals/promotions/list')
        this.promotions = data.data
      } catch (error) {
        console.log(error)
      }
    }
  },
}
</script>

<style scoped>
.el-carousel__item h3 {
  display: flex;
  color: #475669;
  opacity: 0.75;
  line-height: 300px;
  margin: 0;
}

.el-carousel__item:nth-child(2n) {
  background-color: #99a9bf;
}

.el-carousel__item:nth-child(2n + 1) {
  background-color: #d3dce6;
}
</style>
