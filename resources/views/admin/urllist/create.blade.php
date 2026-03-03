@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        Add New URL
    </div>

    <div class="card-body">
        <form action="{{ route('admin.urllist.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="url">URL</label>
                <textarea name="url" class="form-control" id="url" rows="3" oninput="resizeTextarea(this)" required>{{ old('url') }}</textarea>
                @error('url')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

<script>
    function resizeTextarea(el) {
        el.style.height = 'auto';  // Reset height
        el.style.height = (el.scrollHeight) + 'px';  // Set height to fit content
    }
</script>
@endsection
