@extends('layouts.app')

@section('content')
<h1>Edit Coach</h1>
<form method='POST'  action="{{ route('coach.update', $id) }}">
    @csrf
    @method('PUT')
    <label for="fname">Name :</label><br>
    <input type="text" id="name" name="name"><br><br>
    <label for="fname">Gym ID :</label><br>
    <input type="text" id="gym_id" name="gym_id"><br><br>
    <input type="submit" value="Submit">  
</form>
@endsection