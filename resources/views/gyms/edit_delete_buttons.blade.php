<div style="display: flex; justify-content:   space-around">

<form method="POST" action="{{ route('gyms.view', $row->id) }}">
        @csrf
       
        <button type="submit" class="btn btn-info">View</button>
    </form>


    <form method="POST" action="{{ route('gyms.edit', $row->id) }}">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-info">Edit</button>
    </form>

    <button class='deletebutton{{$row->id}}  btn btn-danger'>Delete</button>
    {{-- <form method="POST" action="{{ route('gyms.delete', $row->id) }}">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger" onclick="return confirm('Sure Want Delete?')">Delete</button>
    </form> --}}
</div>

<script>
   
    $(()=>{
    $("body").on("click",".deletebutton{{$row->id}}",function(){
        if( confirm('are you sure')){
            deleteGym($(this))
        }
           })
    })


    function deleteGym(e){
        $(()=>{
            e.parent("div").parent("td").parent("tr").remove()
            let id=Number( e.parent("div").parent("td").siblings("td").html())
            console.log(id);
            $.ajax({
                type: "POST",
                url: '/gyms/delete',
                data: { id: id, _token: '{{csrf_token()}}' },
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