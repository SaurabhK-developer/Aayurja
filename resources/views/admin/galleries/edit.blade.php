@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<div class="card">
    <div class="card-header">
       Slider Edit  
    </div>

    <div class="card-body">
        <form action="{{ route("admin.galleries.update", [$gallery->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
              
             <div class="form-group ">
                <label for="name">Title*</label>
               <input type="text" id="name" name="title" class="form-control" value="{{ old('title', isset($gallery) ? $gallery->title : '') }}" required>
                   
            </div>
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                 <label for="name">Category*</label>
                 
                   
                           <select class="form-control" name="name">
                               <option value="1" {{$gallery->name=="1"? 'selected' : '' }}>School</option>
                               <option value="2" {{$gallery->name=="2"? 'selected' : '' }}>Event</option>
                               <option value="3"{{$gallery->name=="3"? 'selected' : '' }}>Classroom</option>
                                <option value="4"{{$gallery->name=="4"? 'selected' : '' }}>Activites</option>
                           </select>
                
                
                </div>
            
             <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name"> image *</label>
                <input type="file" name="image" class="img form-control">
                 <img src="{{ URL::to('/') }}/public/uploads/{{ $gallery->image }}" class="img-thumbnail"  width="100" />
                               
            </div>
            <div>
                <input class="btn btn-danger" type="submit" id="leftButton" value="{{ trans('global.save') }}">
                  <input class="btn btn-danger" type="button" value="Back" onClick="window.location.href = '{{ url("/admin/galleries") }}'">
            
            </div>
        </form>


    </div>
</div>

@endsection