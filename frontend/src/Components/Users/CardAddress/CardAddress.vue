<template>
  <div>
    <h1>Search address</h1>
    <div class="search_form">
      <div>
        <el-dropdown size="large" split-button type="warning" @command="handleCommand">
          <span>{{ selectedProvince || 'Province' }}</span>
          <template #dropdown>
            <el-dropdown-menu>
              <el-dropdown-item command="Banteay Meanchey">Banteay Meanchey</el-dropdown-item>
              <el-dropdown-item command="Battambang">Battambang</el-dropdown-item>
              <el-dropdown-item command="Kampong Cham">Kampong Cham</el-dropdown-item>
              <el-dropdown-item command="Kampong Chhnang">Kampong Chhnang</el-dropdown-item>
            </el-dropdown-menu>
          </template>
        </el-dropdown>
      </div>
      <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping"><el-icon><Search /></el-icon></span>
        <input type="text" class="form-control" placeholder="Search address" aria-label="Search province" aria-describedby="addon-wrapping" v-model="searchQuery">
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col" v-for="(card, index) in filteredCards" :key="index">
        <div class="card h-100">
          <img :src="card.img" class="card-img-top" alt="...">
          <div class="card-body">
            <h3 class="card-title">{{ card.title }}</h3>
            <h5 class="card-subtitle mb-2 text-muted"><i class="fas fa-clock"></i> {{ card.time }}</h5>
            <p class="card-text"><i class="fas fa-map-marker-alt"></i> {{ card.address }}</p>
            <p class="card-text"><i class="fas fa-phone-alt"></i> {{ card.contact }}</p>
            <p class="card-text">{{ card.description }}</p>
            <el-rate v-model="card.rating" clearable />
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

export default {
  name: 'CardAddress',
  components: {
    Search,
  },
  data() {
    return {
      selectedProvince: '',
      searchQuery: '',
      cardaddress: [
        {
          img: 'https://chamberbusinessnews.com/wp-content/uploads/2024/06/New-Tower-Exteriors-6-5-241-scaled.jpg',
          title: 'Orchid Hospital',
          time: '24/7',
          address: 'Banteay Meanchey',
          contact: '+123 456 7890',
          description: 'Orchid Hospital provides comprehensive healthcare services with state-of-the-art facilities and experienced staff.',
          rating: 3,
        },
        {
          img: 'https://i.ytimg.com/vi/y296UElmNCs/maxresdefault.jpg',
          title: 'General Hospital',
          time: '24/7',
          address: 'RTK',
          contact: '+987 654 3210',
          description: 'General Hospital offers a wide range of medical services, ensuring the best care for all patients.',
          rating: 4,
        },
        {
          img: 'https://slhd.health.nsw.gov.au/sites/default/files/2022-11/2022.01.31%20%5B89918%5D%20Concord%20Hospital%20Redevelopment%20RAY%20WS3-096727.jpg',
          title: 'Concord Hospital',
          time: '24/7',
          address: 'RTK',
          contact: '+555 555 5555',
          description: 'Concord Hospital is known for its excellent patient care and advanced medical technology.',
          rating: 2,
        },
      ]
    }
  },
  computed: {
    filteredCards() {
      return this.cardaddress.filter(card => 
        card.title.toLowerCase().includes(this.searchQuery.toLowerCase()),
      );
    }
  },
  methods: {
    handleCommand(command) {
      this.selectedProvince = command;
    }
  
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
  background: white;
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
  width: 85%;
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  margin-left: 100px;
  margin-top: 20px;
}
.input-group {
  width: 80%;
  height: 7vh;
}
h1 {
  text-align: center;
  color: orange;
}
</style>