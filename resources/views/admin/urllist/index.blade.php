@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        URL List
         <a href="{{ route('admin.urllist.create') }}" class="btn btn-primary btn-sm float-right">Add New</a> 
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($urls as $url)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <textarea readonly class="form-control" rows="3" oninput="resizeTextarea(this)">{{ $url->url }}</textarea>
                    </td>
                    <td>
                        <a href="{{ route('admin.urllist.edit', $url->id) }}" class="btn btn-sm btn-info">Edit</a>

                         <!-- <form action="{{ route('admin.urllist.destroy', $url->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>  -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function resizeTextarea(el) {
        el.style.height = 'auto'; 
        el.style.height = (el.scrollHeight) + 'px';  // Set height to fit content
    }
</script>
@endsection
