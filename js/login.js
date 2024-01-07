const overlayNotifikasi = document.querySelector(".overlay-notifikasi");
const boxNotifikasi = overlayNotifikasi.children[0];
const btnClose = boxNotifikasi.children[2];

btnClose.addEventListener("click", () => {
    boxNotifikasi.style.animation = "500ms fadeOutUp forwards";
    overlayNotifikasi.style.animation = "500ms fadeOut forwards";
    setTimeout(() => {
        overlayNotifikasi.style.display = "none";
    }, 500);
});
