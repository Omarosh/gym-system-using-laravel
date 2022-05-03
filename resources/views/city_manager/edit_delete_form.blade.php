<form method='POST' action="{{ route('city_manager.update', $row->user_id) }}">
    @csrf
    @method('PUT')
    <button type='submit' class='btn btn-info'>Edit</button>
</form>
<form method='POST' action="{{ route('city_manager.delete', $row->user_id) }}">
    @csrf
    @method('DELETE')
    <button type='submit' class='btn btn-danger'>Delete</button>
</form>