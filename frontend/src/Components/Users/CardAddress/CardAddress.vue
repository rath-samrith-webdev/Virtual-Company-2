<template>
  <div>
    <h1>Search address</h1>
    <div class="search_form">
      <div>
        <el-select 
          v-model="selectedOptions"
          multiple
          filterable
          allow-create
          default-first-option
          :reserve-keyword="false"
          placeholder="Select province"
          style="width: 240px;"
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
      <el-input class=" m-2"
       :rows="2"
        prefix-icon="Search"
        style="width: 1000px"
         size="large"
        placeholder="Search province"
        v-model="searchQuery"
      >
        <template #prefix>
          <el-icon><search /></el-icon>
        </template>
      </el-input>
    </div>
    <div class="row row-cols-1 row-cols-md-3">
      <div class="col" v-for="(card, index) in filteredCards" :key="index">
        <div class="card h-100">
          <div class="card_image">
            <img v-if="card.cover_image!=='No cover'" :src="card.cover_image" class="card-img-top" alt="...">
              <h4 v-if="card.cover_image=='No cover'" >
                <img src="https://i0.wp.com/sunrisedaycamp.org/wp-content/uploads/2020/10/placeholder.png?ssl=1" alt="" width="400px">
              </h4>
          </div>
          
          <div class="card-body">
            <h3 class="card-title">{{ card.name }}</h3>
            <h5 class="card-subtitle mb-2 text-muted"><i class="fas fa-clock"></i> {{  }}</h5>
            <p class="card-text"><i class="fas fa-map-marker-alt"></i> {{ }}</p>
            <p class="card-text"><i class="fas fa-phone-alt"></i> {{ }}</p>
            <p class="card-text">{{ }}</p>
            <el-rate
              disabled
              show-score
              text-color="#ff9900"
            />
            <div class="mt-2">
              <button type="button" class="btn btn-warning"><i class="fas fa-info-circle"></i> See Details</button>
            </div>
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
import { da } from 'element-plus/es/locales.mjs';
export default {
  name: 'CardAddress',
  components: {
    Search,
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
        { value: 'Tboung Khmum', label: 'Tboung Khmum' },
      ],
      searchQuery: '',
      cardAddress: []
    }
  },
  computed: {
    filteredCards() {
      return this.cardAddress.filter(card => {
        const matchesTitle = card.name.toLowerCase().includes(this.searchQuery.toLowerCase());
        const matchesOptions = this.selectedOptions.length === 0 || this.selectedOptions.includes(card.province.toLowerCase());
        return matchesTitle && matchesOptions;
      });
    },
  },
  methods:{
    async fetchHospital() {
    try {
      const { data } = await axiosInstance.get('/hospitals/list')
      data.data.forEach(hospitals =>{
        this.cardAddress.push(hospitals)
      })
    } catch (error) {
      console.log(error)
      return null
    }
} 
  },
  mounted() {
    this.fetchHospital()
  }
}
</script>

<style>
.row {
  width: 90%;
  margin: 100px auto;
}
.card-title {
  color: orange;
}
.card {
  background: rgb(255, 255, 255);
  border: 1px solid yellow;
  transition: box-shadow 0.3s ease-in-out;
}
.card:hover {
  box-shadow: 0 4px 8px 0 rgb(247, 219, 8), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.card-img-top {
  max-height: 200px;
  object-fit: cover;
}
.btn-warning {
  background-color: #f0ad4e;
  border-color: #f0ad4e;
}
.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
  margin-left: 10px;
}
.search_form {
  width: 87%;
  display: flex;
  align-items: center;
  margin-left: 100px;
  margin-top: 20px;  
}
h1 {
  text-align: center;
  color: orange;
}
.card-img-top img{
  background: #007bff;
}
h4 img{
  width: 100%;
  height: 100%;
  padding: 10px;
  
}


</style>
