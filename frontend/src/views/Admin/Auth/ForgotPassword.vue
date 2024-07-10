<template>
  <WebLayout>
    <div class="container">
      <form @submit.prevent="forgotPassword">
        <h2>Forgot Password</h2>
        <div class="input-text">
          <input type="email" v-model="forgotPasswordEmail" required>
          <label>Enter Your Email</label>
        </div>
        <button type="submit">Send Email</button>
        <div class="register">
          <p>Don't have an account? <router-link to="/login">Register</router-link></p>
        </div>
      </form>
    </div>
  </WebLayout>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import WebLayout from '@/Components/Layouts/WebLayout.vue';
import { resetPasswordStore } from '@/stores/reset-password';
import { ElNotification } from 'element-plus'
const forgotPasswordEmail = ref('');
const store = resetPasswordStore();

async function forgotPassword() {
  try {
    await store.sentRequest(forgotPasswordEmail.value);
    if (store.message.success) {
      ElNotification({
        title: 'Success',
        message: store.message.message,
        type: 'success',
      })
    }else {
      ElNotification({
        title: 'Error',
        message: store.message.message,
        type: 'warning',
      })
    }
  } catch (error) {
    // Handle error
    console.error(error);
  }
}
</script>


  <style scoped>
  .message {
    margin-top: 1rem;
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
  }
  
  .success {
    background-color: #d4edda;
    color: #155724;
  }
  
  .error {
    background-color: #f8d7da;
    color: #721c24;
  }



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

  .register{
    text-align: center;
    margin-top: 30px;
    color: #fff;
  }

  </style>