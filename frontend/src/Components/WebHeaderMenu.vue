<script setup lang="ts">
import { useAuthStore } from '@/stores/auth-store'
import { useRouter } from 'vue-router'
import { BellFilled, Notification } from '@element-plus/icons-vue'
import { ref } from 'vue'

const router = useRouter()
const store = useAuthStore()
const drawer = ref(false)
function handleLogout() {
  localStorage.removeItem('access_token')
  store.user = null
  router.push('/landing')
}
</script>
<template>
  <header class="nav flex justify-between px-5 bg-white items-center p-4">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <img src="@/assets/logo/care_finder-02.png" alt="" srcset="" width="175">
    </div>

    <!-- Hospital Menu -->
    <nav class="flex justify-center space-x-4 ms-lg-4" v-if="store.user && store.roles[0]=='hospital'">
      <router-link
        to="/hospital/dashboard"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Home
      </router-link
      >
      <router-link
        to="/hospital/feedbacks"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Feedbacks
      </router-link
      >
      <router-link
        to="/hospital/doctors"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Doctors
      </router-link
      >
      <router-link
        to="/hospital/appointments"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Appointments
      </router-link
      >
    </nav>
    <!--Doctor Menu-->
    <nav class="flex justify-center space-x-4 ms-lg-4" v-if="store.user && store.roles[0]=='doctor'">
      <router-link
        to="/doctor/dashboard"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Home
      </router-link
      >
      <router-link
        to="/doctor/calendar"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Calendar
      </router-link
      >
      <router-link
        to="/doctor/appointment"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Appointments
      </router-link
      >
    </nav>
    <!-- User Menu -->
    <nav class="flex justify-center space-x-4 ms-lg-4" v-if="store.user && store.roles[0]=='user'">
      <router-link
        to="/"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Home
      </router-link
      >
      <router-link
        to="/user/hospital"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Hospital
      </router-link
      >
      <router-link
        to="/favorite"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Favorites
      </router-link
      >
      <router-link
        to="/map"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Map
      </router-link
      >
      <router-link
        to="/appointment"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Appointments
      </router-link
      >
    </nav>
    <!-- Landing Nav -->
    <nav class="pb-4 pt-3 flex justify-center space-x-4 " v-if="!store.user">
      <router-link to="/landing" class=" fw-bold text-dark " style="text-decoration: none;">Home</router-link>
      <router-link to="/about" class="fw-bold pl-5 text-dark" style="text-decoration: none;">About Us</router-link>
      <router-link to="" class=" fw-bold pl-5 text-dark" style="text-decoration: none;">Service</router-link>
      <router-link to="/contact" class=" fw-bold pl-5 text-dark" style="text-decoration: none;">Contact</router-link>
    </nav>
    <!-- Sign In -->
    <div class="d-flex gap-2 align-items-center min-w-20 justify-between ">
      <router-link v-if="!store.user" to="/login" class="btn py-1 rounded font-semibold text-white log-in ">Get Started
      </router-link>
      <el-dropdown trigger="click" class="notification">
        <el-badge v-if="store.user!=null" :value="200" :offset="[-35, 3]" :max="99" class="item">
        <span class="el-dropdown-link">
          <el-icon :size="30"><BellFilled /></el-icon>
        </span>
        </el-badge>
        <template #dropdown>
          <el-card>Hi</el-card>
          <el-card>Hi</el-card>
          <el-card>Hi</el-card>
        </template>
      </el-dropdown>
      <el-dropdown trigger="click" v-if="store.user!=null" class="pf-dropdown">
        <span class="el-dropdown-link">
          <el-avatar
            v-if="store.user.profile==='No profile'">{{ store.user.first_name[0] }} {{ store.user.last_name[0]
            }}</el-avatar>
          <el-avatar v-if="store.user.profile!=='No profile'" :src="store.user.profile"></el-avatar>
        </span>
        <template #dropdown>
          <el-dropdown-menu>
            <el-dropdown-item>
              <router-link to="/profile" class="nav-link">Profile</router-link>
            </el-dropdown-item>
            <el-dropdown-item>
              <button @click="handleLogout" class="nav-link">Log out</button>
            </el-dropdown-item>
          </el-dropdown-menu>
        </template>
      </el-dropdown>
    </div>
    <el-button class="menu-btn" type="primary" style="margin-left: 16px" @click="drawer = true">
      Menu
    </el-button>
    <el-drawer class="el-drawer" :size="400" v-model="drawer" title="Menu">
      <template #header>
        <div class="d-flex justify-content-start gap-2 p-2 align-items-center" v-if="store.user">
          <el-avatar
            v-if="store.user.profile==='No profile'">{{ store.user.first_name[0] }} {{ store.user.last_name[0]
            }}</el-avatar>
          <el-avatar v-if="store.user.profile!=='No profile'" :src="store.user.profile"></el-avatar>
          <h4>{{ store.user.first_name }} {{ store.user.last_name }}</h4>
        </div>
      </template>
      <!-- Hospital-->
      <div class="d-flex flex-column" v-if="store.user && store.roles[0]=='hospital'">
        <router-link
          to="/hospital/dashboard"
          class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Home
        </router-link
        >
        <router-link
          to="/hospital/feedbacks"
          class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Feedbacks
        </router-link
        >
        <router-link
          to="/hospital/doctors"
          class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Doctors
        </router-link
        >
        <router-link
          to="/hospital/appointments"
          class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Appointments
        </router-link
        >
      </div>
      <!--Doctor -->
      <div class="d-flex flex-column" v-if="store.user && store.roles[0]=='doctor'">
        <router-link
          to="/doctor/dashboard"
          class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Home
        </router-link
        >
        <router-link
          to="/doctor/calendar"
          class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Calendar
        </router-link
        >
        <router-link
          to="/doctor/appointment"
          class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Appointments
        </router-link
        >
      </div>
      <!--User -->
      <div class="d-flex flex-column" v-if="store.user && store.roles[0]=='user'">
        <router-link
          to="/"
          class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Home
        </router-link
        >
        <router-link
          to="/user/hospital"
          class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Hospital
        </router-link
        >
        <router-link
          to="/favorite"
          class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Favorites
        </router-link
        >
        <router-link
          to="/map"
          class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Map
        </router-link
        >
        <router-link
          to="/appointment"
          class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Appointments
        </router-link
        >
      </div>
      <div class="d-flex flex-column justify-start" v-if="store.user">
        <el-dropdown trigger="click" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">
          <el-badge v-if="store.user!=null" :value="200" :max="99" class="item">
        <span class="el-dropdown-link font-bold">
          Notifications
        </span>
          </el-badge>
          <template #dropdown>
            <el-card>Hi</el-card>
            <el-card>Hi</el-card>
            <el-card>Hi</el-card>
          </template>
        </el-dropdown>
        <router-link to="/profile" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Profile</router-link>
        <button @click="handleLogout" class="nav-link text-start">Log out</button>
      </div>
      <div class="d-flex flex-column justify-start" v-if="!store.user">
        <router-link to="/landing" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900" style="text-decoration: none;">Home</router-link>
        <router-link to="/about" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900" style="text-decoration: none;">About Us</router-link>
        <router-link to="" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900" style="text-decoration: none;">Service</router-link>
        <router-link to="/contact" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900" style="text-decoration: none;">Contact</router-link>
      </div>
    </el-drawer>
  </header>
</template>
<style scoped>
header {
  position: sticky;
  top: 0;
  z-index: 11;
}

.log-in {
  position: relative;
  background-color: #32B4E3;
}
.menu-btn{
  display: none;
}
@media (min-width: 768px) and (max-width: 1023px) {
  header{
    display: flex;
    justify-content: space-between;
    padding: 10px;
  }
  nav {
    display: none;
  }
  .menu-btn{
    display: block;
  }
  .pf-dropdown{
    display: none;
  }
  .log-in{
    display: none;
  }
  .notification{
    display: none;
  }
}
@media (max-width: 767px) {
  nav {
    display: none;
  }
  .menu-btn{
    display: block;
  }
  .el-drawer{
    width: 400px;
  }
  .pf-dropdown{
    display: none;
  }
  .log-in{
    display: none;
  }
  .notification{
    display: none;
  }
}

</style>
