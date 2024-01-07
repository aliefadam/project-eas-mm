const logout = document.querySelector("span.logout");

logout.addEventListener("click", () => {
    location = "logout.php";
});

const detail = document.querySelector(".detail");
const gantiKataSandi = document.querySelector(".ubah-kata-sandi");
const btnGantiKataSandi = detail.children[2].children[0];
const btnBatalGantiKataSandi = gantiKataSandi.children[1].children[3].children[0];

let editNama = false;
let editFoto = false;
const foto = document.querySelector(".foto");

let srcLama = foto.src;

btnGantiKataSandi.addEventListener("click", () => {
    if (editNama) {
        simpanPerubahan.style.animation = "1000ms slideUp forwards";
        spanNama.style.display = "initial";
        inputEditNama.style.display = "none";
        setTimeout(() => {
            simpanPerubahan.style.display = "none";
            simpanPerubahanFoto.style.display = "none";
            //
            detail.style.animation = "500ms slideLeft forwards";
            setTimeout(() => {
                detail.style.display = "none";
                gantiKataSandi.style.display = "flex";
                gantiKataSandi.style.animation = "500ms slideDown forwards";
            }, 300);
        }, 200);
    } else if (editFoto) {
        foto.src = srcLama;
        simpanPerubahanFoto.style.animation = "1000ms slideUp forwards";
        setTimeout(() => {
            simpanPerubahanFoto.style.display = "none";
            detail.style.animation = "500ms slideLeft forwards";
            setTimeout(() => {
                detail.style.display = "none";
                gantiKataSandi.style.display = "flex";
                gantiKataSandi.style.animation = "500ms slideDown forwards";
            }, 300);
        }, 200);
    } else {
        detail.style.animation = "500ms slideLeft forwards";
        setTimeout(() => {
            detail.style.display = "none";
            gantiKataSandi.style.display = "flex";
            gantiKataSandi.style.animation = "500ms slideDown forwards";
        }, 300);
    }
});

btnBatalGantiKataSandi.addEventListener("click", () => {
    if (editNama) {
        editNama = !editNama;
    } else if (editFoto) {
        editFoto = !editFoto;
    }
    gantiKataSandi.style.animation = "500ms slideUp forwards";
    setTimeout(() => {
        gantiKataSandi.style.display = "none";
        detail.style.display = "flex";
        detail.style.animation = "500ms slideRight forwards";
    }, 400);
});

const btnEditNama = document.querySelector(".btn-edit-nama");
const inputEditNama = document.querySelector(".ubah-nama");
const spanNama = document.querySelector("span.nama");
const simpanPerubahan = document.querySelector(".simpan-perubahan");
const btnBatal = simpanPerubahan.children[0];

btnEditNama.addEventListener("click", () => {
    editNama = !editNama;
    spanNama.style.display = "none";
    inputEditNama.value = spanNama.textContent;
    inputEditNama.style.display = "initial";
    simpanPerubahan.style.display = "flex";
    simpanPerubahan.style.animation = "300ms slideDown forwards";
});

btnBatal.addEventListener("click", () => {
    editNama = !editNama;
    simpanPerubahan.style.animation = "1000ms slideUp forwards";
    spanNama.style.display = "initial";
    inputEditNama.style.display = "none";
    setTimeout(() => {
        simpanPerubahan.style.display = "none";
    }, 200);
});

const inputEditFoto = document.getElementById("foto_baru");
const simpanPerubahanFoto = document.querySelector(".simpan-perubahan-foto");
const btnBatalPerubahanFoto = simpanPerubahanFoto.children[0];
foto.addEventListener("click", () => {
    inputEditFoto.click();
});

inputEditFoto.addEventListener("change", () => {
    editFoto = !editFoto;
    simpanPerubahanFoto.style.display = "flex";
    simpanPerubahanFoto.style.animation = "300ms slideDown forwards";
    const reader = new FileReader();
    reader.onload = (e) => {
        foto.src = e.target.result;
    };
    reader.readAsDataURL(inputEditFoto.files[0]);
});

btnBatalPerubahanFoto.addEventListener("click", () => {
    inputEditFoto.value = "";
    foto.src = srcLama;
    editFoto = !editFoto;
    simpanPerubahanFoto.style.animation = "1000ms slideUp forwards";
    setTimeout(() => {
        simpanPerubahanFoto.style.display = "none";
    }, 200);
});
