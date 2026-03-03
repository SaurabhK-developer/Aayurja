@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<div class="card">
    <div class="card-header">
        Add Media
    </div>

    <div class="card-body">
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="url">Media Url*</label>
                <input type="text" id="url" name="url" class="form-control" required>
            </div>
            
            <div class="mt-5 form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                <label for="image">Media Image* (Recommended Size: 178 × 139 px)</label>
                <input type="file" name="image" class="form-control" required>
            </div>
            
            <br>
            <div>
                <input class="btn btn-success" type="submit" value="Save">
                <input class="btn btn-danger" type="button" value="Back" onClick="window.location.href = '{{ url('/admin/news') }}'">
            </div>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

@endsection
