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
          <td>{{ book.poet }}</td>
          <td>{{ book.title }}</td>
          <td>{{ book.groupId }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import Papa from 'papaparse';

export default {
  data() {
    return {
      books: []
    };
  },
  mounted() {
    fetch('/database/csv/book.csv')
      .then(response => response.text())
      .then(csvData => {
        Papa.parse(csvData, {
          header: true,
          delimiter: ';',
          dynamicTyping: true,
          complete: (result) => {
            this.books = result.data;
          }
        });
      })
      .catch(error => console.error('Hiba a CSV beolvasásakor:', error));
  }
};
</script>

<style>
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}
th, td {
  border: 1px solid black;
  padding: 8px;
  text-align: left;
}
th {
  background-color: #f4f4f4;
}
</style>
