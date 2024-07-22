import axiosInstance from '@/plugins/axios'
import { defineStore } from 'pinia'
export const hospitalDetailStore = defineStore('hospitalDetail', {
  state: () => ({
    id: null,
    hospitalDetail: {},
    appointment:[]
  }),
  actions: {
    async fetchHospitalDetail(id: any) {
      try {
        const { data } = await axiosInstance.get(`/hospitals/show/${id}`)
        this.hospitalDetail = data.data
        this.appointment=data.data.appointment
        console.log(data.data)
      } catch (err) {
        console.log(err)
      }
    },
    async submitFeedback(feedback: { hospital_id:any ,content:any ,user_id:string ,star:string}) {
      try {
        const { data } = await axiosInstance.post(`/feedbacks/create`, feedback)
        console.log(data)
      }catch (error){
        console.log(error)
      }
    }
  }
})
