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
                    img: 'https://helloangkor.com/wp-content/uploads/2021/10/IMG_20220408_113311-e1650598048283.jpg'
                }
                ,
                {
                    img: 'https://www.gocambodia.tours/wp-content/uploads/2018/07/Calmette-Hospital-Phnom-Penh.jpg'
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
                    img: 'http://subsites.chinadaily.com.cn/cidca/att/20220330/1648636225570051552.png'
                }
                ,
                {
                    img: 'https://assets.charltonmedia.com/s3fs-public/styles/article_node_main_image/public/2022-04/thumbnail_image002.jpg?h=4938c091&itok=kwxQe63P'
                }
            ]
        }
    },
}
</script>

<style>
.el-carousel{
  height: 80vh;
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
