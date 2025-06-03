document.addEventListener("DOMContentLoaded", function () {
    const menu = document.querySelector(".switch-menu");
    const btnLeft = document.querySelector(".switch-nav-button.is-left");
    const btnRight = document.querySelector(".switch-nav-button.is-right");

    if (menu && btnLeft && btnRight) {
        btnLeft.addEventListener("click", () => {
            menu.scrollBy({ left: -300, behavior: "smooth" });
        });

        btnRight.addEventListener("click", () => {
            menu.scrollBy({ left: 300, behavior: "smooth" });
        });
    }
});