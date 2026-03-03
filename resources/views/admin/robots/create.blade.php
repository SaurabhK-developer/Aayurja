@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        Add Robots Entry
    </div>
    <div class="card-body">
        <form action="{{ route('admin.robots.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="content">Robots.txt Content</label>
                <textarea 
                    name="content" 
                    id="content" 
                    class="form-control" 
                    placeholder="Enter Robots.txt Content" 
                    required 
                    style="overflow-y: hidden; resize: none;" 
                    oninput="adjustTextareaHeight(this)"
                ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function adjustTextareaHeight(textarea) {
        textarea.style.height = 'auto'; 
        textarea.style.height = textarea.scrollHeight + 'px'; 
    }
</script>
@endpush
