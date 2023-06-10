import { defineStore } from 'pinia'
import API from '../composables/Axios'

export const useAdsStore = defineStore('adsStore', {
  state: () => {
    return {
      ads: [],
      ad: {},
      isFetching: false,
      lastPage: null,
      currPage: 1
    }
  },
  actions: {
    async getAll(page = 1) {
      this.isFetching = true
      try {
        const response = await API.post('ads', { page: page })
        const data = await response.data
        this.ads = data.ads.data
        this.currPage = page
        this.lastPage = data.ads.last_page
        return response
      } catch (ex) {
        return ex
      } finally {
        this.isFetching = false
      }
    },
    async getSingle(id) {
      this.isFetching = true
      try {
        const response = await API.post('ad', { id: id })
        const data = await response.data
        this.ad = data.ad
        return response
      } catch (ex) {
        return ex
      } finally {
        this.isFetching = false
      }
    }
  }
})
