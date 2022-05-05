@extends('layouts.app')

@section('content')

<div class="container">
   <h2>Laravel DataTables Tutorial Example</h2>
   <table class="table table-bordered" id="datatable">
      <thead>
         <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Training Session Name</th>
            <th>Attendance Date</th>
            <th>Attendance Time</th>
            <th>Gym Name</th>
            <th>City Name</th>
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
         "ajax": "{{ route('attendance.list') }}",
         "columns": [{
               "data": "id"
            },
            {
               "data": "traineename",
               "name": "traineename.name"
            },
            {
               "data": "traineeemail",
               "name": "traineeemail.email"
            },
            {
               "data": "sessions",
               "name": "sessions.name"
            },
            {
               "data": "date",
               "name": "date.created_at"
            },
            {
               "data": "time",
               "name": "time.created_at"
            },
            {
               "data": "gym",
               "name": "gym.name"
            },
            {
               "data": "city",
               "name": "city.city_name"
            }
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