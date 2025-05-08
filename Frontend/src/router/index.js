import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '@/views/HomeView.vue';

function checkIfNotLogged(to, from, next) {
  const store = useAuthStore();

  if (!store.user) {
    return next("/login"); // Ha nincs bejelentkezve, átirányít a bejelentkezési oldalra
  }

  // Ha admin jogosultságú oldalra próbál belépni a felhasználó, és nem admin
  if (to.meta.requiresAdmin && store.roleId !== 1) {
    return next("/"); // Ha nem admin, átirányítás a kezdőlapra
  }

  next(); // Ha minden rendben, folytatás
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
      path: '/konyvek',
      name: 'konyvek',
      component: () => import('../views/KonyvView.vue'),
    },
    {
      path: '/diakok',
      name: 'diakok',
      component: () => import('../views/DiakView.vue'),
    },
    {
      path: '/evfolyamok',
      name: 'evfolyamok',
      component: () => import('../views/EvfolyamView.vue'),
    },
    {
      path: '/kolcsonzesek',
      name: 'koclsonzesek',
      component: () => import('../views/KolcsonzesView.vue'),
    },
    
  ],
})

export default router
