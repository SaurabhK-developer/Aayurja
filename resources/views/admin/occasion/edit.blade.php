@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Occasion
    </div>

    <div class="card-body">
        <form action="{{ route("admin.occasion.update", [$occasion->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
           
            
            
            
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.user.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($occasion) ? $occasion->name : '') }}" required>
                
                
              
          
                
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="image">  occasion banner round (	236 × 236 px Round shap) </label>
                 <input type="file" name="image" >
            </div>

            @if(!empty($occasion->image))
                <img src="{{url('/public/uploads/occasion')}}/{{$occasion->image}}" style="width: 50px;height: 70px;margin-left: 10px;"> 
                @endif

                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="image1">  occasion banner square (	236 × 236 px Square shap) </label>
                 <input type="file" name="image1" >
            </div>
         
            @if(!empty($occasion->image1))
                <img src="{{ url('/public/uploads/occasion/' . $occasion->image1) }}" style="width: 50px; height: 70px; margin-left: 10px;">
            @endif


            <div>
                <input class="btn btn-danger" id="rightButton" type="submit" value="{{ trans('global.save') }}">
                <input class="btn btn-danger" type="button" value="Back" onClick="window.location.href = '{{url("admin/occasion")}}'">
            </div>
        </form>


    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

@endsection