@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        Edit URL
    </div>

    <div class="card-body">
        <form action="{{ route('admin.urllist.update', $url->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Indicating this is a PUT request -->

            <div class="form-group">
                <label for="url">URL</label>
                <textarea name="url" class="form-control" id="url" rows="3" oninput="resizeTextarea(this)" required>{{ old('url', $url->url) }}</textarea>
                @error('url')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<script>
    function resizeTextarea(el) {
        el.style.height = 'auto';  
        el.style.height = (el.scrollHeight) + 'px';  // Set height to fit content
    }
</script>
@endsection
