<template>
  <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a href="/" class="navbar-brand"><img src="../assets/logo.jpg" alt="logo" /></a>
      <button
        class="navbar-toggler bg-light btn-light"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <RouterLink :to="{ name: 'home' }" class="nav-link">Home</RouterLink>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">FAQ</a>
          </li>
        </ul>

        <ul class="navbar-nav">
          <li class="nav-item mr-md-4 mr-0 mb-lg-0 mb-3">
            <button
              type="button"
              class="btn btn-transparent navbar-toggle-box-collapse mt-lg-0 mt-3 text-light pl-0"
              @click="handleSearchBarToggler"
            >
              Search&ensp;<span class="fa fa-search" aria-hidden="true"></span>
            </button>
          </li>
          <li v-if="loginStore.isLoggedIn" class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              {{ loginStore.user.name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Profile</a>
              <a class="dropdown-item" href="#">My Ads</a>
              <a class="dropdown-item" href="#">Post New</a>
              <div class="dropdown-divider"></div>
              <button class="dropdown-item" id="logout-btn" @click="handleLogoutClick">
                Logout
              </button>
            </div>
          </li>
          <li v-else class="nav-item text">
            <div class="nav-link">
              <RouterLink :to="{ name: 'login' }" class="text-light">Login</RouterLink>
              /
              <RouterLink :to="{ name: 'register' }" class="text-light">Register</RouterLink>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { RouterLink } from 'vue-router'
import { useSearchBarTogglerStore } from '../stores/SearchBarTogglerStore'
import { useLoginStore } from '../stores/LoginStore'
import toaster from '../composables/Toaster'

const bodyElem = document.querySelector('body')
const searchBarTogglerStore = useSearchBarTogglerStore()
const loginStore = useLoginStore()

const handleSearchBarToggler = () => {
  searchBarTogglerStore.isOpen = true
  bodyElem.classList.add('box-collapse-open')
}

const handleLogoutClick = () => {
  loginStore
    .logout()
    .then((d) => {
      toaster.info(d)
    })
    .catch(() => {
      // console.log(e)
    })
}
</script>

<style lang="css" scoped>
#logout-btn:focus {
  outline: none !important;
  background: rgba(128, 128, 128, 0.166) !important;
  color: black;
}
</style>
