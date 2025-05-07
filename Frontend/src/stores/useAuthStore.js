import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    id: Number(sessionStorage.getItem('id')) || null,
    user: sessionStorage.getItem('user') || null,
    token: sessionStorage.getItem('currentToken') || null,
    roleId: sessionStorage.getItem('roleId') || null,
  }),
  getters: {},
  actions: {
    setId(id) {
      sessionStorage.setItem('id', id);
      this.id = id;
    },
    setUser(user) {
      sessionStorage.setItem('user', user);
      this.user = user;
    },
    setToken(token) {
      sessionStorage.setItem('currentToken', token);
      this.token = token;
    },
    setRoleId(roleId) {
      sessionStorage.setItem('roleId', roleId);
      this.roleId = roleId;
    },
    clearStoredData() {
      sessionStorage.removeItem('id');
      sessionStorage.removeItem('user');
      sessionStorage.removeItem('currentToken');
      sessionStorage.removeItem('roleId');
      this.id = null;
      this.token = null;
      this.user = null;
      this.roleId = null;
    }
  }
});