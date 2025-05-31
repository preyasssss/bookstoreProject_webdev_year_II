// clock.js
document.addEventListener("DOMContentLoaded", function () {
    const clock = document.getElementById("live-clock");

    function updateClock() {
        const now = new Date();
        clock.textContent = now.toLocaleTimeString();
    }

    setInterval(updateClock, 1000);
    updateClock(); // call immediately
});
