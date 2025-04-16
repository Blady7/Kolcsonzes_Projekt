<template>
  <div>
    <h1 class="text-center my-4">Kölcsönzések</h1>
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
              <th>író</th>
              <th>cím</th>
              <th>kölcsönző</th>
              <th>Kikölcsönözve</th>
              <th>Vissza hozva</th>
              <th>Műveletek</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="item in items"
              :key="item.id"
              @click="onClickTr(item.id)"
              :class="{
                updating: loading,
                active: item.id === selectedRowId,
              }"
            >
              <td v-if="debug">{{ item.id }}</td>
              <td>{{ item.poet }}</td>
              <td>{{ item.title }}</td>
              <td>{{ item.name }}</td>
              <td>{{ item.startingDate }}</td>
              <td>{{ item.endingDate }}</td>
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
        :totalItems="itemsLength"
        :itemsPerPage="itemsPerPage"
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
          :rentals="this.rentals"
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
  import ItemForm from "../components/Kolcsonzesform.vue";
  import ErrorMessage from "@/components/ErrorMessage.vue";
  import Operations from "@/components/Operations.vue";
  import { useAuthStore } from "@/stores/useAuthStore.js";
  import Modal from "@/components/Modal.vue";
  import * as bootstrap from "bootstrap";
  
  class Item {
    constructor(poet = null, title = null, name = null, startingDate = null, endingDate = null) {
      this.poet = poet;
      this.title = title;
      this.name = name;
      this.startingDate = startingDate;
      this.endingDate = endingDate;
    }
  }
  
  export default {
    components: { Paginator, ItemForm, ErrorMessage, Operations, Modal },
    data() {
      return {
        modal: null,
        items: [],
        rentals: [],
        currentPage: 1,
        itemsPerPage: 50,
        offsetRentals: 0,
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
        urlApi: `${BASE_URL}/queryKolcsonzesAzon`,
        urlApi1: `${BASE_URL}/rentals`,
        urlApi3: `${BASE_URL}/queryRentalsCount`,
        debug: DEBUG,
        itemsLength: 0,
      };
    },
    watch:{
    currentPage(){
      this.getCollections();
    }
  },
    mounted() {
      this.getCollections();
      this.getRentals();
      this.modal = new bootstrap.Modal("#modal", {
        keyboard: false,
      });
    },
    methods: {
      async getRentals() {
        const url = this.urlApi1;
        const headers = {
          Accept: "application/json",
        };
        try {
          const response = await axios.get(url, headers);
          this.rentals = response.data.data;
          this.loading = false;
        } catch (error) {
          this.errorMessages = "Szerver hiba";
        }  
      },
      async getCollections() {
      let url = `${this.urlApi}/${this.itemsPerPage}/${this.offsetRentals}`;
      const headers = {
        Accept: "application/json",
      };
      try {
        let response = await axios.get(url, headers);
        this.items = response.data.data;
        url = this.urlApi3;
        response = await axios.get(url, headers);
        this.itemsLength = response.data.data[0].RentalsCount;   
        this.loading = false;
      } catch (error) {
        this.errorMessages = "Szerver hiba";
      }
    },
  
      async deleteItemById() {
        const id = this.selectedRowId;
        const token = this.stateAuth.token;
  
        const url = `${this.urlApi1}/${id}`;
        const headers = {
          Accept: "application/json",
          "Content-Type": "application/json",
          Authorization: `Bearer ${token}`,
        };
  
        try {
          const response = await axios.delete(url, { headers });
          this.getCollections();
        } catch (error) {
          this.errorMessages = "A kölcsönzés nem törölhető";
        }
      },
  
      async createItem() {
        const token = this.stateAuth.token;
        const url = this.urlApi1;
        const headers = {
          Accept: "application/json",
          "Content-Type": "application/json",
          Authorization: `Bearer ${token}`,
        };
  
        const data = {
          poet: this.poet,
          title: this.title,
          name: this.name,
          startingDate: this.startingDate,
          endingDate: this.ending
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
        const url = `${this.urlApi1}/${id}`;
        const headers = {
          Accept: "application/json",
          "Content-Type": "application/json",
          Authorization: `Bearer ${this.stateAuth.token}`,
        };
        const data = {
          poet: this.poet,
          title: this.title,
          name: this.name,
          startingDate: this.startingDate,
          endingDate: this.ending
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
        }
      },
  
      onClickDeleteButton(item) {
        this.state = "Delete";
        this.selectedRowId = item.id;
        this.title = "Törlés";
        this.messageYesNo = `Valóban törölni akarod a(z) ${item.title} nevű kölcsönzést?`;
        this.yes = "Igen";
        this.no = "Nem";
        this.size = null;
      },
  
      onClickUpdate(item) {
        this.state = "Update";
        this.selectedRowId = item.id;
        this.title = "Könyv módosítása";
        this.yes = null;
        this.no = "Mégsem";
        this.size = "lg";
        this.item = { ...item };
      },
  
      onClickCreate() {
        this.state = "Create";
        this.selectedRowId = null;
        this.title = "Új könyv bevitele";
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
      this.offsetBooks = this.itemsPerPage * (this.currentPage - 1);
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