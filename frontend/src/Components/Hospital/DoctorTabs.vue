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
      <button type="button" class="btn btn-info m-3" @click="$emit('update')">Update</button>
      <button type="button" class="btn btn-warning m-3" @click="$emit('remove')">Remove</button>
    </div>
    <el-dialog v-model="isEdit" title="Update Doctor" width="800">
      <el-form label-position="top">
        <el-form-item label="Doctor Name">
          <el-input v-model="editData.first_name" type="text" />
        </el-form-item>
        <el-form-item label="Doctor Email">
          <el-input v-model="editData.email" type="email" />
        </el-form-item>
        <el-form-item label="Doctor Image">
          <el-upload
            style="width: 100%"
            class="upload-demo"
            drag
            accept="image/*"
            @change="handlePictureCardPreview"
          >
            <el-icon class="el-icon--upload"><upload-filled /></el-icon>
            <div class="el-upload__text">
              Drop file here or <em>click to upload</em>
            </div>
            <template #tip>
              <div class="el-upload__tip">
                jpg/png files with a size less than 500kb
              </div>
            </template>
          </el-upload>
        </el-form-item>
        <el-button @click="$emit('updateDoctor')">Submit</el-button>
      </el-form>
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