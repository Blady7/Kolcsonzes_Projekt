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

</style>

  

  