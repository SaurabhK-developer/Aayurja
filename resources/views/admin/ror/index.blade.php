@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        Ror List
        <a href="{{ route('admin.ror.create') }}" class="btn btn-primary btn-sm float-right">Add New</a>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rors as $ror)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                    {{ $ror->content }}
                    </td>
                    <td>
                        <a href="{{ route('admin.ror.edit', $ror->id) }}" class="btn btn-sm btn-warning">Edit</a>
                         <!-- <form action="{{ route('admin.ror.destroy', $ror->id) }}" method="POST" class="d-inline">
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
@endsection



