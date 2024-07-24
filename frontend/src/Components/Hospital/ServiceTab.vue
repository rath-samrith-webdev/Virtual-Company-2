<template>
  <div class="add-service-container">
    <el-button plain @click="showAddServiceDialog" class="add-service-button">
      Add Service
    </el-button>

    <el-dialog
        v-model="centerDialogVisible"
        :title="formTitle"
        width="500px"
        class="add-service-dialog"
        center
    >
      <div class="dialog-content">
        <div class="image-container">
          <img
              :src="imageUrl || 'https://via.placeholder.com/100'"
              alt="Service Image"
              class="service-image"
              style="width: 100%; height: 50vh"
          />
          <input class="input" type="file" @change="handleFileChange"/>
          <input type="file" ref="fileInput" @change="handleFileChange" style="display: none"/>
        </div>
        <el-input
            v-model="newServiceTitle"
            placeholder="Service Title"
            class="service-title-input"
        />
      </div>
      <template #footer>
        <div class="dialog-footer">
          <el-button @click="editVisible = false" class="cancel-button">Cancel</el-button>
          <el-button type="primary" @click="saveService" class="confirm-button">
            Confirm
          </el-button>
        </div>
      </template>
    </el-dialog>
  </div>
  <div class="equal-height">
    <div class="items" v-for="service in services" :key="service.id">
      <img :src="service.image" alt=""/>
      <h6>{{ service.name }}</h6>
      <div>
        <el-button type="danger" @click="removeService(service.id)">Delete</el-button>
        <el-button type="primary" @click="showEditServiceDialog(service)">Edit</el-button>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import axiosInstance from '@/plugins/axios'
import {defineComponent, ref, onMounted} from 'vue'
import {ElNotification} from "element-plus";

export default defineComponent({
  setup(_, {emit}) {
    const centerDialogVisible = ref(false)
    const newServiceTitle = ref('')
    const services = ref<any[]>([])
    const newServiceImage = ref<File | null>(null)
    const imageUrl = ref<string | null>(null)
    const isEditing = ref(false)
    const currentServiceId = ref<number | null>(null)
    const formTitle = ref('Add Service')

    // Fetch services
    async function fetchServices() {
      try {
        const response = await axiosInstance.get('/hospitals/services/list')
        services.value = response.data.data
      } catch (error) {
        console.error('Failed to fetch services:', error)
      }
    }

    const open2 = (title: string, message: any, type: string) => {
      ElNotification({
        title: title,
        message: message,
        type: type
      })
    }
    // Handle file change
    const handleFileChange = (event: Event) => {
      const target = event.target as HTMLInputElement
      if (target.files && target.files.length > 0) {
        newServiceImage.value = target.files[0]
        imageUrl.value = URL.createObjectURL(newServiceImage.value)
      }
    }

    // Add service
    const addService = async () => {
      try {
        const {data} = await axiosInstance.post('/hospitals/services/create', {
          name: newServiceTitle.value,
          image: newServiceImage.value,
        })
        services.value.push(data.data)
        await fetchServices()
        resetForm()
      } catch (error) {
        console.error('Failed to add service:', error)
      }
    }
    // Edit service
    const editService = async () => {
      try {
        const {data} = await axiosInstance.post(`/hospitals/services/update/${currentServiceId.value}`, {
          name: newServiceTitle.value,
          image: newServiceImage.value,
        })
        const index = services.value.findIndex((service) => service.id === currentServiceId.value)
        if (index !== -1) {
          services.value[index] = {...services.value[index], ...data.data}
          services.value = [...services.value] // Ensure reactivity
        }
        resetForm()
        open2('services', data.message, 'success') // Display success message
      } catch
          (error) {
        console.error('Failed to update service:', error)
        open2('service', 'Failed to update service', 'warning') // Display error message
      }
    }

    const saveService = () => {
      if (isEditing.value) {
        editService()
      } else {
        addService()
      }
    }

    const showEditServiceDialog = (service: any) => {
      isEditing.value = true
      formTitle.value = 'Edit Service'
      centerDialogVisible.value = true
      newServiceTitle.value = service.name
      imageUrl.value = service.image
      currentServiceId.value = service.id
      newServiceImage.value = null // Reset the image file to allow user to upload a new one
    }

// Remove service
    const removeService = async (id: number) => {
      try {
        const response = await axiosInstance.delete(`/hospitals/services/delete/${id}`)
        if (response.data.success) {
          services.value = services.value.filter((service) => service.id !== id)
          emit('remove', id)
        } else {
          console.error('Failed to delete service:', response.data.message)
        }
      } catch (error) {
        console.error('Error removing service:', error)
      }
    }

// Show add service dialog
    const showAddServiceDialog = () => {
      resetForm()
      formTitle.value = 'Add Service'
      centerDialogVisible.value = true
      isEditing.value = false
    }

// Reset form
    const resetForm = () => {
      newServiceTitle.value = ''
      newServiceImage.value = null
      imageUrl.value = null
      currentServiceId.value = null
      centerDialogVisible.value = false
    }

// Fetch services on component mount
    onMounted(() => {
      fetchServices()
    })

    return {
      centerDialogVisible,
      newServiceTitle,
      newServiceImage,
      imageUrl,
      services,
      removeService,
      handleFileChange,
      saveService,
      showAddServiceDialog,
      showEditServiceDialog,
      formTitle
    }
  }
})
</script>

<style scoped>
.add-service-container {
  display: flex;
  justify-content: flex-end;
  margin-bottom: 20px;
}

.add-service-button {
  background-color: #409eff;
  color: white;
  border-color: #409eff;
}

.add-service-dialog {
  background-color: #f2f2f2;
}

.dialog-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
}

.image-container {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.service-image {
  width: 100%;
  object-fit: cover;
}

.image-container .service-image img {
  width: 100%;
  object-fit: cover;
}

.select-image-button {
  margin-top: 10px;
}

.service-title-input {
  flex-grow: 1;
}

.dialog-footer {
  justify-content: flex-end;
  gap: 10px;
}

.cancel-button {
  background-color: #f2f2f2;
  color: #606266;
  border-color: #dcdfe6;
}

.confirm-button {
  background-color: #409eff;
  color: white;
  border-color: #409eff;
}

.image-service {
  background: #409eff;
  display: flex;
}

.equal-height {
  display: flex;
  flex-wrap: wrap;
  flex-direction: row;
}

.items {
  width: 15%;
  margin: 10px;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
  box-shadow: 0 2px 5px rgba(192, 177, 252, 0.556);
}

.items img {
  width: 100%;
  height: 70%;
  object-fit: cover;
}
</style>
