jQuery(document).ready(function($) {

    var header = $('#header'),
        body = $('body');

    // header fade
    $(function() {
        setTimeout(function(){
            body.addClass('show');
        },400);
        setTimeout(function(){
            header.addClass('show');
        }, 1200);
    });


    // header scroll
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