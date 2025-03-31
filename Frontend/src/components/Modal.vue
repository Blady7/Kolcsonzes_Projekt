<template>
  <div
    class="modal fade"
    id="modal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="none"
  >
    <div
      class="modal-dialog modal-dialog-centered"
      :class="{
        'modal-xl': size == 'xl',
        'modal-lg': size == 'lg',
        'modal-sm': size == 'sm',
      }"
    >
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{ title }}</h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            @click="closeModal"
          ></button>
        </div>
        <div class="modal-body">
          <slot></slot>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
            v-if="no"
            @click="onClickNoButton"
          >
            {{ no }}
          </button>
          <button
            type="button"
            class="btn btn-primary"
            v-if="yes"
            @click="onClickYesButton"
          >
            {{ yes }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Modal } from 'bootstrap'; // Importáld a Bootstrap Modal osztályt

export default {
  props: ["title", "yes", "no", "size"],
  emits: ["yesEvent", "noEvent", "close"],
  data() {
    return {
      modalInstance: null,
    };
  },
  mounted() {
    this.modalInstance = new Modal(this.$el); // Inicializáld a Bootstrap Modal-t a komponens root elemén
  },
  methods: {
    show() {
      this.modalInstance.show(); // Bootstrap modal megjelenítése
    },
    hide() {
      this.modalInstance.hide(); // Bootstrap modal elrejtése
    },
    onClickYesButton() {
      this.$emit("yesEvent");
    },
    onClickNoButton() {
      this.$emit("noEvent");
      this.hide(); // Automatikus elrejtés "Nem" gombra kattintva
    },
    closeModal() {
      this.$emit("close");
      this.hide(); // Automatikus elrejtés a bezár gombra kattintva
    },
  },
};
</script>

<style>
</style>