<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<div style="display: flex; justify-content:   space-around">
<form method="POST" action="{{ route('city_manager.view', $row->id) }}">
        @csrf
       
        <button type="submit" class="btn btn-info">View</button>
</form>
    <form method='GET' action="{{ route('city_manager.edit', $row->user_id ) }}">
        @csrf
        <button type='submit' class='btn btn-info' style="margin-left: 10px;">Edit</button>
    </form>

<<<<<<< HEAD
    <button class='deletebutton btn btn-danger'>Delete</button>
=======
        <button class='deletebutton{{$row->id}} btn btn-danger'>Delete</button>
>>>>>>> creating_trainees_tab
</div>
<script>
    $(() => {
        $("body").on("click", '.deletebutton{{$row->id}}', function() {
            if (confirm('are you sure')) {
                deleteCityManger($(this))
            }
        })
    })


<<<<<<< HEAD
=======
    $(()=>{
        $("body").on("click",'.deletebutton{{$row->id}}',function(){
            if( confirm('are you sure')){
                deleteCityManger($(this))
            }
        })
    })
>>>>>>> creating_trainees_tab

    function deleteCityManger(e) {
        $(() => {
            e.parent("div").parent("td").parent("tr").remove()
            let id = Number(e.parent("div").parent("td").siblings("td").html())
            console.log(id);

            $.ajax({
                type: "POST",
                url: '/city_manager/delete',
                data: {
                    user_id: id,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    console.log(data);
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);

                },
            });

<<<<<<< HEAD

        })

    }

    })
    }
=======
    function deleteCityManger(e){
        $(()=>{
            e.parent("div").parent("td").parent("tr").remove()
            let id=Number( e.parent("div").parent("td").siblings("td").html())
            console.log(id);
                
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

      
>>>>>>> creating_trainees_tab
</script>