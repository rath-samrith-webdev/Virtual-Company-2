<template>
  <div class="cardServes">
    <h1>Best Services for You</h1>
    <ol>
      <li v-for="(service, index) in services" :key="index">
        <div class="card">
          <div class="icon"><i :class="service.icon"></i></div>
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
        { icon: 'fa-solid fa-bicycle', img: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT2PX42mnQYYC1mslqZI81r-38sqWmBUdwmIw&s', description: 'General Check-up' },
        { icon: 'fa-solid fa-car', img: 'https://cdn-icons-png.flaticon.com/256/341/341144.png', description: 'Emergency & Trauma' },
        { icon: 'fa-solid fa-helicopter', img: 'https://www.shareicon.net/data/2016/07/04/790710_heart_512x512.png', description: 'Heart' },
        { icon: 'fa-solid fa-plane', img: 'https://cdn-icons-png.flaticon.com/512/12106/12106213.png', description: 'GI Center' },
        { icon: 'fa-solid fa-rocket', img: 'https://t3.ftcdn.net/jpg/00/74/04/96/360_F_74049623_E5SmzacMCYhsmNB3PxGzgtgFzauB93PD.jpg', description: 'Ambulance' },
        { icon: 'fa-solid fa-bus', img: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRT9prAP7T1frpb6qLq4lINSirnG7sS-FIZvQ&s', description: 'Children' }
      ]
    };
  }
}
</script>

<style scoped>
.cardServes {
  padding: 2rem 1rem;
  background-color: var(--bgColor);
  color: var(--color);
}

h1 {
  text-align: center;
  margin-bottom: 2rem;
  font-size: 2.5rem;
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

li:hover {
  transform: translateY(-10px);
}

.card {
  width: 100%;
  text-align: center;
  background-color: white;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
  display: flex;
  justify-content: center;
  align-items: center;
}

.image img {
  width: 100%;
  height: 100%;
  object-fit: contain; 
  border-radius: 50%;
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
