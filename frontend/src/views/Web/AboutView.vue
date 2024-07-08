<script setup="ts">
  import WebLayout from '@/Components/Layouts/WebLayout.vue'
  import FooterLayout from '@/Components/FooterLayout.vue'
</script>
<template>
  <WebLayout>
    <div class="head">
      <h1>About Us</h1>
      <h5>Full service starting from 2023</h5>
      <button>Detail About Service</button>
    </div>
    <div class="container">
      <div class="mt-5 d-flex service">
        <div class="ml-5 d-flex flex-column service-img">
          <img
            class="w-100 h-50 border rounded"
            src="https://static1.anpoimages.com/wordpress/wp-content/uploads/2022/07/googleMapsTricksHero.jpg"
            alt=""
          />
          <div class="two-img d-flex mt-2">
            <img
              class="border mr-3 rounded"
              style="width: 300px; height: 250px"
              src="https://i.pinimg.com/564x/45/1d/b1/451db155874786bd0ba76bee971ac657.jpg"
              alt=""
            />
            <img
              class="border ml-2 rounded"
              style="width: 300px; height: 250px"
              src="https://i.pinimg.com/564x/2a/02/2a/2a022aa6d29aee0bbff11108947310b5.jpg"
              alt=""
            />
          </div>
        </div>
        <div class="ml-5 text-center service-text" style="margin-top: 12%">
          <h3 class="fs-1 text-warning">We are a service to help you find a hospital near you</h3>
          <p class="fs-4">
            For my services can make it easy for you to find a hospital near you and you have used the
            service for hospital reservations and booking all the services available in the booked
            hospital. Especially, you can check the hospital before you booking.
          </p>
        </div>
      </div>
      <div class="card-todo mt-5">
        <h2 class="fs-2 text-warning text-center">What We Do</h2>
        <div class="group-card d-flex justify-content-evenly mt-4">
          <div class="p-4 bg-warning card hospital" style="width: 500px; height: 180px">
            <div class=" d-flex">
              <img
                src="https://cdn-icons-png.freepik.com/512/2798/2798878.png"
                class="card-img-top w-25 h-50 p-3"
                alt="..."
              />
              <div class="card-body">
                <h2>Hospital Service</h2>
                <p class="card-text fs-5 lh-base">
                  we manage all hospital that you our service that customer can find ton our website
                </p>
              </div>
            </div>
          </div>
          <div class=" p-3 bg-info card hospital" style="width: 500px; height: 180px">
            <div class=" d-flex">
              <img
                src="https://www.clipartmax.com/png/full/64-648655_customer-icon-customer-orange.png"
                class="card-img-top w-25 h-50 p-3"
                alt="..."
              />
              <div class="card-body">
                <h2>Customer Service</h2>
                <p class="card-text fs-5 lh-base">
                  Customer can create account fo r use our website and can help customer easier to
                  find hospital than before
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class=" d-flex justify-content-evenly contect-to-contact-page" style="margin-top: 15%">
        <div class="d-flex flex-column align-items-center">
          <h3 class="fw-bold text-center  " style="margin: 10%">If you have any questions about our services or you want
            to use our services, you can contact us.</h3>
          <button type="button" class="btn btn-warning w-25 ml-5  text-light" style="margin-top:-5%">Contact Us</button>
        </div>
        <img src="https://i.pinimg.com/564x/c2/87/c8/c287c8abe56b65b73da4685e15c896be.jpg" alt="">
      </div>
    </div>
    <FooterLayout/>
  </WebLayout>
</template>
<style>
.head {
  height: 50vh;
  background-image: url('https://www.bannerhealthfoundation.org/-/media/images/project/bhf/content-pages/2024-hero-images/tucson_1600x400.ashx');
  background-size: cover;
  background-position: center;
  background-color: rgba(0, 128, 128, 0.578);
  padding: 4% 20px 20px 10%;
  color: rgb(40, 27, 3);
  font-weight: bold;
  filter: blur(0.5);
}

h1 {
  font-size: 50px;
  margin-bottom: 10px;
}

button {
  background-color: rgb(253, 165, 1);
  color: white;
  padding: 10px;
  margin-left: 100px;
  margin-top: 30px;
  border: none;
  border-radius: 10px;
  cursor: pointer;
}

</style>
