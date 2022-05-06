@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Edit Gym Manager </h2>
</div>
@if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <style>
    #user_id{
        display:none;
    }
    </style>
<form method='POST' enctype="multipart/form-data"  action="{{ route('gym_manager.update',  $manager->user_id) }}">
    @csrf
    @method('PUT')
    <input type="text" id="user_id" value='{{$manager->user_id}}' name="id"><br><br>

    
@if( $manager->image_path)
          <center><img src='/gymManagers_images/{{ $manager->image_path }}' width=300 /></center>
          @else
          <center><img src='/gymManagers_images/default.jpg' width=300 /></center>
          @endif

    <label for=" fname">Email :</label><br>
    <input type="text" id="email" value='{{$manager->user->email}}' name="email"><br><br>
    <label for="lname">Password :</label><br>
    <input type="password" id="password" name="password"><br><br>
    <label for="fname">Name :</label><br>
    <input type="text" id="name"  value='{{$manager->user->name}}' name="name"><br><br>
    <label for="fname">GYM:</label>

    <select class="form-control" name="gym_id">

            @foreach ($gyms as $item)
                <option value="{{$item[0]}}">{{$item[1]}}</option>
            @endforeach

</select><br><br>
    <label for="fname">City :</label><br>
    <select class="form-control" name="city">

            @foreach ($cities as $item)
                <option value="{{$item[1]}}">{{$item[1]}}</option>
            @endforeach

</select><br><br> 
    <label for="fname">National ID :</label><br>
    <input type="text" id="national_id"  value='{{$manager->national_id}}' name="national_id"><br><br>
    <label for="exampleFormControlTextarea1" class="form-label">Profile picture:</label><br>

<input type="file" rows="3" id="exampleFormControlTextarea1" class="form-control" name="image" /><br><br>
    <input type="submit" value="Submit">
</form>

@endsection