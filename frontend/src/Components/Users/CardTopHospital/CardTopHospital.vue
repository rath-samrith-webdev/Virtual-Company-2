<template>
  <div>
    <h1>Top Hospitals</h1>

    <div class="marquee-wrapper" style="user-select: none">
      <div class="marquee-content scrollingX">
        <div
          v-for="card in cards.concat(cards)"
          :key="card.id + 'duplicate'"
          class="card-testimonial"
        >
          <article>
            <picture>
              <source media="(min-width: 768px)" srcset="" />
              <img :src="card.img" alt="" />
            </picture>
            <h4>{{ card.title }}</h4>
            <article class="short-description">
              <p>{{ card.text }}</p>
              <el-rate
                v-model="value"
                :texts="['oops', 'disappointed', 'normal', 'good', 'great']"
                show-text
              />
            </article>
          </article>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CardTopHospital',
  data() {
    return {
      cards: [
        {
          id: 1,
          title: 'Orchid Hospital',
          text: 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
          img: 'https://eacnews.asia/uploads/images/1707375287_1d95c21b958defc06a96.jpg',
          stars: 5
        },
        {
          id: 2,
          title: 'Rose Hospital',
          text: 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
          img: 'https://www.diariolaregion.cl/wp-content/uploads/2024/04/DSC01023.jpg',
          stars: 4
        },
        {
          id: 3,
          title: 'Lily Hospital',
          text: 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
          img: 'https://www.khmertimeskh.com/wp-content/uploads/2022/02/photo_2022-02-02_17-41-10.jpg',
          stars: 3
        },
        {
          id: 4,
          title: 'Tulip Hospital',
          text: 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
          img: 'https://cambodianess.com/uploads/images/1640765322z6c2p-chkhgee007005-20211229-cbmfn0a001.jpg',
          stars: 4
        },
        {
          id: 5,
          title: 'Sunflower Hospital',
          text: 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
          img: 'https://helpx.adobe.com/content/dam/help/en/stock/how-to/visual-reverse-image-search/jcr_content/main-pars/image/visual-reverse-image-search-v2_intro.jpg',
          stars: 5
        }
      ],
      value: 4
    }
  }
}
</script>

<style scoped>
h1 {
  color: rgb(0, 0, 0);
  text-align: center;
  margin-bottom: 30px;
  margin-top: 50px;
}

body {
  align-items: center;
  background: #e3e3e3;
  display: flex;
  height: 100vh;
  justify-content: center;
}

.marquee-wrapper {
  position: relative;
  display: flex;
  overflow: hidden;
  gap: 1rem;
  border-radius: 1rem;
  padding: 10px;
  width: 100%;
  max-width: 100%;
  
}

.marquee-wrapper .marquee-content {
  display: flex;
  flex-shrink: 0;
  gap: 1rem;
  animation: scroll 25s linear infinite;
}

.marquee-wrapper .marquee-content .card-testimonial {
  max-width: 300px;
  background-color: #ffffff;
  box-shadow: 0 0 10px #37c0ff85;
  text-align: center;
  padding: 1rem;
  border-radius: 1rem;
  color: #000000;
}

.marquee-wrapper .marquee-content .card-testimonial article picture {
  position: relative;
  min-width: 200px;
}

.marquee-wrapper .marquee-content .card-testimonial article picture img {
  width: 100%;
  height: 200px;
  border-radius: 0.5rem;
  object-fit: cover;
  object-position: 50% 15%;
}

.marquee-wrapper .marquee-content .card-testimonial article h4 {
  font-size: 20px;
  text-transform: capitalize;
  margin-block: 1rem;
}

.marquee-wrapper .marquee-content .card-testimonial article article.short-description p {
  font-size: 14px;
  line-height: 20px;
  margin-bottom: 1.2rem;
}

@keyframes scroll {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(calc(-100% / 2 - 1rem));
  }
}

.marquee-wrapper:hover .marquee-content {
  animation-play-state: paused;
}
</style>
