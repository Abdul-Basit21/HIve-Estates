$(document).ready(function () {
    $('.sider-bar-open').on('click', function () {
        $('.sidebar-wrapper').addClass('active');
    })
    $('.sidebar-close').on('click', function () {
        $(this).parent('.sidebar-wrapper').removeClass('active');
    })


    var owl = $(".aminity-slider");
    owl.owlCarousel({
        items: 5.5,
        margin: 20,
        autoplay: true,
        loop: true,
        nav: true,
        navText: ["<i class='ri-arrow-left-line'></i>", "<i class='ri-arrow-right-line'></i>"],
        dots: false
    });
});