<div style="display: flex; justify-content:   space-around">
    <form method='GET' action="{{ route('trainingSessions.edit', $row->id) }}">
        @csrf
        <button type='submit' class='btn btn-info' style="margin-left: 10px;">Edit</button>
    </form>

    <button class='deletebutton{{$row->id}} btn btn-danger'>Delete</button>
</div>

<script>
   
    $(()=>{
    $("body").on("click",".deletebutton{{$row->id}}",function(){
        if( confirm('are you sure')){
            deleteSession($(this))
        }
           })
    })


    function deleteSession(e){
        $(()=>{
        let id=Number( e.parent("div").parent("td").siblings("td").html())
        console.log(id);
            $.ajax({
                type: "POST",
                url: '/training_sessions/delete',
                data: { id: id, _token: '{{csrf_token()}}' },
                success: function (data) {
                    if (data == 'removed') {
                        e.parent("div").parent("td").parent("tr").remove()
                        console.log(data)
                    } else alert('That session already had trainees')},
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
            
                },
            });
                    
        })
     
    }
</script>