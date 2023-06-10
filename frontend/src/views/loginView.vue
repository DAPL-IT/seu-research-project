<template>
  <main id="main" class="main__margin--y">
    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-12 mx-auto">
            <div class="title-single-box">
              <h1 class="title-single">Login</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Intro Single-->

    <!-- ======= Login  ======= -->
    <section class="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-12 mx-auto">
            <form method="post" class="custom-form" @submit.prevent="handleSubmit">
              <div class="row">
                <div class="col-md-12 mb-3">
                  <div class="form-group">
                    <input
                      type="email"
                      name="email"
                      class="form-control form-control-lg form-control-a"
                      placeholder="Your Email"
                      autocomplete="off"
                      v-model="credentails.email"
                    />
                    <small
                      v-if="validationError && validationError.email"
                      class="form-text text-danger"
                    >
                      {{ validationError.email[0] }}
                    </small>
                  </div>
                </div>
                <div class="col-md-12 mb-3">
                  <div class="form-group">
                    <input
                      type="password"
                      name="password"
                      class="form-control form-control-lg form-control-a"
                      placeholder="Your Password"
                      autocomplete="off"
                      v-model="credentails.password"
                    />
                    <small
                      v-if="validationError && validationError.password"
                      class="form-text text-danger"
                    >
                      {{ validationError.password[0] }}
                    </small>
                  </div>
                </div>

                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-a" :disabled="loginStore.isLoading">
                    {{ `${loginStore.isLoading ? 'Submitting...' : 'Login'}` }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- End Login-->
  </main>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import toaster from '../composables/Toaster'
import { useLoginStore } from '../stores/LoginStore'

const credentails = ref({ email: null, password: null })
const loginStore = useLoginStore()
const validationError = ref(null)
const router = useRouter()

const handleSubmit = () => {
  loginStore
    .login(credentails.value)
    .then((d) => {
      toaster.success(d.message)
      router.push({ name: 'home' })
    })
    .catch((err) => {
      if (err.message) {
        toaster.error(err.message)
      } else {
        validationError.value = err.validation
      }
    })
    .finally(() => {
      credentails.value.password = null
    })
}
</script>
