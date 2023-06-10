import { defineStore } from 'pinia'
import API from '../composables/Axios'

export const useRegisterStore = defineStore('registerStore', {
  state: () => {
    return {
      isLoading: false
    }
  },
  actions: {
    async register(user_info) {
      this.isLoading = true
      try {
        const response = await API.post('surface-user-register', user_info)
        const data = await response.data
        return data
      } catch (ex) {
        return Promise.reject(ex.response.data)
      } finally {
        this.isLoading = false
      }
    }
  }
})
