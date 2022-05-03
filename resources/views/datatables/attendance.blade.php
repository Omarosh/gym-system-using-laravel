<html lang="en">
<head>
    <title></title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
        <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    </head>
      <body>
         <div class="container">
               <h2>Attendance Table</h2>
            <table class="table table-bordered" id="datatable">
               <thead>
                  <tr>
                     <th>Id</th>
                     <th>Name</th>
                     <th>Email</th>
                  </tr>
               </thead>
               <tbody>
               </tbody>
            </table>
         </div>
       <script>
         $(document).ready(function(){
               $('#datatable').DataTable({
               "processing": true,
               "serverSide": true,
               "ajax": "{{ route('attendance.index') }}",
               "columns": [
                        { "data": "id"},
                        { "data": "name" },
                        { "data": "email" }
                    ]
            });
         });
         </script>
   </body>
</html>