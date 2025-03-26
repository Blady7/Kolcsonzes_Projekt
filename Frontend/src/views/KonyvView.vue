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
/* 📚 Általános konténer */
.container {
  margin-top: 40px; /* Lentebb toltuk a táblázatot */
  text-align: center;
}

/* 📚 Könyvtári táblázat stílus */
table {
  width: 90%;
  max-width: 800px;
  margin: 30px auto; /* Lentebb helyezés */
  border-collapse: collapse;
  background: #f5e6c8; /* Sárgás papír szín */
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  font-family: 'Times New Roman', serif;
}

th, td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #8b5e3c; /* Barna vonalak */
}

th {
  background-color: #c19a6b; /* Világosbarna fejléc */
  color: white;
  font-weight: bold;
  text-transform: uppercase;
}

td {
  color: #4a3b2d; /* Sötétebb barna betűszín */
}

tbody tr:hover {
  background-color: #e3d5b7; /* Enyhe sárgás kiemelés */
  transition: 0.2s;
}

tbody tr:nth-child(odd) {
  background-color: #f9f0dd; /* Enyhén eltérő sávos háttér */
}

/* 📖 Könyvtári stílusú lapozó */
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px;
  width: 100%;
  padding: 12px 0;
  background: #f5e6c8;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

button {
  padding: 8px 12px;
  font-size: 14px;
  font-family: 'Times New Roman', serif;
  font-weight: bold;
  border-radius: 4px;
  border: 1px solid #8b5e3c;
  background-color: #c19a6b;
  color: white;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}

button:hover {
  background-color: #a07355;
}

button.active {
  background-color: #8b5e3c;
  color: white;
  border-color: #6b4b2a;
}

button:disabled {
  background-color: #e0c9a6;
  color: #6b4b2a;
  border-color: #d1b58c;
  cursor: not-allowed;
}

/* 🏛️ Reszponzív beállítások */
@media (max-width: 768px) {
  table {
    font-size: 14px;
  }

  button {
    font-size: 12px;
    padding: 6px 10px;
  }
}
</style>
