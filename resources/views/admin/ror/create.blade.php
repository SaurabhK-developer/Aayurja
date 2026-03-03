@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        Add Ror.xml Entry
    </div>
    <div class="card-body">
        <form action="{{ route('admin.ror.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="content">Ror.xml Content</label>
                <textarea 
                    name="content" 
                    id="content" 
                    class="form-control" 
                    placeholder="Enter Ror.xml Content" 
                    required 
                    style="overflow-y: hidden; resize: both;" 
                    oninput="adjustTextareaHeight(this)"
                ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection

<script>
    function adjustTextareaHeight(textarea) {
        textarea.style.height = 'auto'; 
        textarea.style.height = textarea.scrollHeight + 'px'; // Set height according to scrollHeight
    }

    window.addEventListener('load', function () {
        var textarea = document.getElementById('content');
        if (textarea) {
            adjustTextareaHeight(textarea);  
        }
    });
</script>

