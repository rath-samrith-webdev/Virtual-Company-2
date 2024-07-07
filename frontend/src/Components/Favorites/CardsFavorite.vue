<template>
  <div>
    <div class="card_favorite">
      <div class="wrapper" v-for="cardFavorite in cardFavorites" :key="cardFavorite.id">
        <div class="single-card">
          <div class="img-area">
            <img v-if="cardFavorite.cover_image == 'No cover'" :src="cardFavorite.cover_image" class="card-img-top" alt="...">
            <h4 v-if="cardFavorite.cover_image !== 'No cover'">
              <img src="https://i0.wp.com/sunrisedaycamp.org/wp-content/uploads/2020/10/placeholder.png?ssl=1" alt="" width="400px">
            </h4>
          </div>
          <div class="info">
            <h5>{{ cardFavorite.name }}</h5>
            <p class="price">{{ cardFavorite.time }}</p>
            <p>{{ cardFavorite.data }}</p>
            <el-rate v-model="cardFavorite.rating" disabled show-score text-color="#ff9900" score-template="{value} points" />
          </div>
          <div class="card_button m-2">
            <button type="button" class="btn btn-warning"><i class="fas fa-info-circle"></i> See Details</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'
import { Search } from '@element-plus/icons-vue'
import axiosInstance from '@/plugins/axios'

export default {
  name: 'CardAddress',
  components: {
    Search,
  },
  data() {
    return {
      selectedOptions: [],
      searchQuery: '',
      cardFavorites: []
    }
  },
  computed: {
    filteredCards() {
      return this.cardFavorites.filter(card => {
        const matchesTitle = card.name.toLowerCase().includes(this.searchQuery.toLowerCase());
        const matchesOptions = this.selectedOptions.length === 0 || this.selectedOptions.includes(card.address);
        return matchesTitle && matchesOptions;
      });
    }
  },
  methods: {
    // async userhospital() {
    //   try {
    //     const { data } = await axiosInstance.get('/hospitals/list')
    //     this.cardFavorites = data.data;
    //   } catch (error) {
    //     console.log(error)
    //   }
    // },
    async userFavorite() {
      try {
        const { data } = await axiosInstance.get('/favourites/list')
        this.cardFavorites = data.data;
      } catch (error) {
        console.log(error)
      }
    }
  },
  mounted() {
    this.userFavorite()
  }
}
</script>

<style>
.card_favorite {
  width: 90%;
  display: flex;
  flex-wrap: wrap;
  margin-left: 130px;
}

.single-card {
  position: relative;
  width: 280px;
  height: 400px;
  margin: 15px;
  box-shadow: 0 2px 20px rgba(255, 251, 175, 0.635);
  transition: box-shadow 0.3s ease;
  overflow: hidden;
  background: #ffffff;
  border-radius: 15px;
  transition: all 0.8s ease-in-out;
}

.img-area {
  position: relative;
  width: 100%;
  height: 200px;
  overflow: hidden;
}

.img-area img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.img-area:hover img {
  transform: scale(1.1);
}

.info {
  padding: 10px;
  text-align: center;
  color: #000000;
}

.info h5 {
  margin: 15px 0 10px;
  font-size: 20px;
  font-weight: bold;
  text-transform: uppercase;
}

.info .price {
  margin: 0;
  font-size: 20px;
  font-weight: bold;
  color: rgb(255, 229, 84);
}

.card_button {
  display: flex;
  justify-content: flex-end;
}
</style>
