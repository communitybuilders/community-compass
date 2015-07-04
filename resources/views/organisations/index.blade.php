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
                            <a href="#" data-toggle="modal" data-target="#claim">Claim</a><br />
                            <a href="#" data-toggle="modal" data-target="#liked">Like</a> <br />
                            <a href="#" data-toggle="modal" data-target="#subscribe">Subscribe</a><br />
                            <a href="#" data-toggle="modal" data-target="#donate">Donate</a><br />
                        </div>
                    </section>
        @endforeach
            </div>
    </div>
    </div>

    <!-- Modals -->
    <div class="modal fade" id="claim" tabindex="-1" role="dialog" aria-labelledby="claimLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="claimLabel">Claim an Organisation</h4>
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

    <div class="modal fade" id="liked" tabindex="-1" role="dialog" aria-labelledby="likedLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="likedLabel">Liked</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="subscribe" tabindex="-1" role="dialog" aria-labelledby="subscribeLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="subscribeLabel">Subscribe</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="text" class="form-control" id="first_name" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" class="form-control" id="last_name" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id=password" placeholder="Password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

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
