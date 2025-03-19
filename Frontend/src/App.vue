<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
</script>

<template>
  <div class="container-fluid my-border my-container">
    <h1>Online Könyvkölcsönző</h1>

    <Menu />
    <div class="my-border p-2">
      <RouterView />
    </div>
  </div>
</template>

<style scoped>

</style>
