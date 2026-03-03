@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<div class="card">
    <div class="card-header">
        Edit FormType
    </div>

    <div class="card-body">
        <form action="{{ route("admin.formtype.update", [$formType->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group {{ $errors->has('form_type_name') ? 'has-error' : '' }}">
                <label for="form_type_name">FormType Name*</label>
                <input type="text" id="form_type_name" name="form_type_name" class="form-control" value="{{ old('form_type_name', isset($formType) ? $formType->form_type_name : '') }}" required>
                @if($errors->has('form_type_name'))
                    <em class="text-danger">
                        {{ $errors->first('form_type_name') }}
                    </em>
                @endif
            </div>
            <div>
                <input class="btn btn-danger" id="saveButton" type="submit" value="{{ trans('global.save') }}">
                <input class="btn btn-secondary" type="button" value="Back" onClick="window.location.href = '{{ url("/admin/formtype") }}'">
            </div>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        var _URL = window.URL || window.webkitURL;

        $("input[name='image']").change(function() {
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                img.onload = function() {
                    if (this.width !== 350 || this.height !== 300) {
                        alert("Please upload an image with dimensions 350x300px. Current size: " + this.width + "x" + this.height + "px");
                        $("#saveButton").prop('disabled', true);
                    } else {
                        $("#saveButton").prop('disabled', false);
                    }
                };
                img.onerror = function() {
                    alert("Invalid file type: " + file.type);
                };
                img.src = _URL.createObjectURL(file);
            }
        });
    });
</script>
@endsection
