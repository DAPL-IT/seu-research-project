<template>
  <main id="main" class="main__margin--y">
    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 col-12 mx-auto">
            <div class="title-single-box">
              <h1 class="title-single">My Ads</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Intro Single-->

    <section class="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 col-12 mx-auto">
            <div class="text-center" v-if="adsStore.isFetching">
              <div class="spinner-border"></div>
            </div>
            <div
              class="alert alert-primary"
              role="alert"
              v-else-if="!adsStore.isFetching && adsStore.user_ads.length == 0"
            >
              No Data Found
            </div>
            <ul v-else class="list-group">
              <li
                class="list-group-item d-flex justify-content-between align-items-center"
                v-for="ad in adsStore.user_ads"
                :key="ad.id"
              >
                <p class="text-justify">
                  {{ ad.title }}
                </p>
                <div class="btn-group pl-4">
                  <RouterLink
                    :to="{ name: 'ad_details', params: { id: ad.id } }"
                    class="btn btn-sm btn-success"
                  >
                    <span class="fa fa-eye"></span>
                  </RouterLink>
                  <button class="btn btn-sm btn-primary">
                    <span class="fa fa-edit"></span>
                  </button>
                  <button class="btn btn-sm btn-danger" @click.prevent="handleDeleteClick(ad.id)">
                    <span class="fa fa-trash"></span>
                  </button>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script setup>
import { useAdsStore } from '../stores/AdsStore'
import { onMounted } from 'vue'
import { RouterLink } from 'vue-router'
import Swal from 'sweetalert2'
import toaster from '../composables/Toaster'

const adsStore = useAdsStore()

const handleDeleteClick = (id) => {
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'YES'
  }).then((result) => {
    if (result.isConfirmed) {
      adsStore
        .deleteByUser(id)
        .then((d) => {
          adsStore.getAdsByUser().then(() => {
            toaster.success(d.message)
          })
        })
        .catch((e) => {
          toaster.error(e.error)
        })
    }
  })
}

onMounted(() => {
  adsStore.getAdsByUser()
})
</script>
