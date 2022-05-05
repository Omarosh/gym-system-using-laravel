@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Edit Trainee </h2>
</div>



<form method='POST' action="{{ route('trainee.update',  $id)}}">
    @csrf
    @method('PUT')
    <label for="fname">Name:</label><br>
    <input type="text" id="name" name="name"><br><br>
    <label for=" fname">Email:</label><br>
    <input type="text" id="email" name="email"><br><br>
    <label for="lname">Password:</label><br>
    <input type="text" id="password" name="password"><br><br>
    <label for="exampleFormControlTextarea1" class="form-label">Gender:</label>
    <select name="gender" class="form-control">
        <option value="m">Male</option>
        <option value="f">Female</option>
    </select><br><br>
    <label for="date">Date of Birth:</label><br>
    <input type="date" name="date_of_birth">
    <input type="submit" value="Submit">
</div>
</form>  

<script type="text/javascript">

    $('.date').datepicker({  

       format: 'mm-dd-yyyy'

     });  

</script> 

@endsection