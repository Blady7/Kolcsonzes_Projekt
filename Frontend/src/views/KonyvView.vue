<template>
  <div>
    <table class="my-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Költő</th>
          <th>Cím</th>
          <th>Évfolyam</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(book, index) in paginatedItems" :key="index">
          <td>{{ book.id }}</td>
          <td>{{ book.poet }}</td>
          <td>{{ book.title }}</td>
          <td>{{ book.groupId }}</td>
        </tr>
      </tbody>
    </table>

    <Paginator 
      :totalItems="items.length" 
      :itemsPerPage="20"
      :currentPage="currentPage"
      @page-changed="updatePage"
    />
  </div>
</template>

<script>
import Paginator from "@/components/Paginator.vue";
import axios from "axios";
import { BASE_URL } from "../helpers/baseUrls";

export default {
  components: { Paginator },
  data() {
    return {
      items: [],
      currentPage: 1,
      itemsPerPage: 20,
    };
  },
  computed: {
    paginatedItems() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      return this.items.slice(start, start + this.itemsPerPage);
    },
  },
  async mounted() {
    await this.getItems();
  },
  methods: {
    async getItems() {
      try {
        const response = await axios.get(`${BASE_URL}/books`);
        this.items = response.data.data;
      } catch (error) {
        console.error("Hiba történt az adatok lekérése közben:", error);
      }
    },
    updatePage(page) {
      this.currentPage = page;
    },
  },
};
</script>

<style scoped>
.container {
  margin-top: 40px;
  text-align: center;
}

th {
  background-color: #c19a6b;
  color: white;
  font-weight: bold;
  text-transform: uppercase;
}

td {
  color: #4a3b2d;
}
</style>