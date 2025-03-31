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
  props: ["itemForm", "debug"],
  emits: ["saveItem"],
  methods: {
    onClickSubmit() {
      this.$emit("saveItem", this.itemForm);
    },
  },
};
</script>