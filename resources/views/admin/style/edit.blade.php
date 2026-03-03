@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        
    </div>

    <div class="card-body">
        <form action="{{ route("admin.style.update", [$style->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.user.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($style) ? $style->name : '') }}" required>
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">slug*</label>
                <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', isset($style) ? $style->slug : '') }}" required>
            </div>
        
          
            <div>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.name_helper') }}
                </p>
            </div>
            
         
            <div>
                <input class="btn btn-danger" id="rightButton" type="submit" value="{{ trans('global.save') }}">
                <input class="btn btn-danger" type="button" value="Back" onClick="window.location.href = '{{url("admin/style")}}'">
            </div>
        </form>


    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

@endsection