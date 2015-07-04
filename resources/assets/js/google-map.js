$(function () {

    // Only run this js on the index page.
    if (!$('body').is('#pages-index')) {
        return;
    }

    var mapOptions = {
        mapTypeControl: false,
        //mapTypeId: google.maps.MapTypeId.HYBRID,
        overviewMapControl: true,
        panControl: false,
        scaleControl: false,
        streetViewControl: true,
        zoom: 18,
        zoomControl: true
    };
    var map = new google.maps.Map($('#canvas')[0], mapOptions);
    var marker = new google.maps.Marker();
    var infoWindow = new google.maps.InfoWindow();
    var latLng;

    google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent('<p>' + $('#autocomplete').val() + '</p>');
        infoWindow.open(map, marker);
    });

    var updateMap = function(lat, lng) {
        infoWindow.close();
        marker.setMap(null);
        latLng = new google.maps.LatLng(lat, lng);
        map.setCenter(latLng);
        marker.setPosition(latLng);
        marker.setMap(map);
    };

    $('#lat, #lng').on('change', function() {
        updateMap($('#lat').val(), $('#lng').val());
    });

    // Trigger update map for office location.
    var defaultLoc = {
        lat: -33.8132992,
        lng: 151.0094947
    };
    updateMap(defaultLoc.lat, defaultLoc.lng);

});
