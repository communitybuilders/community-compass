$(function () {
    "use strict";
    var defaultGeocode = {
        lat: -33.8132992,
        lng: 151.0094947
    };
    var latLng = new google.maps.LatLng(defaultGeocode.lat, defaultGeocode.lng);
    var mapOptions = {
        //disableDefaultUI: true,
        center: latLng,
        mapTypeControl: false,
        mapTypeId: google.maps.MapTypeId.HYBRID,
        overviewMapControl: true,
        panControl: false,
        scaleControl: false,
        streetViewControl: true,
        zoom: 18,
        zoomControl: true
    };
    var map = new google.maps.Map($('#canvas')[0], mapOptions);

});
