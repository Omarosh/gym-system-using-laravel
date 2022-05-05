@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Trainees Table</h2>
    <table class="table table-bordered" id="datatable">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
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
            "ajax": "{{ route('trainees.list') }}",
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "name",
                    "name": "name"
                },
                {
                    "data": "gender",
                    "name": "gender"
                },
                {
                    "data": "date_of_birth",
                    "name": "date_of_birth"
                },
                {
                    "data": "email",
                    "name": "email"
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