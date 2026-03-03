@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        Edit Sitemap
    </div>
    <div class="card-body">
        <form action="{{ route('admin.sitemap.update', $sitemap->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="url">Sitemap URL</label>
                <textarea 
                    name="url" 
                    id="url" 
                    class="form-control" 
                    placeholder="Enter Sitemap URL" 
                    required 
                    style="overflow-y: hidden; resize: none;" 
                    oninput="adjustTextareaHeight(this)"
                >
                    {{ old('url', $sitemap->url) }}
                </textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection

<script>
    function adjustTextareaHeight(textarea) {
        textarea.style.height = 'auto'; 
        textarea.style.height = textarea.scrollHeight + 'px'; // Adjust height based on content
    }

    document.addEventListener('DOMContentLoaded', function() {
        var textarea = document.getElementById('url');
        adjustTextareaHeight(textarea);  
    });
</script>
