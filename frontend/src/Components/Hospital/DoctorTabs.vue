<script lang="ts">
import { defineComponent, ref } from 'vue'

export default defineComponent({
  props: {
    doctor: {
      type: Object,
      required: true
    },
    isEdit: {
      type: Boolean,
      required: true
    },
    editData:{
      type: Object,
      required: true
    }
  },
  emits: ['update', 'remove','updateDoctor']
})
</script>

<template>
    <div class="card-doctor">
      <div class="">
        <img v-if="doctor.profile!=='No profile'" shape="square" :size="280" :src="doctor.profile" />
        <el-avatar v-else style="margin-top:45px; margin-bottom: 35px;" shape="square" :size="200" src="https://cube.elemecdn.com/9/c2/f0ee8a3c7c9638a54940382568c9dpng.png" />
      </div>
      <div class="card-body mt-3">
      <h4>{{ doctor.name }}</h4>
      <p>{{ doctor.email }}</p>
      <button type="button" class="btn btn-info m-3 text-light fw-bolder " @click="$emit('update')">Update</button>
      <button type="button" class="btn btn-warning m-3 text-light fw-bolder" @click="$emit('remove')">Remove</button>
    </div>
  <!-- form update -->
  <el-dialog v-model="isEdit" title="Edit Doctor" width="800">
      <el-form :model="editData" label-position="top" label-width="120px">
        <div class="flex">
          <el-col :span="11">
            <el-form-item label="First name">
              <el-input v-model="editData.first_name" style="width: 100%" />
            </el-form-item>
          </el-col>
          <el-col :span="2" class="text-center">
            <span class="text-gray-500">-</span>
          </el-col>
          <el-col :span="11">
            <el-form-item label="Last name">
              <el-input v-model="editData.last_name" style="width: 100%" />
            </el-form-item>
          </el-col>
        </div>
        <el-form-item label="Name">
          <el-input v-model="editData.name" />
        </el-form-item>
        <el-form-item label="Gender">
          <el-select v-model="editData.gender" placeholder="Select Gender">
            <el-option label="Male" value="Male"></el-option>
            <el-option label="Female" value="Female"></el-option>
            <el-option label="Other" value="Other"></el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="Email">
          <el-input v-model="editData.email" />
        </el-form-item>
        <el-form-item label="Password">
          <el-input v-model="editData.password" />
        </el-form-item>
        <el-form-item label="Phone Number">
          <el-input v-model="editData.phone" />
        </el-form-item>
      </el-form>
      <el-button type="primary" @click="$emit('updateDoctor')">Update</el-button>
    </el-dialog>
  </div>
</template>

<style scoped>
.card-doctor {
  width: 20%;
  display: flex;
  flex-direction: column;
  margin: 35px;
  text-align: center;
  border: 5px solid #32b4e3;
  border-radius: 50px 0px 50px 0px;
}

img {
  width: 100%;
  height: auto;
  border-radius: 45px 0px 0px 0px;
}

</style>