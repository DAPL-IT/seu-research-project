import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/",
            name: "home",
            component: () => import("../views/HomeView.vue"),
        },
        {
            path: "/:catchAll(.*)",
            name: "not_found",
            component: () => import("../views/NotFoundView.vue"),
        },
    ],
});

export default router;
