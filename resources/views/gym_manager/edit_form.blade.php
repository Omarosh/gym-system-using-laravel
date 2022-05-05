@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Edit Gym Manager </h2>
</div>



<form method='POST' action="{{ route('gym_manager.update',  $user_id) }}">
    @csrf
    @method('PUT')
    <label for=" fname">Email :</label><br>
    <input type="text" id="email" name="email"><br><br>
    <label for="lname">Password :</label><br>
    <input type="text" id="password" name="password"><br><br>
    <label for="fname">Name :</label><br>
    <input type="text" id="name" name="name"><br><br>
    <label for="fname">Gym :</label><br>
    <input type="text" id="gym_id" name="gym_id"><br><br>
    <label for="fname">City :</label><br>
    <input type="text" id="city" name="city"><br><br>
    <label for="fname">National ID :</label><br>
    <input type="text" id="national_id" name="national_id"><br><br>
    <input type="submit" value="Submit">
</form>

@endsection