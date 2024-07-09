<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import { config, Map, MapStyle, Marker, Popup } from '@maptiler/sdk'
import { markRaw, onMounted, onUnmounted, shallowRef } from 'vue'
import '@maptiler/sdk/dist/maptiler-sdk.css'
import axiosInstance from '@/plugins/axios'
const mapContainer = shallowRef(null)
const map = shallowRef(null)
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(showPosition)
} else {
  console.log('Geolocation is not supported by this browser.')
}
const coordinate = { lng: 0, lat: 0, acc: 0 }

function showPosition(position: any) {
  coordinate.lng = position.coords.longitude
  coordinate.lat = position.coords.latitude
  coordinate.acc = position.coords.accuracy
  console.log(coordinate)
}
async function fetchHospital() {
  try {
    const { data } = await axiosInstance.get('/hospitals/list')
    data.data.forEach((hospital: any) => {
      new Marker({ color: 'blue' })
        .setLngLat([hospital.lng, hospital.lat])
        .setPopup(new Popup({ offset: 30 }).setText(hospital.name))
        .addTo(map.value)
    })
  } catch (error) {
    console.log(error)
    return null
  }
}
onMounted(() => {
  config.apiKey = 'EuM9QQJGrvW9fu5g98Sm'
  const initialState = { lng: 104.888535, lat: 11.562108, zoom: 10 }
  map.value = markRaw(
    new Map({
      container: mapContainer.value,
      style: MapStyle.STREETS,
      center: [initialState.lng, initialState.lat],
      zoom: initialState.zoom
    })
  )
  fetchHospital()
})
onUnmounted(() => {
  map.value?.remove()
})
</script>
<template>
  <WebLayout>
    <el-container class=".map-wrap">
      <div class="map" ref="mapContainer"></div>
    </el-container>
  </WebLayout>
</template>

<style scoped>
.map-wrap {
  position: relative;
  width: 100%;
  height: calc(100vh - 150px); /* calculate height of the screen minus the heading */
}
.map {
  position: absolute;
  width: 100%;
  left: 0px;
  height: 100%;
}
</style>
