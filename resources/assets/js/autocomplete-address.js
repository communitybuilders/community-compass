$(function () {
    'use strict';

    // Only run this js on the index page.
    if (!$('body').is('#pages-index')) {
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

        // TODO: use address parts to search for nearby charities.
        //$.each(place.address_components, function(index, component) {
        //    type = component.types[0];
        //    name = addressParts[type];
        //    if (name) {
        //        console.log(type + ' = ' + component[name]);
        //    }
        //});

        // TODO: use geocode to display map marker.
        if (place.geometry && place.geometry.location) {
            $('#lat').val(place.geometry.location.lat()).trigger('change');
            $('#lng').val(place.geometry.location.lng()).trigger('change');
        }

    });

});
