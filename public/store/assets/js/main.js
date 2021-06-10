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

// TABLE MOBILE
var qtdItems = document.querySelectorAll('.qtdItem')
if (qtdItems) {
    var totalItems = document.querySelectorAll('.totalItem .dtItem')
    qtdItems.forEach((item, index) => {
        item.addEventListener('change', (e) => {
            totalItems[index].innerHTML = e.target.dataset.value * e.target.value
            let totalOrder = 0;
            totalItems.forEach(item => {
                totalOrder += Number(item.innerHTML)
            })
            var totOrder = document.querySelector('.totalOrder')
            totOrder.innerHTML = totalOrder
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
            totalItemMobiles.forEach(item => {
                totalOrderMobile += Number(item.innerHTML)
            })
            var totOrder = document.querySelector('.totalOrderMobile')
            totOrder.innerHTML = totalOrderMobile
        })
    })
}