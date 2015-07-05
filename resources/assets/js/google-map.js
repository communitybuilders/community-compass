$(function () {

    // Only run this js on the index page.
    if (!$('body').is('#pages-index')) {
        return;
    }

    var mapCanvas = $('#canvas');
    var mapOptions = {
        mapTypeControl: false,
        //mapTypeId: google.maps.MapTypeId.HYBRID,
        overviewMapControl: true,
        panControl: false,
        scaleControl: false,
        streetViewControl: true,
        zoom: 16,
        zoomControl: true
    };
    var map = new google.maps.Map(mapCanvas[0], mapOptions);
    var marker = new google.maps.Marker();
    var markersArray = [];
    var infoWindow = new google.maps.InfoWindow();
    var latLng;

    google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent('<p>' + $('#autocomplete').val() + '</p>');
        infoWindow.open(map, marker);
    });

    var addNearbyMarker = function(lat, lng, organisation) {
        var nearbyLatLng = new google.maps.LatLng(lat, lng);
        var nearbyMarker = new google.maps.Marker({
            position: nearbyLatLng,
            map: map
        });

        google.maps.event.addListener(nearbyMarker, 'click', function() {
            var infoContainer = $('.info-window').first();

            var content = '<div class="info-window">'
                + '<div class="image-container pull-left">'
                + '<img src="http://placehold.it/100x75">'
                + '<div class="info-actions text-center">'
                + '<a href="info-claim">C</a>'
                + '<a href="info-like">L</a>'
                + '<a href="info-subscribe">S</a>'
                + '<a href="info-donate">D</a>'
                + '</div>'
                + '</div>'
                + '<div class="pull-left">'
                + '<p class="info-legal-name">' + organisation.legal_name + '</p>';

            if (organisation.website) {
                content += '<p class="info-website"><a href="' + organisation.website.url + '">' + organisation.website.url + '</a></p>';
            }

            content += '<p><span class="info-address.address-1">' + organisation.address.address_line_1 + ' ' + organisation.address.address_line_2 + ' ' + organisation.address.address_line_3 + '</span><br>'
            + '<span class="info-address.address-2">' + organisation.address.suburb + ' ' + organisation.address.state + ' ' + organisation.address.state + '</span>'
            + '</p>'
            + '</div>'
            + '</div>';

            infoWindow.setContent(content);
            infoWindow.open(map, nearbyMarker);
            infoContainer.show();
        });

        markersArray.push(nearbyMarker);
    };

    var updateMap = function(lat, lng) {
        infoWindow.close();

        marker.setMap(null);
        for (var i = 0; i < markersArray.length; i++) {
            markersArray[i].setMap(null);
        }
        markersArray = [];

        latLng = new google.maps.LatLng(lat, lng);
        map.setCenter(latLng);
        marker.setPosition(latLng);
        marker.setMap(map);
    };

    var getNearbyOrganisations = function(lat, lng) {

        $.ajax({
            type: 'POST',
            url: 'organisations/nearby',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'lat': lat,
                'lng': lng
            },
            success: function(results) {
                $.each(results, function (index, result) {
                    addNearbyMarker(result.address.lat, result.address.lng, result);
                });
            }
        });

    };

    $('#lat, #lng').on('change', function() {
        updateMap($('#lat').val(), $('#lng').val());
        getNearbyOrganisations($('#lat').val(), $('#lng').val());
    });

    var defaultLoc = {
        lat: -33.8132992,
        lng: 151.0094947
    };
    updateMap(defaultLoc.lat, defaultLoc.lng);


});
