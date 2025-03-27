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
            <tr v-for="(item, index) in paginatedItems" :key="item.id || index">
              <td>{{ item.id }}</td>
              <td>{{ item.poet }}</td>
              <td>{{ item.title }}</td>
              <td>{{ item.groupId }}</td>
              <td class="text-nowrap text-center">
                <Operations
                  @onClickDeleteButton="onClickDeleteButton(item)"
                  @onClickUpdate="onClickUpdate(item)"
                  @onClickCreate="onClickCreate"
                  :data="item"
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
          :yes="yes"
          :no="no"
          :size="size"
          @yesEvent="yesEventHandler"
        >
          <div v-if="state == 'Delete'">
            {{ messageYesNo }}
          </div>
          <ItemForm
            v-if="state == 'Create' || state == 'Update'"
            :itemForm="item"
            @saveItem="saveItemHandler"
          />
        </Modal>
      </div>
    </div>
  </template>
  
  <script>
  import Paginator from "@/components/Paginator.vue";
  import axios from "axios";
  import { BASE_URL } from "../helpers/baseUrls";
  import ItemForm from "@/components/KonyvForm.vue";
  import ErrorMessage from "@/components/ErrorMessage.vue";
  import Operations from "@/components/Operations.vue";
  import { useAuthStore } from "@/stores/useAuthStore.js";
  
  export default {
    components: { Paginator, ItemForm, ErrorMessage, Operations },
    data() {
      return {
        items: [],
        currentPage: 1,
        itemsPerPage: 20,
        item: {},
        stateAuth: useAuthStore(),
        messageYesNo: null,
        state: "Read",
        title: null,
        yes: null,
        no: null,
        size: null,
        errorMessages: null,
        selectedRowId: null,
        token: localStorage.getItem("token") || "",
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
          const response = await axios.get(`${BASE_URL}/books`, {
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
          await axios.delete(`${BASE_URL}/books/${this.selectedRowId}`, {
            headers: { Authorization: `Bearer ${this.token}` },
          });
          this.items = this.items.filter(item => item.id !== this.selectedRowId);
          this.selectedRowId = null;
        } catch (error) {
          this.errorMessages = "A könyv nem törölhető.";
        }
      },
  
      async createItem() {
        if (!this.token) return;
        try {
          const response = await axios.post(`${BASE_URL}/books`, this.item, {
            headers: { Authorization: `Bearer ${this.token}` },
          });
          this.items.push(response.data);
          this.state = "Read";
        } catch (error) {
          this.errorMessages = "A bővítés nem sikerült.";
        }
      },
  
      async updateItem() {
        if (!this.selectedRowId) return;
        try {
          await axios.patch(`${BASE_URL}/books/${this.selectedRowId}`, this.item, {
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
        this.messageYesNo = `Valóban törölni akarod a(z) ${item.title} könyvet?`;
        this.yes = "Igen";
        this.no = "Nem";
      },
  
      onClickUpdate(item) {
        this.state = "Update";
        this.selectedRowId = item.id;
        this.item = { ...item };
        this.title = "Könyv módosítása";
        this.no = "Mégsem";
        this.size = "lg";
      },
  
      onClickCreate() {
        this.state = "Create";
        this.item = {};
        this.title = "Új könyv bevitele";
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
  