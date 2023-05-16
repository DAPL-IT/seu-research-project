<template>
    <TopToolbar />
    <NavbarComponent />
    <SearchComponent />
    <RouterView />
    <FooterComponent />
</template>

<script setup>
import { RouterView } from "vue-router";
import FooterComponent from "./components/FooterComponent.vue";
import TopToolbar from "./components/TopToolbarComponent.vue";
import NavbarComponent from "./components/NavBarComponent.vue";
import SearchComponent from "./components/SearchComponent.vue";
</script>
