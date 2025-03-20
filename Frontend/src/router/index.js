import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '@/views/HomeView.vue';

function checkIfNotLogged() {
  const storeAuth = useAuthStore();
  if (!storeAuth.user) {
    return "/login";
  } else {
    
  }
}

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue'),
    },
    {
      path: '/login',
      name: 'login',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('@/components/Auth/Login.vue'),
      meta: {title: (route) => 'Login'}
    },
    {
      path: '/könyvek',
      name: 'könyvek',
      component: () => import('../views/KonyvView.vue'),
    },
    {
      path: '/diákok',
      name: 'diákok',
      component: () => import('../views/DiakView.vue'),
    },
    {
      path: '/olvasónapló',
      name: 'olvasónapló',
      component: () => import('../views/OlvasonaploView.vue'),
    },
    
  ],
})

export default router
