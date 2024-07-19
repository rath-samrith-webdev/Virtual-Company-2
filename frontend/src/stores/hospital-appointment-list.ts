import { defineStore } from 'pinia'
import axiosInstance from '@/plugins/axios'
export const hospitalAppointmentListStore = defineStore('appointments', {
  state: () => ({
    appointments: [],
    calendars:[],
    monthlyAppointment: [],
    appointmentSummary: {},
    message: {}
  }),
  actions: {
    async fetchAppointments() {
      try {
        const { data } = await axiosInstance.get('/appointments/list')
        this.appointments = data.data
        console.log(data)
      } catch (error) {
        console.log(error)
      }
    },
    async confirmAppointment(id: any) {
      const formData = new FormData()
      formData.append('status', 'Confirmed')
      try {
        const { data } = await axiosInstance.put(`/appointments/update-status/${id}`, formData)
        this.message = data
        this.message=data
      } catch (error) {
        console.log(error)
      }
    },
    async fetchMonthlyAppointment() {
      try {
        const { data } = await axiosInstance.get('/appointments/monthlyAppointments')
        this.monthlyAppointment = data.data
        localStorage.setItem('appointments', JSON.stringify(this.monthlyAppointment))
      } catch (e) {
        console.log(e)
      }
    },
    async fetchAppointmentSummary() {
      try {
        const response = await axiosInstance.get('/appointments/summary')
        console.log(response)
        if (response.data.success) {
          this.appointmentSummary = response.data.data
        } else {
          console.error('Failed to fetch appointments for today')
        }
      } catch (error) {
        console.error('Error fetching appointments for today:', error)
      }
    },
    async cancelAppointment(id: any) {
      const formData = new FormData()
      formData.append('status', 'Canceled')
      try {
        const { data } = await axiosInstance.put(`/appointments/cancel/${id}`, formData)
        this.message = data
        console.log(data)
      } catch (error) {
        console.log(error)
      }
    },
    async fetchCalendarData(){
      try {
        const {data} = await axiosInstance.get('/appointments/calendar')
        this.calendars = data.data
        sessionStorage.setItem('calendarData', JSON.stringify(data.data))
      }catch (error){
        console.log(error)
      }
    },
    calendarData(){
      return JSON.parse(sessionStorage.getItem('calendarData'))
    }
  }
})
