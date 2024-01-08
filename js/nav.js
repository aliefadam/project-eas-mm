const home = document.querySelector(".home");
const body = document.body;
const nav = document.querySelector("nav");

window.addEventListener("scroll", () => {
    const posisiScroll = window.scrollY;
    if (posisiScroll >= 60) {
        nav.style.animation = "300ms fadeInDown forwards";
        nav.classList.add("scrolling");
    } else {
        nav.style.animation = "";
        nav.classList.remove("scrolling");
    }
});
