const menu = document.querySelector("#menu");
const hamburger = document.querySelector("#hamburger");
const closeButton = document.querySelector("#close");
const menuLinks = document.querySelectorAll("#menu nav ul li a");

function toggleMenu() {
    menu.classList.toggle("open");
}

hamburger.addEventListener("click", toggleMenu);
closeButton.addEventListener("click", toggleMenu);

menuLinks.forEach(link => {
    link.addEventListener("click", toggleMenu);
});

const bottomNav = document.querySelector("#bottom-nav");
const footer = document.querySelector("footer");

function handleBottomNavVisibility() {
    if (bottomNav && footer) {
        const footerTop = footer.offsetTop;
        const scrollPosition = window.scrollY + window.innerHeight;
        
        if (scrollPosition >= footerTop - 100) {
            bottomNav.style.opacity = "0";
            bottomNav.style.pointerEvents = "none";
        } else {
            bottomNav.style.opacity = "1";
            bottomNav.style.pointerEvents = "auto";
        }
    }
}

window.addEventListener("scroll", handleBottomNavVisibility);