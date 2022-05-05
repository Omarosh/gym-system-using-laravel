
@extends('layouts.app')

@section('content')

@if( $manager->image_path)
          <center><img src='/gymManagers_images/{{ $manager->image_path }}' width=300 /></center>
          @endif
        
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <label for="exampleFormControlInput1" class="form-control" id="exampleFormControlInput1" class="form-label">{{ $manager->user->name }}</label>
                
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">City name</label>
                <label for="exampleFormControlTextarea1" class="form-control" id="exampleFormControlInput1" class="form-label">{{ $manager->city_name }}</label>
                
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Gym name</label>
                <label for="exampleFormControlTextarea1" class="form-control" id="exampleFormControlInput1" class="form-label">{{ $manager->gym->name }}</label>
                
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">National ID</label>
                <label for="exampleFormControlTextarea1" class="form-control" id="exampleFormControlInput1" class="form-label">{{ $manager->national_id }}</label>
                
            </div>

            @endsection
           