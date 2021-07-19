jQuery(document).ready(function ($) {

    $('#ritz-main-image-gallery').slick({
        arrows: false,
        autoplay: true,
        autoplaySpeed: 3000,
        dots: false,
        draggable: true,
        fade: true,
        infinite: true,
        pauseOnHover: false,
        slidesToScroll: 1,
        slidesToShow: 1,
        speed: 2000
    });

    $('#bookings-panel').on(
        'show.zf.dropdown', function() {
            $('#bookings-panel').css('display', 'none');
            $('#bookings-panel').fadeIn('fast');
        });
    $('#bookings-panel').on(
        'hide.zf.dropdown', function() {
            /*$('#bookings-panel').css('display', 'inherit');
            $('#bookings-panel').fadeOut('slow');*/
        });



});