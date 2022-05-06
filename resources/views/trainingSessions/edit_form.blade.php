@extends('layouts.app')

@section('content')
<h1>Edit Session</h1>
<form method='POST' action="{{ route('session.update', $id)  }}">
    @csrf
    <label for=" fname">Session Name :</label><br>
    <input type="text" id="name" name="name"><br><br>
    <label for="fname">Gym:</label><br>
    <select class="form-control" name="gym_id">

            @foreach ($gyms as $item)
                <option value="{{$item[0]}}">{{$item[1]}}</option>
            @endforeach

</select><br><br>     <label for="fname">Coach ID :</label><br>
    <input type="text" id="coach_id" name="coach_id"><br><br>
    <label for="fname">Starts At:</label><br>
    <input type="datetime-local" name="starts_at"><br><br>
    <label for="fname">Ends At:</label><br>
    <input type="datetime-local" name="finishes_at"><br><br>
    <input type="submit" value="Submit">
</form>

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
</script>
@endsection