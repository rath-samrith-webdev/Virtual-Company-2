<template>
  <WebLayout>
    <div class="container-contact">
      <div class="contact-us">
        <div class="text-section">
          <h1 class="text-color-#32B4E3 mt-20" style="font-size: 80px; font-weight: bold">Contact us</h1>
          <p style="font-size: 18px;">
            You can contact to our service and give feedback to website by use form that have in
            contect us.
          </p>
          <p style="font-size: 18px;">
            Contact to use for build the system and website for your bussiness.
          </p>
        </div>
        <div class="image-section">
          <img width="600px" src="../../assets/image/contact.png" alt="Contact Illustration" />
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-serves">
        <img
          src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSG_iapAWWXQiv3oWF18K46528qui-W1Yl4X5KKOjth6boedVbnt6u8nVT_U3Uu6s9_c3U&usqp=CAU"
          class="rounded-circle"
          alt="..."
        />
        <div class="containers rounded mt5">
          <h4>Email</h4>
          <p>leysreng.ol@gmail.com</p>
        </div>
      </div>
      <div class="card-serves">
        <img src="../../assets/image/location.png" class="rounded" alt="..." />
        <div class="containers rounded mt5">
          <h4>Location</h4>
          <p>
            House No. C20-D33A, One Park, Street R8, Sangkat Srah Chak, Khan Doun Penh, Phnom Penh
          </p>
        </div>
      </div>
      <div class="card-serves">
        <img
          src="https://www.freeiconspng.com/uploads/phone-png-3.png"
          class="rounded-circle bg-white"
          alt="..."
        />
        <div class="containers rounded mt5">
          <h4>Phone Number</h4>
          <p>+855 701 9077</p>
        </div>
      </div>
    </div>
    <div class="contact">
      <h2 class="text-color-#32B4E3 mt-5">Get in Touch with us.</h2>
      <p>
        All of these apps can be found on the Google Play Store or Apple App Store and downloaded
        for offline use.
      </p>
    </div>
    <div class="form">
      <form class="max-w-md-0 mx-auto mt-20">
        <div class="relative mb-6">
          <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg
              class="w-4 h-4 text-gray-500 dark:text-gray-400"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              viewBox="0 0 20 16"
            >
              <path
                d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"
              />
              <path
                d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"
              />
            </svg>
          </div>
          <input
            type="email"
            style="font-size: 16px;"
            id="email-address-icon"
            class="bg-gray-10 border border-gray-100 text-gray-500 text-sm rounded-lg focus:ring-blue-100 focus:border-blue-100 block w-full pl-10 p-2.5 h-15 dark:bg-gray-700 dark:border-gray-100 dark:placeholder-gray-100 dark:focus:ring-blue-100 dark:focus:border-blue-500"
            placeholder="Please input your email!"
          />
        </div>
        <div class="relative">
          <textarea
            id="message"
            style="font-size: 16px;"
            rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-10 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 h-55"
            placeholder="Please enter your feedback..."
          ></textarea>
        </div>
        <div class="flex justify-end mt-4">
          <button
            type="button"
            class="text-white bg-#32B4E3 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:border-blue-500 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          >
            Submit
          </button>
        </div>
      </form>
    </div>
    <FooterLayout />
  </WebLayout>
</template>

<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import FooterLayout from '@/Components/FooterLayout.vue'
</script>

<style scoped>
.container-contact {
  display: flex;
  align-items: center;
  width: 100%;
  height: 80vh;
  padding: 100px;
}

.feedback {
  width: 50%;
}

.contact-us {
  display: flex;
  flex-direction: row;
  gap: 5%;
}

.form {
  width: 70%;
  height: 450px;
  align-items: center;
  margin: 30px auto auto;
  padding: 10px;
  background-color: #F0F9FE;
  border-radius: 10px;
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
  width: 380px;
  height: 30vh;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  box-shadow: 0 4px 6px rgba(167, 167, 167, 0.1), 0 2px 4px rgba(255, 255, 255, 0.06);


}

.containers:hover {
  transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
  box-shadow: 0 4px 6px rgba(167, 167, 167, 0.1), 0 2px 4px rgba(255, 255, 255, 0.06);
  transition: box-shadow 0.3s ease-in-out;
  transition: transform 0.9s ease-in-out;
  transform: translateY(-5px);
  transition: box-shadow 0.3s ease-in-out;
  transition: transform 0.3s ease-in-out;
}

.card-serves img {
  display: flex;
  align-items: center;
  width: 90px;
  height: 90px;
  border-radius: 50%;
  margin-left: 150px;
  margin-bottom: -40px;
  margin-right: 10px;

}


.card {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  align-items: center;
  flex-direction: row;
  margin-top: 25px;
  height: 45vh;
  gap: 50px;
  border: none;
  margin-top: 120px;
  width: 100%;
}

.text-section h1 {
  font-size: 2.5em;
  margin-bottom: 20px;
}

.contact h2 {
  text-align: center;
}

.text-section {
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
  padding: 0.5rem 1rem;
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
