
@extends('layouts.app')

@section('content')

@if( $gym->cover_image_path)
          <center><img src='/gyms_images/{{ $gym->cover_image_path }}' width=300 /></center>
          @endif
        
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <label for="exampleFormControlInput1" class="form-control" id="exampleFormControlInput1" class="form-label">{{ $gym->name }}</label>
                
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">City name</label>
                <label for="exampleFormControlTextarea1" class="form-control" id="exampleFormControlInput1" class="form-label">{{ $gym->city_name }}</label>
                
            </div>

@endsection
           
           
           