<template>
    <main id="main" class="main__margin--y">
        <!-- ======= Intro Single ======= -->
        <section class="intro-single">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 mx-auto">
                        <div class="title-single-box">
                            <h1 class="title-single">Register</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Intro Single-->

        <section class="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 mx-auto">
                        <form
                            method="post"
                            class="custom-form"
                            @submit.prevent="handleSubmit"
                        >
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <input
                                            v-model="formData.name"
                                            type="text"
                                            name="name"
                                            class="form-control form-control-lg form-control-a"
                                            placeholder="Full Name"
                                            autocomplete="off"
                                        />
                                        <small
                                            v-if="
                                                validationError &&
                                                validationError.name
                                            "
                                            class="form-text text-danger"
                                        >
                                            {{ validationError.name[0] }}
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <input
                                            v-model="formData.email"
                                            type="email"
                                            name="email"
                                            class="form-control form-control-lg form-control-a"
                                            placeholder="Email"
                                            autocomplete="off"
                                        />
                                        <small
                                            v-if="
                                                validationError &&
                                                validationError.email
                                            "
                                            class="form-text text-danger"
                                        >
                                            {{ validationError.email[0] }}
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <input
                                            v-model="formData.password"
                                            type="password"
                                            name="password"
                                            class="form-control form-control-lg form-control-a"
                                            placeholder="Password"
                                            autocomplete="off"
                                        />
                                        <small
                                            v-if="
                                                validationError &&
                                                validationError.password
                                            "
                                            class="form-text text-danger"
                                        >
                                            {{ validationError.password[0] }}
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <input
                                            v-model="
                                                formData.password_confirmation
                                            "
                                            type="password"
                                            name="password_confirmation"
                                            class="form-control form-control-lg form-control-a"
                                            placeholder="Retype Password"
                                            autocomplete="off"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button
                                        type="submit"
                                        class="btn btn-a"
                                        :disabled="registerStore.isLoading"
                                    >
                                        {{
                                            `${
                                                registerStore.isLoading
                                                    ? "Submitting..."
                                                    : "Register"
                                            }`
                                        }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import toaster from "../composables/Toaster";
import { useRegisterStore } from "../stores/RegisterStore";

const formData = ref({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});

const validationError = ref(null);
const router = useRouter();
const registerStore = useRegisterStore();

const handleSubmit = () => {
    registerStore
        .register(formData.value)
        .then((d) => {
            toaster.success(d.message);
            router.push({ name: "login" });
        })
        .catch((err) => {
            if (err.message) {
                toaster.error(err.message);
            } else {
                validationError.value = err.validation;
            }
        });
};
</script>
