$(function () {
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
        $.each(place.address_components, function(index, component) {
            type = component.types[0];
            name = addressParts[type];
            if (name) {
                console.log(type + ' = ' + component[name]);
            }
        });

        // TODO: use geocode to display map marker.
        if (place.geometry && place.geometry.location) {
            console.log('lat = ' + place.geometry.location.lat());
            console.log('lng = ' + place.geometry.location.lng());
        }

    });

});

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

$(function () {
    var current_row = 30;

    $(window).scroll(function() {

        setTimeout(function(){
            if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
                $.ajax({
                    type: "POST",
                    url: "organisations/ajaxloadorganisations",
                    data: {
                        '_token':$('input[name=_token]').val(),
                        'current_row':current_row
                    },

                    success: function(data) {
                        current_row = current_row + current_row;
                        var display;
                        var result = JSON.parse(data);

                        $(result).each(function(index, value){
                            display += "<section class='col-xs-6 col-md3 col-md-3 col-lg-3'>";
                            display +="<div class='panel panel-default' style='padding: 10px 10px 10px 10px;'>";
                            display +="<img src='http://www.clipartbest.com/cliparts/9Tp/bX4/9TpbX4njc.png' alt='image' width='140'><br />";
                            display += value.legal_name + "<br />";
                            display +="<a>claim</a><br /><a>like</a> <br /><a>subscribe</a><br /><a>donate</a><br /></div></section>";

                        });

                        $(".organisations_div").append(display);
                    }
                });

            }
        }, 200);
    });

});

//# sourceMappingURL=all.js.map