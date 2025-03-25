<template>
    <div>
      <h1>Diákok</h1>
      <table class="table table-striped-columns table-hover">
        <thead>
          <tr class="text-center">
            <th></th>
            <th>Név</th>
            <th>Osztály</th>
            <th>Osztályfőnök</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(user, index) in users" :key="index">
            <th scope="row">{{ index + 1 }}</th>
            <td>{{ user.nev }}</td>
            <td>{{ user.osztalyNev }}</td>
            <td>{{ user.osztalyfonok }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  import { BASE_URL } from "../helpers/baseUrls";
  import axios from "axios";
  
  export default {
    data() {
      return {
        urlApi: BASE_URL,
        users: [],
      };
    },
    async mounted() {
      await this.getStudents();
    },
    methods: {
      async getStudents() {
        const headers = {
        Accept: 'application/json',
        'Content-Type': 'application/json'
      }
        try {
          const url = `${this.BASE_URL}/users`;
          const response = await axios.get(url, this.users, headers);
          this.users = response.data.data;
          console.log(this.users);
        } catch (error) {
          console.error("Hiba történt az adatok lekérése közben:", error);
          // Itt érdemes lehet kezelni a 401-es hibát, pl. átirányítani a bejelentkezési oldalra
          if (error.response && error.response.status === 401) {
            console.warn("Nincs jogosultság az adatok lekéréséhez.");
            // Például: this.$router.push('/login');
          }
        }
      },
    },
  };
  </script>
  
  <style>
  </style>