import axiosInstance from '@/plugins/axios'
import { data } from '@maptiler/sdk'
import { defineStore } from 'pinia'
export const resetPasswordStore = defineStore('resetPassword',{
    state:()=> ({
        token:''
    }),
    actions:{
        async sentRequest(email: string){
            try{
                const {data}=await axiosInstance.post('/forget-password',{
                    email: email
                })
                console.log(data);
                this.token=data.reset_token;
            }catch(err){
                console.log(err);
                
            }
        },
        async resetPassword(password:string,password_confirmation:string){
            const formData={
                token:this.token,
                password:password,
                password_confirmation:password_confirmation
            }
            try{
                const data = await axiosInstance.post('/reset-password',formData);
                console.log(data);
                
            }catch(err){
                console.log(err);   
            }
        }
    }
})