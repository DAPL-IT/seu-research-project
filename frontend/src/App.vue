<template>
  <NavbarComponent />
  <SearchComponent />
  <RouterView />
  <FooterComponent />
</template>

<script setup>
import { RouterView } from 'vue-router'
import FooterComponent from './components/FooterComponent.vue'
import NavbarComponent from './components/NavbarComponent.vue'
import SearchComponent from './components/SearchComponent.vue'
</script>
