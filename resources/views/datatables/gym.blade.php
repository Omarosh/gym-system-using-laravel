<!DOCTYPE html>
<html lang="en">

<head>
   <title></title>
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

</head>

<body>
   <div class="container">
      <h2>Gym Table</h2>
      <table class="table table-bordered" id="datatable">
         <thead>
            <tr>
               <th>Name</th>
               <th>Created at</th>
               <th>cover_image</th>
               <th>City Manager Name</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
         </tbody>
      </table>
   </div>
   <script>
      $(document).ready(function() {
         $('#datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('api.gyms.index') }}",
            "columns": [{
                  "data": "name"
               },
               {
                  "data": "created_at","name":"created_at"
               },
               {
                  "data": "cover_image_path"
               },
               {
                  "data": "cityManager","name":"cityManager.city_name"
               },
               {  "data" :'action',
                  "name" : 'action',
                  'searchable':true,
                  'orderable': true,
               }
            ]
         });
      });
   </script>
</body>

</html>