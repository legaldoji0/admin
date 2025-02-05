const advDetailsSidebar = document.getElementById("adv-details-sidebar");
const advDetailsBtn = document.getElementById("adv-details-btn");
const aDSClose = document.getElementById("ads-close");

const tickBookSidebar = document.getElementById("tick-book-sidebar");
const tickBookBtn = document.getElementById("tick-book-btn");
const tBSClose = document.getElementById("tbs-close");

const tickDetailsSidebar = document.getElementById("tick-details-sidebar");
const tickDetailsBtn = document.getElementById("tick-details-btn");
const tDSClose = document.getElementById("tds-close");

const tickclosbtn = document.getElementById('tickclosbtn');
const tickopenbtn = document.getElementById('tickopenbtn');
const ticktsec = document.getElementById('ticktsec');

ticktsec.style.display = "none";

aDSClose.addEventListener("click", () => {
    advDetailsSidebar.style.transform = "translateX(500px)";
})
tBSClose.addEventListener("click", () => {
    tickBookSidebar.style.transform = "translateX(500px)";
})
tDSClose.addEventListener("click", () => {
    tickDetailsSidebar.style.transform = "translateX(500px)";
})

advDetailsBtn.addEventListener("click", () => {
    tickDetailsSidebar.style.transform = "translateX(500px)";
    tickBookSidebar.style.transform = "translateX(500px)";
    advDetailsSidebar.style.transform = "translateX(0px)";
})

tickBookBtn.addEventListener("click", () => {
    advDetailsSidebar.style.transform = "translateX(500px)";
    tickDetailsSidebar.style.transform = "translateX(500px)";
    tickBookSidebar.style.transform = "translateX(0px)";
})

tickDetailsBtn.addEventListener("click", () => {
    advDetailsSidebar.style.transform = "translateX(500px)";
    tickBookSidebar.style.transform = "translateX(5000px)";
    tickDetailsSidebar.style.transform = "translateX(0px)";
    // ticktsec.style.display = "none";
})


tickclosbtn.addEventListener("click", () => {
    ticktsec.style.display = "none";
})
tickopenbtn.addEventListener("click", () => {
    ticktsec.style.display = "block";
})