<script setup lang="ts">
import {onMounted, watch} from 'vue'
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import {Lock, Message, UserFilled} from '@element-plus/icons-vue/global'
import axiosInstance from '@/plugins/axios'
import {useRouter} from 'vue-router'


const router = useRouter()

const loginCredential: { email: string; password: string } = {
  email: '',
  password: ''
}
const registerCredential: {
  first_name: string
  last_name: string
  name: string
  email: string
  user_type: string
  password: string
  password_confirmation: string
} = {
  first_name: '',
  last_name: '',
  name: '',
  email: '',
  password: '',
  user_type: '',
  password_confirmation: ''
}

onMounted(() => {
  {
    const sign_in_btn = document.querySelector('#sign-in-btn')
    const sign_up_btn = document.querySelector('#sign-up-btn')
    const container = document.querySelector('.container')
    const sign_in_btn2 = document.querySelector('#sign-in-btn2')
    const sign_up_btn2 = document.querySelector('#sign-up-btn2')
    sign_up_btn.addEventListener('click', () => {
      container.classList.add('sign-up-mode')
    })
    sign_in_btn.addEventListener('click', () => {
      container.classList.remove('sign-up-mode')
    })
    sign_up_btn2.addEventListener('click', () => {
      container.classList.add('sign-up-mode2')
    })
    sign_in_btn2.addEventListener('click', () => {
      container.classList.remove('sign-up-mode2')
    })
  }
})

async function LogIn() {
  try {
    const {data} = await axiosInstance.post('/login', loginCredential)
    localStorage.setItem('access_token', data.access_token)
    if (data.role == 'hospital') {
      await router.push('/hospital/dashboard')
    } else if (data.role == 'admin') {
      await router.push('/admin/dashboard')
    } else if (data.role == 'doctor') {
      await router.push('/doctor/dashboard')
    } else {
      await router.push('/')
    }
  } catch (error) {
    console.log(error)
    location.reload()
  }
}

async function Register() {
  try {
    const {data} = await axiosInstance.post('/register', registerCredential)
    if (data.success) {
      location.reload()
    }
    console.log(data)
  } catch (error) {
    console.log(error)
    await router.push('/login')
  }
}
</script>
<template>
  <WebLayout>
    <div class="container">
      <div class="signin-signup">
        <!--Login Form-->
        <form action="" @submit.prevent="LogIn" class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <input type="email" v-model="loginCredential.email" required/>
            <label>
              <el-icon :size="15">
                <UserFilled/>
              </el-icon>
              Your Email</label
            >
          </div>
          <div class="input-field">
            <input type="password" v-model="loginCredential.password" required/>
            <label>
              <el-icon :size="15">
                <Lock/>
              </el-icon>
              Your Password</label
            >
          </div>
          <p class="forgot-password text-right">
            <router-link to="/forgot-password">Forgot Password</router-link>
          </p>

          <p class="social-text">Or Sign in with social platform</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <el-tooltip content="LinkedIn" placement="top-start" effect="dark">
                <el-avatar><img src="@/assets/image/linkeding.png"/></el-avatar>
              </el-tooltip>
            </a>
            <a href="" class="social-icon">
              <el-tooltip content="Facebook" placement="top-start" effect="dark">
                <el-avatar><img src="@/assets/image/fb_logo.jpg"/></el-avatar>
              </el-tooltip>
            </a>
            <a href="" class="social-icon">
              <el-tooltip content="X" placement="top-start" effect="dark">
                <el-avatar><img src="@/assets/image/x-logo.webp"/></el-avatar>
              </el-tooltip>
            </a>
            <a href="" class="social-icon">
              <el-tooltip content="Google" placement="top-start" effect="dark">
                <el-avatar><img src="@/assets/image/google.png"/></el-avatar>
              </el-tooltip>
            </a>
          </div>
          <div class="main-btn">
            <button type="submit" class="btn">Log in</button>
          </div>

          <p class="account-text">
            Don't have an account? <a href="#" id="sign-up-btn2">Sign up</a>
          </p>
        </form>
        <!--Sign Up Form-->
        <form action="" @submit.prevent="Register" class="sign-up-form">
          <h2 class="title">Sign up</h2>
          <div class="d-flex">
            <div class="input-field d-flex gap-1 align-items-center">
              <input type="text" v-model="registerCredential.first_name" required/>
              <label>
                <el-icon :size="15">
                  <UserFilled/>
                </el-icon>
                Frist Name</label
              >
            </div>
            <div class="input-field d-flex align-items-center">
              <input type="text" v-model="registerCredential.last_name" required/>
              <label>
                <el-icon :size="15">
                  <UserFilled/>
                </el-icon>
                Last Name</label>
            </div>
          </div>
          <div class="input-field">
            <input type="text" v-model="registerCredential.name" required/>
            <label>
              <el-icon :size="15">
                <UserFilled/>
              </el-icon>
              User Name</label>
          </div>
          <div class="input-field">
            <input type="email" v-model="registerCredential.email" required/>
            <label>
              <el-icon :size="15">
                <Message/>
              </el-icon>
              Email</label
            >
          </div>
          <div class="d-flex">
            <div class="input-field d-flex gap-1 align-items-center">
              <input type="password" v-model="registerCredential.password" required/>
              <label>
                <el-icon :size="15">
                  <Lock/>
                </el-icon>
                Password</label>
            </div>
            <div class="input-field d-flex align-items-center">
              <input type="password" v-model="registerCredential.password_confirmation" required/>
              <label>
                <el-icon :size="15">
                  <Lock/>
                </el-icon>
                Confirm Password</label
              >

            </div>
          </div>
          <div class="input-field-select">
            <select class="select form-control" v-model="registerCredential.user_type" required>
              <option selected value="" hidden>Who are you?</option>
              <option value="user">Normal User</option>
              <option value="hospital">Hospital Owner</option>
            </select>
          </div>
          <p class="social-text">Or Sign in with social platform</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <el-tooltip content="LinkedIn" placement="top-start" effect="dark">
                <el-avatar :size="35"><img src="@/assets/image/linkeding.png"/></el-avatar>
              </el-tooltip>
            </a>
            <a href="" class="social-icon">
              <el-tooltip content="Facebook" placement="top-start" effect="dark">
                <el-avatar :size="35"><img src="@/assets/image/fb_logo.jpg"/></el-avatar>
              </el-tooltip>
            </a>
            <a href="" class="social-icon">
              <el-tooltip content="X" placement="top-start" effect="dark">
                <el-avatar :size="35"><img src="@/assets/image/x-logo.webp"/></el-avatar>
              </el-tooltip>
            </a>
            <a href="" class="social-icon">
              <el-tooltip content="Google" placement="top-start" effect="dark">
                <el-avatar :size="35"><img src="@/assets/image/google.png"/></el-avatar>
              </el-tooltip>
            </a>
          </div>
          <div class="main-btn">
            <button type="submit" class="btn">Sign Up</button>
          </div>
          <p class="account-text">
            Already have an account? <a href="#" id="sign-in-btn2">Sign in</a>
          </p>
        </form>
      </div>
      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Welcome to CareFinder!</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque accusantium dolor?</p>
            <button class="btn" id="sign-in-btn">Sign in</button>
          </div>
          <img src="../assets/signin.svg" alt="" class="image"/>
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Welcome Back to CareFinder!</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque accusantium dolor?</p>
            <button class="btn" id="sign-up-btn">Sign up</button>
          </div>
          <img src="../assets/signup.svg" alt="" class="image"/>
        </div>
      </div>
    </div>
  </WebLayout>
</template>

<style scoped>

.container {
  position: relative;
  width: 70vw;
  height: 80vh;
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
  overflow: hidden;
}

.container::before {
  content: '';
  position: absolute;
  top: 0;
  left: -50%;
  width: 100%;
  height: 100%;
  background: linear-gradient(-45deg, #32b4e3, #027fb1);
  z-index: 6;
  transform: translateX(100%);
  transition: 1s ease-in-out;
}

.input-fields {
  display: flex;
  width: 100%;
  justify-content: space-between;
  gap: 0.4rem;
}

.signin-signup {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: space-around;
  z-index: 5;
}

form {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  width: 40%;
  min-width: 238px;
  padding: 0 10px;
}

form.sign-in-form {
  opacity: 1;
  transition: 0.5s ease-in-out;
  transition-delay: 1s;

}


.error-text {
  text-align: left;
  font-size: 0.875rem;
}


form.sign-up-form {
  opacity: 0;
  transition: 0.5s ease-in-out;
  transition-delay: 1s;
}

.title {
  font-size: 35px;
  color: #32b4e3;
  margin-bottom: 10px;
}

.input-field {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  flex: 1;
  width: 100%;
  position: relative;
  border-bottom: 0.8px solid rgb(105, 105, 105);
  margin: 15px 0;
}

.input-field label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin-bottom: 0.5rem;
  position: absolute;
  top: 50%;
  left: 0%;
  transform: translateY(-55%);
  color: #32b4e3;
  font-size: 15px;
  pointer-events: none;
  transition: 0.15s ease;
}


.input-field input,
.input-field .select {
  flex: 4;
  background: none;
  border: none;
  outline: none;
  width: 100%;
  font-size: 18px;
  font-weight: 500;
  color: #444;
  background: transparent;
}

.input-field input:focus ~ label,
.input-field Field:not(:placeholder-shown) ~ label {
  font-size: 0.8rem;
  top: 0px;
  transform: translateY(-120%);
  border-radius: 8px;
}

.input-field-select .select {
  font-size: 15px;
  border: none;
  background: #32b4e3;
  color: #fff;
}


.main-btn {
  display: flex;
  align-items: flex-end;
}

.btn {
  width: 90px;
  height: 50px;
  border: none;
  border-radius: 50px;
  background: #fcb22c;
  color: #fff;
  font-weight: 600;
  margin: 10px 0;
  text-transform: uppercase;
  cursor: pointer;
}

.btn:hover {
  background: #f5a91b;
}

.social-text {
  margin: 10px 0;
  font-size: 16px;
}

.social-media {
  display: flex;
  justify-content: center;
}

.social-icon {
  display: flex;
  font-size: 0px;
  align-items: center;
  justify-content: center;
  color: #444;
  margin: 0 5px;
}

.social-icon img {
  font-size: 100px;
}

a {
  text-decoration: none;
}

i {
  font-size: 300;
}

.social-icon:hover {
  color: #32b4e3;
  border-color: #32b4e3;
}

.panels-container {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: space-around;
}

.panel {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-around;
  width: 35%;
  min-width: 238px;
  padding: 0 10px;
  text-align: center;
  z-index: 6;
}

.left-panel {
  pointer-events: none;
}

.content {
  color: #fff;
  transition: 1.1s ease-in-out;
  transition-delay: 0.5s;
}

.panel h3 {
  font-size: 40px;
  font-weight: 700;
}

.panel p {
  font-size: 15px;
  padding: 10px 0;
}

.image {
  width: 80%;
  transition: 1.1s ease-in-out;
  transition-delay: 0.4s;
}

.left-panel .image,
.left-panel .content {
  transform: translateX(-200%);
}

.right-panel .image,
.right-panel .content {
  transform: translateX(0);
}

.account-text {
  display: none;
}

/*Animation*/
.container.sign-up-mode::before {
  transform: translateX(0);
}

.container.sign-up-mode .right-panel .image,
.container.sign-up-mode .right-panel .content {
  transform: translateX(200%);
}

.container.sign-up-mode .left-panel .image,
.container.sign-up-mode .left-panel .content {
  transform: translateX(0);
}

.container.sign-up-mode form.sign-in-form {
  opacity: 0;
}

.container.sign-up-mode form.sign-up-form {
  opacity: 1;
}

.container.sign-up-mode .right-panel {
  pointer-events: none;
}

.container.sign-up-mode .left-panel {
  pointer-events: all;
}

/*Responsive*/
@media (max-width: 779px) {
  .container {
    width: 100vw;
    height: 100vh;
  }
}

@media (max-width: 635px) {
  .container::before {
    display: none;
  }

  form {
    width: 80%;
  }

  form.sign-up-form {
    display: none;
  }

  .container.sign-up-mode2 form.sign-up-form {
    display: flex;
    opacity: 1;
  }

  .container.sign-up-mode2 form.sign-in-form {
    display: none;
  }

  .panels-container {
    display: none;
  }

  .account-text {
    display: initial;
    margin-top: 30px;
  }
}

@media (max-width: 320px) {
  form {
    width: 90%;
  }

  .input-field-select .select {
    font-size: 12px;
  }

  .input-field label {
    font-size: 14px;
  }

  .title {
    font-size: 25px;
  }

  .btn {
    height: 35px;
  }
}
</style>