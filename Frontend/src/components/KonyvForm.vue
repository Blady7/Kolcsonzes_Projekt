<template>
  <form
    @submit.prevent="onClickSubmit"
    class="row g-3 needs-validation was-validated"
  >
    <p v-if="debug">{{ itemForm }}</p>
    <div class="col-md-4 position-relative">
      <label for="tittle" class="form-label">Cím:</label>
      <input
        type="text"
        class="form-control"
        id="tittle"
        required
        v-model="itemForm.tittle"
      />
    </div>

    <div class="col-md-2 position-relative">
      <label for="poet" class="form-label">író:</label>
      <input
        type="text"
        class="form-control"
        id="poet"
        required
        v-model="itemForm.poet"
      />
    </div>

    <div class="col-md-2 position-relative">
      <label for="groupId" class="form-label">Évfolyam:</label>
      <input
        type="text"
        class="form-control"
        id="groupId"
        required
        v-model="itemForm.groupId"
      />
    </div>
    <button type="submit" class="btn btn-success">Mentés</button>
  </form>
</template>

<script>
export default {
  props: ["itemForm", "items", "debug"],
  emits: ["saveItem"],
  methods: {
    onClickSubmit() {
      this.$emit("saveItem", this.itemForm);
    },
  },
};
</script>