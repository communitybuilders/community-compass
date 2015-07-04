$(function () {

    var current_row = 30;

    // Only run this js on the organisations index page.
    if (!$('body').is('#organisations-index')) {
        return;
    }

    $(window).scroll(function() {
        var increment = 30;
        var display ="";

        if($(window).scrollTop() + $(window).height() == $(document).height()) {
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
                            display +="<div class='panel panel-default' style='height:450px'>";
                            display +="<img class='img-responsive center-block' style='width:100%' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAACgCAMAAAC8EZcfAAAANlBMVEXMzMzPz8+RkZHExMSampqQkJDKysqfn5/Hx8e7u7vDw8OUlJS4uLiXl5esrKypqamzs7Ojo6OgzyMdAAACGUlEQVR4nO3V247cIBAEUJqLAXP//59NNR5npd1IeQl5qiNZYhgsaqBhjCEiIiIiIiIiIiIiIiIiIiIiIiIiIiIiOklE3sa3jp8D5fsbfx75T+URe9LJ8lp1zzrjuv80cV9r7v4eh75hUn9ePWraFot3aBTvgybs1rfwc96EYd52tNAoHgOcb9Gu62y+5H2WbqekVVL2XsztY5plvJv57rxMOy6MviWj0csU9EwTWz4b8Mq3MRUBkQshQ5LaOj74vTB1TNFH264mIxEBNdxth5GFDxryuCuGLFkXbdgss1S5EARfyAj+XsG/BYnw/pLVsiS7krT4LOfxgLF0zG27YK91v6vIExC9Zfjx+8BkX25dxWwkLCcBAd35gFfHaug274D1DfgprVba/Y68Izb3E9DGHdD8h4A4vXqp5NKfLdaA5rOCBgX3FSCWoV1Lz4XFChas4H084O3DXqzchlzDouyxTDit7gn4XCi7OfdKozBRg05rUI903RfPQZdeMXqRYP9EHyRdos8OpTXY5fNLkEd20L4fGThOo+SzfybJt1lrxTb10gemNddqfdn8hnKIsE/0bDHXiv7U/PRambnFWaI7ms+4YgNgujRs2f9gbtk29pe4Zga2POg5Rm3qSFw5kqNt+/arPsTD9zTibNq6nHvqPb0NtJJ2p0/vOzK59PU9EREREREREREREREREREREREREREREf3NL2UnEmIOKkswAAAAAElFTkSuQmCC' alt='image'><br />";
                            display +="<div style='padding-left:17px; padding-right: 17px;'>"
                            display += value.legal_name + "<br />";
                            if ($('#auth').val().length) {
                                display +="<a href='#' id='claim-{{$value->id}}' name='claim' data-toggle='modal' data-target='#claim'>claim</a><br />";
                                display +="<a href='#' id='like-{{$value->id}}' name='like' data-toggle='modal' data-target='#liked'>Like</a><br />";
                                display +="<a href='#' id='subscribe-{{$value->id}}' name='subscribe' data-toggle='modal' data-target='#subscribe'>Subscribe</a><br />";
                                display +="<a href='#' id='donate-{{$value->id}}' name='donate' data-toggle='modal' data-target='#donate'>Donate</a><br />";
                            }else{
                                display +="<a href='/auth/login' >Claim</a><br />";
                                display +="<a href='/auth/login' >Like</a> <br />";
                                display +="<a href='/auth/login' >Subscribe</a><br />";
                                display +="<a href='/auth/login' >Donate</a><br />";
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

    $(document).on("click", ".claim", function () {
        var claim_id = $(this).data('id');
        $(".modal-body #bookId").val( claim_id );
        $('#addBookDialog').modal('show');
    });

});
