$(function () {

    var current_row = 30;

    // Only run this js on the organisations index page.
    if (!$('body').is('#organisations-index')) {
        return;
    }

    $(window).scroll(function() {
        var increment = 30;
        var display ="";
        if(($(window).scrollTop() + $(window).height()) == $(document).height()) {
            setTimeout(function(){
                $.ajax({
                    type: "POST",
                    url: "organisations/ajaxloadorganisations",
                    data: {
                        '_token':$('input[name=_token]').val(),
                        'current_row':current_row
                    },

                    success: function(data) {
                        current_row = current_row + increment;
                        var result = JSON.parse(data);

                        $(result).each(function(index, value){
                            display +="<div class='col-xs-6 col-md3 col-md-3 col-lg-3' style='float:left;'>";
                            display +="<div class='panel panel-default' style='height:500px'>";
                            if (value.image_uri != ''){
                                display +="<img class='img-responsive center-block' style='width:100%; height:252px' src=" + value.image_uri +" alt='image'><br />";
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
