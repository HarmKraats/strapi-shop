import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/over',
    name: 'over',
    component: () => import('../views/AboutView.vue')
  },
  {
    path: '/shop',
    name: 'shop',
    component: () => import('../views/ProductsView.vue')
  },
  // A route for the product details page. like products/this-product
  {
    path: '/product/:id',
    name: 'productDetails',
    component: () => import('../views/ProductView.vue'),
  },
  // {
  //   path: '/cart',
  //   name: 'cart',
  //   component: () => import('../views/CartView.vue')
  // },
  // {
  //   path: '/checkout',
  //   name: 'checkout',
  //   component: () => import('../views/CheckoutView.vue')
  // },
  {
    path: '/:pathMatch(.*)*',
    name: 'not-found',
    component: () => import('../views/NotFoundView.vue')
  }

]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
