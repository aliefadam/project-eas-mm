const btnTambahJudul = document.querySelector(".btn-tambah-judul");
const containerTambahJudul = document.querySelector(".tambah-judul");
const btnTambahTeks = document.querySelector(".btn-tambah-teks");
const containerTambahTeks = document.querySelector(".tambah-teks");
const btnTambahGambar = document.querySelector(".btn-tambah-gambar");
const containerTambahGambar = document.querySelector(".tambah-gambar");
const inputTambahGambar = document.getElementById("pilih-gambar");

btnTambahJudul.addEventListener("click", () => {
    if (btnTambahJudul.innerHTML == "+ Judul") {
        containerTambahJudul.style.display = "initial";
        containerTambahJudul.style.animation = "500ms fadeInDown forwards";
        btnTambahJudul.innerHTML = "X Batal";
    } else {
        btnTambahJudul.innerHTML = "+ Judul";
        containerTambahJudul.style.animation = "500ms fadeOutUp forwards";
        setTimeout(() => {
            containerTambahJudul.style.display = "none";
        }, 400);
    }
});

btnTambahTeks.addEventListener("click", () => {
    if (btnTambahTeks.innerHTML == "+ Teks") {
        containerTambahTeks.style.display = "initial";
        containerTambahTeks.style.animation = "500ms fadeInDown forwards";
        btnTambahTeks.innerHTML = "X Batal";
    } else {
        btnTambahTeks.innerHTML = "+ Teks";
        containerTambahTeks.style.animation = "500ms fadeOutUp forwards";
        setTimeout(() => {
            containerTambahTeks.style.display = "none";
        }, 400);
    }
});

btnTambahGambar.addEventListener("click", () => {
    if (btnTambahGambar.innerHTML == "+ Gambar") {
        inputTambahGambar.click();
    } else {
        containerTambahGambar.style.animation = "500ms fadeOutUp forwards";
        btnTambahGambar.innerHTML = "+ Gambar";
        setTimeout(() => {
            containerTambahGambar.style.display = "none";
        }, 400);
    }
});

inputTambahGambar.addEventListener("change", (e) => {
    containerTambahGambar.style.display = "flex";
    containerTambahGambar.style.animation = "500ms fadeInDown forwards";
    btnTambahGambar.innerHTML = "X Batal";
});
