
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<div style="display: flex; justify-content:   space-around">
    <form method='GET' action="{{ route('city_manager.edit', $row->user_id ) }}">
        @csrf
        <button type='submit' class='btn btn-info' style="margin-left: 10px;">Edit</button>
    </form>
    <!-- <form method='POST' action="{{ route('city_manager.delete', $row->user_id) }}"> -->
        <!-- @csrf -->
        <!-- @method('DELETE') -->
        <button class='deletebutton btn btn-danger'>Delete</button>
    <!-- </form> -->
</div>
<script>
   
    $(()=>{
    $("body").on("click",".deletebutton",function(){
        if( confirm('are you sure')){
            deleteCityManger($(this))
        }
           })
        })


    function deleteCityManger(e){
    $(()=>{
        e.parent("div").parent("td").parent("tr").remove()
       let id=Number( e.parent("div").parent("td").siblings("td").html())
       console.log(id);
        //req_delete= new XMLHttpRequest();
        //   req_delete.open('POST',"/city_manager/delete")
        //  req_delete.send()
        //  req_delete.onreadystatechange=function(){
        // if(req_delete.readyState==4 &&req_delete.status==200){
        //     console.log('done')
        //                   }
        //               }
        $.ajax({
    type: "POST",
    url: '/city_manager/delete',
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