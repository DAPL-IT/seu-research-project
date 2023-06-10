<template>
  <main id="main" class="main__margin--y">
    <div class="text-center" v-if="adsStore.isFetching">
      <div class="spinner-border"></div>
    </div>
    <template v-else>
      <section class="intro-single">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="title-single-box">
                <h3 class="">{{ adsStore.ad.title }}</h3>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Intro Single-->
      <!-- ======= Property Single ======= -->
      <section class="property-single nav-arrow-b">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="gallery-property">
                <img :src="adsStore.ad.image_url" alt="" class="img img-fluid" />
              </div>

              <div class="row justify-content-between">
                <div class="col-md-6">
                  <div class="property-summary">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="title-box-d section-t4">
                          <h3 class="title-d">Quick Summary</h3>
                        </div>
                      </div>
                    </div>
                    <div class="summary-list">
                      <ul class="list">
                        <li class="d-flex justify-content-between" v-if="adsStore.ad.area">
                          <strong>Location:</strong>
                          <span
                            >{{ adsStore.ad.area.district.name }} - {{ adsStore.ad.area.name }}
                          </span>
                        </li>
                        <li class="d-flex justify-content-between">
                          <strong>Full Address:</strong>
                          <span>{{ adsStore.ad.full_address }} </span>
                        </li>
                        <li class="d-flex justify-content-between" v-if="adsStore.ad.rent_type">
                          <strong>Type:</strong>
                          <span>{{ adsStore.ad.rent_type.type }}</span>
                        </li>
                        <li class="d-flex justify-content-between">
                          <strong>Rooms:</strong>
                          <span>{{ adsStore.ad.rooms }}</span>
                        </li>
                        <li class="d-flex justify-content-between">
                          <strong>Bathrooms:</strong>
                          <span>{{ adsStore.ad.bathrooms }}</span>
                        </li>
                        <li class="d-flex justify-content-between">
                          <strong>Floor:</strong>
                          <span>{{ adsStore.ad.floor }}</span>
                        </li>
                        <li class="d-flex justify-content-between" v-if="adsStore.ad.price">
                          <strong>Rent:</strong>
                          <span>{{ adsStore.ad.price.toLocaleString() }} BDT</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 section-md-t3">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="title-box-d">
                        <h3 class="title-d">Property Description</h3>
                      </div>
                    </div>
                  </div>
                  <div class="property-description">
                    <p class="description color-text-a text-justify">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt fugit
                      molestias tenetur. Molestias, minima aliquid. Modi nesciunt, aspernatur libero
                      aperiam quae dicta? Recusandae dolorem, debitis nemo quas odit laboriosam
                      quisquam. Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur,
                      quisquam? Vero iure quos magnam id rem dolore expedita quasi, sunt maxime
                      sequi quaerat. Nam cupiditate aliquam repudiandae? Ad, aliquam commodi.
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12 mt-lg-5 mt-4">
              <div class="agent-info-box">
                <div class="agent-title">
                  <div class="title-box-d">
                    <h3 class="title-d">Ad Poster Details</h3>
                  </div>
                </div>
                <div class="agent-content mb-3" v-if="adsStore.ad.poster">
                  <div class="info-agents color-a">
                    <p>
                      <strong>Name: </strong>
                      <span class="color-text-a"> {{ adsStore.ad.poster.name }} </span>
                    </p>
                    <p>
                      <strong>Phone: </strong>
                      <span class="color-text-a"> {{ adsStore.ad.poster.phone ?? 'N/A' }} </span>
                    </p>

                    <p>
                      <strong>Email: </strong>
                      <span class="color-text-a"> {{ adsStore.ad.poster.email }}</span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </template>
  </main>
</template>

<script setup>
import { onMounted } from 'vue'
import { useAdsStore } from '../stores/AdsStore'
import { useRoute, useRouter } from 'vue-router'

const adsStore = useAdsStore()
const route = useRoute()
const router = useRouter()

onMounted(() => {
  adsStore.getSingle(route.params.id).then((d) => console.log(d.data.ad))
})
</script>
