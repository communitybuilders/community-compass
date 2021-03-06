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

$(function () {

    // Only run this js on the organisations index page.
    if (!$('body').is('#organisations-index')) {
        return;
    }

    var current_row = 24;
    var increment = 24;

    var getNearbyOrganisations = function (lat, lng) {
        $.ajax({
            type: "POST",
            url: "organisations/closest",
            data: {
                '_token':$('input[name=_token]').val(),
                'lat': lat,
                'lng': lng,
                'skip': current_row,
                'take': increment
            },

            success: function(data) {
                current_row = current_row + increment;
                var result = data;
                var display ="";

                $(result).each(function(index, value){
                    display +="<div class='col-xs-6 col-md3 col-md-3 col-lg-3' style='float:left;'>";
                    display +="<div class='panel panel-default' style='height:500px'>";
                    if (value.image){
                        display +="<img class='img-responsive center-block' style='width:100%; height:252px' src=" + value.image.image_uri +" alt='image'><br />";
                    }else{
                        display +="<img class='img-responsive center-block' style='width:100%' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAACgCAMAAAC8EZcfAAAANlBMVEXMzMzPz8+RkZHExMSampqQkJDKysqfn5/Hx8e7u7vDw8OUlJS4uLiXl5esrKypqamzs7Ojo6OgzyMdAAACGUlEQVR4nO3V247cIBAEUJqLAXP//59NNR5npd1IeQl5qiNZYhgsaqBhjCEiIiIiIiIiIiIiIiIiIiIiIiIiIiIiOklE3sa3jp8D5fsbfx75T+URe9LJ8lp1zzrjuv80cV9r7v4eh75hUn9ePWraFot3aBTvgybs1rfwc96EYd52tNAoHgOcb9Gu62y+5H2WbqekVVL2XsztY5plvJv57rxMOy6MviWj0csU9EwTWz4b8Mq3MRUBkQshQ5LaOj74vTB1TNFH264mIxEBNdxth5GFDxryuCuGLFkXbdgss1S5EARfyAj+XsG/BYnw/pLVsiS7krT4LOfxgLF0zG27YK91v6vIExC9Zfjx+8BkX25dxWwkLCcBAd35gFfHaug274D1DfgprVba/Y68Izb3E9DGHdD8h4A4vXqp5NKfLdaA5rOCBgX3FSCWoV1Lz4XFChas4H084O3DXqzchlzDouyxTDit7gn4XCi7OfdKozBRg05rUI903RfPQZdeMXqRYP9EHyRdos8OpTXY5fNLkEd20L4fGThOo+SzfybJt1lrxTb10gemNddqfdn8hnKIsE/0bDHXiv7U/PRambnFWaI7ms+4YgNgujRs2f9gbtk29pe4Zga2POg5Rm3qSFw5kqNt+/arPsTD9zTibNq6nHvqPb0NtJJ2p0/vOzK59PU9EREREREREREREREREREREREREREREf3NL2UnEmIOKkswAAAAAElFTkSuQmCC' alt='image'><br />";
                    }display +="<div id='org_actions' style='padding-left:17px; padding-right: 17px;'>"
                    display += value.legal_name + "<br />";
                    if ($('#auth').val().length) {
                        display +="<a href='#' id='claim-{{$value->id}}' name='claim' data-toggle='modal' data-target='#claim' class='claim_link'><span class='fa fa-plus-square'> Claim</span></a><br />";
                        display +="<a href='#' id='like-{{$value->id}}' name='like' data-toggle='modal' data-target='#liked'><span class='fa fa-heart'> Like</span></a><br />";
                        display +="<a href='#' id='share-{{$value->id}}' name='share' data-toggle='modal' data-target='#share'><span class='fa fa-share-square-o'> Share</span></a><br />";
                        display +="<a href='#' id='donate-{{$value->id}}' name='donate' data-toggle='modal' data-target='#donate'><span class='fa fa-usd'> Donate</span></a><br />";
                        display +="<a href='#' id='volunteer-{{$value->id}}' name='volunteer' data-toggle='modal' data-target='#volunteer'><span class='fa fa-group'> Volunteer</span></a><br />";
                        display +="<a href='#' id='partner-{{$value->id}}' name='partner' data-toggle='modal' data-target='#partner'><span class='fa fa-exchange'> Partner</span></a><br />";
                        display +="<a href='#' id='contact-{{$value->id}}' name='contact' data-toggle='modal' data-target='#contact'><span class='fa fa-envelope'> Contact</span></a><br />";
                    }else{
                        display +="<a href='#' id='claim-{{$value->id}}' name='claim' data-toggle='modal' data-target='#claim' class='claim_link'><span class='fa fa-plus-square'> Claim</span></a><br />";
                        display +="<a href='/auth/login' ><span class='fa fa-heart'> Like</span></a><br />";
                        display +="<a href='/auth/login' ><span class='fa fa-share-square-o'> Share</span></a><br />";
                        display +="<a href='/auth/login' ><span class='fa fa-usd'> Donate</span></a><br />";
                        display +="<a href='/auth/login' ><span class='fa fa-group'> Volunteer</span></a><br />";
                        display +="<a href='/auth/login' ><span class='fa fa-exchange'> Partner</span></a><br />";
                        display +="<a href='/auth/login' ><span class='fa fa-envelope'> Contact</span></a><br />";
                    }

                    display +="</div>";
                    display +="</div>";
                    display +="</div>";

                });

                $(".organisations_div").append(display);
            }
        });
    };

    $('#lat, #lng').on('change', function() {
        current_row = 0;
        $('.organisations_div').empty();
        getNearbyOrganisations($('#lat').val(), $('#lng').val());
    });


    $(window).scroll(function() {
        if(($(window).scrollTop() + $(window).height()) == $(document).height()) {
            setTimeout(function(){
                getNearbyOrganisations($('#lat').val(), $('#lng').val());
            }, 200);
        }

    });

    $(document).on("click", ".claim_link", function () {
        var claim_form = $("#claim_organisation_form");

        // Set the value of the organisation we're going to submit on
        // our form's hidden organisation_id element.
        var organisation_id = $(this).attr('id').replace("claim-", "");
        $("#claim_organisation_id").val(organisation_id);

        if( $("#but_claim_already_logged_in").length > 0 ) {
            // We're already logged in as this button exists.
            // Let's just submit the form.
            claim_form.submit();
        }
    });
});

//# sourceMappingURL=all.js.map