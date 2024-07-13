<script setup lang="ts">

</script>
<template>
  <el-footer class="md:px-20 d-flex justify-content-between align-items-center footer py-2">
    <el-col :span="4">
      <div class="d-flex flex-column align-items-start">
        <img src="@/assets/logo/care_finder-02.png" alt="" width="200px">
        <p class="text-start">Browse through our professionally designed selection. Browse through our professionally
          designed selection.</p>
      </div>
    </el-col>
    <el-col :span="4">
      <div class="d-flex flex-column align-items-start">
        <h4>Navigation</h4>
        <router-link to="/landing" class="nav-link">Home</router-link>
        <router-link to="/about" class="nav-link">About</router-link>
        <router-link to="/landing" class="nav-link">Service</router-link>
        <router-link to="/landing" class="nav-link">Contact</router-link>
      </div>
    </el-col>
    <el-col :span="4">
      <div>
        <h4 class="text-start">Address</h4>
        <div>
          <p class="text-justify">
            BP 511, Phum Tropeang Chhuk (Borey Sorla) Sangtak, Street 371, Phnom Penh
          </p>
        </div>
      </div>
    </el-col>
    <el-col :span="4">
      <div class="d-flex justify-content-between gap-lg-5 flex-column mt-2">
        <h4>Social Media</h4>
        <div class="d-flex justify-content-between mt-2">
          <el-tooltip class="box-item" effect="dark" content="LinkedIn" placement="top-start">
            <el-avatar
              shape="circle"
              :src="'https://cdn1.iconfinder.com/data/icons/logotypes/32/circle-linkedin-512.png'"
            ></el-avatar>
          </el-tooltip>
          <el-tooltip class="box-item" effect="dark" content="Gmail" placement="top-start">
            <el-avatar
              shape="circle"
              :src="'https://img.freepik.com/premium-vector/email-symbol-white-icon_1076610-15454.jpg'"
            ></el-avatar>
          </el-tooltip>
          <el-tooltip class="box-item" effect="dark" content="Instagram" placement="top-start">
            <el-avatar
              shape="circle"
              :src="'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Instagram_icon.png/1200px-Instagram_icon.png'"
            ></el-avatar>
          </el-tooltip>
          <el-tooltip class="box-item" effect="dark" content="Github" placement="top-start">
            <el-avatar
              shape="circle"
              :src="'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/GitHub_Invertocat_Logo.svg/1200px-GitHub_Invertocat_Logo.svg.png'"
              class="bg-white"
            ></el-avatar>
          </el-tooltip>
        </div>
      </div>
    </el-col>
  </el-footer>
</template>
<style scoped>

.footer {
  background-color: #ffffff;
  height: 40vh;
}

.bg-card img {
  width: 100%;
}

.el-col {
  text-align: center;
}

.w-25 img {
  width: 400px;
}
</style>