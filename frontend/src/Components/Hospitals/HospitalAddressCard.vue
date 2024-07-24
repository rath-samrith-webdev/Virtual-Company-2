<template>
  <div>
    <h1>Search Address</h1>
    <div class="search_form">
      <div class="ms-3">
        <el-select
          v-model="selectedOptions"
          multiple
          filterable
          allow-create
          default-first-option
          :reserve-keyword="false"
          placeholder="Select province"
          style="width: 240px"
          size="large"
        >
          <el-option
            v-for="item in options"
            :key="item.value"
            :label="item.label"
            :value="item.value"
          />
        </el-select>
      </div>
      <div class="ms-3">
        <el-select
          v-model="selectedCategory"
          multiple
          filterable
          allow-create
          default-first-option
          :reserve-keyword="false"
          placeholder="Hospital category"
          style="width: 240px"
          size="large"
        >
          <el-option
            v-for="item in category"
            :key="item.id"
            :label="item.name"
            :value="item.name"
          />
        </el-select>
      </div>
      <el-input
        class="m-2"
        :rows="2"
        prefix-icon="Search"
        style="width: 1000px"
        size="large"
        placeholder="Search hospital name....."
        v-model="searchQuery"
      />
    </div>
    <div class="card_hospital">
      <div class="wrapper" v-for="(card, index) in filteredCards" :key="index">
        <div class="single-card">
          <div class="img-area">
            <img
              v-if="card.cover_image !== 'No Cover'"
              :src="card.cover_image"
              alt="Placeholder"
              width="400px"
            />
            <img
              v-if="card.cover_image == 'No Cover'"
              src="https://i0.wp.com/sunrisedaycamp.org/wp-content/uploads/2020/10/placeholder.png?ssl=1"
              class="card-img-top"
              alt="Hospital cover image"
            />
          </div>
          <div class="info">
            <div class="card_title">
              <h4 class="card-title">{{ card.name }}</h4>
            </div>
            <h6 class="card-subtitle mb-2 text-muted">
              <i class="fas fa-clock"></i> {{ card.open_time }}
            </h6>
            <p class="card-text"><i class="fas fa-map-marker-alt"></i> {{ card.province }}</p>
            <p class="card-text"><i class="fas fa-phone-alt"></i> {{ card.phone_number }}</p>
            <p class="card-text">{{ card.street_address }}</p>
            <el-rate v-model="card.average_rating" disabled text-color="#ff9900" />
            <div class="card_button mt-2">
              <button type="button" @click="seeDetails(card.id)" class="btn btn-outline-primary">
                <i class="fas fa-info-circle"></i> See Details
              </button>
              <button
                type="button"
                class="btn btn-outline-primary"
                @click="addToFavorites(card.id)"
              >
                <el-icon><CollectionTag /></el-icon>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Search, CollectionTag } from '@element-plus/icons-vue'
import axiosInstance from '@/plugins/axios'
import { useAuthStore } from '@/stores/auth-store'
import { ElNotification } from 'element-plus'
import { hospitalDetailStore } from '@/stores/hospital-detail'
const store = useAuthStore()
const details = hospitalDetailStore()
export default {
  name: 'HospitalAddressCard',
  components: {
    Search,
    CollectionTag
  },
  data() {
    return {
      selectedOptions: [],
      options: [
        { value: 'Banteay Meanchey', label: 'Banteay Meanchey' },
        { value: 'Battambang', label: 'Battambang' },
        { value: 'Kampong Cham', label: 'Kampong Cham' },
        { value: 'Kampong Chhnang', label: 'Kampong Chhnang' },
        { value: 'Kampong Thom', label: 'Kampong Thom' },
        { value: 'Kampong Speu', label: 'Kampong Speu' },
        { value: 'Kampot', label: 'Kampot' },
        { value: 'Kandal', label: 'Kandal' },
        { value: 'Kep', label: 'Kep' },
        { value: 'Koh Kong', label: 'Koh Kong' },
        { value: 'Kratié', label: 'Kratié' },
        { value: 'Mondulkiri', label: 'Mondulkiri' },
        { value: 'Oddar Meanchey', label: 'Oddar Meanchey' },
        { value: 'Pailin', label: 'Pailin' },
        { value: 'Phnom Penh', label: 'Phnom Penh' },
        { value: 'Preah Sihanouk', label: 'Preah Sihanouk' },
        { value: 'Preah Vihear', label: 'Preah Vihear' },
        { value: 'Prey Veng', label: 'Prey Veng' },
        { value: 'Pursat', label: 'Pursat' },
        { value: 'Ratanakiri', label: 'Ratanakiri' },
        { value: 'Siem Reap', label: 'Siem Reap' },
        { value: 'Stung Treng', label: 'Stung Treng' },
        { value: 'Svay Rieng', label: 'Svay Rieng' },
        { value: 'Takéo', label: 'Takéo' },
        { value: 'Tboung Khmum', label: 'Tboung Khmum' }
      ],
      searchQuery: '',
      cardAddress: [],
      selectedCategory: [],
      category: []
    }
  },
  computed: {
    filteredCards() {
      return this.cardAddress.filter((card) => {
        const matchesTitle = card.name.toLowerCase().includes(this.searchQuery.toLowerCase())
        const matchesOptions =
          this.selectedOptions.length === 0 || this.selectedOptions.includes(card.province)
        const matchesCategory =
          this.selectedCategory.length === 0 || this.selectedCategory.includes(card.category.name)
        return matchesTitle && matchesOptions && matchesCategory
      })
    }
  },
  methods: {
    alertMessage(title, message, type) {
      ElNotification({
        title: title,
        message: message,
        type: type
      })
    },
    async fetchHospital() {
      try {
        const { data } = await axiosInstance.get('/hospitals/list')
        this.cardAddress = data.data
      } catch (error) {
        console.log(error)
        return null
      }
    },
    async categoryHospital() {
      try {
        const { data } = await axiosInstance.get('/categories/list')
        this.category = data.data
      } catch (error) {
        return null
      }
    },
    async addToFavorites(card) {
      const fav = {
        user_id: store.user.id,
        hospital_id: card
      }
      try {
        const { data } = await axiosInstance.post('/favourites/create', fav)
        if (data.success) {
          this.alertMessage('Favorite', data.message, 'success')
        } else {
          this.alertMessage('Favorite', data.message, 'warning')
        }
      } catch (error) {
        console.log(error)
      }
    },
    seeDetails(id) {
      details.id = id
      this.$router.push(`/hospital/detail?id=${id}`)
      details.fetchHospitalDetail(id)
    }
  },
  mounted() {
    this.fetchHospital()
    this.categoryHospital()
  }
}
</script>

<style>
h1 {
  width: 99%;
  margin-left: auto;
  /* background: #dff6ff; */
  text-align: center;
  color: hsl(0, 0%, 0%)}

.search_form {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-left: auto;
  margin-bottom: auto;
}

.card_hospital {
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  margin-left: 0px;
}

.single-card {
  position: relative;
  width: 280px;
  margin: 15px;
  box-shadow: 0 2px 20px rgba(255, 204, 175, 0.43);
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

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 174, 255, 0.8);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.single-card:hover .overlay {
  opacity: 1;
}

.add-to-cart,
.view-details {
  background-color: #fff;
  color: #000000;
  padding: 10px 15px;
  border-radius: 4px;
  font-size: 12px;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 1px;
  cursor: pointer;
  transition:
    background-color 0.3s ease,
    color 0.3s ease;
  margin-bottom: 10px;
}

.add-to-cart:hover,
.view-details:hover {
  background-color: orangered;
  color: #000000;
  border: none;
}

.info {
  padding: 10px;
  text-align: center;
  color: #000000;
}

.info h3 {
  margin: 15px 0 10px;
  font-size: 30px;
  font-weight: bold;
  text-transform: uppercase;
  font-family: 'Bebas Neue', sans-serif;
}

.info .price {
  margin: 0;
  font-size: 30px;
}

.card_button {
  display: flex;
  justify-content: space-between;
}
</style>
