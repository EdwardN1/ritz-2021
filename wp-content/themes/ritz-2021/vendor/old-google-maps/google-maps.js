(function ($) {

    /*
     *  render_map
     *
     *  This function will render a Google Map onto the selected jQuery element
     *
     *  @type	function
     *  @date	8/11/2013
     *  @since	4.3.0
     *
     *  @param	$el (jQuery element)
     *  @return	n/a
     */

    var map;
    var mMap;
    var firstMarker = true;
    var directionsService = new google.maps.DirectionsService;
    var currentTravelMode = 'DRIVING'; /* TRANSIT WALKING BICYCLING */
    var directionsDisplay = new google.maps.DirectionsRenderer;
    var directionsVisible = false;
    var markersToRemove = [];
    var styledMapType = new google.maps.StyledMapType([{
        "featureType": "all",
        "elementType": "labels.text.fill",
        "stylers": [{"saturation": 36}, {"color": "#181818"}, {"lightness": 40}]
    }, {
        "featureType": "all",
        "elementType": "labels.text.stroke",
        "stylers": [{"visibility": "on"}, {"color": "#ffffff"}, {"lightness": 16}]
    }, {
        "featureType": "all",
        "elementType": "labels.icon",
        "stylers": [{"visibility": "off"}]
    }, {
        "featureType": "administrative",
        "elementType": "all",
        "stylers": [{"visibility": "off"}]
    }, {
        "featureType": "administrative",
        "elementType": "geometry",
        "stylers": [{"visibility": "on"}]
    }, {
        "featureType": "administrative",
        "elementType": "geometry.fill",
        "stylers": [{"color": "#fefefe"}, {"lightness": 20}]
    }, {
        "featureType": "administrative",
        "elementType": "geometry.stroke",
        "stylers": [{"color": "#fefefe"}, {"lightness": 17}, {"weight": 1.2}]
    }, {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [{"color": "#ff0000"}, {"visibility": "on"}]
    }, {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [{"lightness": 20}, {"visibility": "off"}]
    }, {
        "featureType": "landscape",
        "elementType": "geometry.fill",
        "stylers": [{"visibility": "on"}, {"color": "#e6e5e5"}]
    }, {
        "featureType": "landscape.man_made",
        "elementType": "all",
        "stylers": [{"visibility": "off"}]
    }, {
        "featureType": "landscape.man_made",
        "elementType": "labels",
        "stylers": [{"visibility": "off"}]
    }, {
        "featureType": "landscape.natural.landcover",
        "elementType": "geometry.fill",
        "stylers": [{"visibility": "on"}]
    }, {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "on"}]}, {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [{"color": "#a3a3a3"}, {"lightness": 21}, {"visibility": "on"}]
    }, {
        "featureType": "poi",
        "elementType": "geometry.fill",
        "stylers": [{"visibility": "on"}]
    }, {
        "featureType": "poi",
        "elementType": "labels",
        "stylers": [{"visibility": "off"}, {"lightness": "0"}, {"saturation": "0"}, {"weight": "2.5"}]
    }, {
        "featureType": "poi.attraction",
        "elementType": "all",
        "stylers": [{"visibility": "off"}]
    }, {
        "featureType": "poi.attraction",
        "elementType": "geometry.fill",
        "stylers": [{"visibility": "on"}, {"color": "#cfcfce"}]
    }, {
        "featureType": "poi.attraction",
        "elementType": "labels.text",
        "stylers": [{"visibility": "off"}]
    }, {
        "featureType": "poi.attraction",
        "elementType": "labels.text.fill",
        "stylers": [{"color": "#d5692c"}, {"visibility": "on"}]
    }, {
        "featureType": "poi.attraction",
        "elementType": "labels.icon",
        "stylers": [{"visibility": "off"}]
    }, {
        "featureType": "poi.park",
        "elementType": "geometry",
        "stylers": [{"color": "#4d6340"}, {"lightness": 21}]
    }, {"featureType": "road", "elementType": "all", "stylers": [{"visibility": "on"}]}, {
        "featureType": "road",
        "elementType": "geometry.fill",
        "stylers": [{"visibility": "on"}, {"color": "#ff0000"}]
    }, {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [{"color": "#ffffff"}, {"lightness": 17}]
    }, {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [{"color": "#ffffff"}, {"lightness": 29}, {"weight": 0.2}]
    }, {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [{"color": "#ffffff"}, {"lightness": 18}]
    }, {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [{"color": "#ffffff"}, {"lightness": 16}]
    }, {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [{"visibility": "off"}]
    }, {
        "featureType": "transit",
        "elementType": "geometry",
        "stylers": [{"color": "#f2f2f2"}, {"lightness": 19}]
    }, {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [{"color": "#e9e9e9"}, {"lightness": 17}]
    }, {
        "featureType": "water",
        "elementType": "geometry.fill",
        "stylers": [{"color": "#3b4e65"}, {"visibility": "on"}]
    }, {
        "featureType": "water",
        "elementType": "labels.text",
        "stylers": [{"visibility": "simplified"}, {"color": "#ffffff"}]
    }], {name: 'Styled Map'});

    function add_marker($marker) {

        // var
        var icon = $marker.attr('data-icon');
        var labelClass = $marker.attr('data-class');
        var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));
        var label = $marker.attr('data-title');
        var labelAnchorX = $marker.attr('data-anchorX');
        var labelAnchorY = $marker.attr('data-anchorY');

        // create marker

        var marker = new MarkerWithLabel({
            position: latlng,
            icon: icon,
            labelContent: label,
            labelAnchor: new google.maps.Point(labelAnchorX,labelAnchorY),
            labelClass: labelClass, // the CSS class for the label
            labelInBackground: false,
            map: map
        });

        markersToRemove.push(marker);

        // add to array
        map.markers.push(marker);

        // if marker contains HTML, add it to an infoWindow
        if ($marker.html()) {
            // Change info window when marker is clicked
            google.maps.event.addListener(marker, 'click', function () {

                /*infowindow.open( map, marker );*/
                /*$('#marker').html($marker.html());
                 window.console.log('Marker Clicked');*/

                var aMarker = document.getElementById("map-info-box");
                aMarker.innerHTML = $marker.html();

            });

            if (firstMarker) {
                firstMarker = false;
                var aMarker = document.getElementById("map-info-box");
                aMarker.innerHTML = $marker.html();
            }
        }

    }

    function add_mMarker($marker) {

        // var
        var icon = $marker.attr('data-icon');
        var labelClass = $marker.attr('data-class');
        var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));
        var label = $marker.attr('data-title');
        var labelAnchorX = $marker.attr('data-anchorX');
        var labelAnchorY = $marker.attr('data-anchorY');

        // create marker

        var marker = new MarkerWithLabel({
            position: latlng,
            icon: icon,
            labelContent: label,
            labelAnchor: new google.maps.Point(labelAnchorX,labelAnchorY),
            labelClass: labelClass, // the CSS class for the label
            labelInBackground: false,
            mMap: mMap
        });

        markersToRemove.push(marker);

        // add to array
        mMap.markers.push(marker);

        // if marker contains HTML, add it to an infoWindow
       /* if ($marker.html()) {
            // Change info window when marker is clicked
            google.maps.event.addListener(marker, 'click', function () {

                /!*infowindow.open( map, marker );*!/
                /!*$('#marker').html($marker.html());
                 window.console.log('Marker Clicked');*!/

                var aMarker = document.getElementById("map-info-box");
                aMarker.innerHTML = $marker.html();

            });

            if (firstMarker) {
                firstMarker = false;
                var aMarker = document.getElementById("map-info-box");
                aMarker.innerHTML = $marker.html();
            }
        }*/

    }

    function center_map() {

        // vars
        var bounds = new google.maps.LatLngBounds();

        // loop through all markers and create bounds
        $.each(map.markers, function (i, marker) {

            var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());

            window.console.log('lat='+marker.position.lat());
            window.console.log('lng='+marker.position.lng());

            bounds.extend(latlng);

        });

        // only 1 marker?
        if (map.markers.length == 1) {
            // set center of map
            map.setCenter(bounds.getCenter());
            map.setZoom(16);
        }
        else {
            // fit to bounds
            map.fitBounds(bounds);
        }

    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        directionsService.route({
            origin: document.getElementById('start-point').value,
            destination: 'The Ritz London, Piccadilly, London',
            /*origin: 'chicago, il',
            destination: 'amarillo, tx',*/
            travelMode: currentTravelMode
        }, function (response, status) {
            if (status === 'OK') {
                directionsDisplay.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        })
    }

    function removeMarkers() {
        for(var i = 0; i < markersToRemove.length; i++) {
            markersToRemove[i].setMap(null);
        }
    }

    $(document).ready(function () {

        var $markers = $('#acfMap').find('.marker');
        //var $mMarkers = $('#m-acfMap').find('.marker');

        $markers.hide();
        //$mMarkers.hide();

        map = new google.maps.Map(document.getElementById('acfMap'), {
            zoom: 16,
            center: {lat: 51.507, lng: -0.142}
        });

        /*mMap = new google.maps.Map(document.getElementById('m-acfMap'), {
            zoom: 16,
            center: {lat: 51.507, lng: -0.142}
        });*/

        map.mapTypes.set('styled_map', styledMapType);
        map.setMapTypeId('styled_map');

        /*mMap.mapTypes.set('styled_map', styledMapType);
        mMap.setMapTypeId('styled_map');*/

        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById('map-info-box'));

        $('#get-directions').click(function () {
            removeMarkers();
            var aMarker = document.getElementById("map-info-box");
            aMarker.innerHTML = '';
            directionsVisible = true;
            calculateAndDisplayRoute(directionsService,directionsDisplay);
        });

        $("#start-point").keyup(function(event){
            if(event.keyCode == 13){
                $("#get-directions").click();
            }
        });

        // add a markers reference
        map.markers = [];

        //mMap.markers = [];

        // add markers
        $markers.each(function () {

            add_marker($(this), map);

        });

        /*$mMarkers.each(function () {

            add_mMarker($(this), mMap);

        });*/

        google.maps.event.addDomListener(window, "resize", function () {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });

        $('.transit-mode').click(function () {
            var transitMode = $(this).data('mode');
            $('.transit-mode').removeClass('selected');
            $(this).addClass('selected');
            currentTravelMode = transitMode;
            if(directionsVisible){
                $("#get-directions").click();
            }
        })


    });


})(jQuery);