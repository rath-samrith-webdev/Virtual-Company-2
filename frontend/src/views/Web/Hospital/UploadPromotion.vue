<template>
  <WebLayout>
    <el-button class="mt-4" style="width: 20%" plain @click="centerDialogVisible = true">
      Add Item
    </el-button>
    <el-table :data="tableData" style="width: 100%" max-height="250">
      <el-table-column fixed prop="date" label="Date" width="150" />
      <el-table-column prop="name" label="Name" width="120" />
      <el-table-column prop="state" label="State" width="120" />
      <el-table-column prop="city" label="City" width="120" />
      <el-table-column prop="address" label="Address" width="600" />
      <el-table-column prop="zip" label="Zip" width="120" />
      <el-table-column fixed="right" label="Operations" min-width="120">
        <template #default="scope">
          <el-button type="primary" size="small" @click="deleteRow(scope.$index)">
            Remove
          </el-button>
        </template>
      </el-table-column>
    </el-table>
    <el-dialog v-model="centerDialogVisible" width="400" center>
      <div class="image-pro">
        <img
          src="https://i.pinimg.com/564x/ce/08/60/ce0860643f75ab5410f57518799a7a88.jpg"
          alt=""
          width="100%"
        />
      </div>
      <div>
        <div class="mt-4">
          <p>Title</p>
          <el-input v-model="title" placeholder="Please input" clearable />
        </div>
        <div class="mt-4">
          <p>Description</p>
          <el-input v-model="description" placeholder="Please input" clearable />
        </div>
        <div class="date">
          <div class="date-start mt-4">
            <p>Start date</p>
            <el-col :span="11">
              <el-date-picker
                v-model="startDate"
                type="date"
                placeholder="Pick a date"
                style="width: 180px"
              />
            </el-col>
          </div>
          <div class="date-end mt-4">
            <p>End date</p>
            <el-col :span="11">
              <el-date-picker
                v-model="endDate"
                type="date"
                placeholder="Pick a date"
                style="width: 170px"
              />
            </el-col>
          </div>
        </div>
      </div>
      <template #footer>
        <div class="dialog-footer">
          <el-button @click="centerDialogVisible = false">Cancel</el-button>
          <el-button type="primary" @click="onAddItem">Confirm</el-button>
        </div>
      </template>
    </el-dialog>
  </WebLayout>
</template>

<script lang="ts" setup>
import { ref, reactive } from 'vue'
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import dayjs from 'dayjs'

const centerDialogVisible = ref(false)
const title = ref('')
const description = ref('')
const startDate = ref('')
const endDate = ref('')

const tableData = ref([
  {
    date: '2016-05-01',
    name: 'Tom',
    state: 'California',
    city: 'Los Angeles',
    address: 'No. 189, Grove St, Los Angeles',
    zip: 'CA 90036'
  },
  {
    date: '2016-05-02',
    name: 'Tom',
    state: 'California',
    city: 'Los Angeles',
    address: 'No. 189, Grove St, Los Angeles',
    zip: 'CA 90036'
  },
  {
    date: '2016-05-03',
    name: 'Tom',
    state: 'California',
    city: 'Los Angeles',
    address: 'No. 189, Grove St, Los Angeles',
    zip: 'CA 90036'
  }
])

const deleteRow = (index: number) => {
  tableData.value.splice(index, 1)
}

const onAddItem = () => {
  tableData.value.push({
    date: dayjs(startDate.value).format('YYYY-MM-DD'),
    name: title.value,
    state: 'California',
    city: 'Los Angeles',
    address: description.value,
    zip: 'CA 90036'
  })
  centerDialogVisible.value = false
  title.value = ''
  description.value = ''
  startDate.value = ''
  endDate.value = ''
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
.image-pro img{
  margin-top: 10px;
}
</style>
