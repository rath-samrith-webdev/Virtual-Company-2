<template>
  <div class="card-department">
    <button class="btn btn-info btn-sm  fw-bold text-white"  @click="showAddDepartmentModal">+ Add new department</button>
    <div class="group-card m-5">
      <div class="card d-flex flex-row m-5 border border-3 border-info" v-for="department in departments" :key="department.id">
        <img src="https://png.pngtree.com/png-vector/20221206/ourmid/pngtree-midwife-or-doctor-with-newborn-concept-png-image_6511706.png" alt="" width="150" height="150">
        <div class="card-body mt-3">
          <h4>{{department.name}}</h4>
          <p>{{description}}</p>
          <router-link class="btn bg-info btn-sm m-2 text-white fw-bold" @click="showUpdateModal(department.id)">Update</router-link>
          <button class="btn bg-warning btn-sm m-2 text-white fw-bold" @click="deleteDepartment(department.id)">Remove</button>
        </div>
      </div>
    </div>

    <!-- Add Department Modal -->
    <div v-if="showAddModal" class="modal">
      <div class="modal-content w-50 text-center">
        <h2>Add Department</h2>
        <form @submit.prevent="addDepartment">
          <div class="form-group p-5 d-flex flex-column">
            <label for="newDepartmentName" class="form-label fw-bold">Department Name:</label>
            <input class="form-control" type="text" id="newDepartmentName" v-model="newDepartmentName" required>
          </div>
          <button class="btn bg-warning btn-sm m-2 text-white fw-bold" @click="closeAddModal">Close</button>
          <button type="submit" class="btn bg-info btn-sm m-2 text-white fw-bold">Add department</button>
        </form>
      </div>
    </div>

    <!-- Update Department Modal -->
    <div v-if="showModal" class="modal">
      <div class="modal-content w-50 text-center">
        <h2>Update Department</h2>
        <form @submit.prevent="updateDepartment">
          <div class="form-group p-5 d-flex flex-column">
            <label for="departmentName" class="form-label fw-bold">Department Name:</label>
            <input class="form-control" type="text" id="departmentName" v-model="departmentName" required>
          </div>
          <button class="btn bg-warning btn-sm m-2 text-white fw-bold" @click="closeModal">Close</button>
          <button type="submit" class="btn bg-info btn-sm m-2 text-white fw-bold">Update</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'list-departments',
  data() {
    return {
      departments: [],
      description: "We provide all kinds of treatment from preventive care to critical treatment including diagnostic, comprehensive health screenings, as well as antenatal care and child delivery for expectant mothers.",
      showModal: false,
      showAddModal: false,
      departmentId: null,
      departmentName: '',
      newDepartmentName: ''
    };
  },
  mounted() {
    this.fetchDepartments();
  },
  methods: {
    async fetchDepartments() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/v1/departments/list', {
          headers: {
            'Authorization': 'Bearer 14|MmfZXW4qxutpL0fXrnyCJ1ENEfBx1oZ9lPfVgufl5458dcfd'
          }
        });
        this.departments = response.data.data;
      } catch (error) {
        console.error("An error occurred while fetching departments:", error);
      }
    },
    async fetchDepartmentDetails(departmentId) {
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/v1/departments/show/${departmentId}`, {
          headers: {
            'Authorization': 'Bearer 14|MmfZXW4qxutpL0fXrnyCJ1ENEfBx1oZ9lPfVgufl5458dcfd'
          }
        });
        this.departmentName = response.data.data.name;
      } catch (error) {
        console.error("An error occurred while fetching department details:", error);
      }
    },
    async deleteDepartment(departmentId) {
      try {
        const response = await axios.delete(`http://127.0.0.1:8000/api/v1/departments/delete/${departmentId}`, {
          headers: {
            'Authorization': 'Bearer 14|MmfZXW4qxutpL0fXrnyCJ1ENEfBx1oZ9lPfVgufl5458dcfd'
          }
        });
        if (response.data.success) {
          this.fetchDepartments();
        }
      } catch (error) {
        console.error("An error occurred while deleting department:", error);
      }
    },
    async addDepartment() {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/v1/departments/create', {
          name: this.newDepartmentName
        }, {
          headers: {
            'Authorization': 'Bearer 14|MmfZXW4qxutpL0fXrnyCJ1ENEfBx1oZ9lPfVgufl5458dcfd'
          }
        });
        if (response.data.success) {
          this.fetchDepartments();
          this.closeAddModal();
        }
      } catch (error) {
        console.error("An error occurred while adding department:", error);
      }
    },
    async updateDepartment() {
      try {
        const response = await axios.put(`http://127.0.0.1:8000/api/v1/departments/update/${this.departmentId}`, {
          name: this.departmentName
        }, {
          headers: {
            'Authorization': 'Bearer 14|MmfZXW4qxutpL0fXrnyCJ1ENEfBx1oZ9lPfVgufl5458dcfd'
          }
        });
        if (response.data.success) {
          this.fetchDepartments();
          this.closeModal();
        }
      } catch (error) {
        console.error("An error occurred while updating department:", error);
      }
    },
    showAddDepartmentModal() {
      this.showAddModal = true;
    },
    closeAddModal() {
      this.showAddModal = false;
      this.newDepartmentName = '';
    },
    showUpdateModal(departmentId) {
      this.departmentId = departmentId;
      this.fetchDepartmentDetails(departmentId);
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
      this.departmentId = null;
      this.departmentName = '';
    }
  }
};
</script>

<style scoped>
button {
  margin-left: 80%;
  margin-top: 30px;
}
.modal {
  display: block;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0, 0, 0);
  background-color: rgba(0, 0, 0, 0.4);
}
.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}
.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>
