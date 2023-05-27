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
                        <form method="post" class="custom-form">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <input
                                            type="email"
                                            name="email"
                                            class="form-control form-control-lg form-control-a"
                                            placeholder="Your Email"
                                            autocomplete="off"
                                        />
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
                                        />
                                    </div>
                                </div>

                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-a">
                                        Login
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

<script setup></script>
