window.addEventListener("load", function () {
    //page loader
    document.querySelector(".page-loader").classList.add("fade-out");
    setTimeout(function () {
        document.querySelector(".page-loader").style.display = "none";
    }, 1500);
    //animation on scroll
    AOS.init();
});

// toggle navbar

const navToggler = document.querySelector(".nav-toggler");

navToggler.addEventListener("click", toggleNav);

function toggleNav() {
    navToggler.classList.toggle("active");
    document.querySelector(".nav").classList.toggle("open");
}

//close nav whe clicking on a nav item

document.addEventListener("click", function (e) {
    if (e.target.closet(".nav-item")) {
        toggleNav();
    }
});

//sticky header

window.addEventListener("scroll", function () {
    var header = document.querySelector("header");
    header.classList.toggle("sticky", window.scrollY > 50);
});

//menu tabs

// const menuTabs = document.querySelector(".menu-tabs");
// menuTabs.addEventListener("click", function (e) {
//     if (e.target.classList.contains("menu-tabs-item") && !e.target.classList.contains("active")) {
//         const target = e.target.getAttribute("data-target");
//         console.log(target);
//     }
// });

const menuTabs = document.querySelector(".menu-tabs");
menuTabs.addEventListener("click", function (e) {
    if (e.target.classList.contains("menu-tabs-item") && !e.target.classList.contains("active")) {
        const target = e.target.getAttribute("data-target");
        menuTabs.querySelector(".active").classList.remove("active");
        e.target.classList.add("active");
        const menuSection = document.querySelector(".menu-section");
        menuSection.querySelector(".menu-tab-content.active").classList.remove("active");
        menuSection.querySelector(target).classList.add("active");
        AOS.init();
    }
});








