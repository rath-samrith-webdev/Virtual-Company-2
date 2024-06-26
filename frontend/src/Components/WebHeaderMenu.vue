<script setup lang="ts">
import { useAuthStore } from '@/stores/auth-store'
import { useRouter } from 'vue-router'
const router = useRouter()
const store = useAuthStore()

function handleLogout() {
  localStorage.removeItem('access_token')
   router.push('/landing')
}
</script>
<template>
  <header class="nav flex justify-between px-5 bg-white items-center p-4">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <img src="@/assets/logo/care_finder-02.png" alt="" srcset="" width="175">
    </div>

    <!-- Menu Items -->
    <nav class="flex justify-center space-x-4 ms-lg-4" v-if="store.user && store.roles[0]=='hospital'">
      <router-link
        to="/"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Home
      </router-link
      >
      <router-link
        to="/hospital"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Feedbacks
      </router-link
      >
      <router-link
        to="/map"
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
        to="/reports"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Reports
      </router-link
      >
    </nav>
    <nav class="pb-4 pt-3 flex justify-center space-x-4 " v-if="!store.user">
      <router-link to="/landing" class=" fw-bold text-dark " style="text-decoration: none;">Home</router-link>
      <router-link to="/about" class="fw-bold pl-5 text-dark" style="text-decoration: none;">About Us</router-link>
      <router-link to="" class=" fw-bold pl-5 text-dark" style="text-decoration: none;">Service</router-link>
      <router-link to="/contact" class=" fw-bold pl-5 text-dark" style="text-decoration: none;">Contact</router-link>
    </nav>

    <!-- Sign In -->
    <div>
      <router-link v-if="!store.user" to="/landing" class="btn mr-3 py-1 rounded font-semibold sign-up">Sign up
      </router-link>
      <router-link v-if="!store.user" to="/login" class="btn py-1 rounded font-semibold text-white log-in ">Log in
      </router-link>
      <button v-if="store.user" @click="handleLogout" class="btn px-4 py-1 rounded font-semibold">Log out</button>
    </div>
  </header>
</template>
<style scoped>
header {
  position: sticky;
  top: 0;
  z-index: 1;
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
