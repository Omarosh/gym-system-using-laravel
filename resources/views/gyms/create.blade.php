@extends('layouts.app')

@section('content')
<h1>Create Gym </h1>
<!-- <form method='POST' action="{{ route('city_manager.store')  }}"> -->
<form method='POST' enctype="multipart/form-data" action="{{ route('gyms.store')  }}">
    @csrf
    <label for=" fname">Name :</label><br>
    <input type="text" id="name" name="name"><br><br>
    <label for="fname">City Name :</label><br>
    <select class="form-control" name="city_name">

            @foreach ($cities as $item)
                <option value="{{$item[1]}}">{{$item[1]}}</option>
            @endforeach

</select><br><br>  
   <label for="exampleFormControlTextarea1" class="form-label">Gym Cover :</label><br>
    <input type="file" rows="3" id="exampleFormControlTextarea1" class="form-control" name="image" /><br><br>
    <input type="submit" value="Submit">
</form>
@endsection