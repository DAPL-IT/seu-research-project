import axios from 'axios'
import storage from './SessionStorage'
import { useLoginStore } from '../stores/LoginStore'

const BASE_URL = 'http://127.0.0.1:8000/api/'

const API = axios.create({
  baseURL: BASE_URL,
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json'
  },
  withCredentials: true
})

API.interceptors.request.use((config) => {
  const loginStore = useLoginStore()
  if (storage.keyExists('surface_user_auth_token') && loginStore.user.isLoggedIn) {
    config.headers.Authorization = `Bearer ${storage.get('surface_user_auth_token')}`
  }
  return config
})

export default API
