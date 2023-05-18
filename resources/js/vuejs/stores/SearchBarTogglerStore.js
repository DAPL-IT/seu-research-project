import { defineStore } from "pinia";

export const useSearchBarTogglerStore = defineStore("searchBarTogglerStore", {
    state: () => {
        return {
            isOpen: false,
        };
    },
    getters: {
        is_open(state) {
            return state.isOpen;
        },
    },
});
