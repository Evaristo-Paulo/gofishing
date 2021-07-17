/*
Template Name: ShopGrids - Bootstrap 5 eCommerce HTML Template.
Author: GrayGrids
*/

(function () {
    //===== Prealoder

    window.onload = function () {
        window.setTimeout(fadeout, 500);
    }

    function fadeout() {
        document.querySelector('.preloader').style.opacity = '0';
        document.querySelector('.preloader').style.display = 'none';
    }


    /*=====================================
    Sticky
    ======================================= */
    window.onscroll = function () {
        var header_navbar = document.querySelector(".navbar-area");
        var sticky = header_navbar.offsetTop;

        // show or hide the back-top-top button
        var backToTo = document.querySelector(".scroll-top");
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            backToTo.style.display = "flex";
        } else {
            backToTo.style.display = "none";
        }
    };

    //===== mobile-menu-btn
    let navbarToggler = document.querySelector(".mobile-menu-btn");
    navbarToggler.addEventListener('click', function () {
        navbarToggler.classList.toggle("active");
    });


})();

var cartUpdateBtn = document.getElementById('cart-update-btn')
var cartUpdateBtnMobile = document.getElementById('cart-update-btn-mobile')

// TABLE MOBILE
var qtdItems = document.querySelectorAll('.qtdItem')
var cartUpdateText = document.querySelectorAll('.cart-update-text')
if (qtdItems) {
    var totalItems = document.querySelectorAll('.totalItem .dtItem')
    qtdItems.forEach((item, index) => {
        item.addEventListener('change', (e) => {
            totalItems[index].innerHTML = e.target.dataset.value * e.target.value
            cartUpdateBtnMobile.style.display = 'block'
            cartUpdateText[0].style.display = 'block'
        })
    })
}

var qtdItemMobiles = document.querySelectorAll('.qtdItemMobile')
if (qtdItemMobiles) {
    var totalItemMobiles = document.querySelectorAll('.totalItemMobile .dtItemMobile')
    qtdItemMobiles.forEach((item, index) => {
        item.addEventListener('change', (e) => {
            totalItemMobiles[index].innerHTML = e.target.dataset.value * e.target.value
            let totalOrderMobile = 0;
            cartUpdateBtn.style.display = 'block'
            cartUpdateText[1].style.display = 'block'
            totalItemMobiles.forEach(item => {
                totalOrderMobile += Number(item.innerHTML)
            })
            var totOrder = document.querySelector('.totalOrderMobile')
            totOrder.innerHTML = totalOrderMobile
        })
    })
}


if (cartUpdateBtn) {
    var cartUpdateForm = document.getElementById('cart-update')
    cartUpdateBtn.addEventListener('click', () => {
        cartUpdateForm.submit();
    })
}

if (cartUpdateBtnMobile) {
    var cartUpdateMobileForm = document.getElementById('cart-update-mobile')
    cartUpdateBtnMobile.addEventListener('click', () => {
        cartUpdateMobileForm.submit();
    })
}

function myFunction(x) {
    if (x.matches) { // If media query matches
        if (cartUpdateBtn) {
            cartUpdateBtn.style.display = 'none'
            cartUpdateText[1].style.display = 'none'
        }
    } else {
        if (cartUpdateBtnMobile) {
            cartUpdateBtnMobile.style.display = 'none'
            cartUpdateText[0].style.display = 'none'
        }
    }
}

var x = window.matchMedia("(max-width: 766px)")
myFunction(x) // Call listener function at run time
x.addListener(myFunction) // Attach listener function on state changes
