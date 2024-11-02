import { defineStore } from 'pinia'
import API from '../composables/Axios'

export const useAdsStore = defineStore('adsStore', {
  state: () => {
    return {
      ads: [],
      ad: {},
      isFetching: false,
      lastPage: null,
      currPage: 1,
      searched_ads: [],
      isSearching: false,
      isSubmitting: false,
      user_ads: []
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
    },
    async search(q) {
      this.isSearching = true
      try {
        const response = await API.post('search', {
          ...q
        })
        const data = await response.data
        this.currPage = q.page
        this.lastPage = data.ads.last_page
        this.searched_ads = data.ads.data
        //console.log(data)
        return data.ads
      } catch (ex) {
        return ex
      } finally {
        this.isSearching = false
      }
    },
    async add(body) {
      this.isSubmitting = true
      try {
        const response = await API.post('create-ad', body, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        })
        return response.data
      } catch (ex) {
        return Promise.reject(ex.response.data.validation)
      } finally {
        this.isSubmitting = false
      }
    },
    async getAdsByUser() {
      this.isFetching = true
      try {
        const response = await API.get('user-ads')
        const data = await response.data
        this.user_ads = data.ads
        return data.ads
      } catch (ex) {
        return ex
      } finally {
        this.isFetching = false
      }
    },
    async deleteByUser(id) {
      try {
        const response = await API.delete(`user-ads-delete/${id}`)
        const data = await response.data
        return data
      } catch (ex) {
        return Promise.reject(ex.response.data)
      }
    }
  }
})
