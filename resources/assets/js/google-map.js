$(function () {

    // Only run this js on the index page.
    if (!$('body').is('#organisations-index')) {
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

    var addNearbyMarker = function(lat, lng, orgInfo) {
        var nearbyLatLng = new google.maps.LatLng(lat, lng);
        var nearbyMarker = new google.maps.Marker({
            position: nearbyLatLng,
            map: map
        });

        google.maps.event.addListener(nearbyMarker, 'click', function() {
            var infoContainer = $('.info-window').first();

            var content = '<div class="info-window">' +
                '<div class="image-container pull-left" style="margin-right: 1em;">';

            if (orgInfo.image) {
                content += '<img style="max-height: 100px; max-width: 100px;" src=' + orgInfo.image.image_uri + '>';
            } else {
                content += '<img src="http://placehold.it/100x100">';
            }

            content += '<div class="info-actions text-center">' +
                ' <a href="#" title="Claim" class="info-claim"><i class="fa fa-plus-square"></i></a>' +
                ' <a href="#" title="Like" class="info-like"><i class="fa fa-heart"></i></a>' +
                ' <a href="#" title="Share" class="info-share"><i class="fa fa-share-square-o"></i></a>' +
                ' <a href="#" title="Donate" class="info-donate"><i class="fa fa-usd"></i></a>' +
                ' <a href="#" title="Volunteer" class="info-volunteer"><i class="fa fa-group"></i></a>' +
                ' <a href="#" title="Partner" class="info-partner"><i class="fa fa-exchange"></i></a>' +
                ' <a href="#" title="Contact" class="info-contact"><i class="fa fa-envelope"></i></a>' +
                '</div>' +
                '</div>' +
                '<div class="pull-left">' +
                '<p class="info-legal-name">' + orgInfo.legal_name + '</p>';

            content += '<p><span class="info-address.address-1">' + orgInfo.address_line_1 + ' ' + orgInfo.address_line_2 + ' ' + orgInfo.address_line_3 + '</span><br>' +
                '<span class="info-address.address-2">' + orgInfo.suburb + ' ' + orgInfo.state + ' ' + orgInfo.state + '</span>' +
                '</p>';

            if (orgInfo.website) {
                content += '<p class="info-website"><a href="' + orgInfo.website.url + '">' + orgInfo.website.url + '</a></p>';
            }

            content += '</div>' +
                '</div>';

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
        marker.setIcon('http://maps.google.com/mapfiles/marker_green.png');
        marker.setPosition(latLng);
        marker.setMap(map);
    };

    var getNearbyOrganisations = function(lat, lng, skip, take) {

        $.ajax({
            type: 'POST',
            url: 'organisations/closest',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'lat': lat,
                'lng': lng,
                'skip': skip,
                'take': take
            },
            success: function(results) {
                $.each(results, function (index, result) {
                    addNearbyMarker(result.lat, result.lng, result);
                });
            }
        });

    };

    $('#lat, #lng').on('change', function() {
        updateMap($('#lat').val(), $('#lng').val());
        getNearbyOrganisations($('#lat').val(), $('#lng').val(), 0, 10);
    });

    var defaultLoc = {
        lat: -33.8132992,
        lng: 151.0094947
    };
    updateMap(defaultLoc.lat, defaultLoc.lng);


});
