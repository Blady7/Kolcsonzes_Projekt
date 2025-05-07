<template>
    <form @submit.prevent="onClickSubmit" class="row g-4 needs-validation was-validated">
      <p v-if="debug">{{ itemForm }}</p>
      <div class="col-md-8 position-relative">
        <label for="group" class="form-label">Évfolyam:</label>
        <input
          type="text"
          class="form-control"
          id="group"
          required
          v-model="itemForm.group"
        />
      </div>
      <div class="col-md-8 position-relative">
        <label for="techerId" class="form-label">Tanárok:</label>
        <input
          type="text"
          class="form-control"
          id="techerId"
         
          v-model="itemForm.teacherId"
        />
      </div>
      <button type="submit" class="btn btn-success">Mentés</button>
    </form>
  </template>
  
  <script>
  export default {
    props: ["itemForm", "debug"],
    emits: ["saveItem"],
    methods: {
      onClickSubmit() {
        this.$emit("saveItem", this.itemForm);
      },
    },
  };
  </script>
  
  <style>
  </style>
  