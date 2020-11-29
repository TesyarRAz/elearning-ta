import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
  {
    path: '/login',
    name: 'Login', 
    component: () => import('../views/Login.vue'),
    meta: {
      auth: false
    }
  },
  {
    path: '/register',
    name: 'Register', 
    component: () => import('../views/Register.vue'),
    meta: {
      auth: false
    }
  },
  {
    path: '/modul/:id',
    name: 'Modul Join',
    component: () => import('../views/ModulJoin.vue'),
    meta: {
      auth: true
    }
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
