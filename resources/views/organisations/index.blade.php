@extends('app')

@section('content')
    <h1>View organisation</h1>

    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

    <div class="container">
        <div clas="row">
            <div class="organisations_div">
        @foreach($organisation_arr as $value)
                    <section class="col-xs-6 col-md3 col-md-3 col-lg-3" style="float:left;">

                        <div class="panel panel-default" style="padding: 10px 10px 10px 10px;">
                            <img src="http://www.clipartbest.com/cliparts/9Tp/bX4/9TpbX4njc.png" alt="image" width="140"><br />
                            {{$value->legal_name}}<br />
                            @if (!is_null($logged_in))
                                <a href="#" id="claim-{{$value->id}}" name="claim" data-toggle="modal" data-target="#claim">Claim</a><br />
                                <a href="#" id="like-{{$value->id}}" name="like" data-toggle="modal" data-target="#liked">Like</a> <br />
                                <a href="#" id="subscribe-{{$value->id}}" name="subscribe" data-toggle="modal" data-target="#subscribe">Subscribe</a><br />
                                <a href="#" id="donate-{{$value->id}}" name="donate" data-toggle="modal" data-target="#donate">Donate</a><br />
                            @else
                                <a href="/auth/login" >Claim</a><br />
                                <a href="/auth/login" >Like</a> <br />
                                <a href="/auth/login" >Subscribe</a><br />
                                <a href="/auth/login" >Donate</a><br />
                            @endif
                        </div>
                    </section>
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
