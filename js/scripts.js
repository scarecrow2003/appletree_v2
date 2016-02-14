(function($) {
    $(".dropdown-toggle").hover(
        function() {
            $(".dropdown").removeClass("open");//close the other open ones first
            $(this).parent().addClass("open");
        },

        function() {
            //$(this).parent().removeClass("open");
        }
    );

    $(".dropdown-menu-custom").hover(
        function() {
            //nothing here
        },

        function() {
            $(this).parent().removeClass("open");
        }
    );

    $(".menu-item-link").hover(
        function() {
            $(this).focus();
            $(".dropdown").removeClass("open");
        },

        function() {
            $(this).blur();
        }
    );

    $('[data-toggle=offcanvas]').click(function() {
        $('.row-offcanvas').toggleClass('active');
    });
})(jQuery);