<template>
  <div>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Költő</th>
          <th>Cím</th>
          <th>Évfolyam</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(book, index) in paginatedBooks" :key="index">
          <td>{{ book.id }}</td>
          <td>{{ book.poet }}</td>
          <td>{{ book.title }}</td>
          <td>{{ book.groupId }}</td>
        </tr>
      </tbody>
    </table>

    <Paginator 
      :totalItems="books.length" 
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
      books: [],
      currentPage: 1,
      itemsPerPage: 20,
    };
  },
  computed: {
    paginatedBooks() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      return this.books.slice(start, start + this.itemsPerPage);
    },
  },
  async mounted() {
    await this.getBooks();
  },
  methods: {
    async getBooks() {
      try {
        const response = await axios.get(`${BASE_URL}/books`);
        this.books = response.data.data || response.data;
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
/* Táblázat stílusok */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  background: white;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

th, td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #007bff;
  color: white;
  font-weight: bold;
}

tbody tr:hover {
  background-color: #f1f1f1;
  transition: 0.2s;
}

/* Paginator pozícionálása */
.pagination-container {
  display: flex;
  justify-content: center;
  margin-top: 20px;
}

/* Lapozó gombok */
button {
  padding: 10px 15px;
  border: 2px solid #007bff;
  background-color: white;
  color: #007bff;
  font-size: 16px;
  font-weight: bold;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
  box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
  margin: 0 5px;
}

button:hover {
  background-color: #007bff;
  color: white;
}

button.active {
  background-color: #0056b3;
  color: white;
  border-color: #0056b3;
}

button:disabled {
  background-color: #ccc;
  color: #666;
  border-color: #ccc;
  cursor: not-allowed;
  box-shadow: none;
}

/* Reszponzív beállítások */
@media (max-width: 768px) {
  table {
    font-size: 14px;
  }
  
  button {
    font-size: 14px;
    padding: 8px 12px;
  }
}
</style>
