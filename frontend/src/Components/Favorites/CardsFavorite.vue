<template>
  <div>
    <div class="card_favorite">
      <div class="wrapper" v-for="cardFavorite in cardFavorites" :key="cardFavorite.id">
        <div class="single-card card">
          <div class="img-area">
            <img
              v-if="cardFavorite.hospital.cover_image !== 'No Cover'"
              :src="cardFavorite.hospital.cover_image"
              alt="Placeholder"
              width="400px"
            />
            <img
              v-if="cardFavorite.hospital.cover_image === 'No Cover'"
              src="https://i0.wp.com/sunrisedaycamp.org/wp-content/uploads/2020/10/placeholder.png?ssl=1"
              class="card-img-top"
              alt="Hospital cover image"
            />
          </div>
          <div class="info">
            <h5>{{ cardFavorite.hospital.name }}</h5>
            <p class="price">{{ cardFavorite.hospital.open_time }}</p>
            <p>{{ cardFavorite.hospital.province }}</p>
            <p>{{ cardFavorite.hospital.phone_number }}</p>
            <p>{{ cardFavorite.hospital.street_address }}</p>
            <el-rate
              v-model="cardFavorite.hospital.average_rating"
              disabled
              show-score
              text-color="#ff9900"
              score-template="{value} points"
            />
          </div>
          <div class="card_button m-2 flex justify-between">
            <el-button @click="Remove(cardFavorite.id)">Remove</el-button>
            <el-button @click="seeDetails(cardFavorite.id)">See detail</el-button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Search } from '@element-plus/icons-vue'
import axiosInstance from '@/plugins/axios'
import { hospitalDetailStore } from '@/stores/hospital-detail'
const details = hospitalDetailStore()
export default {
  name: 'CardAddress',
  components: {
    Search
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
      return this.cardFavorites.filter((card) => {
        const matchesTitle = card.name.toLowerCase().includes(this.searchQuery.toLowerCase())
        const matchesOptions =
          this.selectedOptions.length === 0 || this.selectedOptions.includes(card.address)
        return matchesTitle && matchesOptions
      })
    }
  },
  methods: {
    async userFavorite() {
      try {
        const { data } = await axiosInstance.get('/favourites/list')
        console.log(data)
        this.cardFavorites = data.data
      } catch (error) {
        console.log(error)
      }
    },
    seeDetails(id) {
      details.id = id
      this.$router.push(`/hospital/detail?id=${id}`)
      details.fetchHospitalDetail(id)
    },
    async removeFavorites(id) {
      try {
        const { data } = await axiosInstance.delete(`/favourites/delete/${id}`)
        console.log(data)
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
  margin: 15px;
  box-shadow: 0 2px 20px rgba(249, 206, 206, 0.421);
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
}

.card_button {
  display: flex;
  justify-content: flex-end;
}
</style>
