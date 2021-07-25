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

    $('#bookings-panel-mobile').on(
        'show.zf.dropdown', function() {
            $('#bookings-panel-mobile').css('display', 'none');
            $('#bookings-panel-mobile').fadeIn('fast');
        });
    $('#bookings-panel-mobile').on(
        'hide.zf.dropdown', function() {
            /*$('#bookings-panel-mobile').css('display', 'inherit');
            $('#bookings-panel-mobile').fadeOut('slow');*/
        });

    $("a[data-bookatable]").each(function () {
        let connectionid = $(this).data("connectionid");
        let restaurantid = $(this).data("restaurantid");
        let basecolor = $(this).data("basecolor");
        let promotionid = $(this).data("promotionid");
        let sessionid = $(this).data("sessionid");
        let conversionjs = $(this).data("conversionjs");
        let gaaccountnumber = $(this).data("gaaccountnumber");
        //window.console.log(connectionid+':'+restaurantid+':'+basecolor+':'+promotionid+':'+sessionid+':'+gaaccountnumber);
        if(connectionid != '') {
            if(restaurantid != '') {
                let obj = {
                    connectionid  :  connectionid,
                    restaurantid : restaurantid,
                    modalWindow  :  {enabled  :  true}
                };
                if(basecolor != '') {
                    obj.style = {
                        baseColor : basecolor
                    };
                }
                if(promotionid != '') {
                    obj.promotionid = promotionid;
                }
                if(sessionid != '') {
                    obj.preselect = {
                        sessionid : sessionid
                    };
                }
                if(conversionjs != '') {
                    obj.conversionjs = conversionjs;
                }
                if(gaaccountnumber != '') {
                    obj.gaaccountnumber = gaaccountnumber;
                }
                $(this).lbuiDirect(obj);
            }
        }
    });

    $('.dining .top-button, .reservations .top-button').on('click', function (e){
        $(this).preventDefault;
    });

});