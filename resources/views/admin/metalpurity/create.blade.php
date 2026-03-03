@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
    Jewelry Purity
    </div>
    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('status') }}
        </div>
        @elseif(session('failed'))
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('failed') }}
        </div>
        @endif

    <div class="card-body">
        <form action="{{ route('admin.metalpurity.store') }}" method="POST" enctype="multipart/form-data">
            @csrf


            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                  <label for="product_falavor">materials Type*</label>
                  <select class="form-control" id="category-dropdown" name="material_id"  required>
                     @foreach ($materials as $material) 
                     <option value="{{$material->id}}">{{$material->name}} </option>
                     @endforeach
                  </select>
               </div>
           
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.user.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($falavor) ? $falavor->name : '') }}" required>
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
              <input class="btn btn-danger" type="submit" id="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  




</script>
<script>


@endsection