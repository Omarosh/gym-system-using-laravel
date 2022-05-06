@extends('layouts.app')

@section('content')
<h1>Create Coach</h1>
<form method='POST'  action="{{ route('coach.store')  }}">
    @csrf
    <label for="fname">Name :</label><br>
    <input type="text" id="name" name="name"><br><br>
    <label for="fname">Gym  :</label><br>
    <select class="form-control" name="gym_id">

            @foreach ($gyms as $item)
                <option value="{{$item[0]}}">{{$item[1]}}</option>
            @endforeach

</select><br><br>
    <input type="submit" value="Submit">  
</form>
@endsection