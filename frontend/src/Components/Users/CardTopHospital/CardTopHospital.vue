<template>
  <div>
    <h1>Top Hospitals</h1>
    <el-carousel :interval="4000" type="card" height="200px">
      <el-carousel-item v-for="(card, index) in cards" :key="index">
        <div class="card-content">
          <img :src="card.img" alt="Hospital Image" class="card-img" />
          <div class="card-info">
            <h2>{{ card.h1 }}</h2>
            <p>{{ card.text }}</p>
            <div class="stars">
              <span v-for="n in card.stars" :key="`star-${n}`" class="star">★</span>
              <span v-for="n in 5 - card.stars" :key="`empty-${n}`" class="star empty">★</span>
            </div>
          </div>
        </div>
      </el-carousel-item>
    </el-carousel>
  </div>
</template>

<script>
export default {
  name: 'CardTopHospital',
  data() {
    return {
      cards: [
        {
          h1: 'Orchid Hospital',
          title: 'Card 1',
          text: 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
          img: 'https://eacnews.asia/uploads/images/1707375287_1d95c21b958defc06a96.jpg',
          stars: 5
        },
        {
          h1: 'Orchid Hospital',
          title: 'Card 2',
          text: 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
          img: 'https://www.diariolaregion.cl/wp-content/uploads/2024/04/DSC01023.jpg',
          stars: 4
        },
        {
          h1: 'Orchid Hospital',
          title: 'Card 3',
          text: 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
          img: 'https://www.khmertimeskh.com/wp-content/uploads/2022/02/photo_2022-02-02_17-41-10.jpg',
          stars: 3
        },
        {
          h1: 'Orchid Hospital',
          title: 'Card 4',
          text: 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
          img: 'https://cambodianess.com/uploads/images/1640765322z6c2p-chkhgee007005-20211229-cbmfn0a001.jpg',
          stars: 4
        },
      ]
    }
  }
}
</script>

<style scoped>
.el-carousel {
  margin-top: 70px;
  background:  white;
}

h1 {
  color: rgb(0, 0, 0);
  margin-top: 150px;
  text-align: center;
}

.card-content {
  border-radius: 8px;
  height: 350px;
  background: #ffffff;
  
}

.card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 10px;
  margin-bottom: 20px;
}

.card-info {
  /* width: 50%; */
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  justify-content: center;
  box-sizing: border-box;
}

.card-info h2 {
  font-size: 1.5em;
  margin-bottom: 10px;
  color: orange;
}

.card-info p {
  font-weight: bold;
  color: #000000;
  text-align: center;
  /* margin-bottom: 20px; */
}

.stars {
  display: flex;
  justify-content: center;
}

.star {
  color: gold;
  margin: 0 2px;
}

.star.empty {
  color: #ddd;
}

.el-carousel__item {
  background-color: #efefef;
  
}

.el-carousel__item p {
  text-align: center;
}
</style>