<script setup lang="ts">
import {useAuthStore} from '@/stores/auth-store'
import { useRouter} from 'vue-router'
import {BellFilled} from '@element-plus/icons-vue'
import {onMounted, ref} from 'vue'
import {NotificationStore} from "@/stores/notification-store";
import {pusherConstance} from "@/pusher/pusher";
import {hospitalAppointmentListStore} from "@/stores/hospital-appointment-list";
import {FeedbackList} from "@/stores/feedback-list";

const pusher = pusherConstance;
const router = useRouter()
const store = useAuthStore()
const notifyStore = NotificationStore()
const appointment = hospitalAppointmentListStore()
const feedback=FeedbackList()
const drawer = ref(false)

function handleLogout() {
  localStorage.removeItem('access_token')
  store.user = null
  router.push('/landing')
}

const gotoAppointment = (id: any) => {
  notifyStore.markAsSeen(id)
  console.log(id)
  if (store.roles[0] == 'user') {
    router.push('/appointment')
  } else if (store.roles[0] == 'hospital') {
    router.push('/hospital/appointments')
  } else if (store.roles[0] == 'doctor') {
    router.push('/doctor/appointment')
  } else {
    router.push('/not-found')
  }
}
const fetchData = async () => {
  await appointment.fetchAppointments()
  await notifyStore.fetchNotification()
  await notifyStore.fetchUnseenNotifications()
  await appointment.fetchCalendarData()
}
onMounted(() => {
  appointment.fetchCalendarData()

  if (store.user) {
    notifyStore.fetchNotification()
    notifyStore.fetchUnseenNotifications()
    if(store.roles[0]=='hospital'){
      appointment.fetchMonthlyAppointment()
      feedback.fetchMonthlyFeedbacks()
    }
    pusher.subscribe(`appointment`).bind(`appointment`, function (data) {
      if (data) {
        fetchData()
      }
    })
    pusher.subscribe(`appointment-placed`).bind(`appointment-placed`, function (data) {
      if (data) {
        fetchData()
      }
    })
    pusher.subscribe(`notification`).bind(`notify`, function (data) {
      if (data) {
        fetchData()
      }
    })
  }
})
</script>
<template>
  <header class="nav flex justify-between px-5 bg-white align-items-center p-4">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <img src="@/assets/logo/care_finder-02.png" alt="" srcset="" width="175">
    </div>

    <!-- Hospital Menu -->
    <nav class="flex justify-center space-x-4 ms-lg-4" v-if="store.user && store.roles[0]=='hospital'">
      <router-link
          to="/hospital/dashboard"
          class="font-bold px-3 py-2 text-slate-700  rounded-lg hover:bg-slate-100 hover:text-slate-900"
          style="text-decoration: none;"
      >Home
      </router-link
      >
      <router-link
          to="/myHospital"
          class="font-bold px-3 py-2 text-slate-700  rounded-lg hover:bg-slate-100 hover:text-slate-900"
          style="text-decoration: none;"
      >Hospital
      </router-link
      >
      <router-link
          to="/hospital/feedbacks"
          class="font-bold px-3 py-2 text-slate-700  rounded-lg hover:bg-slate-100 hover:text-slate-900"
          style="text-decoration: none;"
      >Feedbacks
      </router-link
      >
      <router-link
          to="/hospital/doctors"
          class="font-bold px-3 py-2 text-slate-700  rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Doctors
      </router-link
      >
      <router-link
          to="/hospital/appointments"
          class="font-bold px-3 py-2 text-slate-700  rounded-lg hover:bg-slate-100 hover:text-slate-900"
          style="text-decoration: none;"
      >Appointments
      </router-link
      >
      <router-link class="font-bold px-3 py-2 text-slate-700  rounded-lg hover:bg-slate-100 hover:text-slate-900" to="/hospital/calendar">
        Calendar
      </router-link>
      <router-link class="font-bold px-3 py-2 text-slate-700  rounded-lg hover:bg-slate-100 hover:text-slate-900" to="/upload/promotion">
        My promotions
      </router-link>
    </nav>
    <!--Doctor Menu-->
    <nav class="flex justify-center space-x-4 ms-lg-4" v-if="store.user && store.roles[0]=='doctor'">
      <router-link
          to="/doctor/dashboard"
          class="font-bold px-3 py-2 text-slate-700  rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Home
      </router-link
      >
      <router-link
          to="/doctor/calendar"
          class="font-bold px-3 py-2 text-slate-700  rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Calendar
      </router-link
      >
      <router-link
          to="/doctor/appointment"
          class="font-bold px-3 py-2 text-slate-700  rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Appointments
      </router-link>
    </nav>
    <!-- User Menu -->
    <nav class="flex justify-center space-x-4 ms-lg-4" v-if="store.user && store.roles[0]=='user'">
      <router-link
          to="/"
          class="font-bold px-3 py-2 text-slate-700  rounded-lg hover:bg-slate-100 hover:text-slate-900"
          style="text-decoration: none;"
      >Home
      </router-link
      >
      <router-link
          to="/favorite"
          class="font-bold px-3 py-2 text-slate-700  rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Favorites
      </router-link
      >
      <router-link
          to="/map"
          class="font-bold px-3 py-2 text-slate-700  rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Map
      </router-link
      >
      <router-link
          to="/appointment"
          class="font-bold px-3 py-2 text-slate-700  rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Appointments
      </router-link>
      <router-link
          to="/calendar"
          class="font-bold px-3 py-2 text-slate-700  rounded-lg hover:bg-slate-100 hover:text-slate-900"
      >Calendar
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
      <el-dropdown v-if="store.user" trigger="click" max-height="500px" placement="bottom-end" class="notification">
        <el-badge v-if="store.user"
                  :value="notifyStore.unseenNotifications.length"
                  :offset="[-30, 3]" :max="99"
                  class="item">
        <span class="el-dropdown-link">
          <el-icon :size="30"><BellFilled/></el-icon>
        </span>
        </el-badge>
        <template v-if="store.roles[0]=='user'" #dropdown>
          <el-dropdown-menu>
            <el-dropdown-item class="d-flex justify-content-around h-25 align-items-center gap-2"
                              v-for="note in notifyStore.notifications" :key="note.id"
                              @click="gotoAppointment(note.id)">
              <el-avatar></el-avatar>
              <div class="d-flex flex-column">
                <small :class="note.is_read==0?'font-bold':''">{{note.user.fist_name}} {{ note.message }}</small>
                <small :class="note.is_read==0?'font-bold':''">{{ note.created_at }}</small>
              </div>
            </el-dropdown-item>
          </el-dropdown-menu>
        </template>
        <template v-if="store.roles[0]=='doctor'" #dropdown>
          <el-dropdown-menu>
            <el-dropdown-item class="d-flex justify-content-around h-25 align-items-center gap-2"
                              v-for="note in notifyStore.notifications" :key="note.id"
                              @click="gotoAppointment(note.id)">
              <el-avatar></el-avatar>
              <div class="d-flex flex-column">
                <small :class="note.is_read==0?'font-bold':''">{{ note.message }}</small>
                <small :class="note.is_read==0?'font-bold':''">{{ note.created_at }}</small>
              </div>
            </el-dropdown-item>
          </el-dropdown-menu>
        </template>
        <template v-if="store.roles[0]=='hospital'" #dropdown>
          <el-dropdown-menu>
            <el-dropdown-item class="d-flex justify-content-start h-25 align-items-center gap-2"
                              v-for="note in notifyStore.notifications" :key="note.id"
                              @click="gotoAppointment(note.id)">
              <el-avatar></el-avatar>
              <div class="d-flex flex-column">
                <small :class="note.is_read==0?'font-bold':''">{{note.from}} {{ note.message }}</small>
                <small :class="note.is_read==0?'font-bold':''">{{ note.created_at }}</small>
              </div>
            </el-dropdown-item>
          </el-dropdown-menu>
        </template>
      </el-dropdown>
      <el-dropdown trigger="click" v-if="store.user!=null" class="pf-dropdown">
        <span class="el-dropdown-link">
          <el-avatar
              v-if="store.user.profile==='No profile'">{{ store.user.first_name[0] }} {{
              store.user.last_name[0]
            }}</el-avatar>
          <el-avatar v-if="store.user.profile!=='No profile'" :src="store.user.profile"></el-avatar>
        </span>
        <template #dropdown>
          <el-dropdown-menu>
            <el-dropdown-item>
              <router-link to="/profile" class="font-bold px-3 py-2 text-slate-700 nav-link rounded-lg hover:bg-slate-100 hover:text-slate-900">Profile</router-link>
            </el-dropdown-item>
            <el-dropdown-item>
              <button @click="handleLogout" class="font-bold px-3 py-2 text-slate-700 nav-link rounded-lg hover:bg-slate-100 hover:text-slate-900"
              >Log out</button>
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
              v-if="store.user.profile==='No profile'">{{ store.user.first_name[0] }} {{
              store.user.last_name[0]
            }}
          </el-avatar>
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
            to="/myHospital"
            class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
            style="text-decoration: none;"
        >Hospital
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
        </router-link>
        <router-link
            to="/calendar"
            class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Calendar
        </router-link>
      </div>
      <div class="d-flex flex-column justify-start" v-if="store.user">
        <el-dropdown v-if="store.user" trigger="click" placement="top-start"
                     class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">
          <el-badge v-if="notifyStore.notifications.length>0 " :value="notifyStore.unseenNotifications.length" :max="99"
                    class="item">
        <span class="el-dropdown-link font-bold">
          Notifications
        </span>
          </el-badge>
          <el-badge v-else
                    class="item">
          <span class="el-dropdown-link font-bold">
          Notifications
        </span>
          </el-badge>
          <template v-if="store.roles[0]=='user'" #dropdown>
            <el-card @click="gotoAppointment(note.id)" v-for="note in notifyStore.notifications" :key="note.id">
              <small :class="note.is_read==0?'font-bold':''"><span v-if="note.user">{{ note.user.first_name }}</span>
                {{ note.message }}</small>
              <small :class="note.is_read==0?'font-bold':''">{{ note.created_at }}</small>
            </el-card>
          </template>
          <template v-if="store.roles[0]=='hospital'" #dropdown>
            <el-card @click="gotoAppointment(note.id)" v-for="note in notifyStore.notifications" :key="note.id">
              <small :class="note.is_read==0?'font-bold':''"><span v-if="note.from">{{ note.from }}</span>
                {{ note.message }}</small>
              <small :class="note.is_read==0?'font-bold':''">{{ note.created_at }}</small>
            </el-card>
          </template>
          <template v-if="store.roles[0]=='doctor'" #dropdown>
            <el-card @click="gotoAppointment(note.id)" v-for="note in notifyStore.notifications" :key="note.id">
              <small :class="note.is_read==0?'font-bold':''"><span>{{ note.from }}</span> {{ note.message }}</small>
              <small :class="note.is_read==0?'font-bold':''">{{ note.created_at }}</small>
            </el-card>
          </template>
        </el-dropdown>
        <router-link to="/profile"
                     class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">
          Profile
        </router-link>
        <button @click="handleLogout" class="nav-link text-start">Log out</button>
      </div>
      <!--Landing -->
      <div class="d-flex flex-column justify-start" v-if="!store.user">
        <router-link to="/landing"
                     class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
                     style="text-decoration: none;">Home
        </router-link>
        <router-link to="/about"
                     class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
                     style="text-decoration: none;">About Us
        </router-link>
        <router-link to="" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
                     style="text-decoration: none;">Service
        </router-link>
        <router-link to="/contact"
                     class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
                     style="text-decoration: none;">Contact
        </router-link>
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

.menu-btn {
  display: none;
}

@media (min-width: 768px) and (max-width: 1023px) {
  header {
    display: flex;
    justify-content: space-between;
    padding: 10px;
  }

  nav {
    display: none;
  }

  .menu-btn {
    display: block;
  }

  .pf-dropdown {
    display: none;
  }

  .log-in {
    display: none;
  }

  .notification {
    display: none;
  }
}

@media (max-width: 767px) {
  nav {
    display: none;
  }

  .menu-btn {
    display: block;
  }

  .el-drawer {
    width: 400px;
  }

  .pf-dropdown {
    display: none;
  }

  .log-in {
    display: none;
  }

  .notification {
    display: none;
  }
}

</style>
