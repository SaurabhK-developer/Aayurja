@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        Edit Robots Entry
    </div>
    <div class="card-body">
        <form action="{{ route('admin.robots.update', $robot->id) }}" method="POST">            
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="content">Robots.txt Content</label>
                <textarea 
                    name="content" 
                    id="content" 
                    class="form-control" 
                    placeholder="Enter Robots.txt Content" 
                    required 
                    style="overflow-y: hidden; resize: none; min-height: 100px;" 
                    oninput="adjustTextareaHeight(this)"
                >{{ old('content', $robot->content) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function adjustTextareaHeight(textarea) {
        textarea.style.height = 'auto';  
        textarea.style.height = (textarea.scrollHeight) + 'px';  
    }

    document.addEventListener('DOMContentLoaded', function() {
        var textarea = document.getElementById('content');
        if (textarea) {
            adjustTextareaHeight(textarea);
        }
    });
</script>
@endpush
