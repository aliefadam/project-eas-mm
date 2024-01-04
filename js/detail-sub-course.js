const adminEdit = document.querySelectorAll(".admin-edit");

adminEdit.forEach((item) => {
    const span = item.children[0];
    const inputSpan = item.children[1];
    const overlayAdmin = item.children[2];
    const btnEdit = overlayAdmin.children[1];
    const btnHapus = overlayAdmin.children[0];

    const mouseOverHandler = () => {
        overlayAdmin.style.display = "flex";
    };

    const mouseOutHandler = () => {
        overlayAdmin.style.display = "none";
    };

    const btnEditClickHandler = () => {
        if (btnEdit.getAttribute("jenis") == "button") {
            item.removeEventListener("mouseover", mouseOverHandler);
            item.removeEventListener("mouseout", mouseOutHandler);
            btnEdit.innerHTML = "Simpan";
            btnHapus.innerHTML = "Batal";
            overlayAdmin.style.width = "fit-content";
            overlayAdmin.style.alignItems = "center";
            inputSpan.value = span.getAttribute("isi");
            inputSpan.style.display = "initial";
            span.style.display = "none";
            btnEdit.setAttribute("jenis", "submit");
        } else {
            btnEdit.setAttribute("type", "submit");
        }
    };

    const btnHapusClickHandler = () => {
        item.addEventListener("mouseover", mouseOverHandler);
        item.addEventListener("mouseout", mouseOutHandler);
        btnEdit.addEventListener("click", btnEditClickHandler);
        overlayAdmin.style.alignItems = "flex-start";
        btnEdit.innerHTML = "Edit";
        btnHapus.innerHTML = "Hapus";
        inputSpan.style.display = "none";
        span.style.display = "block";
        btnEdit.setAttribute("jenis", "button");
    };

    item.addEventListener("mouseover", mouseOverHandler);
    item.addEventListener("mouseout", mouseOutHandler);
    btnEdit.addEventListener("click", btnEditClickHandler);
    btnHapus.addEventListener("click", btnHapusClickHandler);
});

// adminEdit.addEventListener("mouseover", () => {
//     overlayAdmin.style.display = "flex";
// });
// adminEdit.addEventListener("mouseout", () => {
//     overlayAdmin.style.display = "none";
// });

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
