<template>
  <div>
    <h1 class="text-center my-4">Évfolyamok</h1>
    <ErrorMessage
      :errorMessages="errorMessages"
      @close="onClickCloseErrorMessage"
    />
    <div>
      <div>
        <table class="my-table">
          <thead>
            <tr>
              <th v-if="debug">ID</th>
              <th>Évfolyam</th>
              <th>Tanárok</th>
              <th>Műveletek</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="item in paginatedItems"
              :key="item.id"
              @click="onClickTr(item.id)"
              :class="{
                updating: loading,
                active: item.id === selectedRowId,
              }"
            >
              <td v-if="debug">{{ item.id }}</td>
              <td>{{ item.group }}</td>
              <td>{{ item.name }}</td>
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
      </div>

      <Paginator
        :totalItems="items.length"
        :itemsPerPage="6"
        :currentPage="currentPage"
        @page-changed="goToPage"
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
          :debug="debug"
          @saveItem="saveItemHandler"
        />
      </Modal>
    </div>
  </div>
</template>

<script>
import Paginator from "@/components/Paginator.vue";
import axios from "axios";
import { DEBUG } from "../helpers/debug";
import { BASE_URL } from "../helpers/baseUrls";
import ItemForm from "@/components/EvfolyamForm.vue";
import ErrorMessage from "@/components/ErrorMessage.vue";
import Operations from "@/components/Operations.vue";
import { useAuthStore } from "@/stores/useAuthStore.js";
import Modal from "@/components/Modal.vue";
import * as bootstrap from "bootstrap";

class Item {
  constructor(id = null, group = null, teacherId = null) {
    this.id = id;
    this.group = group;
    this.teacherId = teacherId;
  }
}

export default {
  components: { Paginator, ItemForm, ErrorMessage, Operations, Modal },
  data() {
    return {
      modal: null,
      items: [],
      currentPage: 1,
      itemsPerPage: 6,
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
      urlApi: `${BASE_URL}/queryTanarValaszto`,
      urlApi2: `${BASE_URL}/groups`,
      urlApi3: `${BASE_URL}/roles`,
      debug: DEBUG,
    };
  },
  computed: {
    paginatedItems() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.items.slice(start, end);
    },
    totalPages() {
      return Math.ceil(this.items.length / this.itemsPerPage);
    },
  },
  mounted() {
    this.getCollections();
    this.modal = new bootstrap.Modal("#modal", {
      keyboard: false,
    });
  },
  methods: {
    async getCollections() {
      const url = this.urlApi;
      const headers = {
        Accept: "application/json",
      };
      try {
        const response = await axios.get(url, headers);
        this.items = response.data.data;
        this.loading = false;
      } catch (error) {
        this.errorMessages = "Szerver hiba";
      }
    },

    async deleteItemById() {
      const id = this.selectedRowId;
      const token = this.stateAuth.token;

      const url = `${this.urlApi2}/${id}`;
      const headers = {
        Accept: "application/json",
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
      };

      try {
        const response = await axios.delete(url, { headers });
        this.getCollections();
      } catch (error) {
        this.errorMessages = "A csoport nem törölhető";
      }
    },

    async createItem() {
      const token = this.stateAuth.token;
      console.log("Token:", token);
      const url = this.urlApi2;
      const headers = {
        Accept: "application/json",
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
      };

      const data = {
        group: this.item.group,
        teacherId: this.item.teacherId,
      };
      try {
        const response = await axios.post(url, data, { headers });
        this.getCollections();
      } catch (error) {
        this.errorMessages = "A bővítés nem sikerült.";
      }
      this.state = "Read";
    },

    async updateItem() {
      this.loading = true;
      const id = this.selectedRowId;
      const url = `${this.urlApi2}/${id}`;
      const headers = {
        Accept: "application/json",
        "Content-Type": "application/json",
        Authorization: `Bearer ${this.stateAuth.token}`,
      };

      const data = {
        group: this.item.group,
        teacherId: this.item.teacherId,
      };
      try {
        const response = await axios.patch(url, data, { headers });
        this.getCollections();
      } catch (error) {
        this.errorMessages = "A módosítás nem sikerült.";
      }
      this.state = "Read";
    },

    yesEventHandler() {
      if (this.state == "Delete") {
        this.deleteItemById();
        this.goToPage(1);
      }
    },

    onClickDeleteButton(item) {
      this.state = "Delete";
      this.selectedRowId = item.id;
      this.title = "Törlés";
      this.messageYesNo = `Valóban törölni akarod a(z) ${item.group} nevű csoportot?`;
      this.yes = "Igen";
      this.no = "Nem";
      this.size = null;
    },

    onClickUpdate(item) {
      this.state = "Update";
      this.selectedRowId = item.id;
      this.title = "Csoport módosítása";
      this.yes = null;
      this.no = "Mégsem";
      this.size = "lg";
      this.item = { ...item };
    },

    onClickCreate() {
      this.state = "Create";
      this.selectedRowId = null;
      this.title = "Új csoport bevitele";
      this.yes = null;
      this.no = "Mégsem";
      this.size = "lg";
      this.item = new Item();
    },

    onClickCloseErrorMessage() {
      this.errorMessages = null;
      this.state = "Read";
    },

    onClickTr(id) {
      this.selectedRowId = id;
    },

    saveItemHandler() {
      if (this.state === "Update") {
        this.updateItem();
      } else if (this.state === "Create") {
        this.createItem();
      }
      this.modal.hide();
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
