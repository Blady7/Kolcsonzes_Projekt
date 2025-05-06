<template>
  <form
    @submit.prevent="onClickSubmit"
    class="row g-3 needs-validation was-validated"
  >
    <p v-if="true">{{ itemForm }} </p>

    <div class="col-md-3 position-relative">
      <label for="poet" class="form-label">Neve:</label>
      <input
        type="text"
        class="form-control"
        id="poet"
        required
        v-model="itemForm.name"
      />
    </div>
    <div class="col-md-2 position-relative">
      <label for="groupId" class="form-label">Évfolyam:</label>
      <select
        class="form-control"
        id="groupId"
        required
        v-model="itemForm.groupId"
      >
        <option v-for="group in groups" :key="group.id" :value="group.id">
          {{ group.group }}
        </option>
      </select>
    </div>

    <div class="col-md-4 position-relative">
      <label for="title" class="form-label">Email:</label>
      <input
        type="text"
        class="form-control"
        id="title"
        required
        v-model="itemForm.email"
      />
    </div>

    <div class="col-md-3 position-relative">
      <label for="title" class="form-label">Jelszó:</label>
      <input
        type="text"
        class="form-control"
        id="title"
        required
        v-model="itemForm.password"
      />
    </div>

    <button type="submit" class="btn btn-success">Mentés</button>
  </form>
</template>

<script>
import { DEBUG } from "../helpers/debug";
export default {
  data() {
    return {
      debug:DEBUG,
    };
  },
  props: ["itemForm", "debug","groups"],
  emits: ["saveItem"],
  methods: {
    onClickSubmit() {
      this.$emit("saveItem", this.itemForm);
    }
  },
};
</script>