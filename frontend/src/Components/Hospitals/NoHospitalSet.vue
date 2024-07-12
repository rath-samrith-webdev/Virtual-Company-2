<script lang="ts">
import { defineComponent } from 'vue'
</script>

<template>
  <div class="not-found-page">
    <el-container>
      <!-- Header -->
      <el-header>
        <h1>Hospital Not yet Set</h1>
      </el-header>

      <!-- Main content area -->
      <el-main>
        <el-card class="content-card">
          <h2>Oops! It looks like you have not set up your hospital yet.</h2>
          <p>Please Set up one and let the every one knows you</p>
          <p>Please click here to set up</p>
          <el-button type="primary" @click="goHome">Set Up hospital</el-button>
        </el-card>
      </el-main>
    </el-container>
  </div>
</template>

<style scoped>
.not-found-page {
  margin: 20px;
  text-align: center;
}

.content-card {
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
}
</style>