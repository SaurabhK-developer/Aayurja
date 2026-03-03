@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        Tracking Codes
        <a href="{{ route('admin.tracking.create') }}" class="btn btn-primary float-right">Add New</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tracking Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($trackingCodes as $code)
                    <tr>
                        <td>{{ $code->id }}</td>
                        <td>{{ $code->TrackingCode }}</td>
                        <td>
                            <a href="{{ route('admin.tracking.edit', $code->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.tracking.destroy', $code->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No tracking codes available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
