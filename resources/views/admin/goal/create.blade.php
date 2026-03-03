@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
       Goal
    </div>

    <div class="card-body">
        <form action="{{ route('admin.goals.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.user.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control"  required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.name_helper') }}
                </p>
            </div>
            <div class="mt-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Icon Image* (98 × 98 px)</label>
                <input type="file" name="image" required class="imgLeft form-control"> 
            </div>
             
            <div>
              <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
 
@endsection