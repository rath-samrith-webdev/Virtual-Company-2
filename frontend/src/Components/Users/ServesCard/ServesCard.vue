<template>
  <div class="cardServes">
    <h1>Best Services for You</h1>
    <ol>
      <li v-for="(service, index) in services" :key="index">
        <div class="cards">
          <div class="image"><img :src="service.img" alt="Service Image"></div>
          <div class="description">{{ service.description }}</div>
        </div>
      </li>
    </ol>
  </div>
</template>

<script>
export default {
  name: 'ServesCard',
  data() {
    return {
      services: [
        { icon: 'fa-solid fa-bicycle', img: 'https://cdn.pixabay.com/photo/2020/12/09/16/41/stethoscope-5817919_960_720.png', description: 'General Check-up' },
        { icon: 'fa-solid fa-car', img: 'https://cdn.pixabay.com/photo/2021/08/30/07/52/bed-6585117_1280.png', description: 'Emergency & Trauma' },
        { icon: 'fa-solid fa-helicopter', img: 'https://cdn.pixabay.com/photo/2017/01/31/23/23/heart-2028154_1280.png', description: 'Heart' },
        { icon: 'fa-solid fa-plane', img: 'https://cdn.pixabay.com/photo/2014/04/03/10/31/stomach-310730_1280.png', description: 'GI Center' },
        { icon: 'fa-solid fa-rocket', img: 'https://cdn.pixabay.com/photo/2021/05/12/17/23/the-ambulance-6248792_1280.png', description: 'Ambulance' },
        { icon: 'fa-solid fa-bus', img: 'https://cdn.pixabay.com/photo/2024/04/02/14/27/ai-generated-8670974_1280.png', description: 'Children' }
      ]
    };
  }
}
</script>

<style scoped>
.cardServes {
  padding:10%;
  background-color: var(--bgColor);
  color: var(--color);
}

h1 {
  text-align: center;
  margin-bottom: 2rem;
  font-weight: bold;
  color: var(--color);
  color: orange;
}

ol {
  width: min(100rem, 90%);
  margin: 0 auto;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 2rem;
  list-style: none;
  padding: 0;
}

li {
  counter-increment: stepnr;
  width: 18rem; 
  aspect-ratio: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 1rem;
  transition: transform 0.3s;
}
.cards {
  width: 100%;
  margin-top: 5%;
  text-align: center;
  background-color: white;
  border-radius: 10px;
  border: 4px solid orange;
  padding: 1.5rem;
}

.icon {
  font-size: 2rem;
  color: var(--accent-color);
}

.image {
  width: 13rem; 
  height: 10rem; 
  margin-bottom: 1rem;
  margin-top: -90px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.image img {
  width: 100%;
  height: 100%;
  object-fit: contain; 
  /* background: white;/ */
  /* border-radius: 50%; */
}

.description {
  font-size: 1rem;
  font-weight: 300;
  margin-top: 0.5rem;
  color: var(--color);
}

li:nth-child(6n + 1) { --accent-color: #b8df4e; }
li:nth-child(6n + 2) { --accent-color: #4cbccb; }
li:nth-child(6n + 3) { --accent-color: #7197d3; }
li:nth-child(6n + 4) { --accent-color: #ae78cb; }
li:nth-child(6n + 5) { --accent-color: #7dc7a4; }
li:nth-child(6n + 6) { --accent-color: #f078c2; }
</style>
