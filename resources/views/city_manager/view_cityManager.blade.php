@extends('layouts.app')

@section('content')
@hasanyrole('admin')


@if( $manager->image_path)
<center><img src='/cityManagers_images/{{ $manager->image_path }}' width=300 /></center>
@else
<center><img src='/cityManagers_images/default.jpg' width=300 /></center>

@endif

<div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Name</label>
    <label for="exampleFormControlInput1" class="form-control" id="exampleFormControlInput1" class="form-label">{{
        $manager->user->name }}</label>

</div>
<div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">City name</label>
    <label for="exampleFormControlTextarea1" class="form-control" id="exampleFormControlInput1" class="form-label">{{
        $manager->city_name }}</label>

</div>
@endhasanyrole

@endsection