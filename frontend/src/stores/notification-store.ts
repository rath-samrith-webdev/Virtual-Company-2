import {defineStore} from "pinia";
import axiosInstance from "@/plugins/axios";
export const NotificationStore = defineStore("NotificationStore", {
    state:()=> ({
        message:{},
        notifications:[],
        unseenNotifications:[]
    }),
    actions:{
        async fetchNotification() {
            try {
                const {data}=await axiosInstance.get(`appointment-notify/list`)
                this.notifications=data.data
            }catch(error){
                console.log(error)
            }
        },
        async fetchUnseenNotifications() {
            try {
                const {data}=await axiosInstance.get(`appointment-notify/unseen`)
                this.unseenNotifications=data.data
            }catch(error){
                console.log(error)
            }
        },
        async markAsSeen(id:any){
            const formData=new FormData()
            formData.append('read', 'true')
            try {
                const {data}=await axiosInstance.put(`appointment-notify/markAsSeen${id}`,formData)
                console.log(data)
            }catch (error){
                console.log(error)
            }
        }
    }
})