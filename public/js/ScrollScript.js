window.addEventListener('scroll', (event) => {
    const navbar = document.querySelector(".navbar");
    if (window.pageYOffset > 0) {
        navbar.classList.add("nav-scroll");
    } else {
        navbar.classList.remove("nav-scroll");
    }
});