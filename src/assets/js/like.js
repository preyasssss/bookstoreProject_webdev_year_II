// like.js
document.addEventListener("DOMContentLoaded", function () {
    const likeBtn = document.getElementById("like-btn");
    const likeCount = document.getElementById("like-count");

    let count = parseInt(localStorage.getItem("likeCount") || "0");
    likeCount.textContent = count;

    likeBtn.addEventListener("click", function () {
        count++;
        likeCount.textContent = count;
        localStorage.setItem("likeCount", count);
    });
});
