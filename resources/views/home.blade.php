@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @role('city manager')
    <h1 class="text-black-50">You are logged in!</h1>
    @endrole
</div>
@endsection