@extends('layouts.app')

@section('content')
<h1>Create City Manager</h1>
<!-- <form method='POST' action="{{ route('city_manager.store')  }}"> -->
<form method='POST'  enctype="multipart/form-data" action="{{ route('city_manager.store')  }}">
    @csrf
    <label for=" fname">Email :</label><br>
    <input type="text" id="email" name="email"><br><br>
    <label for="lname">Password :</label><br>
    <input type="text" id="password" name="password"><br><br>
    <label for="fname">Name :</label><br>
    <input type="text" id="name" name="name"><br><br>
    <label for="fname">City :</label><br>
    <input type="text" id="city_name" name="city_name"><br><br>
    <label for="fname">National ID :</label><br>
    <input type="text" id="national_id" name="national_id"><br><br>
    <label for="exampleFormControlTextarea1" class="form-label">Profile picture:</label><br>

    <input type="file" rows="3" id="exampleFormControlTextarea1" class="form-control" name="image" /><br><br>
    <input type="submit" value="Submit">
    

</form>
@endsection