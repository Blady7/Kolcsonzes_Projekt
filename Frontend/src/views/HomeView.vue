<template>
  <div class="home-container">
    <h2 class="home-title">Üdvözöljük a Könyvkölcsönzőben!</h2>
    <p class="home-description">
      Fedezze fel könyvek széles választékát, és merüljön el az olvasás világában.
    </p>
  </div>
</template>




<style scoped>
.home-container {
  max-width: 1200px;
  margin: 40px auto;
  padding: 20px;
  text-align: center;
}

.home-title {
  font-size: 36px;
  font-weight: 600;
  margin-bottom: 20px;
  color: #2c3e50;
}

.home-description {
  font-size: 18px;
  color: #555;
  margin-bottom: 30px;
}

.featured-books {
  margin-bottom: 40px;
}

.featured-title {
  font-size: 28px;
  font-weight: 600;
  margin-bottom: 20px;
  color: #2c3e50;
}

.book-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 20px;
}

.book-item {
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  padding: 20px;
}

.book-image {
  max-width: 100%;
  height: auto;
  margin-bottom: 15px;
}

.book-title {
  font-size: 20px;
  margin-bottom: 10px;
  color: #2c3e50;
}

.book-author {
  font-size: 16px;
  color: #555;
}
</style>