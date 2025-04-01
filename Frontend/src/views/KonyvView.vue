<template>
  <div>
    <h1 class="text-center my-4">Könyvek</h1>
    <ErrorMessage
      :errorMessages="errorMessages"
      @close="onClickCloseErrorMessage"
    />

    <div>
      <table class="my-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Költő</th>
            <th>Cím</th>
            <th>Évfolyam</th>
            <th>Műveletek</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in paginatedItems" :key="index">
            <td>{{ item.id }}</td>
            <td>{{ item.poet }}</td>
            <td>{{ item.title }}</td>
            <td>{{ item.groupId }}</td>
            <td class="text-nowrap text-center">
              <Operations
                @onClickDeleteButton="onClickDeleteButton"
                @onClickUpdate="onClickUpdate"
                @onClickCreate="onClickCreate"
                :data="item"
              />
            </td>
          </tr>
        </tbody>
      </table>

      <Paginator
        :totalItems="items.length"
        :itemsPerPage="20"
        :currentPage="currentPage"
        @page-changed="updatePage"
      />

      <Modal
        ref="myModal"
        :title="title"
        :yes="yes"
        :no="no"
        :size="size"
        @yesEvent="yesEventHandler"
        @close="hideModal"
      >
        <div v-if="state == 'Delete'">
          {{ messageYesNo }}
        </div>

        <ItemForm
          v-if="state == 'Create' || state == 'Update'"
          :itemForm="item"
          :debug="debug"
          @saveItem="saveItemHandler"
        />
      </Modal>

      <div class="d-flex justify-content-center my-3">
        <div class="pagination-container d-flex">
          <div
            v-for="page in totalPages"
            :key="page"
            @click="goToPage(page)"
            :class="['page-box', { 'active-page': currentPage === page }]"
          >
            {{ page }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Paginator from "@/components/Paginator.vue";
import axios from "axios";
import { DEBUG } from "../helpers/debug";
import { BASE_URL } from "../helpers/baseUrls";
import ItemForm from "@/components/KonyvForm.vue";
import ErrorMessage from "@/components/ErrorMessage.vue";
import Operations from "@/components/Operations.vue";
import { useAuthStore } from "@/stores/useAuthStore.js";
import Modal from "@/components/Modal.vue"; // Frissített Modal import

class Item {
  constructor(poet = null, title = null, groupId = null) {
    this.poet = poet;
    this.title = title;
    this.groupId = groupId;
  }
}

export default {
  components: { Paginator, ItemForm, ErrorMessage, Operations, Modal },
  data() {
    return {
      items: [],
      currentPage: 1,
      itemsPerPage: 20,
      stateAuth: useAuthStore(),
      item: new Item(),
      messageYesNo: null,
      state: "Read",
      title: null,
      yes: null,
      no: null,
      size: null,
      errorMessages: null,
      selectedRowId: null,
      urlApi: `${BASE_URL}/books`,
      debug: DEBUG,
      showModal: false, // Egyszerűsített flag a modal megjelenítéshez
    };
  },
  computed: {
    paginatedItems() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      return this.items.slice(start, start + this.itemsPerPage);
    },
    totalPages() {
      return Math.ceil(this.items.length / this.itemsPerPage);
    },
  },
  async mounted() {
    await this.getItems();
    // Töröltük a modalInstance kezelését, mert most a Modal komponens kezeli
  },
  methods: {
    async getItems() {
      try {
        const response = await axios.get(`${BASE_URL}/books`);
        this.items = response.data.data;
      } catch (error) {
        console.error("Hiba történt az adatok lekérése közben:", error);
      }
    },
    updatePage(page) {
      this.currentPage = page;
    },

    async deleteItemById() {
      try {
        await axios.delete(`${this.urlApi}/${this.selectedRowId}`, {
          headers: { Authorization: `Bearer ${this.stateAuth.token}` },
        });
        this.getItems();
      } catch (error) {
        this.errorMessages = "A könyv nem törölhető";
      }
    },

    async createItem() {
      try {
        await axios.post(this.urlApi, this.item, {
          headers: { Authorization: `Bearer ${this.stateAuth.token}` },
        });
        this.getItems();
      } catch (error) {
        this.errorMessages = "A bővítés nem sikerült.";
      }
      this.state = "Read";
    },

    async updateItem() {
      try {
        await axios.patch(`${this.urlApi}/${this.selectedRowId}`, this.item, {
          headers: { Authorization: `Bearer ${this.stateAuth.token}` },
        });
        this.getItems();
      } catch (error) {
        this.errorMessages = "A módosítás nem sikerült.";
      }
      this.state = "Read";
    },

    yesEventHandler() {
      if (this.state == "Delete") {
        this.deleteItemById();
      }
      this.hideModal();
      this.getItems(); // Könyvlista frissítése
    },

    onClickDeleteButton(item) {
      this.state = "Delete";
      this.selectedRowId = item.id;
      this.title = "Törlés";
      this.messageYesNo = `Valóban törölni akarod a(z) ${item.title} nevű könyvet?`;
      this.yes = "Igen";
      this.no = "Nem";
      this.size = null;
      this.$refs.myModal.show(); // Modal megjelenítése
    },

    onClickUpdate(item) {
      this.state = "Update";
      this.selectedRowId = item.id;
      this.title = "Könyv módosítása";
      this.yes = null;
      this.no = "Mégsem";
      this.size = "lg";
      this.item = { ...item };
      this.$refs.myModal.show(); // Modal megjelenítése
    },

    onClickCreate() {
      this.state = "Create";
      this.selectedRowId = null;
      this.title = "Új könyv bevitele";
      this.yes = null;
      this.no = "Mégsem";
      this.size = "lg";
      this.item = new Item();
      this.$refs.myModal.show(); // Modal megjelenítése
    },

    hideModal() {
      this.$refs.myModal.hide(); // Modal elrejtése
    },

    onClickCloseErrorMessage() {
      this.errorMessages = null;
      this.state = "Read";
    },

    saveItemHandler() {
      if (this.state === "Update") {
        this.updateItem();
      } else if (this.state === "Create") {
        this.createItem();
      }
      this.hideModal();
      this.getItems(); // Könyvlista frissítése
    },

    goToPage(page) {
      this.currentPage = page;
    },
  },
};
</script>

<style scoped>
.container {
  margin-top: 40px;
  text-align: center;
}

th {
  background-color: #c19a6b;
  color: white;
  font-weight: bold;
  text-transform: uppercase;
}

td {
  color: #4a3b2d;
}
</style>