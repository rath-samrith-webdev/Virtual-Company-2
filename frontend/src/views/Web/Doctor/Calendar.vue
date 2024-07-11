<script lang="ts" setup>
import { ref } from 'vue'
import WebLayout from '@/Components/Layouts/WebLayout.vue';

const value = ref(new Date())
</script>

<template>
    <WebLayout>
        <!-- Remove the unnecessary <template> tag inside WebLayout -->
        <el-calendar v-model="value" />
    </WebLayout>
</template>
