@extends('layouts.app')

@section('content')
@hasanyrole('city_manager|admin')

<h1>Edit Gym </h1>
<form method='POST' enctype="multipart/form-data" action="{{ route('gyms.update', $gym->id)  }}">
  @csrf
  @method('PUT')

  @if( $gym->cover_image_path)
  <center><img src='/gyms_images/{{ $gym->cover_image_path }}' width=300 /></center>

  @else
  <center><img src='/gyms_images/default.jpg' width=300 /></center>

  @endif

  <label for=" fname">Name :</label><br>
  <input type="text" id="name" value='{{$gym->name}}' name="name"><br><br>
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
@endhasanyrole

@endsection