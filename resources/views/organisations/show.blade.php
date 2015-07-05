@extends('app')

@section('content')

<div class="container">

    
    <div class="center-block" style="max-width: 50%">
    <h1>{{$org["legal_name"]}}</h1>

    <div class="form-group">
    <label for="Address Line 1" class="control-label">Address Line 1</label>
          {{$org->getAddress()["address_line_1"]}} 
       </div>

     <div class="form-group">
     <label for="Address Line 2" class="control-label">Address Line 2</label>
          {{$org->getAddress()["address_line_2"]}}
       </div>


    <div class="form-group">
    <label for="Address Line 3" class="control-label">Address Line 3</label>
          {{$org->getAddress()["address_line_3"]}}
       </div>
           

    <div class="form-group">
        <label for="Suburb" class="control-label">Suburb</label>
        {{$org->getAddress()["suburb"]}}
    </div>

    <div class="form-group">
        <label for="State" class="control-label">State</label>
        {{$org->getAddress()["state"]}}
    </div>

    <div class="form-group">
        <label for="Postcode" class="control-label">Postcode</label>
        {{$org->getAddress()["postcode"]}}
    </div>
    
     <div class="form-group">
          <label for="Website" class="control-label">Website</label>
          {{$org->getWebsite()["url"]}}
     </div>





    <a class="btn btn-primary" type="button" href=/organisations/{{$org["id"]}}/edit> Update Details </a>

    </form>
    </div>


</div> 
    
@stop
