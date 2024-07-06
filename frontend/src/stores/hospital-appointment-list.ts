import {defineStore} from 'pinia'
import axiosInstance from '@/plugins/axios'
export const hopsitalAppointmentListStore = defineStore('appointments',{
  state:()=>({
    appointments:[],
    monthlyAppointment:[],
    message:{}
  }),
  actions:{
    async fetchAppointments(){
      try {
        const {data}= await axiosInstance.get('/appointments/list')
        this.appointments = data.data
      }catch(error){
        console.log(error)
      }
    },
    async confirmAppointment(id:number){
      try {
        const {data}= await axiosInstance.put(`/appointments/update-status/${id}`,{
          status:'Confirmed'
        })
        this.message=data
      }catch(error){
        console.log(error)
      }
    },
    async fetchMonthlyAppointment(){
      try {
        const {data}= await axiosInstance.get('/appointments/monthlyAppointments')
        this.monthlyAppointment=data.data
      }catch (e){
        console.log(e)
      }
    }
  }
})