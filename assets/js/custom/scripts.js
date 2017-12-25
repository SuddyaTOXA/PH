jQuery(document).ready(function($) {
    // header scroll
    var header = $('#header');
    $(window).on('scroll', function () {
        var st2 = $(this).scrollTop();

        if (st2 > 0) {
            console.log(st2);
            header.addClass('scrolling');

        } else {
            header.removeClass('scrolling');
        }
    });

    $(document).ready(function () {
        // for burger menu
        $('.mobile-menu-toggle, .mobile-menu-overlay').on('click', function () {
            $('.mobile-menu-toggle').toggleClass('active');
            $('.mobile-menu-wrap').toggleClass('showing');
            $(document.body).toggleClass('overflow');
        });
    });
});