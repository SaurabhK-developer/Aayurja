@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<div class="card">
    <div class="card-header">
        Media Edit
    </div>

    <div class="card-body">
        <form action="{{ route("admin.media.update", [$media->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            
             <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">Title*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($media) ? $media->title : '') }}" required>
            </div>
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="brief">Brief*</label>
                <input type="text" id="title" name="brief" class="form-control" value="{{ old('brief', isset($media) ? $media->brief : '') }}" required>
            </div>
           
            {{--<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Description*</label>
                 <textarea  name="description" rows="4" cols="50" class="form-control">{{$media->description}}
                     </textarea>
                    
                   <script>
                                CKEDITOR.replace('description');
                            </script>
            </div>--}}
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="logo">Logo* (255 × 310 px)</label>
                <input type="file" name="logo" class="imgLeft form-control"> 
            </div>
            @if(@$media->logo)
            <div class="col-md-12 pl-0">
                <img src="{{url('/public/uploads/media/logo')}}/{{ $media->logo }}" class="img-thumbnail" width="350px" height="300px" />
            </div>
            @endif
           
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="url">URL*</label>
                <input type="text" id="url" name="url" class="form-control" value="{{ old('url', isset($media) ? $media->url : '') }}" required>
            </div>
                
            <input class="btn btn-danger" id="rightButton" type="submit" value="{{ trans('global.save') }}">
           <div>
        </form>


    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 

@endsection
