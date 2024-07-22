<template>
  <WebLayout>
    <el-button class="mt-4" style="width: 20%" plain @click="centerDialogVisible = true">
      Add Item
    </el-button>
    <el-table :data="store.promotions" style="width: 100%" max-height="250">
      <el-table-column prop="image" label="Image" width="120">
        <template #default="scope">
          <el-image :src="scope.row.image" fit="cover" :preview-src-list="imageUrl"/>
        </template>
      </el-table-column>
      <el-table-column prop="title" label="Title" width="120" />
      <el-table-column prop="start_date" label="Start Date" width="150" />
      <el-table-column prop="end_date" label="End Date" width="120" />
      <el-table-column prop="address" label="Address" width="600" />
      <el-table-column prop="zip" label="Zip" width="120" />
      <el-table-column fixed="right" label="Operations" min-width="120">
        <template #default="scope">
          <el-button type="primary" size="small" @click="deleteRow(scope.$index,scope.row.id)">
            Remove
          </el-button>
        </template>
      </el-table-column>
    </el-table>
    <el-dialog v-model="centerDialogVisible" width="400" center>
      <div class="image-pro">
        <img
          :src="
            imageUrl || 'https://t4.ftcdn.net/jpg/01/64/16/59/360_F_164165971_ELxPPwdwHYEhg4vZ3F4Ej7OmZVzqq4Ov.jpg'
          "
          alt=""
          width="100%"
          height="250vh"
          @click="triggerFileInput"
        />
        <input type="file" ref="fileInput" style="display: none" @change="onFileChange" />
      </div>
      <div>
        <div class="mt-4">
          <p>Title</p>
          <el-input v-model="form.title" placeholder="Please input" clearable />
        </div>
        <div class="mt-4">
          <p>Description</p>
          <el-input v-model="form.description" placeholder="Please input" clearable />
        </div>
        <div class="date">
          <div class="date-start mt-4">
            <p>Start date</p>
            <el-col :span="11">
              <el-date-picker
                v-model="form.start_date"
                type="date"
                placeholder="Pick a date"
                style="width: 180px"
                value-format="YYYY-MM-DD"
              />
            </el-col>
          </div>
          <div class="date-end mt-4">
            <p>End date</p>
            <el-col :span="11">
              <el-date-picker
                v-model="form.end_date"
                type="date"
                placeholder="Pick a date"
                style="width: 170px"
                value-format="YYYY-MM-DD"
              />
            </el-col>
          </div>
        </div>
      </div>
      <template #footer>
        <div class="dialog-footer">
          <el-button @click="centerDialogVisible = false">Cancel</el-button>
          <el-button type="primary" @click="onAddItem">Upload</el-button>
        </div>
      </template>
    </el-dialog>
  </WebLayout>
</template>

<script lang="ts" setup>
import {onMounted, ref} from 'vue'
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import {promotionStore} from "@/stores/promotion-store";

const centerDialogVisible = ref(false)
const fileInput = ref(null)
const imageUrl=ref('')
const form=ref({
  title:'',
  description:'',
  start_date:'',
  end_date:'',
  image:''
})
const store = promotionStore()
const deleteRow = (index: number,id:any) => {
  store.deletePromotion(id)
  store.promotions.splice(index, 1)
}

const onAddItem = () => {
  store.addPromotion(form.value)
  store.fetchPromotions()
  centerDialogVisible.value = false
  form.value.title = ''
  form.value.description = ''
  form.value.start_date = ''
  form.value.end_date = ''
  form.value.image = ''
  imageUrl.value = ''
}

const triggerFileInput = () => {
  fileInput.value.click()
}
onMounted(()=>{
  store.fetchPromotions()
})

const onFileChange = (event: Event) => {
  const file = (event.target as HTMLInputElement).files?.[0]
  form.value.image=file
  if (file) {
    const reader = new FileReader()
    reader.onload = (e) => {
      imageUrl.value = e.target?.result as string
    }
    reader.readAsDataURL(file)
  }
}
</script>

<style scoped>
.mt-4 {
  margin-top: 16px;
}
.date {
  display: flex;
  flex-direction: row;
  gap: 16px;
}
.date .date-start,
.date .date-end {
  width: 50%;
}
.image-pro img {
  margin-top: 10px;
  cursor: pointer;
 
}
</style>
