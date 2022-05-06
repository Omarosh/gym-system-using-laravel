
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script> 
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
      <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
      <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> 
    --}}
</head>    
    
    <div style="display: flex; justify-content:   space-around">
    <form method="POST" action="{{ route('gym_manager.view', $row->id) }}">
        @csrf
       
        <button type="submit" class="btn btn-info mx-1">View</button>
    </form>
        <form method='GET' action="{{ route('gym_manager.edit', $row->user_id ) }}">
            @csrf
            <button type='submit' class='btn btn-info mx-1'>Edit</button>
        </form>
            <button class='deletebutton{{$row->id}} btn btn-danger mx-2'>Delete</button>

            <input data-id="{{$row->id}}" class="toggle-class mx-2 banbutton{{$row->id}} " type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="UnBan" data-off="Ban" {{ $row->status ? 'checked' : '' }} >             
    </div>
    <script>
        $(()=>{
            $("body").on("click",'.deletebutton{{$row->id}}',function(){
                if( confirm('are you sure')){
                    deleteGymManager($(this))
                }
            })
        })    
    
        function deleteGymManager(e){
        $(()=>{
        e.parent("div").parent("td").parent("tr").remove()
        let id=Number( e.parent("div").parent("td").siblings("td").html())
        console.log(id);
            $.ajax({
                type: "POST",
                url: '/gym_manager/delete',
                data: { user_id: id, _token: '{{csrf_token()}}' },
                success: function (data) {
                console.log(data);
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
                        

        })
     
    }    
</script>
<script>
    $(function() { 
           $('.banbutton{{$row->id}}').change(function() { 
           var status = $(this).prop('checked') == true ? 1 : 0;  
           var id = $(this).data('id');
           $.ajax({ 
    
               type: "POST", 
               dataType: "json", 
               url: "{{ route('gym_manager.status') }}", 
               data: { 'user_id': id,'status': status, _token: '{{csrf_token()}}' }, 
               success: function(data){ 
               console.log(data) 
            },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                }, 
         }); 
      }) 
   }); 
</script>