<template>
    <nav
        class="navbar navbar-default navbar-trans navbar-expand-lg"
        id="main-nav-container"
    >
        <div class="container">
            <button
                class="navbar-toggler collapsed"
                type="button"
                ref="navTogglerBtn"
                @click="handleNavMenuToggler"
            >
                <span></span>
                <span></span>
                <span></span>
            </button>

            <a class="navbar-brand text-brand" href="index.html"
                >App<span class="color-b">Name</span></a
            >
            <button
                type="button"
                class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none"
                @click="handleSearchBarToggler"
            >
                <span class="fa fa-search" aria-hidden="true"></span>
            </button>

            <div
                class="navbar-collapse collapse justify-content-end mr-5"
                ref="mainNav"
            >
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">FAQ</a>
                    </li>
                </ul>
            </div>
            <button
                type="button"
                class="btn btn-b-n navbar-toggle-box-collapse d-none d-md-block"
                @click="handleSearchBarToggler"
            >
                <span class="fa fa-search" aria-hidden="true"></span>
            </button>
        </div>
    </nav>
</template>

<script setup>
import { ref } from "vue";
import { useSearchBarTogglerStore } from "../stores/SearchBarTogglerStore";

const navTogglerBtn = ref(null);
const mainNav = ref(null);
const bodyElem = document.querySelector("body");

const searchBarTogglerStore = useSearchBarTogglerStore();

const handleNavMenuToggler = () => {
    const isClosed = navTogglerBtn.value.classList
        .toString()
        .includes("collapsed")
        ? true
        : false;

    if (isClosed) {
        navTogglerBtn.value.classList.remove("collapsed");
        mainNav.value.classList.add("show");
    } else {
        navTogglerBtn.value.classList.add("collapsed");
        mainNav.value.classList.remove("show");
    }
};

const handleSearchBarToggler = () => {
    searchBarTogglerStore.isOpen = true;
    console.log(searchBarTogglerStore.is_open);
    bodyElem.classList.add("box-collapse-open");
};
</script>
