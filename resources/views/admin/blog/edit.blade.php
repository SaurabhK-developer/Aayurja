@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<div class="card">
    <div class="card-header">
        Blog Edit
    </div>

    <div class="card-body">
    <form action="{{ route("admin.blog.update", [$blog->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            
              <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Title*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($blog) ? $blog->title : '') }}" required>
               
            </div>
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Slug*</label>
               <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', isset($blog) ? $blog->slug : '') }}" required>
                   
            </div>
            
            
           <div class="row">

           <div class="col-md-3 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Date*</label>
                <input type="date" id="created_at" name="created_at" value="{{ date('Y-m-d', strtotime($blog->created_at))}}" class="form-control">
                   
            </div>
           
            <div class="col-md-3 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Category*</label>
                 <select name="category"  class="form-control select2"  required>
                   @foreach($category as $id => $categories)
                       <option value="{{ $id }}" {{ $blog->category == $id ? 'selected' : '' }}>{{ $categories }}</option>
                     
                   @endforeach
               </select>  </div>


                 <div class="col-md-3 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Author*</label>
                 <select name="author"  class="form-control select2"  required>
                   @foreach($author as $id => $author)
                       <option value="{{ $id }}" {{ $blog->author_id == $id ? 'selected' : '' }}>{{ $author }}</option>
                     
                   @endforeach
               </select>  </div>
           </div>
     
                <div class="mt-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">User Image  Round Shap* (252 × 252 px)</label>
                <input type="file" name="image"  class="imgLeft form-control"> 
            </div>
            @if(@$blog->image)
            <div class="col-md-12 pl-0">
                <img src="{{ URL::to('/') }}/public/uploads/blog/{{ $blog->image }}" class="img-thumbnail" width="350px" height="300px" /><br>
            </div>
            @endif
            <br>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Description*</label>
                 <textarea  name="description" rows="4" cols="50" class="form-control">{{$blog->description}}
                     </textarea>
                    
                   <script>
                                CKEDITOR.replace('description');
                            </script>
            </div>
           <div class="mt-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
               <label for="name">Banner Image (1334px × 614px)</label>
                <input type="file" name="image1" class="imgCenter form-control"> 
            </div>
            @if(@$blog->image1)
            <div class="col-md-12 pl-0">
                <img src="{{ URL::to('/') }}/public/uploads/blog/{{ $blog->image1 }}" class="img-thumbnail" width="400px" height="400px" />
            </div>
            @endif

           <br>

            <div class="row">
                <div class="col-lg-4">
                        <div class="mt-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Blog Listing Image (540 × 647 px)</label>
                        <input type="file" name="image2" class="imgCenter form-control"> 
                    </div>
                    @if(@$blog->image2)
                    <div class="col-md-12 pl-0">
                        <img src="{{ URL::to('/') }}/public/uploads/blog/{{ $blog->image2 }}" class="img-thumbnail" width="400px" height="400px" />
                    </div>
                    @endif
                </div>

            </div>

            <br>

            <br>    
            <input class="btn btn-danger" id="rightButton" type="submit" value="{{ trans('global.save') }}">
          
           <div>
        </form>


    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 
<!-- <script type="text/javascript">

    $(document).ready(function(){
        $("#rightButton").prop('disabled', false);
      //  $(".imgCenter").prop('disabled', true);
       
        var _URL = window.URL || window.webkitURL;
    
        
        $(".imgLeft").change(function(){
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                
                img.onload = function(){
                    if(this.width > 350 || this.height > 300 ){
                        alert("Please upload image in this dimension: 350x300px and uploaded size is " + this.width+'x'+this.height+' px');
                        
                        $("#rightButton").prop('disabled', true);
                    }
                    else if(this.width < 350 || this.height < 300){
                        alert("Please upload image in this dimension: 350x300px and uploaded size is " + this.width+'x'+this.height+' px');
                         
                        $("#rightButton").prop('disabled', true);
                    }
                    else if(this.width === 350 && this.height === 300){
                        $("#rightButton").prop('disabled', false); 
                    }
                };
                img.onerror = function() {
                     alert( "not a valid file: " + file.type);
                };
                img.src = _URL.createObjectURL(file);
            }
        });
        
        $(".imgCenter").change(function() {
                var file_center, img_center;
                if ((file_center = this.files[0])) {
                    img_center = new Image();
                    
                    img_center.onload = function(){
                    if(this.width > 1349 || this.height > 400 ){
                        alert("Please upload image in this dimension: 1349x400px and uploaded size is " + this.width+'x'+this.height+' px');
                        
                        $("#rightButton").prop('disabled', true);
                    }
                    else if(this.width < 1349 || this.height < 400){
                        alert("Please upload image in this dimension: 1349x400px and uploaded size is " + this.width+'x'+this.height+' px');
                       
                        $("#rightButton").prop('disabled', true);
                    }
                    else if(this.width === 1349 && this.height === 400){
                       $("#rightButton").prop('disabled', false);
                        }
                    };
                    img_center.onerror = function() {
                        alert( "not a valid file: " + file_center.type);
                    };
                    img_center.src = _URL.createObjectURL(file_center);
                }
            });
        
             
    }); 
</script>-->
@endsection