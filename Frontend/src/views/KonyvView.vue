<template>
  <div>
    <h2>Könyvek listája</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Szerző</th>
          <th>Cím</th>
          <th>Évfolyam</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="book in books" :key="book.id">
          <td>{{ book.id }}</td>
          <td>{{ book.poet || book.author }}</td>
          <!-- Ha más a mezőnév -->
          <td>{{ book.title }}</td>
          <td>{{ book.groupId || book.group }}</td>
          <!-- Ha más a mezőnév -->
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import Papa from "papaparse";

export default {
  data() {
    return {
      books: [],
    };
  },
  mounted() {
    fetch("/database/csv/books.csv") // Frissítsd az elérési utat!
      .then((response) => {
        if (!response.ok)
          throw new Error(`HTTP error! status: ${response.status}`);
        return response.text();
      })
      .then((csvData) => {
        Papa.parse(csvData, {
          header: true,
          delimiter: ";",
          complete: (result) => {
            console.log("Sikeresen feldolgozva:", result.data);
            this.books = result.data;
          },
          error: (error) => {
            console.error("CSX hiba:", error);
          },
        });
      })
      .catch((error) => {
        console.error("Fetch hiba:", error);
      });
  },
};
</script>

<style>
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}
th,
td {
  border: 1px solid black;
  padding: 8px;
  text-align: left;
}
th {
  background-color: #f4f4f4;
}
</style>