@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        Sitemap 
        <!-- <a href="{{ route('admin.sitemap.create') }}" class="btn btn-primary float-right">Add Sitemap</a> -->
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Sitemap</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sitemaps as $sitemap)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sitemap->url }}</td>
                    <td>
                        <a href="{{ route('admin.sitemap.edit', $sitemap->id) }}" class="btn btn-sm btn-info">Edit</a>
                         <!-- <form action="{{ route('admin.sitemap.destroy', $sitemap->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>  -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
