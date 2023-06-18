<template>
  <main id="main" class="main__margin--y">
    <section class="intro-single">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-single-box">
              <h3 class="">Create New Rent Ad</h3>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Intro Single-->
    <!-- ======= Property Single ======= -->
    <section class="property-single nav-arrow-b">
      <div class="container">
        <form
          class="row"
          method="post"
          enctype="multipart/form-data"
          @submit.prevent="handleSubmit"
        >
          <div class="form-group col-12">
            <input
              type="text"
              name="title"
              class="form-control form-control-lg form-control-a"
              placeholder="Title"
              autocomplete="off"
              v-model="formValue.title"
            />
            <small v-if="validationError && validationError.title" class="form-text text-danger">
              {{ validationError.title[0] }}
            </small>
          </div>
          <div class="form-group col-lg-3 col-md-6 col-12">
            <input
              type="number"
              name="price"
              class="form-control form-control-lg form-control-a"
              placeholder="Price"
              autocomplete="off"
              v-model="formValue.price"
            />
            <small v-if="validationError && validationError.price" class="form-text text-danger">
              {{ validationError.price[0] }}
            </small>
          </div>
          <div class="form-group col-lg-3 col-md-6 col-12">
            <input
              type="number"
              name="rooms"
              class="form-control form-control-lg form-control-a"
              placeholder="Rooms"
              autocomplete="off"
              v-model="formValue.rooms"
            />
            <small v-if="validationError && validationError.rooms" class="form-text text-danger">
              {{ validationError.rooms[0] }}
            </small>
          </div>
          <div class="form-group col-lg-3 col-md-6 col-12">
            <input
              type="number"
              name="bathrooms"
              class="form-control form-control-lg form-control-a"
              placeholder="Bathrooms"
              autocomplete="off"
              v-model="formValue.bathrooms"
            />
            <small
              v-if="validationError && validationError.bathrooms"
              class="form-text text-danger"
            >
              {{ validationError.bathrooms[0] }}
            </small>
          </div>
          <div class="form-group col-lg-3 col-md-6 col-12">
            <input
              type="number"
              name="floor"
              class="form-control form-control-lg form-control-a"
              placeholder="floor"
              autocomplete="off"
              v-model="formValue.floor"
            />
            <small v-if="validationError && validationError.floor" class="form-text text-danger">
              {{ validationError.floor[0] }}
            </small>
          </div>
          <div class="form-group col-lg-4 col-md-6 col-12">
            <input
              type="number"
              name="square_feet"
              class="form-control form-control-lg form-control-a"
              placeholder="Square Feet"
              autocomplete="off"
              v-model="formValue.square_feet"
            />
            <small
              v-if="validationError && validationError.square_feet"
              class="form-text text-danger"
            >
              {{ validationError.square_feet[0] }}
            </small>
          </div>
          <div class="form-group col-lg-4 col-md-6 col-12">
            <input
              v-model="searchVal"
              type="text"
              name="area_id"
              class="form-control form-control-lg form-control-a"
              placeholder="Area, Type..."
              autocomplete="off"
              @input="debouncedSearch"
            />
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
            <small v-if="validationError && validationError.area_id" class="form-text text-danger">
              {{ validationError.area_id[0] }}
            </small>
          </div>
          <div class="form-group col-lg-4 col-md-6 col-12">
            <select
              name="rent_type_id"
              class="form-control form-control-lg form-control-a"
              :disabled="rentTypeStore.rent_types.length == 0"
              v-model="formValue.rent_type_id"
            >
              <template v-if="rentTypeStore.rent_types.length > 0">
                <option value="">--TYPE--</option>
                <option
                  v-for="rent_type in rentTypeStore.rent_types"
                  :key="rent_type.id"
                  :value="rent_type.id"
                >
                  {{ rent_type.type }}
                </option>
              </template>
            </select>
            <small
              v-if="validationError && validationError.rent_type_id"
              class="form-text text-danger"
            >
              {{ validationError.rent_type_id[0] }}
            </small>
          </div>
          <div class="form-group col-md-6 col-12">
            <input
              type="text"
              name="full_address"
              class="form-control form-control-lg form-control-a"
              placeholder="Full Address"
              autocomplete="off"
              v-model="formValue.full_address"
            />
            <small
              v-if="validationError && validationError.full_address"
              class="form-text text-danger"
            >
              {{ validationError.full_address[0] }}
            </small>
          </div>
          <div class="form-group col-md-6 col-12">
            <input
              type="file"
              name="image"
              class="form-control form-control-lg form-control-a"
              placeholder="Image"
              autocomplete="off"
              accept=".jpg, .png, .jpeg"
              @change="imageFieldChange"
            />
            <small v-if="validationError && validationError.image" class="form-text text-danger">
              {{ validationError.image[0] }}
            </small>
          </div>
          <div class="form-group col-12">
            <textarea
              class="form-control form-control-lg form-control-a"
              name="description"
              rows="3"
              placeholder="Description"
              v-model="formValue.description"
            ></textarea>
            <small
              v-if="validationError && validationError.description"
              class="form-text text-danger"
            >
              {{ validationError.description[0] }}
            </small>
          </div>
          <div class="col-12 text-right">
            <button type="submit" class="btn btn-a" :disabled="adsStore.isSubmitting">
              {{ `${adsStore.isSubmitting ? 'Submitting...' : 'Submit'}` }}
            </button>
          </div>
        </form>
      </div>
    </section>
  </main>
</template>

<script setup>
import { onMounted, ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useRentTypeStore } from '../stores/RentTypeStore'
import { useAreaStore } from '../stores/AreaStore'
import { useAdsStore } from '../stores/AdsStore'
import toaster from '../composables/Toaster'
import { debounce } from 'lodash'

const rentTypeStore = useRentTypeStore()
const areaStore = useAreaStore()
const adsStore = useAdsStore()
const router = useRouter()
const showList = ref(true)
const searchVal = ref(null)
const validationError = ref(null)

const formValue = ref({
  area_id: null,
  rent_type_id: '',
  title: null,
  rooms: null,
  bathrooms: null,
  floor: null,
  price: null,
  square_feet: null,
  full_address: null,
  description: null,
  image: null
})

const handleSubmit = () => {
  adsStore
    .add(formValue.value)
    .then((d) => {
      toaster.success(d.message)
      router.push({ name: 'my_ads' })
    })
    .catch((e) => (validationError.value = e))
}

const handleAreaListClick = (id, name) => {
  formValue.value.area_id = id
  searchVal.value = name
  showList.value = false
}

const imageFieldChange = (event) => {
  formValue.value.image = event.currentTarget.files[0]
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

onMounted(() => {
  rentTypeStore.getAll()
})
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
