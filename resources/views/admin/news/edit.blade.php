@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<div class="card">
    <div class="card-header">
        Edit Concern
    </div>

    <div class="card-body">
        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
                <label for="url">Media Url*</label>
                <input type="text" id="url" name="url" class="form-control" value="{{ old('url', $news->url) }}" required>
            </div>
            
            <div class="mt-5 form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                <label for="image">Concern Image* (Recommended Size: 178 × 139 px)</label>
                <input type="file" name="image" class="form-control">
                @if($news->image)
                    <div class="mt-2">
                        <img src="{{ asset('public/' . $news->image) }}" width="100" alt="Current Image">
                    </div>
                @endif
            </div>
            
            <br>
            <div>
                <input class="btn btn-success" type="submit" value="Update">
                <input class="btn btn-danger" type="button" value="Back" onClick="window.location.href = '{{ url('/admin/shop-by-concern') }}'">
            </div>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

@endsection
