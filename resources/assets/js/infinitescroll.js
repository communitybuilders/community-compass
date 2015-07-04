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

    $(document).on("click", ".claim", function () {
        var claim_id = $(this).data('id');
        $(".modal-body #bookId").val( claim_id );
        $('#addBookDialog').modal('show');
    });

});
