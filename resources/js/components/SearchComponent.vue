<template>
    <div class="click-closed" @click="handleSearchBarClose"></div>
    <div class="box-collapse">
        <div class="title-box-d">
            <h3 class="title-d">Search Property</h3>
        </div>
        <span
            class="close-box-collapse right-boxed ion-ios-close"
            @click="handleSearchBarClose"
        ></span>
        <div class="box-collapse-wrap form">
            <form class="form-a">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="form-group">
                            <label for="Type">Area Name</label>
                            <input
                                type="text"
                                class="form-control form-control-lg form-control-a"
                                placeholder="Area"
                            />
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-group">
                            <label for="rooms">Number Of Rooms</label>
                            <input
                                type="number"
                                class="form-control form-control-lg form-control-a"
                                id="rooms"
                                placeholder="Rooms"
                            />
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-group">
                            <label for="bathrooms">Number Of Bathrooms</label>
                            <input
                                type="number"
                                class="form-control form-control-lg form-control-a"
                                id="bathrooms"
                                placeholder="Bathrooms"
                            />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-b">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useSearchBarTogglerStore } from "../stores/SearchBarTogglerStore";

const searchBarTogglerStore = useSearchBarTogglerStore();
const bodyElem = document.querySelector("body");

const handleSearchBarClose = () => {
    if (searchBarTogglerStore.is_open) {
        searchBarTogglerStore.isOpen = false;
        bodyElem.classList.remove("box-collapse-open");
    }
};
</script>
