@extends('layouts.app')

@section('content')
<h1>Create City Manager</h1>
<!-- <form method='POST' action="{{ route('city_manager.store')  }}"> -->
<form method='POST' action="{{ route('attendance.store')  }}">
    @csrf
    <label for=" fname">Trainee ID :</label><br>
    <input type="text" id="trainee_id" name="trainee_id"><br><br>
    <label for="lname">Session ID :</label><br>
    <input type="text" id="training_session_id" name="training_session_id"><br><br>
    
    <input type="submit" value="Submit">
</form>
@endsection