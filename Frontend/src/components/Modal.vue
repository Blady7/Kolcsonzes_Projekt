<template>
  <div
    class="modal fade"
    id="modal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    :inert="!isOpen"
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
import { Modal } from "bootstrap"; // Importáld a Bootstrap Modal osztályt

export default {
  props: ["title", "yes", "no", "size"],
  emits: ["yesEvent", "noEvent", "close"],
  data() {
    return {
      modalInstance: null,
      isOpen: false, // Nyitott állapot figyelése
      triggerButton: null, // Eltároljuk a modált megnyitó elemet
    };
  },
  mounted() {
    this.modalInstance = new Modal(this.$el);
    this.$el.addEventListener("hidden.bs.modal", this.onHidden);
  },
  methods: {
    onHidden() {
      document.body.classList.remove("modal-open");
      const backdrop = document.querySelector(".modal-backdrop");
      if (backdrop) backdrop.remove();
    },
    show() {
      this.triggerButton = document.activeElement; // Elmentjük a fókuszban lévő elemet
      this.modalInstance.show(); // Bootstrap modal megjelenítése
      this.isOpen = true;
    },
    hide() {
      this.modalInstance.hide(); // Bootstrap modal elrejtése
      this.isOpen = false;
      this.restoreFocus(); // Visszaállítjuk a fókuszt
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
    restoreFocus() {
      if (this.triggerButton) {
        this.triggerButton.focus(); // Visszaállítjuk a fókuszt az előző elemre
      }
    },
  },
};
</script>

<style>
</style>
