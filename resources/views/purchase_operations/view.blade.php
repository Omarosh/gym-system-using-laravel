@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Purchase Operations</h2>
    <table class="table table-bordered" id="datatable">
        <thead>
            <tr>
                <th>id</th>
                <th>trainee_id</th>
                <th>package_id</th>
                <th>gym_id</th>
                <th>created_by_id</th>
                <th>price</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
{{-- @if($success)
<div style="width: fit-content; left: 45%; position: absolute; opacity: 0.75;" class="bg bg-success my-3 py-2 px-3 bg-opacity-50">
    <span>Payment was successful!</span>
</div>
@endif --}}

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
                    "data": "id"
                },
                {
                    "data": "trainee_id",
                    "name": "trainee_id"
                },
                {
                    "data": "package_id",
                    "name": "package_id"
                },
                {
                    "data": "gym_id",
                    "name": "gym_id"
                },
                {
                    "data": "created_by_id",
                    "name": "created_by_id"
                },
                {
                    "data": "price",
                    "name": "price"
                },
            ]
        });
    });
</script>
@endsection