import axiosInstance from '@/plugins/axios'
import { defineStore } from 'pinia'
export const hospitalDetailStore = defineStore('hospitalDetail', {
  state: () => ({
    id: null,
    hospitalDetail: {}
  }),
  actions: {
    async fetchHospitalDetail(id: any) {
      try {
        const { data } = await axiosInstance.get(`/hospitals/show/${id}`)
        console.log(data)
      } catch (err) {
        console.log(err)
      }
    }
  }
})
