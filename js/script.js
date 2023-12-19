const loginBox = document.querySelector(".login");
const itemLoginBox = loginBox.children;
const ganti = document.querySelector(".form-item a");

ganti.addEventListener("click", (e) => {
    const a = document.querySelector(".form-item a");
    const form = document.querySelector("form");
    const formItemEmail = document.querySelector(".form-item:first-child");
    const formItemTombol = document.querySelector(".form-item.tombol");
    const tombol = formItemTombol.querySelector("button");

    e.preventDefault();
    loginBox.style.height = "0";
    for (let i = 0; i < itemLoginBox.length; i++) {
        itemLoginBox[i].style.transition = "500ms";
        itemLoginBox[i].style.opacity = "0";
        setTimeout(() => {
            itemLoginBox[i].style.display = "none";
        }, 50);
    }

    if (a.getAttribute("form") == "register") {
        setTimeout(() => {
            loginBox.style.height = "calc(100vh - 50px)";
            setTimeout(() => {
                for (let i = 0; i < itemLoginBox.length; i++) {
                    itemLoginBox[i].style.transition = "500ms";
                    itemLoginBox[i].style.opacity = "1";
                }
                setTimeout(() => {
                    tombol.innerHTML = "DAFTAR";
                    a.innerHTML = "Sudah punya akun ? Silahkan Login";
                    a.setAttribute("form", "login");

                    itemLoginBox[0].innerHTML = "REGISTER";
                    const formItemNamaDepan = document.createElement("div");
                    formItemNamaDepan.setAttribute("class", "form-item");

                    const labelNamaDepan = document.createElement("label");
                    const teksLabelNamaDepan = document.createTextNode("Nama Depan");
                    labelNamaDepan.setAttribute("for", "nama-depan");
                    labelNamaDepan.append(teksLabelNamaDepan);
                    formItemNamaDepan.append(labelNamaDepan);

                    const inputNamaDepan = document.createElement("input");
                    inputNamaDepan.setAttribute("required", "");
                    inputNamaDepan.setAttribute("type", "text");
                    inputNamaDepan.setAttribute("name", "nama-depan");
                    inputNamaDepan.setAttribute("id", "nama-depan");
                    formItemNamaDepan.append(inputNamaDepan);

                    const formItemNamaBelakang = document.createElement("div");
                    formItemNamaBelakang.setAttribute("class", "form-item");

                    const labelNamaBelakang = document.createElement("label");
                    const teksLabelNamaBelakang = document.createTextNode("Nama Belakang");
                    labelNamaBelakang.setAttribute("for", "nama-belakang");
                    labelNamaBelakang.append(teksLabelNamaBelakang);
                    formItemNamaBelakang.append(labelNamaBelakang);

                    const inputNamaBelakang = document.createElement("input");
                    inputNamaBelakang.setAttribute("required", "");
                    inputNamaBelakang.setAttribute("type", "text");
                    inputNamaBelakang.setAttribute("name", "nama-belakang");
                    inputNamaBelakang.setAttribute("id", "nama-belakang");
                    formItemNamaBelakang.append(inputNamaBelakang);

                    const formItemCol = document.createElement("div");
                    formItemCol.setAttribute("class", "form-item-col");
                    formItemCol.append(formItemNamaDepan);
                    formItemCol.append(formItemNamaBelakang);
                    formItemEmail.before(formItemCol);

                    const formItemKonfirmasiKataSandi = document.createElement("div");
                    formItemKonfirmasiKataSandi.setAttribute("class", "form-item");

                    const labelKonfirmasiKataSandi = document.createElement("label");
                    const teksLabelKonfirmasiKataSandi = document.createTextNode("Konfirmasi Kata Sandi");
                    labelKonfirmasiKataSandi.setAttribute("for", "konfirmasi-kata-sandi");
                    labelKonfirmasiKataSandi.append(teksLabelKonfirmasiKataSandi);
                    formItemKonfirmasiKataSandi.append(labelKonfirmasiKataSandi);

                    const inputKonfirmasiKataSandi = document.createElement("input");
                    inputKonfirmasiKataSandi.setAttribute("required", "");
                    inputKonfirmasiKataSandi.setAttribute("type", "password");
                    inputKonfirmasiKataSandi.setAttribute("name", "konfirmasi-kata-sandi");
                    inputKonfirmasiKataSandi.setAttribute("id", "konfirmasi-kata-sandi");
                    formItemKonfirmasiKataSandi.append(inputKonfirmasiKataSandi);
                    formItemTombol.before(formItemKonfirmasiKataSandi);

                    itemLoginBox[0].style.display = "block";
                    itemLoginBox[1].style.display = "flex";

                    tombol.setAttribute("name", "register");
                }, 100);
            }, 400);
        }, 500);
    } else {
        setTimeout(() => {
            loginBox.style.height = "calc(100vh - 150px)";
            setTimeout(() => {
                for (let i = 0; i < itemLoginBox.length; i++) {
                    itemLoginBox[i].style.transition = "500ms";
                    itemLoginBox[i].style.opacity = "1";
                }
                setTimeout(() => {
                    tombol.innerHTML = "LOGIN";
                    a.innerHTML = "Belum punya akun? Silahkan Daftar";
                    a.setAttribute("form", "register");

                    itemLoginBox[0].innerHTML = "LOGIN";

                    const formItemCol = document.querySelector(".form-item-col");
                    const formItemKonfirmasiKataSandi = document.querySelector(".form-item:nth-child(4)");
                    formItemCol.remove();
                    formItemKonfirmasiKataSandi.remove();

                    itemLoginBox[0].style.display = "block";
                    itemLoginBox[1].style.display = "flex";

                    tombol.setAttribute("name", "login");
                }, 100);
            }, 400);
        }, 500);
    }
});
