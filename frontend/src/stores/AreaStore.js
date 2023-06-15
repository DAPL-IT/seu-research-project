import { defineStore } from 'pinia'
import API from '../composables/Axios'

export const useAreaStore = defineStore('areaStore', {
  state: () => {
    return {
      searched_areas: []
    }
  },
  actions: {
    async search(val) {
      try {
        const response = await API.post('area-search', { q: val })
        const data = await response.data
        this.searched_areas = data.areas
        return data.areas
      } catch (ex) {
        return ex
      }
    }
  }
})
