
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    
    
    <div style="display: flex; justify-content:   space-around">
        <form method='GET' action="{{ route('gym_manager.edit', $row->user_id ) }}">
            @csrf
            <button type='submit' class='btn btn-info' style="margin-left: 10px;">Edit</button>
        </form>
    
            <button class='deletebutton{{$row->id}} btn btn-danger'>Delete</button>
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