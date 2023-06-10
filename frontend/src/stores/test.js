import { defineStore } from 'pinia'

export const useTestStore = defineStore('test', {
  state: () => {
    return {
      name: 'Saleh',
      counter: 0
    }
  },
  actions: {
    increment() {
      this.counter++
    }
  },
  getters: {
    multiply(state) {
      return state.counter * state.counter
    }
  }
})
