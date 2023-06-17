import { defineStore } from 'pinia'
import API from '../composables/Axios'

export const useRentTypeStore = defineStore('rentTypeStore', {
  state: () => {
    return {
      rent_types: []
    }
  },
  actions: {
    async getAll() {
      try {
        const response = await API.get('rent-type-list')
        const data = await response.data
        this.rent_types = data.rent_types
        return data.rent_types
      } catch (ex) {
        return ex
      }
    }
  }
})
