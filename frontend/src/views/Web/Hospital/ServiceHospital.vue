<template>
  <WebLayout>
    <h1> Choose your subscription plan</h1>
    <div class="card-service">
      <div class="card" v-for="(service, index) in services" :key="index">
        <div class="content">
          <div class="title">{{ service.title }}</div>
          <div class="price">{{ service.price }}</div>
          <div class="description">
            <div class="text" v-for="(desc, idx) in service.description" :key="idx">
              <el-icon class="size-8" style="color: green"><Check /></el-icon>
              {{ desc }}
            </div>
          </div>
        </div>
        <el-button plain @click="openDialog">Subscribe</el-button>
      </div>
    </div>
    <el-dialog v-model="centerDialogVisible" width="800" center>
      <div class="d-flex text-center center payment">
        <h1>Payment Invoice</h1>
      </div>
      <div class="card-from">
        <div class="card-pay card border-primary mb-3" style="width: 50%">
          <div class="card-header">Payment Dummsry</div>
          <div class="card-body">
            <div class="card_payment">
              <div class="card_payment-date">
                <h6>Electronice</h6>
                <p>2020 February 10, at 12:20 PM</p>
              </div>
              <div class="card_payment-card border-start">
                <h4>CAF</h4>
              </div>
            </div>
            <div class="card_payment mt-2">
              <div class="card_payment-date">
                <h6>Electronice</h6>
                <p>2020 February 10, at 12:20 PM</p>
              </div>
              <div class="card_payment-card border-start">
                <h4>JFK</h4>
              </div>
            </div>
            <div class="card_payment mt-2">
              <div class="card_payment-date">
                <h6>Electronice</h6>
                <p>2020 February 10, at 12:20 PM</p>
              </div>
              <div class="card_payment-card border-start">
                <h4>LHR</h4>
              </div>
            </div>
            <div class="card_payment mt-2">
              <div class="card_payment-date">
                <h6>Electronice</h6>
                <p>2020 February 10, at 12:20 PM</p>
              </div>
              <div class="card_payment-card border-start">
                <h4>JFK</h4>
              </div>
            </div>
          </div>
          <div class="total">
            <p>Total Price</p>
            <h3>$123456.78</h3>
            <p>Payment Type: Credit Card</p>
          </div>
        </div>
        <!-- //////////////////////////////////////////////////////////////// -->
        <div class="card border-secondary mb-3" style="width: 50%">
          <div class="card-header">Payment Method</div>
          <div class="card-body text-secondary">
            <h5 class="card-title mt-8">
              <button type="button" class="btn btn-outline-warning ms-3">VISA</button>
              <button type="button" class="btn btn-outline-warning" ms-3>PayPal</button>
            </h5>
            <p class="card-text mt-3">
              <div class="card-input">
                <p>Email</p>
                <el-input
                v-model="email"
                type="email"
                placeholder="Please input email"
              />
              </div>
              <div class="card-input-two mt-6">
                <div class="cards">
                  <p>Card Number</p>
                <el-input v-model="cardNumber" type="number" placeholder="Please input card number" />
                </div>
                <div class="cards">
                  <p>CVV</p>
                <el-input v-model="cvv"type="number" placeholder="Please input CVV" />
                </div>
              </div>
              <div class="card-input mt-6" >
                <p>Expiration date</p>
                <el-input
                v-model="expirationDate"
                type="date"
                placeholder="Please input expiration date"
              />
              </div>
            </p>
          </div >
          <button type="button" class="btn btn-primary mt-6 " @click="makePayment" >Make a payment</button>
        </div>
      </div>

      <!-- <template #footer>
        <div class="dialog-footer">
          <el-button @click="centerDialogVisible = false">Cancel</el-button>
          <el-button type="primary" @click="centerDialogVisible = false">Confirm</el-button>
        </div>
      </template> -->
    </el-dialog>
  </WebLayout>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import { Check } from '@element-plus/icons-vue'
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import { ElInput } from 'element-plus';
export default defineComponent({
  name: 'HospitalService',
  components: {
    ElInput,
    WebLayout,
    'el-icon': Check
  },
  setup() {
    const centerDialogVisible = ref(false)
    const services = ref([
      {
        title: 'Day',
        price: '$39.99',
        description: [
          'consectetur adipiscing elit. Lorem ipsum dolor sit amet',
          'Lorem ipsum dolor sit amet'
        ]
      },
      {
        title: 'Month',
        price: '$39.99',
        description: [
          'consectetur adipiscing elit. Lorem ipsum dolor sit amet',
          'Lorem ipsum dolor sit amet'
        ]
      },
      {
        title: 'Year',
        price: '$39.99',
        description: [
          'consectetur adipiscing elit. Lorem ipsum dolor sit amet',
          'Lorem ipsum dolor sit amet'
        ]
      }
      
    ])
    const email = ref('');
    const cardNumber = ref('');
    const cvv = ref('');
    const expirationDate = ref('');

    const makePayment = () => {
      // Handle the payment logic here
      console.log('Payment made', { email, cardNumber, cvv, expirationDate });
    };


    const openDialog = () => {
      centerDialogVisible.value = true
    }

    return {
      centerDialogVisible,
      services,
      openDialog,
      email,
      cardNumber,
      cvv,
      expirationDate,
      makePayment
    }
  }
  
})
</script>

<style scoped>
.card-service {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  margin-top: 50px;
}

.card {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-around;
  width: 400px;
  padding: 20px 1px;
  margin: 10px 0;
  text-align: center;
  position: relative;
  box-shadow:
    0 10px 15px -3px rgba(33, 150, 243, 0.4),
    0 4px 6px -4px rgba(33, 150, 243, 0.4);
  border-radius: 10px;
  background: white;
}

.content {
  padding: 20px;
}

.content .price {
  color: rgb(0, 0, 0);
  font-weight: 800;
  font-size: 50px;
  text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.42);
}

.description {
  width: 100%;
  display: flex;
  justify-content: start;
  align-items: center;
  flex-wrap: wrap;
  padding: 10px;
  background: rgb(255, 255, 255);
}

.text {
  text-align: start;
  display: flex;
}

.content .description {
  color: rgba(0, 0, 0, 0.6);
  margin-top: 10px;
  font-size: 14px;
}

.el-progress {
  font-size: 10px;
}

.content .title {
  font-weight: 800;
  text-transform: uppercase;
  color: rgba(0, 0, 0, 0.64);
  margin-top: 10px;
  font-size: 25px;
  letter-spacing: 1px;
}

.card .el-button {
  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
  border: none;
  outline: none;
  color: rgb(255, 255, 255);
  text-transform: uppercase;
  font-weight: 700;
  font-size: 0.75rem;
  padding: 0.75rem 1.5rem;
  background-color: rgb(0, 102, 255);
  border-radius: 0.5rem;
  width: 90%;
  text-shadow: 0px 4px 18px #2c3442;
}
.card-from {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  padding: 20px;
  gap: 20px;
}
.card_payment {
  width: 100%;
  display: flex;
  flex-direction: row;
  gap: 10px;
}
.card-body {
  width: 100%;
}
.card_payment-date {
  width: 70%;
  display: flex;
  align-items: start;
  flex-direction: column;
}
.card_payment-card {
  width: 20%;
  display: flex;
  align-items: center;
  flex-direction: column;
  border: 1px 0px 0px 0px solid olivedrab;
}
.total {
  width: 95%;
  /* background: rgb(0, 111, 111); */
  background:  #0c7195;
  display: flex;
  flex-direction: column;
  align-items: start;
  color: white;
  border-radius: 5px;
  padding: 5px;
}
.card-input{
  display: flex;
  flex-direction: column;
  align-items: start;
}
.card-input-two{
  display: flex;
  flex-direction: row;
  align-items:start ;
  gap: 10px;
}
.cards{
  width: 50%;
  display: flex;
  align-items: start;
  flex-direction: column;
}
.card-pay{
  background-color: rgba(255, 255, 255, 0.4);
  color: rgb(0, 0, 0);
}
.payment {
  display: flex;
  justify-content: center;
  text-align: center;
  align-items: center;
} 
.payment h1 {
  font-size: 40px;
  font-weight: bold;
  color: #32b4e3;
}
h1{
  text-align: center;
}
</style>
