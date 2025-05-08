<template>
  <form @submit.prevent="onClickSubmit" class="row g-3 needs-validation was-validated">
    <p v-if="debug">{{ itemForm }}</p>

    <div class="col-md-4 position-relative">
      <label for="specimenId" class="form-label">Könyv ID:</label>
      <input
        type="number"
        class="form-control"
        id="specimenId"
        required
        v-model="itemForm.specimenId"
      />
    </div>

    <div class="col-md-4 position-relative">
      <label for="userId" class="form-label">Diák ID:</label>
      <input
        type="number"
        class="form-control"
        id="userId"
        required
        v-model="itemForm.userId"
      />
    </div>

    <div class="col-md-4 position-relative">
      <label for="startingDate" class="form-label">Kikölcsönözve:</label>
      <input type="datetime-local" class="form-control" id="startingDate" required v-model="itemForm.startingDate" />
    </div>

    <div class="col-md-4 position-relative">
      <label for="endingDate" class="form-label">Vissza hozva:</label>
      <input type="datetime-local" class="form-control" id="endingDate" required v-model="itemForm.endingDate" />
    </div>

    <div class="col-md-4 position-relative">
      <label for="opinion" class="form-label">Olvasónapló:</label>
      <input type="text" class="form-control" id="opinion" required v-model="itemForm.opinion" />
    </div>

    <button type="submit" class="btn btn-success">Mentés</button>
  </form>
</template>

<script>
export default {
  props: ["itemForm", "debug"], // Eltávolítottuk a books és students prop-okat
  emits: ["saveItem"],
  methods: {
    onClickSubmit() {
      this.$emit("saveItem", this.itemForm);
    },
  },
};
</script>