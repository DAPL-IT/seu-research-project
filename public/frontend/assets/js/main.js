const searchBtn = document.querySelectorAll(".navbar-toggle-box-collapse");

const bodyElem = document.querySelector("body");
const closeBtn = document.querySelectorAll(
    ".close-box-collapse, .click-closed"
);

const navbarTogglerBtn = document.getElementById("nav-menu-toggler-btn");
const mainNavbar = document.getElementById("main-nav");

searchBtn.forEach((item) => {
    item.addEventListener("click", (e) => {
        bodyElem.classList.remove("box-collapse-closed");
        bodyElem.classList.add("box-collapse-open");
    });
});

closeBtn.forEach((item) => {
    item.addEventListener("click", (e) => {
        bodyElem.classList.remove("box-collapse-open");
        bodyElem.classList.add("box-collapse-closed");
    });
});

navbarTogglerBtn.addEventListener("click", (e) => {
    const target = e.currentTarget;
    if (target.classList.toString().includes("collapsed")) {
        target.classList.remove("collapsed");
        mainNavbar.classList.add("show");
    } else {
        target.classList.add("collapsed");
        mainNavbar.classList.remove("show");
    }
});
