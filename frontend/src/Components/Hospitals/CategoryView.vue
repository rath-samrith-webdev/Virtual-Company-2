<template>
  <div>
    <div class="wrapper">
      <i id="left" class="fa-solid fa-angle-left" @click="scrollCarousel(-1)"></i>
      <div class="carousel" ref="carousel">
        <div
          v-for="(item, index) in carouselItems"
          :key="index"
          class="card"
          @click="setCurrentSlide(index)"
        >
          <img src="https://cdn-icons-png.flaticon.com/256/5961/5961654.png" :alt="item.title" class="card-img" />
          <div class="card-title">{{ item.name }}</div>
        </div>
      </div>
      <i id="right" class="fa-solid fa-angle-right" @click="scrollCarousel(1)"></i>
    </div>
  </div>
</template>

<script lang="ts">
import axiosInstance from "@/plugins/axios.js";
export default {
  data() {
    return {
      currentSlide: 0,
      carouselItems: []
    };
  },
  methods: {
    scrollCarousel(direction) {
      const carousel = this.$refs.carousel;
      const firstCardWidth = carousel.querySelector('.card').clientWidth + 14;
      carousel.scrollLeft += direction * firstCardWidth;
    },
    setCurrentSlide(index) {
      this.currentSlide = index;
    },
    async fetchCategory(){
      try {
        const {data} = await axiosInstance.get('/categories/list')
        this.carouselItems = data.data
        console.log(data.data)
      }catch(error){
        console.log(error)
      }
    }
  },
  mounted() {
    this.fetchCategory()
  }
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
.wrapper {
  position: relative;
  max-width: 100%;
  overflow: hidden;
  margin-bottom: 50px;
  margin-top:30px ;
}

.wrapper i {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  height: 44px;
  width: 44px;
  color: #fff;
  cursor: pointer;
  font-size: 1.5rem;
  background-color: rgba(255, 255, 255, 0);
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1;
  transition: background-color 0.3s ease;
}

.wrapper i:hover {
  background-color: rgba(242, 242, 242, 0.8);
  color: #343f4f;
}

.wrapper i:first-child {
  left: 10px;
}

.wrapper i:last-child {
  right: 10px;
}

.carousel {
  display: flex;
  overflow-x: auto;
  scroll-snap-type: x mandatory;
  -webkit-overflow-scrolling: touch;
  scrollbar-width: none; 
  -ms-overflow-style: none;
}

.carousel::-webkit-scrollbar {
  display: none;
}

.card {
  flex: 0 0 calc(100% / 5);
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-right: 10px;
  cursor: pointer;
  scroll-snap-align: center;
  transition: transform 0.3s ease;
}
.card img{
  width: 150px;
  height: 150px;
  border-radius: 10px;
  padding: 20px;
}

.card-img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 10px;
}

.card-title {
  margin-top: 10px;
  font-size: 1rem;
  color: #000000;
  text-align: center;
}

@media screen and (max-width: 900px) {
  .card {
    flex: 0 0 calc(100% / 2);
  }
}

@media screen and (max-width: 550px) {
  .card {
    flex: 0 0 100%;
  }
}
</style>
