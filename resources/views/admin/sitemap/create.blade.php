@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        Add Sitemap
    </div>
    <div class="card-body">
        <form action="{{ route('admin.sitemap.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="url">Sitemap URL</label>
                <textarea 
                    name="url" 
                    id="url" 
                    class="form-control" 
                    placeholder="Enter Sitemap URL" 
                    required 
                    style="overflow-y: hidden; resize: none;" 
                    oninput="adjustTextareaHeight(this)">
                </textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection

<script>
    function adjustTextareaHeight(textarea) {
        textarea.style.height = 'auto'; 
        textarea.style.height = textarea.scrollHeight + 'px'; // Adjust height based on content
    }
</script>
