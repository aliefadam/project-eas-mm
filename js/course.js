const courseItems = document.querySelectorAll(".courses-item");
const btnEdits = document.querySelectorAll(".courses-item .admin button.btn-edit");

courseItems.forEach((item) => {
    item.addEventListener("click", () => {
        window.location = "sub-course.php";
    });
});

// let typeBtn = "button";
btnEdits.forEach((item) => {
    const spanCourseName = item.parentElement.previousElementSibling.children[1].children[0];
    const textSpanCourseName = spanCourseName.innerHTML;
    const inputCourseName = item.parentElement.previousElementSibling.children[1].children[1];

    const spanCourseSubName = item.parentElement.previousElementSibling.children[1].children[2];
    const textSpanCourseSubName = spanCourseSubName.innerHTML;
    const inputCourseSubName = item.parentElement.previousElementSibling.children[1].children[3];

    const spanDescription = item.parentElement.parentElement.nextElementSibling.children[0];
    const textSpanDescription = spanDescription.innerHTML;
    const inputDescription = item.parentElement.parentElement.nextElementSibling.children[1];

    const btnBatal = item.previousElementSibling;

    item.addEventListener("click", (e) => {
        e.stopPropagation();
        if (item.getAttribute("jenis") == "button") {
            e.target.innerHTML = `Simpan`;
            e.target.previousElementSibling.style.display = "flex";
            inputCourseName.style.display = "block";
            inputCourseName.value = textSpanCourseName;
            spanCourseName.style.display = "none";

            inputCourseSubName.style.display = "block";
            inputCourseSubName.value = textSpanCourseSubName;
            spanDescription.style.display = "none";

            inputDescription.style.display = "block";
            inputDescription.value = textSpanDescription;
            spanCourseSubName.style.display = "none";

            e.target.setAttribute("jenis", "submit");
        } else {
            e.target.setAttribute("type", "submit");
        }
    });

    inputCourseName.addEventListener("click", (e) => {
        e.stopPropagation();
    });

    inputCourseSubName.addEventListener("click", (e) => {
        e.stopPropagation();
    });

    btnBatal.addEventListener("click", (e) => {
        e.stopPropagation();
        e.target.style.display = "none";
        e.target.nextElementSibling.innerHTML = `Edit`;

        inputCourseName.style.display = "none";
        spanCourseName.style.display = "block";

        inputCourseSubName.style.display = "none";
        spanCourseSubName.style.display = "block";

        inputDescription.style.display = "none";
        spanDescription.style.display = "block";

        item.setAttribute("jenis", "button");
    });
});
