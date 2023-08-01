import { createRouter, createWebHashHistory, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
  // {
  //   path: '/',
  //   name: 'home',
  //   component: HomeView
  // },
  // {
  //   path: '/over',
  //   name: 'over',
  //   component: () => import('../views/AboutView.vue')
  // },
  {
    path: '/shop',
    name: 'shop',
    component: () => import('../views/ProductsView.vue')
  },
  {
    path: '/shop/:slug',
    name: 'productDetails',
    component: () => import('../views/ProductView.vue'),
  },
  // {
  //   path: '/blog',
  //   name: 'blog',
  //   component: () => import('../views/BlogsView.vue'),
  // },
  // {
  //   path: '/blog/:urlSlug',
  //   name: 'blogDetails',
  //   component: () => import('../views/BlogView.vue'),
  //   props: true,
  // },
  {
    path: '/cart',
    name: 'cart',
    component: () => import('../views/CartView.vue')
  },

  {
    path: '/checkout',
    name: 'checkout',
    component: () => import('../views/CheckoutView.vue')
  },

  // success page
  {
    path: '/success',
    name: 'success',
    component: () => import('../views/SuccessView.vue')
  },
  {
    path: '/cancel',
    name: 'cancel',
    component: () => import('../views/CancelView.vue')
  },



  {
    path: '/:slug', // Dynamic route for all page slugs
    name: 'page',
    component: () => import('../views/PageView.vue')
  },

  {
    path: '/:pathMatch(.*)*',
    name: 'not-found',
    component: () => import('../views/NotFoundView.vue')
  }





]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
