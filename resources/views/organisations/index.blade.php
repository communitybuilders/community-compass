@extends('app')

@section('content')
    <div id="canvas" style="margin-left: 0px;"></div>
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" id="auth" value="<?php echo $logged_in; ?>">
    <h2></h2>
    <div class="container">


        <div clas="row">
            <div class="organisations_div">
        @foreach($organisation_arr as $value)
                    <div class="col-xs-6 col-md3 col-md-3 col-lg-3" style="float:left;">
                        <div class="panel panel-default" style=" height:450px"  >
                             @if ($value->image_uri != '')
                                <img class="img-responsive center-block" style="width:100%; height:252px" src="{{$value->image_uri}}" alt="image"><br />
                                @else
                                <img class="img-responsive center-block" style="width:100%; height:252px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAACgCAMAAAC8EZcfAAAANlBMVEXMzMzPz8+RkZHExMSampqQkJDKysqfn5/Hx8e7u7vDw8OUlJS4uLiXl5esrKypqamzs7Ojo6OgzyMdAAACGUlEQVR4nO3V247cIBAEUJqLAXP//59NNR5npd1IeQl5qiNZYhgsaqBhjCEiIiIiIiIiIiIiIiIiIiIiIiIiIiIiOklE3sa3jp8D5fsbfx75T+URe9LJ8lp1zzrjuv80cV9r7v4eh75hUn9ePWraFot3aBTvgybs1rfwc96EYd52tNAoHgOcb9Gu62y+5H2WbqekVVL2XsztY5plvJv57rxMOy6MviWj0csU9EwTWz4b8Mq3MRUBkQshQ5LaOj74vTB1TNFH264mIxEBNdxth5GFDxryuCuGLFkXbdgss1S5EARfyAj+XsG/BYnw/pLVsiS7krT4LOfxgLF0zG27YK91v6vIExC9Zfjx+8BkX25dxWwkLCcBAd35gFfHaug274D1DfgprVba/Y68Izb3E9DGHdD8h4A4vXqp5NKfLdaA5rOCBgX3FSCWoV1Lz4XFChas4H084O3DXqzchlzDouyxTDit7gn4XCi7OfdKozBRg05rUI903RfPQZdeMXqRYP9EHyRdos8OpTXY5fNLkEd20L4fGThOo+SzfybJt1lrxTb10gemNddqfdn8hnKIsE/0bDHXiv7U/PRambnFWaI7ms+4YgNgujRs2f9gbtk29pe4Zga2POg5Rm3qSFw5kqNt+/arPsTD9zTibNq6nHvqPb0NtJJ2p0/vOzK59PU9EREREREREREREREREREREREREREREf3NL2UnEmIOKkswAAAAAElFTkSuQmCC" alt="image"><br />
                            @endif

                            <div style="padding-left: 17px; padding-right: 17px; ">
                                <b>{{$value->legal_name}}</b><br />
                            @if (!is_null($logged_in))
                                <a href="#" id="claim-{{$value->id}}" name="claim" data-toggle="modal" data-target="#claim"><span class='fa fa-plus-square';> Claim</span></a><br />
                                <a href="#" id="like-{{$value->id}}" name="like" data-toggle="modal" data-target="#liked"><span class='fa fa-heart'> Like</span></a><br />
                                <a href="#" id="subscribe-{{$value->id}}" name="subscribe" data-toggle="modal" data-target="#subscribe"><span class='fa fa-share-square-o'> Subscribe</span></a><br />
                                <a href="#" id="donate-{{$value->id}}" name="donate" data-toggle="modal" data-target="#donate"><span class='fa fa-usd'> Donate</span></a><br />
                            @else
                                <a href="/auth/login" ><span class='fa fa-plus-square';> Claim</span></a><br />
                                <a href="/auth/login" ><span class='fa fa-heart'> Like</span></a> <br />
                                <a href="/auth/login" ><span class='fa fa-share-square-o'> Subscribe</span></a><br />
                                <a href="/auth/login" ><span class='fa fa-usd'> Donate</span></a><br />
                            @endif
                            </div>
                        </div>
                    </div>
        @endforeach
            </div>
    </div>
    </div>
    <!-- Modals -->

    <!-- Claim -->
    <div class="modal fade" id="claim" tabindex="-1" role="dialog" aria-labelledby="claimLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="claimLabel">Claim your Organisation</h4>
                </div>
                <div class="modal-body">
                    Not Yet Implemented
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Like -->
    <div class="modal fade" id="like" tabindex="-1" role="dialog" aria-labelledby="likeLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="claimLabel">Liked</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Subscribe -->
    <div class="modal fade" id="donate" tabindex="-1" role="dialog" aria-labelledby="donateLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="donateLabel">Subscribed</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Donate -->
    <div class="modal fade" id="donate" tabindex="-1" role="dialog" aria-labelledby="donateLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="donateLabel">Donate to your Organisation</h4>
                </div>
                <div class="modal-body">
                    Not Yet Implemented
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop
