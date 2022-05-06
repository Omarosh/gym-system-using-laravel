@extends('layouts.app')

@section('content')
@if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
<h1>Create Gym Manager</h1>
<!-- <form method='POST' action="{{ route('city_manager.store')  }}"> -->
<form method='POST'  enctype="multipart/form-data" action="{{ route('gym_manager.store')  }}">
    @csrf
    <label for=" fname">Email :</label><br>
    <input type="text" id="email" name="email"><br><br>
    <label for="lname">Password :</label><br>
    <input type="password" id="password" name="password"><br><br>
    <label for="fname">Name :</label><br>
    <input type="text" id="name" name="name"><br><br>
    <label for="fname">City :</label><br>
    <select class="form-control" name="city_name">

            @foreach ($cities as $item)
                <option value="{{$item[1]}}">{{$item[1]}}</option>
            @endforeach

</select><br><br> 
   <label for="fname">National ID :</label><br>
    <input type="text" id="national_id" name="national_id"><br><br>
    <label for="fname">GYM:</label>
    <select class="form-control" name="gym_id">

            @foreach ($gyms as $item)
                <option value="{{$item[0]}}">{{$item[1]}}</option>
            @endforeach

</select><br><br>
    <input type="file" rows="3" id="exampleFormControlTextarea1" class="form-control" name="image" /><br><br>

    <input type="submit" value="Submit">
</form>
@endsection