import {defineStore} from "pinia";
import axiosInstance from "@/plugins/axios";

export const promotionStore = defineStore("promotion-store", {
    state: () => (
        {
            promotions: []
        }
    ),
    actions:{
        async fetchPromotions()
        {
            try {
                const {data}=await axiosInstance.get('/hospitals/promotions/list')
                this.promotions = data.data
                console.log(data)
            }catch (error){
                console.log(error)
            }
        },
        async addPromotion(promotion:any){
            try{
                const {data}=await axiosInstance.post('/hospitals/promotions/create',promotion)
                console.log(data)
            }catch (error){
                console.log(error)
            }
        },
        async deletePromotion(id:any){
            try{
                const {data}=await axiosInstance.delete(`/hospitals/promotions/delete/${id}`)
                console.log(data)
            }catch (error){
                console.log(error)
            }
        },
        async updatePromotion(id:any, promotion:any){
            try {
                const {data}=await axiosInstance.put(`/hospitals/promotions/update/${id}`,promotion)
                console.log(data)
            }catch (error){
                console.log(error)
            }
        }
    }
})