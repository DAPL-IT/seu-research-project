<template>
  <main id="main" class="main__margin--y">
    <section class="property-grid grid">
      <div class="container">
        <div class="text-center" v-if="adsStore.isFetching">
          <div class="spinner-border"></div>
        </div>
        <div
          class="alert alert-primary"
          role="alert"
          v-else-if="!adsStore.isFetching && adsStore.ads.length == 0"
        >
          No Data Found
        </div>
        <template v-else>
          <div class="row">
            <div v-for="ad in adsStore.ads" :key="ad.id" class="col-md-6 col-lg-4 mb-4">
              <div class="card">
                <img :src="ad.image_url" class="card-img-top" alt="..." />
                <div class="card-body">
                  <p class="card-text">
                    <b> RENT: {{ ad.price.toLocaleString() }} BDT </b>
                  </p>
                  <ul class="list-group mb-3">
                    <li class="list-group-item">Area: {{ ad.area.name }}</li>
                    <li class="list-group-item">Rooms: {{ ad.rooms }}</li>
                    <li class="list-group-item">Bathrooms: {{ ad.bathrooms }}</li>
                    <li class="list-group-item">Type: {{ ad.rent_type.type }}</li>
                  </ul>
                  <RouterLink
                    :to="{ name: 'ad_details', params: { id: ad.id } }"
                    class="btn btn-primary"
                    >DETAILS</RouterLink
                  >
                </div>
              </div>
            </div>
          </div>

          <div class="row" v-if="adsStore.lastPage > 1">
            <div class="col-sm-12">
              <nav class="pagination-a">
                <ul class="pagination justify-content-end">
                  <li class="page-item" :class="[{ disabled: adsStore.currPage == 1 }]">
                    <button class="page-link" @click="adsStore.getAll(adsStore.currPage - 1)">
                      <span class="ion-ios-arrow-back"></span>
                    </button>
                  </li>
                  <li
                    v-for="number in adsStore.lastPage"
                    :key="number"
                    class="page-item"
                    :class="[{ active: number == adsStore.currPage }]"
                  >
                    <button class="page-link" @click="adsStore.getAll(number)">{{ number }}</button>
                  </li>

                  <li
                    class="page-item next"
                    :class="[{ disabled: adsStore.currPage == adsStore.lastPage }]"
                  >
                    <button class="page-link" @click="adsStore.getAll(adsStore.currPage + 1)">
                      <span class="ion-ios-arrow-forward"></span>
                    </button>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </template>
      </div>
    </section>
  </main>
</template>

<script setup>
import { onMounted } from 'vue'
import { RouterLink } from 'vue-router'
import { useAdsStore } from '../stores/AdsStore'

const adsStore = useAdsStore()

onMounted(() => {
  adsStore.getAll()
})
</script>
