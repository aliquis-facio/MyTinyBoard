window.addEventListener("DOMContentLoaded",
    function () {
        showContentOrComent('content');
    }
);

function showContentOrComent(showing) {
    let content = document.getElementById("my-content-list");
    let coment = document.getElementById("my-coment-list");

    content.style.display = "none";
    coment.style.display = "none";

    if (showing === "content") {
        content.style.display = "block";
    } else if (showing === "coment") {
        coment.style.display = "block";
    }
}