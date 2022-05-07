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
<h1>Create Attendance</h1>
<form method='POST'  enctype="multipart/form-data" action="{{ route('gui.attended_sessions')  }}">
    @csrf
    <label for=" fname">trainee id :</label><br>
    <input type="text" id="trainee id" name="trainee id"><br><br>
    <label for="lname">session id :</label><br>
    <input type="text" id="training_session_id" name="training_session_id"><br><br>
    <input type="submit" value="Submit">
</form>
@endsection