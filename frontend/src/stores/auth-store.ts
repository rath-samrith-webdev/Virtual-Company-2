import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAuthStore = defineStore('auth', () => {
  const user = ref()
  const isAuthenticated = ref()
  const permissions = ref()
  const roles = ref()
  const hospital=ref()

  return {
    user,
    roles,
    permissions,
    isAuthenticated,
    hospital
  }
})
