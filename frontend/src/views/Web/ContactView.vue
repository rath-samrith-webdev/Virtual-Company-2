<template>
    <WebLayout>
        <div class="container">
            <div class="contact-us">
                <div class="text-section">
                    <h1>Contact us</h1>
                    <p>You can contact to our service and give feedback to website by use form that have in contect us.</p>
                </div>
                <div class="image-section">
                    <img width="500px" src="../../assets/image/contact.png" alt="Contact Illustration">
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-serves">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSG_iapAWWXQiv3oWF18K46528qui-W1Yl4X5KKOjth6boedVbnt6u8nVT_U3Uu6s9_c3U&usqp=CAU" class="rounded-circle" alt="...">
                <div class="containers border border-warning rounded">
                    <h4>Email</h4>
                    <p>leysreng.ol@gmail.com</p>
                </div>
            </div>
            <div class="card-serves">
                <img src="../../assets/image/location.png" class="rounded" alt="...">
                <div class="containers border border-warning rounded">
                    <h4>Location</h4>
                    <p>House No. C20-D33A, One Park, Street R8, Sangkat Srah Chak, Khan Doun Penh, Phnom Penh</p>
                </div>
            </div>
            <div class="card-serves">
                <img src="https://www.freeiconspng.com/uploads/phone-png-3.png" class="rounded-circle" alt="...">
                <div class="containers border border-warning rounded">
                    <h4>Phone Number</h4>
                    <p>+855 701 9077</p>
                </div>
            </div>
        </div>
        <div class="contact">
            <h2>Get in Touch with us.</h2>
            <p>All of these apps can be found on the Google Play Store or Apple App Store and downloaded for offline use.</p>
        </div>
        <div class="form">
            <form class="max-w-md-0 mx-auto mt-20">
                <div class="relative mb-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                            <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                            <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                        </svg>
                    </div>
                    <input type="email" id="email-address-icon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 h-15 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com">
                </div>
                <div class="relative">
                    <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 h-55" placeholder="Please enter your feedback..."></textarea>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button" class="text-white bg-blue-700 border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:border-blue-500 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
                </div>
            </form>
        </div>
        <el-footer class="md:px-20 d-flex justify-content-between align-items-center footer py-2" style="background-color: white;">
            <el-col :span="4">
                <div class="d-flex flex-column align-items-start">
                    <img src="@/assets/logo/care_finder-02.png" alt="" width="200px">
                    <p class="text-start">Browse through our professionally designed selection. Browse through our professionally designed selection.</p>
                </div>
            </el-col>
            <el-col :span="4">
                <div class="d-flex flex-column align-items-start">
                    <h4>Navigation</h4>
                    <router-link to="/landing" class="nav-link">Home</router-link>
                    <router-link to="/landing" class="nav-link">About</router-link>
                    <router-link to="/landing" class="nav-link">Service</router-link>
                    <router-link to="/landing" class="nav-link">Contact</router-link>
                </div>
            </el-col>
            <el-col :span="4">
                <div>
                    <h4 class="text-start">Address</h4>
                    <div>
                        <p class="text-justify">
                            BP 511, Phum Tropeang Chhuk (Borey Sorla) Sangtak, Street 371, Phnom Penh
                        </p>
                    </div>
                </div>
            </el-col>
            <el-col :span="4">
                <div class="d-flex justify-content-between gap-lg-5 flex-column mt-2">
                    <h4>Social Media</h4>
                    <div class="d-flex justify-content-between mt-2">
                        <el-tooltip class="box-item" effect="dark" content="LinkedIn" placement="top-start">
                            <el-avatar shape="circle" :src="'https://cdn1.iconfinder.com/data/icons/logotypes/32/circle-linkedin-512.png'"></el-avatar>
                        </el-tooltip>
                        <el-tooltip class="box-item" effect="dark" content="Gmail" placement="top-start">
                            <el-avatar shape="circle" :src="'https://img.freepik.com/premium-vector/email-symbol-white-icon_1076610-15454.jpg'"></el-avatar>
                        </el-tooltip>
                        <el-tooltip class="box-item" effect="dark" content="Instagram" placement="top-start">
                            <el-avatar shape="circle" :src="'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Instagram_icon.png/1200px-Instagram_icon.png'"></el-avatar>
                        </el-tooltip>
                        <el-tooltip class="box-item" effect="dark" content="Github" placement="top-start">
                            <el-avatar shape="circle" :src="'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/GitHub_Invertocat_Logo.svg/1200px-GitHub_Invertocat_Logo.svg.png'" class="bg-white"></el-avatar>
                        </el-tooltip>
                    </div>
                </div>
            </el-col>
        </el-footer>
    </WebLayout>
</template>

<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue';
import { ref } from 'vue'
import { useTransition } from '@vueuse/core'
import {
    ChatLineRound,
    DataAnalysis,
    FirstAidKit,
    Location,
    Memo,
    Position,
    Search, Service, SuitcaseLine,
    User, View
} from '@element-plus/icons-vue'

const source = ref(0)
const feedbacks = ref(0)
const outputValue = useTransition(source, {
    duration: 1500
})
const outputFeedBack = useTransition(feedbacks, {
    duration: 1500
})
source.value = 172000
feedbacks.value = 512
</script>

<style>
.container {
    display: flex;
    align-items: center;
    padding: 70px;
    padding-left: 200px;
}
.text-section p {
    width: 145%;
}

.feedback {
    width: 50%;
}

.contact-us {
    display: flex;
    flex-direction: row;
    gap: 35%;
}

.form {
    width: 70%;
    height: 450px;
    align-items: center;
    margin: auto;
    margin-top: 30px;
    padding: 10px;
    background-color: #f5f4f3;
    border-radius: 30px;
}
.el-footer {
    margin-top: 20px;
    width: 100%;
    height: 300px;
    background: white;
}

.contact p {
    max-width: 50%;
    align-items: center;
    justify-content: center;
    text-align: center;
    margin: auto;
}

.containers h4 {
    justify-content: center;
    align-items: center;
    text-align: center;
    margin-top: 50px;
}

.containers {
    width: 250px;
    height: 30vh;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    /* background:pink; */
}

.containers:hover {
    box-shadow: 0 4px 8px 0 rgb(223, 185, 34), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.card-serves img {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    margin-left: 82px;
    margin-bottom: -40px;
    margin-right: 10px;
}

.card {
    margin-top: 25px;
    height: 45vh;
    display: flex;
    flex-direction: row;
    gap: 80px;
    border: none;
    justify-content: center;
}
/* .card-serves{
    background: #000;
} */

.text-section h1 {
    color: #f68b1e;
    font-size: 2.5em;
    margin-bottom: 20px;
}

.contact h2 {
    color: #f68b1e;
    text-align: center;
}

.text-section{
    margin-top: 60px;
}
.contact p {
    font-size: 1.2em;
    line-height: 1.5em;
}

.card-section {
    width: 290px;
    height: 254px;
    border-radius: 20px;
    margin-bottom: 20px;
    margin-top: 20px;
    position: relative;
    transition: 0.9s ease-out;
    overflow: visible;
}

.card-button {
    transform: translate(-50%, 125%);
    width: 60%;
    border-radius: 1rem;
    border: none;
    color: #fff;
    font-size: 1rem;
    padding: .5rem 1rem;
    position: absolute;
    left: 50%;
    bottom: 0;
    opacity: 0;
    transition: 0.3s ease-out;
}

.text-title {
    font-size: 1.5em;
    font-weight: bold;
}
</style>
