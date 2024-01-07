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

    const gambar = item.children[0];
    const srcGambarLama = gambar.src;
    const inputGambar = gambar.nextElementSibling;

    inputGambar.addEventListener("change", () => {
        if (inputGambar.files && inputGambar.files[0]) {
            var reader = new FileReader();
            reader.onload = (e) => {
                gambar.src = e.target.result;
            };

            reader.readAsDataURL(inputGambar.files[0]);
            btnEdit.setAttribute("type", "submit");
            btnEdit.innerHTML = "Simpan";
            btnHapus.innerHTML = "Batal";
        }
    });

    const btnEditClickHandler = () => {
        if (overlayAdmin.getAttribute("jenis") == "gambar") {
            if (btnEdit.getAttribute("jenis") == "button") {
                item.removeEventListener("mouseover", mouseOverHandler);
                item.removeEventListener("mouseout", mouseOutHandler);
                if (btnEdit.getAttribute("type") != "submit") {
                    inputGambar.click();
                }
            }
        } else {
            if (btnEdit.getAttribute("jenis") == "button") {
                item.removeEventListener("mouseover", mouseOverHandler);
                item.removeEventListener("mouseout", mouseOutHandler);
                btnEdit.innerHTML = "Simpan";
                btnHapus.innerHTML = "Batal";
                overlayAdmin.style.width = "fit-content";
                if (btnEdit.getAttribute("jenis-materi") != "text") {
                    overlayAdmin.style.alignItems = "center";
                }
                inputSpan.value = span.getAttribute("isi");
                inputSpan.style.display = "initial";
                span.style.display = "none";
                btnEdit.setAttribute("jenis", "submit");
            } else {
                btnEdit.setAttribute("type", "submit");
            }
        }
    };

    const konfirmasiHapusCourse = document.querySelector(".konfirmasi-hapus-course");
    const boxKonfirmasiHapusCourse = konfirmasiHapusCourse.children[0];
    const btnBatalKonfirmasiHapusCourse = konfirmasiHapusCourse.children[0].children[1].children[0];
    const btnYakinKonfirmasiHapusCourse = btnBatalKonfirmasiHapusCourse.nextElementSibling;

    const btnHapusClickHandler = (e) => {
        if (btnHapus.innerHTML == "Batal") {
            item.addEventListener("mouseover", mouseOverHandler);
            item.addEventListener("mouseout", mouseOutHandler);
            btnEdit.addEventListener("click", btnEditClickHandler);
            overlayAdmin.style.alignItems = "flex-start";
            if (btnEdit.getAttribute("jenis-materi") == "gambar") {
                btnEdit.innerHTML = "Ganti Gambar";
                inputGambar.value = "";
            } else {
                btnEdit.innerHTML = "Edit";
            }
            btnHapus.innerHTML = "Hapus";
            inputSpan.style.display = "none";
            span.style.display = "block";
            btnEdit.setAttribute("jenis", "button");
            btnEdit.setAttribute("type", "button");
            gambar.src = srcGambarLama;
        } else {
            konfirmasiHapusCourse.style.display = "grid";
            konfirmasiHapusCourse.style.animation = "300ms fadeIn";
            boxKonfirmasiHapusCourse.style.animation = "300ms fadeInDown";
            detailMateriId = e.target.getAttribute("detail-materi-id");
            materiId = e.target.getAttribute("materi-id");
            courseId = e.target.getAttribute("course-id");
        }
    };

    item.addEventListener("mouseover", mouseOverHandler);
    item.addEventListener("mouseout", mouseOutHandler);
    btnEdit.addEventListener("click", btnEditClickHandler);
    btnHapus.addEventListener("click", btnHapusClickHandler);

    btnBatalKonfirmasiHapusCourse.addEventListener("click", () => {
        boxKonfirmasiHapusCourse.style.animation = "300ms fadeOutUp forwards";
        konfirmasiHapusCourse.style.animation = "300ms fadeOut forwards";
        setTimeout(() => {
            konfirmasiHapusCourse.style.display = "none";
        }, 300);
    });

    btnYakinKonfirmasiHapusCourse.addEventListener("click", () => {
        console.log(courseId);
        if (btnHapus.getAttribute("jenis-materi") == "gambar") {
            window.location = `functions/index.php?id-hapus-detail-materi-gambar=${detailMateriId}&materi-id=${materiId}&course-id=${courseId}`;
        } else {
            window.location = `functions/index.php?id-hapus-detail-materi=${detailMateriId}&materi-id=${materiId}&course-id=${courseId}`;
        }
    });
});
