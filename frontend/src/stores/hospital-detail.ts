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
        this.hospitalDetail = data.data
        console.log(data)
      } catch (err) {
        console.log(err)
      }
    },
    async submitFeedback(feedback: { hospital_id:any ,content:any ,user_id:string ,star:string}) {
      try {
        const { data } = await axiosInstance.post(`/feedbacks/create`, feedback)
        this.hospitalDetail.feedbacks.push(feedback)
        console.log(data)
      }catch (error){
        console.log(error)
      }
    }
  }
})
