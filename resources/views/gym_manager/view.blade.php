@extends('layouts.app')

@section('content')
@hasanyrole('city_manager|admin')

<div class="container">
    <h2>Gym Managers Table</h2>
    <table class="table table-bordered" id="datatable">
        <thead>
            <tr>
                <th>id</th>
                <th>national_id</th>
                <th>city_name</th>
                <th>gym_name</th>
                <th>user_id</th>
                <th>name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@hasanyrole('city_manager|admin')
<a href="/create_gym_manager">Create Gym Manager</a>
@endhasanyrole


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
            "ajax": "{{ route('gym_managers.list') }}",
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "national_id",
                    "name": "national_id"
                },
                {
                    "data": "city_name"
                },
                {
                    "data": "gymname",
                    "name": "gym.name"
                },
                {
                    "data": "user_id",
                    "name": "user_id"
                },
                {
                    "data": "username",
                    "name": "user.name"
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
    });
</script>

@endhasanyrole

@endsection
@section('third_party_scripts')
<script script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js" defer></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" defer></script>
<script type="text/javascript"></script>

@endsection