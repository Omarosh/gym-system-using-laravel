@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Purchase Operations</h2>
    <!-- <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">the total revenue of my gym</span>
            <span class="info-box-number"></span>
        </div>
    </div> -->
    <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">the total revenue of my city</span>
            <span class="info-box-number">{{$city}}</span>
        </div>
    </div>
    @if(Session::has("success"))
<div class="container my-5">
    <div class="row my-5">
        <div style="width: fit-content; left: 45%; position: absolute; opacity: 0.75;" class="bg bg-success my-3 py-2 px-3 bg-opacity-50">
            <span>{{Session::get("success")}}</span>
        </div>
    </div>
</div>
@endif
    <table class="table table-bordered" id="datatable">
        <thead>
            <tr>
                <th>Trainee Name</th>
                <th>Trainee Email</th>
                <th>package name</th>
                <th>amount the user bought</th>
                <th>Gym</th>
                <th>City</th>
                <th>Created By</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


@endsection

@section('third_party_scripts')
<script script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js" defer></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" defer></script>
<script type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('purchase_operations.list') }}",
            "columns": [{
                    "data": "traineename",
                },
                {
                    "data": "traineeemail",
                },
                {
                    "data": "packegename"
                },
                {
                    "data": "price",
                },
                {
                    "data": "gym",
                },
                {
                    "data": "city",
                },
                {
                    "data": "createdby",
                },

            ]
        });
    });
</script>
@endsection