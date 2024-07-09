import { defineStore } from 'pinia'
import axiosInstance from '@/plugins/axios'
import { log10 } from 'chart.js/helpers'

export const FeedbackList = defineStore('feedback-list', {
  state:()=>( {
      allFeedback:[],
      recentFeedbacks:[]
  }),
  actions:{
    async fetchFeedback(){
      try {
        const { data }=await axiosInstance.get('feedbacks/list')
        this.allFeedback=data.data
      }catch(error){
        console.log(error)
      }
    },
    async deleteFeedback(id:number){
      try {
        const response=await axiosInstance.delete(`/feedbacks/delete/${id}`)
        console.log(response)
      }catch(error){
        console.log(error)
      }
    },
    async fetchRecentFeedbacks(){
      try {
        const { data }=await axiosInstance.get('feedbacks/recent')
        this.recentFeedbacks=data.data
      }catch(error){
        console.log(error)
      }
    }
  }
})