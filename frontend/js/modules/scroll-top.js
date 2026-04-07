export function scrollTop() {
    const btn = document.querySelector("#scroll-top-btn");

    btn.addEventListener("click", function() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
}