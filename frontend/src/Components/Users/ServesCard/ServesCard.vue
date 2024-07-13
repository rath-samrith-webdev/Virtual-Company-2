<template>
  <div class="cardServes">
    <section class="we-offer-area text-center bg-gray">
      <div class="container">
        <div class="row our-offer-items less-carousel">
          <div class="col-md-4 col-sm-6 equal-height">
            <div class="item">
              <i class="fas fa-pen-fancy"
                ><img
                  src="https://cdn-icons-png.freepik.com/512/8506/8506003.png"
                  alt=""
                  width="100px"
              /></i>
              <h4>General Check-up</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 equal-height">
            <div class="item">
              <i class="fas fa-dharmachakra">
                <img
                  src="https://cdn-icons-png.flaticon.com/512/8507/8507710.png"
                  alt=""
                  width="100px"
              /></i>
              <h4>Emergency & Trauma</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 equal-height">
            <div class="item">
              <i class="fas fa-tasks">
                <img
                  src="https://cdn-icons-png.freepik.com/512/10237/10237979.png"
                  alt=""
                  width="100px"
              /></i>
              <h4>Heart</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 equal-height">
            <div class="item">
              <i class="fas fa-tachometer-alt">
                <img
                  src="https://cdn-icons-png.flaticon.com/512/12106/12106213.png"
                  alt=""
                  width="100px"
              /></i>
              <h4>GI Center</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 equal-height">
            <div class="item">
              <i class="fas fa-recycle">
                <img
                  src="https://www.pikpng.com/pngl/b/563-5635508_hospital-clipart-emergency-room-urgent-care-icon-png.pnghttps://cdn-icons-png.flaticon.com/512/2764/2764533.png"
                  alt=""
                  width="100px"
              /></i>
              <h4>Ambulance</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 equal-height">
            <div class="item">
              <i class="fas fa-headset">
                <img
                  src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS8yeE7bX_hEkEXllka-Spgsbxpv4poh-VZeQ&s"
                  alt=""
                  width="100px"
              /></i>
              <h4>Children</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'ServesCard'
}
</script>

<style scoped>
section {
  padding: 60px 0;
  min-height: 100vh;
}
ul {
  margin: 0;
  padding: 0;
  list-style: none;
}
.bg-gray {
  background-color: #f9f9f9;
}

.site-heading h2 {
  display: block;
  font-weight: 700;
  margin-bottom: 10px;
  text-transform: uppercase;
}

i img{
  border-radius: 100px;
  border: 1px solid  #a0a8ff;
}
.site-heading h4 {
  display: inline-block;
  padding-bottom: 20px;
  position: relative;
  text-transform: capitalize;
  z-index: 1;
}

.site-heading {
  margin-bottom: 60px;
  overflow: hidden;
  margin-top: -5px;
}

.carousel-shadow .owl-stage-outer {
  margin: -15px -15px 0;
  padding: 15px;
}

.we-offer-area .our-offer-carousel .owl-dots .owl-dot span {
  background: #ffffff none repeat scroll 0 0;
  border: 2px solid;
  height: 15px;
  margin: 0 5px;
  width: 15px;
}

.we-offer-area.text-center .item {
  background: #ffffff none repeat scroll 0 0;
  border: medium none;
  padding: 67px 40px 64px;
}

.we-offer-area.text-center .item i {
  /* background: #a0a8ff none repeat scroll 0 0; */
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  color: #ffffff;
  font-size: 40px;
  height: 80px;
  line-height: 80px;
  position: relative;
  text-align: center;
  width: 80px;
  z-index: 1;
  transition: all 0.35s ease-in-out;
  -webkit-transition: all 0.35s ease-in-out;
  -moz-transition: all 0.35s ease-in-out;
  -ms-transition: all 0.35s ease-in-out;
  -o-transition: all 0.35s ease-in-out;
  margin-bottom: 25px;
}

.we-offer-area.item-border-less .item {
  border: medium none;
}

.we-offer-area .our-offer-items.less-carousel .equal-height {
  margin-bottom: 30px;
}

.we-offer-area.item-border-less .item .number {
  font-family: 'Poppins', sans-serif;
  font-size: 50px;
  font-weight: 900;
  opacity: 0.1;
  position: absolute;
  right: 30px;
  top: 30px;
}

.our-offer-carousel.center-active .owl-item:nth-child(2n) .item i,
.our-offer-carousel.center-active .owl-item:nth-child(2n) .item h4,
.our-offer-carousel.center-active .owl-item:nth-child(2n) .item p,
.we-offer-area.center-active .single-item:nth-child(2n) .item i,
.we-offer-area.center-active .single-item:nth-child(2n) .item h4,
.we-offer-area.center-active .single-item:nth-child(2n) .item p {
  color: #ffffff;
}

.we-offer-area .item i {
  color: #00a01d;
  display: inline-block;
  font-size: 60px;
  margin-bottom: 20px;
}

.we-offer-area .item h4 {
  font-weight: 600;
  text-transform: capitalize;
}

.we-offer-area .item p {
  margin: 0;
}

.we-offer-area .item i,
.we-offer-area .item h4,
.we-offer-area .item p {
  transition: all 0.35s ease-in-out;
  -webkit-transition: all 0.35s ease-in-out;
  -moz-transition: all 0.35s ease-in-out;
  -ms-transition: all 0.35s ease-in-out;
  -o-transition: all 0.35s ease-in-out;
}

.we-offer-area .item:hover::after {
  left: 0;
}
.we-offer-area.text-center .item:hover i::after {
  border-color: #ffffff !important;
}
</style>
