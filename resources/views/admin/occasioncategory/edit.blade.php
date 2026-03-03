@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
    Occasion Category
    </div>

    <div class="card-body">
        <form action="{{ route("admin.occasioncategory.update", [$occasioncategory->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
             {{-- <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                 <label for="name">Category*</label>
                  <select name="category_id"  class="form-control select2"  required>
                    @foreach($category as $id => $category)
                        <option value="{{ $id }}" {{ $occasioncategory->category_id == $id ? 'selected' : '' }}>{{ $category }}</option>
                      
                    @endforeach  
                </select>  </div> --}}
            
            
            
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.user.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($occasioncategory) ? $occasioncategory->name : '') }}" required>
                
                
              
          
                
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
                <input class="btn btn-danger" type="button" value="Back" onClick="window.location.href = '{{url("admin/occasioncategory")}}'">
            </div>
        </form>


    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

@endsection