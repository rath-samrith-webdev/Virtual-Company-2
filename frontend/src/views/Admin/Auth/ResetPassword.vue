<template>
  <WebLayout>
    <div class="container">
      <form @submit.prevent="resetPassword(form)">
        <h2>Create New Password</h2>
        <div class="input-text">
          <input type="password" v-model="form.newPass" required>
          <label>New Password</label>
        </div>
        <div class="input-text">
          <input type="password" v-model="form.confirmPassword" required>
          <label>Confirm Password</label>
        </div>
        <button type="submit">Save</button>
      </form>
    </div>
  </WebLayout>
</template>
<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue';
import { onMounted, ref } from 'vue'
import { resetPasswordStore } from '@/stores/reset-password'
import { useRoute, useRouter } from 'vue-router'
import { ElNotification } from 'element-plus'
const router = useRouter()
const form=ref({
  token:'',
  newPass:'',
  confirmPassword:'',
})
const route=useRoute()
const store =resetPasswordStore()
const resetPassword=(pass)=>{
  const formData=new FormData()
  formData.append('reset_token',pass.token)
  formData.append('password',pass.newPass)
  formData.append('password_confirmation',pass.confirmPassword)
  store.resetPassword(formData)
  if (store.resetMessage.success) {
    ElNotification({
      title: 'Success',
      message: store.resetMessage.message,
      type: 'success',
    })
    router.push('/login')
  }else {
    ElNotification({
      title: 'Error',
      message: store.resetMessage.message,
      type: 'warning',
    })
    router.push('/login')
  }
}
onMounted(()=>{
  form.value.token=<string>route.query.t;
  console.log(store.token)
})
</script>

<style scoped>

body{
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    width: 100%;
    padding: 0 10px;
  }

  body::before{
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background-position: center;
    background-size: cover;
  }

  .container{
    width: 400px;
    border-radius: 10px;
    padding: 30px;
    text-align: center;
    border: 1px solid rgba(255, 255, 255,0.15);
    backdrop-filter: blur(15px);
    --webkit-backdrop-filter: blur(15px);
    background: linear-gradient(-45deg, #32B4E3, #027fb1);
  }

  form{
    display: flex;
    flex-direction: column;
  }

  h2{
    font-size: 2rem;
    margin-top: 20px;
    color: rgb(245, 245, 245);
  }
  .input-text{
    position: relative;
    border-bottom:2px solid rgb(255, 255, 255);
    margin: 15px 0;
  }
  .input-text label{
    position: absolute;
    top: 50%;
    left: 0%;
    transform: translateY(-50%);
    color: rgb(231, 231, 231);
    font-size: 15px;
    pointer-events: none;
    transition: 0.15s ease;
  }
  .input-text input{
    width: 100%;
    height: 40%;
    background: transparent;
    border: none;
    outline: none;
    font-size: 16px;
    color: #fff;
   
  }
  .input-text input:focus~label,
  .input-text input:valid~label{
    font-size: 0.8rem;
    top: 5px;
    transform: translateY(-120%);
    border-radius: 8px;
  }

  .container a{
    color: #fff;
    text-decoration: none;
  }
  .container a:hover{
    text-decoration: underline;
    color: aqua;
  }

  button{
    background: #FCB22C;
    color: rgb(0, 115, 192);
    font-weight: 700;
    border: none;
    padding: 10px 0px;
    cursor: pointer;
    border-radius:10px;
    font-size: 16px;
    border: 2px solid transparent;
    transition: 0.3s ease;
  }
  button:hover{
    color: #020101;
    background: #FCB22C;
    border-color:rgb(71, 170, 236);
  }

</style>