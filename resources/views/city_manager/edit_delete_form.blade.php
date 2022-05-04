<div style="display: flex; justify-content:   space-around">
    <form method='POST' action="{{ route('city_manager.update', $row->user_id) }}">
        @csrf
        @method('PUT')
        <button type='submit' class='btn btn-info' style="margin-left: 10px;">Edit</button>
    </form>
    <form method='POST' action="{{ route('city_manager.delete', $row->user_id) }}">
        @csrf
        @method('DELETE')
        <button type='submit' class='btn btn-danger'>Delete</button>
    </form>
</div>
