<script setup>
import { RouterLink, RouterView } from "vue-router";
import { useCounterStore } from "@/stores/counter";
import { useAuthStore } from "@/stores/useAuthStore.js";
import axios from "axios";
import { BASE_URL } from "@/helpers/baseUrls";
import { useRouter } from 'vue-router'; // Importáld a useRouter hook-ot

const state = useCounterStore();
const stateAuth = useAuthStore();
const router = useRouter(); // Inicializáld a routert

async function Logout() {
  const url = `${BASE_URL}/users/logout`;
  const headers = {
    Accept: "application/json",
    Authorization: `Bearer ${stateAuth.token}`,
  };
  try {
    await axios.post(url, null, { headers });
  } catch (error) {
    console.error("Error:", error);
  }
  stateAuth.clearStoredData();
  router.push('/'); // Használd a router.push-t a navigációhoz
}
</script>

<template>
  <div class="container-fluid p-0">
    <header>
      <div class="wrapper">
        <div class="logo">
          <RouterLink to="/">Könyvkölcsönző</RouterLink>
        </div>
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Menü
          </button>
          <ul class="dropdown-menu">
            <li v-if="stateAuth.user"><RouterLink to="/konyvek" class="dropdown-item">Könyvek <i class="bi bi-book"></i></RouterLink></li>
            <li v-if="stateAuth.user"><RouterLink to="/diakok" class="dropdown-item">Diákok <i class="bi bi-person-lines-fill"></i></RouterLink></li>
            <li v-if="stateAuth.user"><RouterLink to="/kolcsonzesek" class="dropdown-item">Kölcsönzések <i class="bi bi-archive"></i></RouterLink></li>
            <li v-if="stateAuth.user"><RouterLink to="/olvasonaplo" class="dropdown-item">Olvasónaplók <i class="bi bi-book-half"></i></RouterLink></li>
            <li v-if="stateAuth.user"><RouterLink to="/evfolyamok" class="dropdown-item">Groups <i class="bi bi-people-fill"></i></RouterLink></li>
          </ul>
        </div>
        
      </div>
    </header>

    <RouterView />
  </div>
</template>

<style scoped>

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html,


.wrapper {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 30px;
  background-color: rgba(240, 162, 79, 0.8);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  z-index: 10;
}

.logo a {
  font-size: 32px;
  color: #164652;
  text-decoration: none;
  font-weight: 600;
  letter-spacing: 1px;
}

nav {
  display: flex;
}

nav ul {
  display: flex;
  list-style: none;
  margin: 0;
}

nav li {
  margin-left: 20px;
}

.nav-link {
  color: #164652;
  text-decoration: none;
  font-size: 18px;
  padding: 10px 15px;
  border-radius: 6px;
  transition: background-color 0.3s ease, color 0.3s ease;
}

.nav-link:hover {
  background-color: #164652;
  color: #fff;
}

@media (max-width: 768px) {
  nav {
    display: none;
  }

  .wrapper {
    justify-content: space-between;
  }

  nav ul {
    display: block;
    width: 100%;
    text-align: center;
  }

  nav li {
    margin: 10px 0;
  }

  .nav-link {
    display: block;
    padding: 15px;
    font-size: 18px;
  }

  .hamburger {
    display: block;
    cursor: pointer;
    font-size: 30px;
    color: #fff;
  } 
}
</style>