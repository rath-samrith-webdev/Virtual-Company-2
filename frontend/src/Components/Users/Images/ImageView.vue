<template>
  <div>
    <div class="containers">
      <div class="container_img_big">
        <img
          src="https://thehospitallocation.co.uk/wp-content/uploads/2022/10/Ward-3-DB-800x533.jpg"
          alt="Hospital ward"
          class="img_big"
        />
      </div>
      <div class="container_img">
        <div>
          <img
            src="https://media.post.rvohealth.io/wp-content/uploads/2020/08/hospital-acquired-nosocomial-infections_thumb-1-732x549.jpg"
            alt="Hospital"
            class="img_small"
          />
        </div>
        <div>
          <img
            src="https://gray-knop-prod.cdn.arcpublishing.com/resizer/v2/PE4AAKGGA5A7HO7NXDCOTLUO6A.jpg?auth=d32895239286d2161b7fc77e523d1969938c546a25b6d850fc06a213e933133b&width=800&height=450&smart=true"
            alt="Hospital"
            class="img_small"
          />
        </div>
        <div>
          <img
            src="https://codeblue.galencentre.org/wp-content/uploads/2019/02/Hospital.jpg"
            alt="Hospital"
            class="img_small"
          />
        </div>
        <div>
          <img
            src="https://thehospitallocation.co.uk/wp-content/uploads/2022/10/Ward-3-DB-800x533.jpg"
            alt="Hospital ward"
            class="img_small"
          />
        </div>
      </div>
    </div>
    <div class="containers">
      <div class="container_img">
        <div>
          <img
            src="https://www.verywellfamily.com/thmb/m5vCHw2YW_zteiIwmYXmJ2QRosE=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/AA6030-001-56a7713e3df78cf77295fbe7.jpg"
            alt="Hospital"
            class="img_small"
          />
        </div>
        <div>
          <img
            src="https://healthtalk.unchealthcare.org/wp-content/uploads/2021/01/GettyImages-579472814-healthtalk-012221-860x478.jpg"
            alt="Hospital"
            class="img_small"
          />
        </div>
        <div>
          <img
            src="https://i.guim.co.uk/img/media/6a09173ccca92df63535ba4a97bd864021de9ff1/0_224_6733_4039/master/6733.jpg?width=445&dpr=1&s=none"
            alt="Hospital"
            class="img_small"
          />
        </div>
        <div>
          <img
            src="https://www.shutterstock.com/shutterstock/videos/1101035605/thumb/1.jpg?ip=x480"
            alt="Hospital ward"
            class="img_small"
          />
        </div>
      </div>
      <div class="container_img_big">
        <img
          src="https://img.freepik.com/premium-photo/new-born-baby-infant-sleep-incubator-hospital_293060-16338.jpg"
          alt="Hospital ward"
          class="img_big"
        />
      </div>
    </div>
    <div class="containers">
      <div class="container_img_big">
        <img
          src="https://boardwalkhealth.com.au/wp-content/uploads/2016/11/doctor-slider.png"
          alt="Hospital ward"
          class="img_big"
        />
      </div>
      <div class="container_img">
        <div>
          <img
            src="https://www.shutterstock.com/image-photo/doctors-nurse-women-on-clipboard-600nw-2345511891.jpg"
            alt="Hospital"
            class="img_small"
          />
        </div>
        <div>
          <img
            src="https://t4.ftcdn.net/jpg/06/39/29/43/360_F_639294374_bmeuyMYeLtgt3j52qqsOqkty4uXZ9OII.jpg"
            alt="Hospital"
            class="img_small"
          />
        </div>
        <div>
          <img
            src="https://www.medicine.wisc.edu/sites/default/files/styles/max_650x650/public/2022-11/RCT01634.jpg?itok=_2jgHNE3"
            alt="Hospital"
            class="img_small"
          />
        </div>
        <div>
          <img
            src="https://www.aamc.org/sites/default/files/styles/scale_and_crop_1200_x_666/public/dgk-column2-042418.jpg__992x558_q85_crop-smart_subsampling-2_upscale.jpg?itok=pi_g3tXm"
            alt="Hospital ward"
            class="img_small"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { Picture as IconPicture } from '@element-plus/icons-vue'
</script>

<style scoped>
.containers {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 68vh;
  width: 100%;
  border-radius: 10px;
  margin-bottom: 20px;
}

.container_img {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 15px;
  width: 50%;
  margin: 20px;
}

.container_img_big {
  width: 50%;
  margin: auto;
}

.img_small {
  width: 100%;
  height: 190px;
  object-fit: cover;
  border-radius: 10px;
}

.img_big {
  width: 100%;
  height: 390px;
  object-fit: cover;
  border-radius: 10px;
}
</style>
