<template>
  <div>
    <table class="my-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Név</th>
          <th>Osztály</th>
          <th>Email</th>
          <th>Műveletek</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user, index) in paginatedItems" :key="user.id || index">
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.groupId }}</td>
          <td>{{ user.email }}</td>
          <td class="text-nowrap text-center">
            <OperationsCrud
              @onClickDeleteButton="onClickDeleteButton(user)"
              @onClickUpdate="onClickUpdate(user)"
              @onClickCreate="onClickCreate"
              :data="user"
            />
          </td>
        </tr>
      </tbody>
    </table>

    <Paginator
      :totalItems="items.length"
      :itemsPerPage="itemsPerPage"
      :currentPage="currentPage"
      @page-changed="updatePage"
    />

    <Modal
      :title="title"
      :message="messageYesNo"
      :yes="yes"
      :no="no"
      :size="size"
      @yesEvent="yesEventHandler"
    />
  </div>
</template>

<script>
import Paginator from "@/components/Paginator.vue";
import axios from "axios";
import { BASE_URL } from "../helpers/baseUrls";
import DiakForm from "@/components/DiakForm.vue";
import ErrorMessage from "@/components/ErrorMessage.vue";

export default {
  components: { Paginator, DiakForm, ErrorMessage },
  data() {
    return {
      items: [],
      currentPage: 1,
      itemsPerPage: 20,
      item: {},
      messageYesNo: null,
      state: "Read",
      title: null,
      yes: null,
      no: null,
      size: null,
      errorMessages: null,
      selectedRowId: null,
      token: localStorage.getItem("token") || "", // Token betöltése localStorage-ból
    };
  },
  computed: {
    paginatedItems() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      return this.items.slice(start, start + this.itemsPerPage);
    },
  },
  async mounted() {
    await this.getItems();
  },
  methods: {
    async getItems() {
      if (!this.token) {
        console.error("Hiba: nincs token!");
        return;
      }
      try {
        const response = await axios.get(`${BASE_URL}/users`, {
          headers: { Authorization: `Bearer ${this.token}` },
        });
        this.items = response.data?.data || [];
      } catch (error) {
        console.error("Hiba történt az adatok lekérése közben:", error);
      }
    },

    updatePage(page) {
      this.currentPage = page;
    },

    async deleteItemById() {
      if (!this.selectedRowId) return;

      try {
        await axios.delete(`${BASE_URL}/users/${this.selectedRowId}`, {
          headers: { Authorization: `Bearer ${this.token}` },
        });

        // Frissítés helyett a törölt elemet kiszűrjük a listából
        this.items = this.items.filter(item => item.id !== this.selectedRowId);
        this.selectedRowId = null;
      } catch (error) {
        this.errorMessages = "A felhasználó nem törölhető.";
      }
    },

    async createItem() {
      if (!this.token) return;

      try {
        const response = await axios.post(`${BASE_URL}/users`, this.item, {
          headers: { Authorization: `Bearer ${this.token}` },
        });

        this.items.push(response.data); // Hozzáadjuk az új elemet
        this.state = "Read";
      } catch (error) {
        this.errorMessages = "A bővítés nem sikerült.";
      }
    },

    async updateItem() {
      if (!this.selectedRowId) return;

      try {
        await axios.patch(`${BASE_URL}/users/${this.selectedRowId}`, this.item, {
          headers: { Authorization: `Bearer ${this.token}` },
        });

        this.items = this.items.map(item =>
          item.id === this.selectedRowId ? { ...item, ...this.item } : item
        );
        this.state = "Read";
      } catch (error) {
        this.errorMessages = "A módosítás nem sikerült.";
      }
    },

    yesEventHandler() {
      if (this.state === "Delete") {
        this.deleteItemById();
      }
    },

    onClickDeleteButton(item) {
      this.state = "Delete";
      this.selectedRowId = item.id;
      this.title = "Törlés";
      this.messageYesNo = `Valóban törölni akarod a(z) ${item.name || "ismeretlen"} nevű felhasználót?`;
      this.yes = "Igen";
      this.no = "Nem";
    },

    onClickUpdate(item) {
      this.state = "Update";
      this.selectedRowId = item.id;
      this.item = { ...item };
      this.title = "Felhasználó módosítása";
      this.no = "Mégsem";
      this.size = "lg";
    },

    onClickCreate() {
      this.state = "Create";
      this.item = {};
      this.title = "Új felhasználó hozzáadása";
      this.no = "Mégsem";
      this.size = "lg";
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
