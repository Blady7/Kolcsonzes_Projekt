<template>
  <div class="pagination">
    <button @click="prevPage" :disabled="currentPage === 1">Előző</button>

    <span v-for="page in totalPages" :key="page">
      <button
        @click="changePage(page)"
        :class="{ active: page === currentPage }"
      >
        {{ page }}
      </button>
    </span>

    <button @click="nextPage" :disabled="currentPage === totalPages">
      Következő
    </button>
  </div>
</template>
  
  <script>
export default {
  props: {
    totalItems: {
      type: Number,
      required: true,
    },
    itemsPerPage: {
      type: Number,
      required: true,
      default: 10,
    },
    currentPage: {
      type: Number,
      required: true,
    },
  },
  computed: {
    totalPages() {
      return Math.ceil(this.totalItems / this.itemsPerPage);
    },
  },
  methods: {
    changePage(page) {
      if (page !== this.currentPage) {
        this.$emit("page-changed", page);
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.$emit("page-changed", this.currentPage - 1);
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.$emit("page-changed", this.currentPage + 1);
      }
    },
  },
};
</script>
  
<style scoped>
/* 🏛️ Könyvtári katalógus stílusú lapozó */
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px;
  width: 100%;
  padding: 12px 0;
  background: #f5e6c8; /* Sárgás papír hatás */
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

/* 📖 Gombok - Régi könyvtári katalóguscédula stílus */
button {
  padding: 8px 12px;
  font-size: 14px;
  font-family: "Times New Roman", serif;
  font-weight: bold;
  border-radius: 4px;
  border: 1px solid #8b5e3c; /* Barna szegély */
  background-color: #c19a6b; /* Világosbarna háttér */
  color: white;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
  text-transform: uppercase;
  box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
}

button:hover {
  background-color: #a07355; /* Sötétebb barna */
}

button.active {
  background-color: #8b5e3c; /* Mély barna */
  color: white;
  border-color: #6b4b2a;
}

button:disabled {
  background-color: #e0c9a6; /* Elszínezett katalóguscímke hatás */
  color: #6b4b2a;
  border-color: #d1b58c;
  cursor: not-allowed;
  box-shadow: none;
}

/* 🏛️ Reszponzív beállítások */
@media (max-width: 768px) {
  button {
    font-size: 12px;
    padding: 6px 10px;
  }
}
</style>

  

  