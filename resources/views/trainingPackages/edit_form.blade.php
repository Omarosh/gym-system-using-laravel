@extends('layouts.app')

@section('content')
<h1>Create Package</h1>
<form method='POST' action="{{ route('packages.update', $package->id)  }}">
    @csrf
    <label for=" fname">Package Name :</label><br>
    <input type="text" id="name" value='{{$package->name}}' name="name"><br><br>
    <label for="lname">Price :</label><br>
    <input type="text" id="price" value='{{$package->price}}'name="price"><br><br>
    <label for="fname">Number of sessions :</label><br>
    <input type="text" id="num_of_sessions" value='{{$package->num_of_sessions}}' name="num_of_sessions"><br><br>
    <input type="submit" value="Submit">
</form>
@endsection