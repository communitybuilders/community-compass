
@extends('app')
@section('content')
  
  
  
  
   <div class="container">
  
 
     <div class="center-block" style="max-width: 50%">
      <h1>{{$org["legal_name"]}}</h1>
 
 
      <form method="POST" action="http://dev.community-builder.192.168.22.10.xip.io/organisations/store" accept-charset="UTF-8"><input name="_token" type="hidden" value="fLLt0yli9LZhPMb5VaQGoQFpxoUW0hLt7frf3ekd"> <div class="form-group">
 
    <div class="form-group">
    <label for="Address Line 1" class="control-label">Address Line 1</label>
           <input class="form-control" name="Address Line 1" type="text" id="Address Line 1" value="{{$org->getAddress()["address_line_1"]}}" placeholder="Address Line 1">
        </div>

     <div class="form-group">
     <label for="Address Line 2" class="control-label">Address Line 2</label>
          <input class="form-control" name="Address Line 2" type="text" id="Address Line 2" value="{{$org->getAddress()["address_line_2"]}}" placeholder="Address Line 2" >
         </div>
 
 
      <div class="form-group">
      <label for="Address Line 3" class="control-label">Address Line 3</label>
            <input class="form-control" name="Address Line 3" type="text" id="Address Line 3" value="{{$org->getAddress()["address_line_3"]}}" placeholder="Address Line 3">
         </div>
 
 
      <div class="form-group">
         <label for="Suburb" class="control-label">Suburb</label>
         <input class="form-control" name="Suburb" type="text" id="Suburb" value="{{$org->getAddress()["suburb"]}}">
      </div>
 
      <div class="form-group">
        <label for="State" class="control-label">State</label>
         <input class="form-control" name="State" type="text" value="{{$org->getAddress()["state"]}}" id="State">
     </div>
 
   <div class="form-group">
         <label for="Postcode" class="control-label">Postcode</label>
       <input class="form-control" name="Postcode" type="text" id="Postcode" value="{{$org->getAddress()["postcode"]}}">
      </div>
 
      <div class="form-group">
            <label for="Website" class="control-label">Website</label>
            <input class="form-control" name="Website" type="text" id="Website" value="{{$org->getWebsite()["url"]}}">
       </div>
 
      <input class="btn btn-primary" type="submit" value="Submit"> 



      </form>
   </div>
 
 
  </div>
 
  @stop

