<template>
  <div class="contanier">
    <div class="row my-5">
      <div class="col-md-6 mx-auto">
        <div class="card">
          <h5 class="card-header">Login</h5>
          <div class="card-body">
            <form @submit.prevent="userAuth">
              <div class="form-group mb-3">
                <input
                  type="text"
                  v-model="user.email"
                  placeholder="Email*"
                  class="form-control"
                />
              </div>
              <div class="form-group mb-3">
                <input
                  type="password"
                  v-model="user.password"
                  placeholder="Password*"
                  class="form-control"
                />
              </div>
              <div class="form-group mb-3">
                <div class="d-flex align-items-center">
                  <button type="submit" class="btn btn-primary me-4">
                    Login
                  </button>

                  <div
                    class="spinner-border m-0 p-0"
                    role="status"
                    v-if="errorMessage == '...'"
                  >
                    <span class="visually-hidden m-0">Loading...</span>
                  </div>
                  <span v-if="errorMessage != '...'">{{ errorMessage }}</span>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useAuthStore } from "../../stores/useAuthStore.js";
import axios from "axios";
import { BASE_URL } from "../../helpers/baseUrls";
export default {
  data() {
    return {
      user: {
        email: "admin@gmail.com",
        password: "admin",
      },
      store: useAuthStore(),
      errorMessage: null,
    };
  },
  methods: {
    async userAuth() {
      this.errorMessage = "...";
      const url = `${BASE_URL}/users/login`;
      const headers = {
        Accept: "application/json",
        "Content-Type": "application/json",
      };

      try {
        const response = await axios.post(url, this.user, { headers });

        // Kiírjuk a teljes választ, hogy lássuk mi van benne
        console.log("Full response:", response);

        // Ellenőrizzük, hogy a válasz tartalmazza-e a várt adatokat
        if (response.data) {
          console.log("Response Data:", response.data); // Nézd meg a 'data' részt

          // Ellenőrizzük, hogy van-e hibaüzenet a válaszban
          if (response.data.error) {
            this.errorMessage = response.data.error;
            console.error("Error in response:", response.data.error);
            return;
          }

          // Ha nincs 'user' objektum, akkor próbáljunk meg más adatokat keresni

          // Ellenőrizzük, hogy az 'id' valóban létezik-e
          if (response.data && response.data.data) {
            const userData = response.data.data;
            this.store.setId(userData.id);
            this.store.setUser(userData.name);
            this.store.setToken(userData.token);
            this.errorMessage = "Successful login!";
            this.$router.push("/");
          } else {
            this.errorMessage = "User data is missing in the response.";
            console.error("User data is missing:", response.data);
          }
        }
      } catch (error) {
        console.error("Error:", error);
        this.errorMessage = "Login failed";
        this.store.clearStoredData();
      }
    },
  },
};
</script>

<style>
</style>