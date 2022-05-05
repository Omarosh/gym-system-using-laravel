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

    <form method="POST" action="{{ route('gyms.delete', $row->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Sure Want Delete?')">Delete</button>
    </form>
</div>