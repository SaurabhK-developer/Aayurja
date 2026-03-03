@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<div class="card">
    <div class="card-header">
     slider
    </div>

    <div class="card-body">
        <form action="{{ route("admin.slider.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
             <div class="form-group ">
                <label for="name">Title*</label>
               <input type="text" id="name" name="title" class="form-control"  required>
                   
            </div>
          
        <div class="form-group ">
                <label for="name">Profile image*</label>
                <input type="file" name="image" class="img form-control"> 
            </div>

            <div>
                <input class="btn btn-danger"  type="submit" value="{{ trans('global.save') }}">
                  <input class="btn btn-danger" type="button" value="Back" onClick="window.location.href = '{{ url("/admin/slider") }}'">
            
            </div>
        </form>


    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@endsection