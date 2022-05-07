@extends('layouts.app')

@section('content')
@hasanyrole('city_manager|admin')


<div class="container">
   <h2>Gym Table</h2>
   <table class="table table-bordered" id="datatable">
      <thead>
         <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created at</th>
            <th>cover_image</th>
            <th>City Name</th>
            @hasanyrole('admin')

            <th>City Manager Name</th>
            @endhasanyrole


            <th>Actions</th>
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
@hasanyrole('admin')

<script>
   $(document).ready(function() {
      $('#datatable').DataTable({
         "processing": true,
         "serverSide": true,
         "ajax": "{{ route('gyms.list') }}",
         "columns": [{
               "data": "id"
            },
            {
               "data": "name"
            },
            {
               "data": "created_at",
               "name": "created_at"
            },
            {
               "data": "cover_image_path"
            },
            {
               "data": "city_name",
            },

            {

               "data": 'username',
               'name': 'user.name'
               //'name': 'cityMangerName'


            },

            {
               "data": 'action',
               "name": 'action',
               'searchable': true,
               'orderable': true,
            }
         ]
      });
   });
</script>
@endhasanyrole

{{-- stRT cp --}}
@hasanyrole('gym_manager|city_manager')

<script>
   $(document).ready(function() {
      $('#datatable').DataTable({
         "processing": true,
         "serverSide": true,
         "ajax": "{{ route('gyms.list') }}",
         "columns": [{
               "data": "id"
            },
            {
               "data": "name"
            },
            {
               "data": "created_at",
               "name": "created_at"
            },
            {
               "data": "cover_image_path"
            },
            {
               "data": "city_name",
            },



            {
               "data": 'action',
               "name": 'action',
               'searchable': true,
               'orderable': true,
            }
         ]
      });
   });
</script>
@endhasanyrole
{{-- ENDcp --}}
<a href="{{route('gyms.create')}}">Create Gym</a>
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