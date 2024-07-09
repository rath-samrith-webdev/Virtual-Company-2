<template>
  <div>
    <div class="header_Favorite">
      <div class="card_text">
        <h1>Welcome to My App</h1>
        <p class="p-4">This is a simple Vue.js application that displays a header, a carousel, and a favorite section.
        </p>
      </div>
      <div class="card_image">
        <el-carousel :interval="4000" type="card" height="500px">
          <el-carousel-item v-for="(item, index) in items" :key="index">
            <img :src="item.img" alt="carousel item" />
          </el-carousel-item>
        </el-carousel>
      </div>
    </div>
  </div>
</template>

<script>
const format = (percentage) => (percentage === 100 ? 'Full' : `${percentage}%`)
export default {
  name: 'HeaderView',
  data() {
    return {
      items: [
        {
          img: 'https://st.depositphotos.com/1010613/2860/i/950/depositphotos_28609075-stock-photo-group-of-happy-doctors.jpg',
        },
        {
          img: 'https://www.rockfordhealthsystem.org/wp-content/uploads/2023/05/job-outlook-of-a-doctor.jpg',
        },
        {
          img: 'https://cdn.create.vista.com/api/media/small/300945744/stock-photo-portrait-of-young-woman-doctor-with-white-coat-standing-in-hospital',
        },
        {
          img: 'https://www.shutterstock.com/image-photo/you-can-order-drug-here-600nw-2138799461.jpg',
        },
        {
          img: 'https://img.freepik.com/premium-photo/healthcare-medicine-concept-attractive-male-doctor-front-medical-group-hospital-showing-thumbs-up_380164-53019.jpg',
        },
      ],
    };
  },
};
</script>

<style scoped>
.header_Favorite {
  width: 100%;
  height: 80vh;
  display: flex;
  flex-direction: row;
  background: rgba(198, 231, 255, 0.446);
}

.card_text {
  width: 30%;
  padding: 10px;
  box-sizing: border-box;
  text-align: center;
}

.card_text h1 {
  width: 100%;
  padding: 10px;
  box-sizing: border-box;
  text-align: center;
  color: white;
  font-size: 24px;
  margin: 0;
  font-weight: bold;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  transition: box-shadow 0.3s ease;
  cursor: pointer;
  background: rgb(23, 165, 253);
}

.el-carousel__item:nth-child(2n) {
  background-color: #99a9bf;
}

.el-carousel__item:nth-child(2n + 1) {
  background-color: #d3dce6;
}

.card_image {
  width: 70%;
  padding: 10px;
  /* background: olivedrab; */
}

.card_image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.demo-progress .el-progress--line {
  margin-bottom: 15px;
  max-width: 600px;
}
</style>
