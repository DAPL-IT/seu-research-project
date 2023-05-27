<template>
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
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
                        <a class="nav-link" href="#">Home</a>
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
                            Search&ensp;<span
                                class="fa fa-search"
                                aria-hidden="true"
                            ></span>
                        </button>
                    </li>
                    <li class="nav-item text">
                        <div class="nav-link">
                            <RouterLink
                                :to="{ name: 'login' }"
                                class="text-light"
                                >Login</RouterLink
                            >
                            /
                            <a href="" class="text-light">Register</a>
                        </div>
                    </li>

                    <!-- <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdown"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            Dropdown
                        </a>
                        <div
                            class="dropdown-menu"
                            aria-labelledby="navbarDropdown"
                        >
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"
                                >Something else here</a
                            >
                        </div>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { RouterLink } from "vue-router";
import { useSearchBarTogglerStore } from "../stores/SearchBarTogglerStore";

const bodyElem = document.querySelector("body");

const searchBarTogglerStore = useSearchBarTogglerStore();

const handleSearchBarToggler = () => {
    searchBarTogglerStore.isOpen = true;
    console.log(searchBarTogglerStore.is_open);
    bodyElem.classList.add("box-collapse-open");
};
</script>
