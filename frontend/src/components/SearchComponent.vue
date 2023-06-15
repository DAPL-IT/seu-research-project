<template>
  <div class="click-closed" @click="handleSearchBarClose"></div>
  <div class="box-collapse">
    <div class="title-box-d">
      <h3 class="title-d">Search Property</h3>
    </div>
    <span class="close-box-collapse right-boxed ion-ios-close" @click="handleSearchBarClose"></span>
    <div class="box-collapse-wrap form">
      <form class="form-a" method="get" @submit.prevent="handleSubmit">
        <div class="row">
          <div class="col-md-6 mb-2">
            <div class="form-group">
              <label for="Type">Area Name</label>
              <input
                type="text"
                class="form-control form-control-lg form-control-a"
                placeholder="Area"
                v-model="searchVal"
                required
                @input="debouncedSearch"
              />
            </div>
            <div
              class="row"
              v-if="
                showList && searchVal && searchVal.length > 0 && areaStore.searched_areas.length > 0
              "
            >
              <div class="col-11">
                <div class="card p-0" id="search-list">
                  <ul class="list-group list-group-flush">
                    <li
                      v-for="area in areaStore.searched_areas"
                      :key="area.id"
                      class="list-group-item list-group-item-action"
                      @click.prevent="handleAreaListClick(area.id, area.name)"
                    >
                      {{ area.name }}
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group">
              <label for="Type">Square Feet</label>
              <input
                type="number"
                class="form-control form-control-lg form-control-a"
                placeholder="Square Feet"
                v-model="squareFeet"
                required
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
                v-model="rooms"
                placeholder="Rooms"
                required
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
                v-model="bathrooms"
                required
              />
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-b" :disabled="adsStore.isSearching">
              {{ `${adsStore.isSearching ? 'Searching...' : 'Search'}` }}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { useSearchBarTogglerStore } from '../stores/SearchBarTogglerStore'
import { useRouter } from 'vue-router'
import { ref, computed } from 'vue'
import { debounce } from 'lodash'
import { useAreaStore } from '../stores/AreaStore'
import { useAdsStore } from '../stores/AdsStore'

const searchBarTogglerStore = useSearchBarTogglerStore()
const bodyElem = document.querySelector('body')
const router = useRouter()
const areaId = ref(null)
const squareFeet = ref(null)
const rooms = ref(null)
const bathrooms = ref(null)
const searchVal = ref(null)
const showList = ref(true)
const areaStore = useAreaStore()
const adsStore = useAdsStore()

const handleAreaListClick = (id, name) => {
  areaId.value = id
  searchVal.value = name
  showList.value = false
}

const performSearch = () => {
  showList.value = true
  if (searchVal.value && searchVal.value.length > 0) {
    areaStore.search(searchVal.value)
  }
}

const debouncedSearch = computed(() => {
  return debounce(performSearch, 500)
})

const handleSubmit = () => {
  const q = {
    area_id: areaId.value,
    square_feet: squareFeet.value,
    rooms: rooms.value,
    bathrooms: bathrooms.value
  }

  adsStore.search({ ...q, page: 1 }).then(() => {
    handleSearchBarClose()
  })

  router.push({
    name: 'search',
    query: q
  })
}

const handleSearchBarClose = () => {
  if (searchBarTogglerStore.is_open) {
    searchBarTogglerStore.isOpen = false
    bodyElem.classList.remove('box-collapse-open')
  }
}
</script>

<style scoped>
#search-list {
  border: 1px sold black !important;
  position: absolute;
  height: 200px !important;
  z-index: 98;
  scrollbar-width: none;
  overflow-y: auto;
  width: 100%;
}

#search-list ul li {
  cursor: pointer;
}
</style>
