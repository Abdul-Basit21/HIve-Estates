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
        autoplaySpeed: 2000,
        loop: true,
        nav: true,
        navText: ["<i class='ri-arrow-left-line'></i>", "<i class='ri-arrow-right-line'></i>"],
        dots: false
    });

    var owl = $(".property_sale_carousel");
    owl.owlCarousel({
        items: 3.5,
        margin: 20,
        autoplay: true,
        autoplaySpeed: 2000,
        loop: true,
        nav: true,
        navText: ["<i class='ri-arrow-left-line'></i>", "<i class='ri-arrow-right-line'></i>"],
        dots: false
    });


    $(".gallery-masonry-item [data-fancybox]").fancybox({
        loop: true,
        buttons: [
            "zoom",
            "slideShow",
            "fullScreen",
            "close"
        ]
    });




    var bigimage = $("#big");
    var thumbs = $("#thumbs");
    //var totalslides = 10;
    var syncedSecondary = true;

    bigimage
        .owlCarousel({
            items: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            nav: false,
            dots: false,
            loop: true,
            responsiveRefreshRate: 200,
        })
        .on("changed.owl.carousel", syncPosition);

    thumbs
        .on("initialized.owl.carousel", function () {
            thumbs
                .find(".owl-item")
                .eq(0)
                .addClass("current");
        })
        .owlCarousel({
            items: 4,
            dots: false,
            nav: false,
            margin: 12,
            autoplay: false,
            slideBy: 1,
            responsiveRefreshRate: 100
        })
        .on("changed.owl.carousel", syncPosition2);

    function syncPosition(el) {
        //if loop is set to false, then you have to uncomment the next line
        //var current = el.item.index;

        //to disable loop, comment this block
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }
        //to this
        thumbs
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = thumbs.find(".owl-item.active").length - 1;
        var start = thumbs
            .find(".owl-item.active")
            .first()
            .index();
        var end = thumbs
            .find(".owl-item.active")
            .last()
            .index();

        if (current > end) {
            thumbs.data("owl.carousel").to(current, 100, true);
        }
        if (current < start) {
            thumbs.data("owl.carousel").to(current - onscreen, 100, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            bigimage.data("owl.carousel").to(number, 100, true);
        }
    }

    thumbs.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        bigimage.data("owl.carousel").to(number, 300, true);
    });

    $(".property-detail-gallery [data-fancybox]").fancybox({
        loop: true,
        buttons: [
            "zoom",
            "slideShow",
            "fullScreen",
            "close"
        ]
    });

});

gsap.from('.gallery-masonry-wrapper div', {
    y: -20,
    delay: 0.5,
    opacity: 0,
    stagger: 0.2,
    scrollTrigger: {
        trigger: '.gallery-masonry-container',
        scroller: 'body',
    }
});
gsap.from('.hive-accordion div.accordion-item', {
    x: -20,
    delay: 0.5,
    opacity: 0,
    stagger: 0.2,
    scrollTrigger: {
        trigger: '.faqs-container',
        scroller: 'body',
    }
});

