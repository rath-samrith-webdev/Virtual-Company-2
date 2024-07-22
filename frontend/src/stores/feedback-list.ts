import { defineStore } from 'pinia'
import axiosInstance from '@/plugins/axios'

export const FeedbackList = defineStore('feedback-list', {
  state: () => ({
    allFeedback: [],
    recentFeedbacks: [],
    monthlyFeedbacks: [],
    feedbackDetails:{}
  }),
  actions: {
    async fetchFeedback() {
      try {
        const { data } = await axiosInstance.get('feedbacks/list')
        this.allFeedback = data.data
      } catch (error) {
        console.log(error)
      }
    },
    async deleteFeedback(id: number) {
      try {
        const response = await axiosInstance.delete(`/feedbacks/delete/${id}`)
        console.log(response)
      } catch (error) {
        console.log(error)
      }
    },
    async fetchRecentFeedbacks() {
      try {
        const { data } = await axiosInstance.get('feedbacks/recent')
        this.recentFeedbacks = data.data
      } catch (error) {
        console.log(error)
      }
    },
    async fetchMonthlyFeedbacks() {
      try {
        const { data } = await axiosInstance.get('feedbacks/monthly')
        this.monthlyFeedbacks = data.data
        localStorage.setItem('monthlyFeedbacks', JSON.stringify(this.monthlyFeedbacks))
      } catch (error) {
        console.log(error)
      }
    },
    async showFeedback(id: number) {
      try {
        const {data}=await axiosInstance.get(`/feedbacks/show/${id}`)
        this.feedbackDetails=data.data
      }catch (e){
        console.log(e)
      }
    }
  }
})