<div style="display: flex; justify-content:   space-around">
    <form method='GET' action="{{ route('trainee.edit', $row->id) }}">
        @csrf
        <button type='submit' class='btn btn-info' style="margin-left: 10px;">Edit</button>
    </form>
    <form method='POST' action="{{ route('trainee.delete', $row->id) }}">
        @csrf
        @method('DELETE')
        <button type='submit' class='btn btn-danger'>Delete</button>
    </form>
</div>