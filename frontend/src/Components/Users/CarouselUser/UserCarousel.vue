<template>
  <div>
    <el-carousel :interval="5000" arrow="always">
      <el-carousel-item v-for="(item, index) in items" :key="index">
        <img :src="item.img" :alt="'Image ' + (index + 1)" style="width: 100%; height: auto;" />
      </el-carousel-item>
    </el-carousel>
  </div>
</template>

<script>
export default {
    name: 'CarouselView',
    data() {
        return {
            items: [
                {
                    img: 'https://cdn.pixabay.com/photo/2016/11/08/05/29/surgery-1807541_1280.jpg'
                }
                ,
                {
                    img: 'https://cdn.pixabay.com/photo/2024/04/09/05/38/ai-generated-8685104_1280.jpg'
                }
                ,
                {
                    img: 'https://cloudfront-us-east-1.images.arcpublishing.com/deseretnews/3WBPIDXBCJEBRM3RKCCSI2CLEE.jpg'
                }
                ,
                {
                    img: 'https://chorayphnompenhhospital.com.kh/images/Cho-ray-photo.jpg'
                }
                ,
                {
                    img: 'https://cdn.pixabay.com/photo/2017/07/23/10/44/dentist-2530990_1280.jpg'
                }
                ,
                {
                    img: 'https://cdn.pixabay.com/photo/2024/05/20/14/30/ai-generated-8775433_960_720.png'
                }
            ]
        }
    },
}
</script>

<style>
.el-carousel{
  height: 85vh;
  width: 90vw;
  margin: 0 auto;
}
.el-carousel__item img {
  display: block;
  margin: 0 auto; 
}

.el-carousel__item:nth-child(2n) {
  background-color: #99a9bf;
  height: 100vh;
}

.el-carousel__item:nth-child(2n + 1) {
  background-color: #d3dce6;
  height: 100vh;
}
</style>
