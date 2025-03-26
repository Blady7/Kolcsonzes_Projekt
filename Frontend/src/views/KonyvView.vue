<template>
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
      <tr v-for="(book, index) in allBooks" :key="index">
        <td>{{ book.id }}</td>
        <td>{{ book.poet }}</td>
        <td>{{ book.title }}</td>
        <td>{{ book.groupId }}</td>
      </tr>
    </tbody>
  </table>
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
    fetch("/database/csv/books.csv") 
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