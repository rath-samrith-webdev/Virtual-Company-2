import { defineStore } from 'pinia';
import axiosInstance from '@/plugins/axios';

export const useDoctorStore = defineStore('doctorStore', {
  state: () => ({
    doctors: [],
  }),
  actions: {
    async fetchDoctors() {
      try {
        const { data } = await axiosInstance.get('/doctors/list');
        console.log(data);
        this.doctors = data.data;
      } catch (e) {
        console.log(e);
      }
    },
    async deleteDoctor(doctorId:any) {
      try {
        const { data } = await axiosInstance.delete(`/doctors/delete/${doctorId}`);
        console.log(data.data);
        
      } catch (e) {
        console.error(e);
      }
    },
    async updateDoctor(doctorId: any, updatedData: { name: string; email: string; profile: File }) {
      try {
        const formData = new FormData();
        formData.append('name', updatedData.name);
        formData.append('email', updatedData.email);
        // formData.append('profile', updatedData.profile);

        const { data } = await axiosInstance.put(`/doctors/update/${doctorId}`, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });

        console.log(data.data);
      } catch (e) {
        console.error(e);
      }
    },
  },
});