<template>
    <form
      @submit.prevent="onClickSubmit"
      class="row g-3 needs-validation was-validated"
    >
      <p v-if="debug">{{ itemForm }}</p>
  
      <div class="col-md-2 position-relative">
        <label for="poet" class="form-label">Költő:</label>
        <input
          type="text"
          class="form-control"
          id="poet"
          required
          v-model="itemForm.poet"
        />
      </div>
      <div class="col-md-4 position-relative">
        <label for="title" class="form-label">Cím:</label>
        <input
          type="text"
          class="form-control"
          id="title"
          required
          v-model="itemForm.title"
        />
      </div>

      <div class="col-md-4 position-relative">
        <label for="name" class="form-label">Kölcsönző:</label>
        <input
          type="text"
          class="form-control"
          id="name"
          required
          v-model="itemForm.name"
        />
      </div>
  
      <div class="col-md-4 position-relative">
        <label for="startingDate" class="form-label">Kikölcsönözve:</label>
        <input
          type="datetime-local"
          class="form-control"
          id="startingDate"
          required
          v-model="itemForm.startingDate"
        />
      </div>

      <div class="col-md-4 position-relative">
        <label for="endingDate" class="form-label">Vissza hozva:</label>
        <input
          type="datetime-local"
          class="form-control"
          id="endingDate"
          required
          v-model="itemForm.endingDate"
        />
      </div>

      <div class="col-md-4 position-relative">
        <label for="title" class="form-label">Olvasónapló:</label>
        <input
          type="text"
          class="form-control"
          id="opinion"
          required
          v-model="itemForm.opinion"
        />
      </div>
  
      <button type="submit" class="btn btn-success">Mentés</button>
    </form>
  </template>
  
  <script>
  export default {
    data() {
      return {
        
      };
    },
    props: ["itemForm", "debug", "rentals"],
    emits: ["saveItem"],
    methods: {
      onClickSubmit() {
        this.$emit("saveItem", this.itemForm);
      }
    },
  };
  </script>