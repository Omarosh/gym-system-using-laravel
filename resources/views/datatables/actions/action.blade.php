<form method="POST" action="{{ route('gym.update', $row->id) }}">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-info">Update</button>
</form>

<form method="POST" action="{{ route('gym.delete', $row->id) }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Sure Want Delete?')">Delete</button>
</form>