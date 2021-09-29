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

    $('.ritz-page-carousel').slick({
        arrows: true,
        autoplay: false,
        dots: true,
        draggable: true,
        fade: false,
        infinite: true,
        slidesToScroll: 1,
        slidesToShow: 2,
        responsive: [
            {
                breakpoint :768,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
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

    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/player_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    $(document).on(
        'open.zf.reveal', '[data-reveal]', function () {
            let $modal = $(this);
            if($modal.data('ytvideoid')) {
                let $id = $(this).data('id');
                let ytVideoID = $modal.data('ytvideoid');
                let player = new YT.Player('feature-video-' + $id, {
                    width: '800',
                    videoId: ytVideoID,
                    playerVars: {
                        rel: 0,
                        theme: 'light',
                        showinfo: 0,
                        showsearch: 0,
                        autoplay: 1,
                        autohide: 1,
                        modestbranding: 1
                    },
                    events: {}
                });
            } else {
                if($modal.data('galleryid')) {
                    let galleryid = $modal.data('galleryid');
                    $('#gallery-slick-'+galleryid).slick({
                        arrows: true,
                        autoplay: false,
                        autoplaySpeed: 3000,
                        dots: false,
                        draggable: true,
                        fade: false,
                        infinite: true,
                        pauseOnHover: false,
                        slidesToScroll: 1,
                        slidesToShow: 1,
                        speed: 2000
                    });
                }
            }

        }
    );

    $(document).on(
        'closed.zf.reveal', '[data-reveal]', function () {
            $id = $(this).data('id');
            $('#'+$id+' .flex-video iframe').remove();
            $('#'+$id+' .flex-video').append('<div id="feature-video-'+$id+'" />');
        }
    );

    $('.block-ritz-offers-block .filter-row .button-filter').on('click', function (){
        if(!$(this).hasClass('selected')) {
            $('.block-ritz-offers-block .filter-row .button-filter').each(function (){
               $(this).removeClass('selected');
            });
            $(this).addClass('selected');
            if($(this).data('filter-class')=='all') {
                $('.block-ritz-offers-block .offers-grid > .grid-x > .cell').show();
            } else {
                let filterClass = $(this).data('filter-class');
                $('.block-ritz-offers-block .offers-grid > .grid-x > .cell').each(function(){
                    if($(this).hasClass(filterClass)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        }
    });

    $('.block-ritz-image-gallery-block .filter-row .button-filter').on('click', function (){
        if(!$(this).hasClass('selected')) {
            $('.block-ritz-image-gallery-block .filter-row .button-filter').each(function (){
                $(this).removeClass('selected');
            });
            $(this).addClass('selected');
            if($(this).data('filter-class')=='all') {
                $('.block-ritz-image-gallery-block .icontainer').show();
            } else {
                let filterClass = $(this).data('filter-class');
                $('.block-ritz-image-gallery-block .icontainer').each(function(){
                    if($(this).hasClass(filterClass)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        }
    });

    $('.header-main').waypoint(function (direction){
        if(direction=='down') {
            $('.white-top').addClass('visible');
        }
        if(direction=='up') {
            $('.white-top').removeClass('visible');
        }
    },{
        offset: '-100px'
    })

    $('.animated-container').each(function () {
        let $this = $(this);
        $this.waypoint(function (direction) {
            $this.addClass('animate__animated animate__fadeInUp');
        }, {
            offset: '70%',
        });
    })

    $('.animated-background .image').each(function () {
        let $this = $(this);
        $this.waypoint(function (direction) {
            $this.addClass('animated');
        }, {
            offset: '70%',
        });
    });


});