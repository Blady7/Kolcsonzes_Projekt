<script setup>
import { RouterLink, RouterView } from "vue-router";
import { useCounterStore } from "@/stores/counter";
import { useAuthStore } from "@/stores/useAuthStore.js";
import axios from "axios";
import { BASE_URL } from "@/helpers/baseUrls";

const state = useCounterStore();
const stateAuth = useAuthStore();

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
  this.$router.push("/");
}
</script>

<template>
  <div class="container-fluid p-0">
    <!-- Fejléc -->
    <header>
      <div class="wrapper">
        <div class="logo">
          <RouterLink to="/">Könyvkölcsönző</RouterLink>
        </div>
        <nav>
          <ul>
            <li>
              <RouterLink to="/konyvek" class="nav-link" v-if="stateAuth.user">
                Könyvek <i class="bi bi-book"></i>
              </RouterLink>
            </li>
            <li>
              <RouterLink to="/diákok" class="nav-link" v-if="stateAuth.user">
                Diákok <i class="bi bi-person-lines-fill"></i>
              </RouterLink>
            </li>
            <li>
              <RouterLink
                to="/olvasónapló"
                class="nav-link"
                v-if="stateAuth.user"
              >
                Olvasónaplók <i class="bi bi-book-half"></i>
              </RouterLink>
            </li>
            <li>
              <RouterLink to="/login" class="nav-link" v-if="!stateAuth.user">
                <i class="bi bi-bookmark"></i>
              </RouterLink>
            </li>
            <li>
              <RouterLink
                class="nav-link"
                to="#"
                @click="Logout()"
                v-if="stateAuth.user"
              >
                <i class="bi bi-bookmark-check"></i>
              </RouterLink>
            </li>
          </ul>
        </nav>
      </div>
    </header>

    <!-- Tartalom -->
    <RouterView />
  </div>
</template>

<style scoped>
/* Alap stílusok */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html,


/* Fejléc és navigáció */
.wrapper {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 30px;
  background-color: rgba(240, 162, 79, 0.8); /* Átlátszó barna háttér */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  z-index: 10; /* Fejléc fölé helyezés */
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

/* Mobil reszponzív menü */
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
