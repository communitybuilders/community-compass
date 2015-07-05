$(function () {
    'use strict';

    // Only run this js on the index page.
    if (!$('body').is('#organisations-index')) {
        return;
    }

    var input = $('#autocomplete')[0];
    var options = {
        types: ['address']
    };

    var autocomplete = new google.maps.places.Autocomplete(input, options);

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var addressParts = {
            street_number: 'long_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'long_name',
            postal_code: 'short_name'
        };
        var place = autocomplete.getPlace();
        var type;
        var name;

        // TODO: use geocode to display map marker.
        if (place.geometry && place.geometry.location) {
            $('#lat').val(place.geometry.location.lat());
            $('#lng').val(place.geometry.location.lng()).trigger('change');
        }

    });

});
