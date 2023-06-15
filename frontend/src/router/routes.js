import { createRouter, createWebHistory } from 'vue-router'
import { useLoginStore } from '../stores/LoginStore'

// const routeAuthGuard = (to, from, next) => {
//   const loginStore = useLoginStore()
//   const isLoggedIn = loginStore.user.isLoggedIn
//   if (isLoggedIn) {
//     next()
//   } else {
//     next('/')
//   }
// }

const redirectIfAlredyLoggedIn = (to, from, next) => {
  const loginStore = useLoginStore()
  const isLoggedIn = loginStore.user.isLoggedIn
  if (isLoggedIn) {
    next('/')
  } else {
    next()
  }
}

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/HomeView.vue')
    },
    {
      path: '/ad-details/:id',
      name: 'ad_details',
      component: () => import('../views/AdDetailsView.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/LoginView.vue'),
      beforeEnter: redirectIfAlredyLoggedIn
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/RegisterView.vue'),
      beforeEnter: redirectIfAlredyLoggedIn
    },
    {
      path: '/search',
      name: 'search',
      component: () => import('../views/SearchView.vue')
    },
    {
      path: '/:catchAll(.*)',
      name: 'not_found',
      component: () => import('../views/NotFoundView.vue')
    }
  ]
})

export default router
