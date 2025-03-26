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

.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 5px;
  width: 100%;
  padding: 10px 0;
}

button {
  padding: 5px 10px;
  font-size: 14px;
  font-weight: normal;
  border-radius: 5px;
  border: 1px solid #007bff;
  background-color: white;
  color: #007bff;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
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
</style>
  

  