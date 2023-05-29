import { defineStore } from "pinia";
import API from "../composables/Axios";
import storage from "../composables/SessionStorage";

export const useLoginStore = defineStore("loginStore", {
    state: () => {
        return {
            data: {},
            isLoggedIn: false,
            isLoading: false,
        };
    },
    actions: {
        async login(credentails) {
            this.isLoading = true;
            try {
                const response = await API.post(
                    "surface-user-login",
                    credentails
                );
                const responseData = await response.data;
                this.isLoggedIn = true;
                this.data = responseData.surface_user;
                storage.set(
                    "surface_user_auth_token",
                    responseData.surface_user_auth_token
                );
                return responseData;
            } catch (ex) {
                return Promise.reject(ex.response.data);
            } finally {
                this.isLoading = false;
            }
        },

        async logout() {
            try {
                const response = await API.post("surface-user-logout");
                const data = await response.data.message;
                this.isLoggedIn = false;
                this.data = {};
                storage.remove("surface_user_auth_token");
                return data;
            } catch (ex) {
                return Promise.reject(ex.response.data);
            }
        },
    },
    getters: {
        user(state) {
            return { ...state.data, isLoggedIn: state.isLoggedIn };
        },
    },
    persist: {
        storage: sessionStorage,
    },
});
