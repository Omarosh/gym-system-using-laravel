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
<div class="container">
    <h2>Edit City Managers </h2>
</div>

<style>
    #user_id{
        display:none;
    }
    </style>

<form method='POST'  enctype="multipart/form-data" action="{{ route('city_manager.update',  $manager->user_id) }}">
    @csrf
    @method('PUT')
    <center><img src='/cityManagers_images/{{ $manager->image_path }}' width=300 /></center>
    <input type="text" id="user_id" value='{{$manager->user_id}}' name="id"><br><br>
    <label for=" fname">Email :</label><br>
    <input type="text" id="email" value='{{$manager->user->email}}' name="email"><br><br>
    <label for="lname">Password :</label><br>
    <input type="password" id="password"  name="password"><br><br>
    <label for="fname">Name :</label><br>
    <input type="text" id="name" value='{{$manager->user->name}}' name="name"><br><br>
    <label for="fname">City :</label><br>
    <input type="text" id="city" value='{{$manager->city_name}}' name="city"><br><br>
    <label for="fname">National ID :</label><br>
    <input type="text" id="national_id" value='{{$manager->national_id}}' name="national_id"><br><br>
    <label for="exampleFormControlTextarea1" class="form-label">Profile picture:</label><br>

<input type="file" rows="3" id="exampleFormControlTextarea1" class="form-control" name="image" /><br><br>
    <input type="submit" value="Submit">
</form>

@endsection