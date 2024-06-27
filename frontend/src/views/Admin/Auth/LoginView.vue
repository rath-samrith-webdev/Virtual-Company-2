<script setup lang="ts">
import { onMounted } from 'vue'
import WebLayout from '@/Components/Layouts/WebLayout.vue'

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
</script>
<template>
  <WebLayout>
    <div class="container">
      <div class="signin-signup">
        <form action="" class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Email" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" />
          </div>
          <p class="social-text">Or Sign in with social platform</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook"></i>
            </a>
            <a href="" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
          <div class="main-btn">
            <input type="submit" value="Login" class="btn" />
          </div>
          <p class="account-text">
            Don't have an account? <a href="#" id="sign-up-btn2">Sign up</a>
          </p>
        </form>
        <form action="" class="sign-up-form">
          <h2 class="title">Sign up</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="First Name" />
          </div>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Last Name" />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="text" placeholder="Email" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" />
          </div>
          <p class="social-text">Or Sign in with social platform</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook"></i>
            </a>
            <a href="" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
          <div class="main-btn">
            <input type="submit" value="Sign up" class="btn" />
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
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque
              accusantium dolor?
            </p>
            <button class="btn" id="sign-in-btn">Sign in</button>
          </div>
          <img src="../assets/signin.svg" alt="" class="image" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Welcome Back to CareFinder!</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque
              accusantium dolor?
            </p>
            <button class="btn" id="sign-up-btn">Sign up</button>
          </div>
          <img src="../assets/signup.svg" alt="" class="image" />
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
  content: "";
  position: absolute;
  top: 0;
  left: -50%;
  width: 100%;
  height: 100%;
  background: linear-gradient(-45deg, #32B4E3, #027fb1);
  z-index: 6;
  transform: translateX(100%);
  transition: 1s ease-in-out;
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

form.sign-up-form {
  opacity: 0;
  transition: 0.5s ease-in-out;
  transition-delay: 1s;
}

.title {
  font-size: 35px;
  color: #32B4E3;
  margin-bottom: 10px;
}

.input-field {
  width: 100%;
  height: 50px;
  background: #f0f0f0;
  margin: 5px 0;
  border: 2px solid #32B4E3;
  border-radius: 10px;
  display: flex;
  align-items: center;
}

.input-field i {
  flex: 0.5;
  text-align: center;
  color: #666;
  font-size: 10px;
}

.input-field input {
  flex: 4;
  background: none;
  border: none;
  outline: none;
  width: 100%;
  font-size: 18px;
  font-weight: 500;
  color: #444;
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
  background: #FCB22C;
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
  height: 45px;
  width: 45px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #444;
  border: 1px solid #444;
  border-radius: 50px;
  margin: 0 5px;
}

a {
  text-decoration: none;
}

i {
  font-size: 300;
}

.social-icon:hover {
  color: #32B4E3;
  border-color: #32B4E3;
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
}
</style>