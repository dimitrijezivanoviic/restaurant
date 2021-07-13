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

// window.addEventListener("scroll", function () {
//     if (this.pageYOffset > 60) {
//         document.querySelector(".header").classList.add("sticky");
//     } else {
//         document.querySelector(".header").classList.remove("sticky");
//     }
// });

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
        menuSection.querySelector(".account-tab-content.active").classList.remove("active");
        menuSection.querySelector(target).classList.add("active");
    }
});



function updateCheckBox(opts) {
    var chks = document.getElementsByName("sadrzaj[]");

    if (opts.value == 'Svinjsko' || opts.value == 'Junece' || opts.value == 'Pilece') {
        for (var i = 0; i <= chks.length - 1; i++) {
            chks[i].disabled = false;
        }
    }
    else {
        for (var i = 0; i <= chks.length - 1; i++) {
            chks[i].disabled = true;
            chks[i].checked = false;
        }
    }
}

function enableCheckBox(opts1) {
    var chks1 = document.getElementsByName("dodatak[]");

    if (opts1.value == 'Mala' || opts1.value == 'Velika') {
        for (var i = 0; i <= chks1.length - 1; i++) {
            chks1[i].disabled = false;
        }
    }
    else {
        for (var i = 0; i <= chks1.length - 1; i++) {
            chks1[i].disabled = true;
            chks1[i].checked = false;
        }
    }
}


