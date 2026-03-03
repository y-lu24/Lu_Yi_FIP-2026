export function bottomNav() {
    const bottomNav = document.querySelector("#bottom-nav");
    const footer = document.querySelector("footer");

    function handleVisibility() {
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

    window.addEventListener("scroll", handleVisibility);
}