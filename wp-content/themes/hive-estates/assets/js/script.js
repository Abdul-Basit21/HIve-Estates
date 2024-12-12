$(document).ready(function () {
    $('.sider-bar-open').on('click', function () {
        $('.sidebar-wrapper').addClass('active');
    })
    $('.sidebar-close').on('click', function () {
        $(this).parent('.sidebar-wrapper').removeClass('active');
    })


    var owl = $(".aminity-slider");
    owl.owlCarousel({
        items: 5,
        margin: 20,
        loop: true,
        nav: true,
        dots: false
    });
});