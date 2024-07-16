<template>
  <div>
    <div class="card_information">
      <div class="card-slider">
        <label for="1" class="card_one">
          <img
            src="https://wp02-media.cdn.ihealthspot.com/wp-content/uploads/sites/494/2020/08/iStock-986678504-1024x683.jpg"
            alt=""
            width="300px"
            height="400vh"
          />
        </label>
        <label for="2" class="card_two">
          <img
            src="https://client32.webvalue.party/wp-content/uploads/2023/01/hero-3-3HT8LSZ-1.jpg"
            alt=""
            width="300px"
            height="400vh"
          />
        </label>
        <label for="3" class="card_three">
          <img
            src="https://www.shutterstock.com/image-photo/healthcare-medical-staff-concept-portrait-600nw-2281024823.jpg"
            alt=""
            width="300px"
            height="400vh"
          />
        </label>
      </div>
      <div class="card_text">
        <h1>General hospital</h1>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem ipsa odio vel? Tempore
          eaque porro suscipit! Officiis, soluta consequuntur? Sunt enim aliquid quasi officiis eum
          ad culpa dolorum odio cumque.
        </p>
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
import { Picture as IconPicture } from '@element-plus/icons-vue'
</script>

<style scoped>
label {
  width: 150px;
  font-size: 2em;
}
.card_two img {
  margin-top: 100px;
}
.card_three img {
  margin-top: 200px;
}
.card-slider {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 100px;
}
.card_text {
  text-align: center;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-left: 100px;
}
.card_information {
  display: flex;
}
</style>
