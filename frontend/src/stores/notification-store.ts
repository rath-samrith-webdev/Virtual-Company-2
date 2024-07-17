import {defineStore} from "pinia";
import axiosInstance from "@/plugins/axios";
export const NotificationStore = defineStore("NotificationStore", {
    state:()=> ({
        message:{},
        notifications:[]
    }),
    actions:{
        async fetchNotification() {
            try {
                const {data}=await axiosInstance.delete(`notifications/list`)
                console.log(data)
            }catch(error){
                console.log(error)
            }
        }
    }
})