@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<div class="card">
    <div class="card-header">
     Testimonials
    </div>

    <div class="card-body">
        <form action="{{ route("admin.galleries.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
           
             <div class="form-group ">
                <label for="name">Title*</label>
               <input type="text" id="name" name="title" class="form-control"  required>
                   
            </div>
           <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                 <label for="name">Category*</label>
                 
                   
                           <select class="form-control" name="name">
                               <option value="1">School</option>
                               <option value="2">Event</option>
                               <option value="3">Classroom</option>
                                <option value="4">Activites</option>
                           </select>
                
                
                </div>
         
        <div class="form-group " >
                <label for="name">Banner image*</label>
                <input type="file" name="image" class="img form-control"> 
            </div>
     
            <div>
                <input class="btn btn-danger" id="leftButton" type="submit" value="{{ trans('global.save') }}">
                  <input class="btn btn-danger" type="button" value="Back" onClick="window.location.href = '{{ url("/admin/galleries") }}'">
            
            </div>
        </form>


    </div>
</div>

@endsection