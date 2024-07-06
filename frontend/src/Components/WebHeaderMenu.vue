<script setup lang="ts">
import { useAuthStore } from '@/stores/auth-store'
import { useRouter } from 'vue-router'
const router = useRouter()
const store = useAuthStore()

function handleLogout() {
  localStorage.removeItem('access_token')
  store.user = null
  router.push('/landing')
}
function handleCommand(command) {
  if (command === 'profile') {
    router.push('/profile')
  } else if (command === 'logout') {
    handleLogout()
  }
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
        to="/hospital/appointments"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Appointments
      </router-link
      >
      <router-link
        to="/reports"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Reports
      </router-link
      >
    </nav>
    <!--Doctor Menu-->
    <nav class="flex justify-center space-x-4 ms-lg-4" v-if="store.user && store.roles[0]=='doctor'">
      <router-link
        to="/"
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
        to="/hospital"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Hospital
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
<!-- Landing Nav           -->
    <nav class="pb-4 pt-3 flex justify-center space-x-4 " v-if="!store.user">
      <router-link to="/landing" class=" fw-bold text-dark " style="text-decoration: none;">Home</router-link>
      <router-link to="/about" class="fw-bold pl-5 text-dark" style="text-decoration: none;">About Us</router-link>
      <router-link to="" class=" fw-bold pl-5 text-dark" style="text-decoration: none;">Service</router-link>
      <router-link to="/contact" class=" fw-bold pl-5 text-dark" style="text-decoration: none;">Contact</router-link>
    </nav>
    <!-- Sign In -->
    <div>
      <router-link v-if="!store.user" to="/login" class="btn py-1 rounded font-semibold text-white log-in ">Get Started
      </router-link>
      <el-dropdown trigger="click" v-if="store.user!=null">
        <span class="el-dropdown-link">
          <el-avatar v-if="store.user.profile==='No profile'">{{store.user.first_name[0]}} {{store.user.last_name[0]}}</el-avatar>
          <el-avatar v-if="store.user.profile!=='No profile'" :src="store.user.profile"></el-avatar>
        </span>
        <template #dropdown>
          <el-dropdown-menu>
            <el-dropdown-item><router-link to="/profile" class="nav-link">Profile</router-link></el-dropdown-item>
            <el-dropdown-item>
              <button @click="handleLogout" class="nav-link">Log out</button>
            </el-dropdown-item>
          </el-dropdown-menu>
        </template>
      </el-dropdown>
    </div>
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

.sign-up {
  position: absolute;
  background-color: #FCB22D;
  color: white;
  right: 105px;
  z-index: 1;
}
</style>
