@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Goal
    </div>

    <div class="card-body">
        <form action="{{ route("admin.goals.update", [$goal->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.user.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($goal) ? $goal->name : '') }}" required>
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
                <label for="name">Icon Image * (98 × 98 px  Png only)</label>
                <input type="file" name="image"  class="imgLeft form-control"> 
            </div>
            @if(@$goal->image)
            <div class="col-md-12 pl-0">
                <img src="{{ URL::to('/') }}/public/uploads/goal/{{ $goal->image }}" class="img-thumbnail" width="350px" height="300px" />
            </div>
            @endif
            
            
           
            <div>
                <input class="btn btn-danger"  type="submit" value="{{ trans('global.save') }}">
                <input class="btn btn-danger" type="button" value="Back" onClick="window.location.href = '{{url("admin/tags")}}'">
            </div>
        </form>


    </div>
</div>


@endsection