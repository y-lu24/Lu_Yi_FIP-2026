export function burgerMenu() {
    const menu = document.querySelector("#menu");
    const hamburger = document.querySelector("#hamburger");
    const closeButton = document.querySelector("#close");
    const menuLinks = document.querySelectorAll("#menu nav ul li a");

    function toggleMenu() {
        if (menu) {
            menu.classList.toggle("open");
        }
    }

    if (hamburger) hamburger.addEventListener("click", toggleMenu);
    if (closeButton) closeButton.addEventListener("click", toggleMenu);

    menuLinks.forEach(link => {
        link.addEventListener("click", toggleMenu);
    });
}