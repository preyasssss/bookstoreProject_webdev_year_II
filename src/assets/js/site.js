document.addEventListener("DOMContentLoaded", function () {
    // LIKE
    const likeBtn = document.getElementById("like-btn");
    const likeCount = document.getElementById("like-count");
    let count = localStorage.getItem("siteLikes") || 0;
    likeCount.textContent = count;

    likeBtn.addEventListener("click", function () {
        count++;
        localStorage.setItem("siteLikes", count);
        likeCount.textContent = count;
    });

    // SHARE
    const shareBtn = document.getElementById("share-btn");
    shareBtn.addEventListener("click", function () {
        navigator.clipboard.writeText(window.location.href)
            .then(() => alert("Link copied to clipboard!"))
            .catch(() => alert("Failed to copy link."));
    });

    // CLOCK
    const clock = document.getElementById("live-clock");
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString();
        clock.textContent = timeString;
    }
    updateClock();
    setInterval(updateClock, 1000);
});
