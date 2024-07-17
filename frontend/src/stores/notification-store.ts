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
                const {data}=await axiosInstance.get(`notifications/list`)
                console.log(data)
            }catch(error){
                console.log(error)
            }
        },
        async fetchUnseenNotifications() {
            try {
                const {data}=await axiosInstance.get(`notifications/unseen`)
                console.log(data)
            }catch(error){
                console.log(error)
            }
        },
        async markAsSeen(){
            try {
                const {data}=await axiosInstance.put(`notifications/markAsSeen`)
                console.log(data)
            }catch (error){
                console.log(error)
            }
        }
    }
})