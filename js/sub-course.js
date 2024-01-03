const btnTambahMateri = document.querySelector(".aksi button");
btnTambahMateri.addEventListener("click", () => {
    if (btnTambahMateri.innerHTML == "+ Tambah Materi") {
        btnTambahMateri.parentElement.nextElementSibling.style.animation = "500ms fadeInDown forwards";
        btnTambahMateri.parentElement.nextElementSibling.style.display = "block";
        btnTambahMateri.innerHTML = "X Batal";
    } else {
        btnTambahMateri.parentElement.nextElementSibling.style.animation = "500ms fadeOutUp forwards";
        setTimeout(() => {
            btnTambahMateri.parentElement.nextElementSibling.style.display = "none";
            btnTambahMateri.innerHTML = "+ Tambah Materi";
        }, 400);
    }
});

const btnEdits = document.querySelectorAll(".btn-edit");

btnEdits.forEach((btnEdit) => {
    const inputEditMateri = btnEdit.parentElement.previousElementSibling.children[1].children[1];
    const spanMateri = inputEditMateri.previousElementSibling;
    const btnHapus = btnEdit.previousElementSibling;

    inputEditMateri.style.display = "none";

    btnEdit.addEventListener("click", (e) => {
        if (btnEdit.innerHTML != "Simpan") {
            e.preventDefault();
            inputEditMateri.value = spanMateri.getAttribute("nama-materi");
            inputEditMateri.style.display = "initial";
            spanMateri.style.display = "none";

            btnHapus.innerHTML = "Batal";
            btnEdit.innerHTML = "Simpan";
            btnEdit.setAttribute("type", "submit");
        } else {
            btnEdit.setAttribute("name", "update-materi");
        }
    });

    inputEditMateri.addEventListener("click", (e) => {
        e.preventDefault();
    });

    const konfirmasiHapusCourse = document.querySelector(".konfirmasi-hapus-course");
    const boxKonfirmasiHapusCourse = konfirmasiHapusCourse.children[0];
    const btnBatalKonfirmasiHapusCourse = konfirmasiHapusCourse.children[0].children[1].children[0];
    const btnYakinKonfirmasiHapusCourse = btnBatalKonfirmasiHapusCourse.nextElementSibling;

    btnHapus.addEventListener("click", (e) => {
        e.stopPropagation();
        e.preventDefault();
        if (btnHapus.innerHTML == "Batal") {
            inputEditMateri.style.display = "none";
            spanMateri.style.display = "initial";
            btnHapus.innerHTML = "Hapus";
            btnEdit.innerHTML = "Edit";
        } else {
            konfirmasiHapusCourse.style.display = "grid";
            konfirmasiHapusCourse.style.animation = "300ms fadeIn";
            boxKonfirmasiHapusCourse.style.animation = "300ms fadeInDown";
            materiId = e.target.getAttribute("materi-id");
            courseId = e.target.getAttribute("course-id");
        }
    });

    btnBatalKonfirmasiHapusCourse.addEventListener("click", () => {
        boxKonfirmasiHapusCourse.style.animation = "300ms fadeOutUp forwards";
        konfirmasiHapusCourse.style.animation = "300ms fadeOut forwards";
        setTimeout(() => {
            konfirmasiHapusCourse.style.display = "none";
        }, 300);
    });

    btnYakinKonfirmasiHapusCourse.addEventListener("click", () => {
        window.location = `functions/index.php?id-hapus-materi=${materiId}&course-id=${courseId}`;
    });
});
