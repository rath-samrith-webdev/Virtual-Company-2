<template>
<WebLayout/>
<div class="body">
    <img class= "image" src="https://teacarchitect.com/wp-content/uploads/2021/09/Royal-Phnom-Penh-Hospital.jpg" alt="">
    <div class="G-button d-flex justify-content-around mt-5">
        <button class="btn">Information</button>
        <button class="btn">Department</button>
        <button class="btn">Doctor</button>
        <button class="btn">Service</button>
    </div>
</div>
</template>

<script>
import WebLayout from '@/Components/Layouts/WebLayout.vue';
export default {
    components: {
        WebLayout,
    }

}
</script>

<style>
.image{
    width: 100%;
    height: 150vh;
    object-fit: cover;
    margin-top: -33%;
}
.btn{
    padding: 10px 20px;
    border-radius: 15px;
    border: 1px solid #32B4E3;
    color: rgb(0, 0, 0);
}
</style>