import axiosInstance from '@/plugins/axios'
import { defineStore } from 'pinia'
export const resetPasswordStore = defineStore('resetPassword',{
    state:()=> ({
        token:'',
        message:{},
        resetMessage:{}
    }),
    actions:{
        async sentRequest(email: string){
            try{
                const {data}=await axiosInstance.post('/forget-password',{
                    email: email
                })
                this.message=data
                this.token=data.reset_token;
            }catch(err){
                console.log(err);
            }
        },
        async resetPassword(formData:any){
            try{
                const data = await axiosInstance.post('/reset-password',formData);
                this.resetMessage=data.data
            }catch(err){
                console.log(err);
            }
        }
    }
})