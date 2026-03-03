@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<div class="card">
    <div class="card-header">
     Blog
    </div>

    <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
             <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Gold Price(24)*</label>
               <input type="text" id="price24" name="gold_price" class="form-control"  required>
                   
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Gold Price(22)*</label>
               <input type="text" id="price22" name="slug" class="form-control"  required>
                   
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Gold Price(18)*</label>
               <input type="text"id="price18" name="slug" class="form-control"  required>   
            </div>

            <div class="row">
            
            <div class="col-md-3 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Date*</label>
                <input type="date" id="created_at" name="created_at" value="<?php echo date('Y-m-d'); ?>" class="form-control"  required>
                   
            </div>

            
             
           
             
              
          
             
            

             <div class="mt-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Blog Listing & Banner Image* (1190px × 830px)</label>
                <input type="file" name="image" required class="imgLeft form-control"> 
            </div>

            



             <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name"> Description (500 to 600 Char Only)*</label>
                {!! Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                  <script>
                    CKEDITOR.replace('description');
                </script>
            </div>

            <div class="mt-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Content Image First* (1190px × 840px)</label>
                <input type="file" name="image1" class="imgCenter form-control"> 
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name"> Second Description(500 to 600 Char Only) *</label>
                {!! Form::textarea('description2', old('description2'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                  <script>
                        CKEDITOR.replace('description2');
                  </script>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="mt-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Portrait Image* (610px × 800px)</label>
                        <input type="file" name="image2" class="imgCenter form-control"> 
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name"> Portrait Side First Description(500 to 600 Char Only) *</label>
                        {!! Form::textarea('description3', old('description3'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                        <script>
                                CKEDITOR.replace('description3');
                        </script>
                    </div>
                    <br>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name"> Portrait Side Second Description(500 to 600 Char Only) *</label>
                        {!! Form::textarea('description4', old('description4'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                        <script>
                                CKEDITOR.replace('description4');
                        </script>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name"> Bottom Description(500 to 600 Char Only) *</label>
                        {!! Form::textarea('description5', old('description5'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                        <script>
                                CKEDITOR.replace('description5');
                        </script>
                    </div>
                </div>
            </div>

            
            
        
             
<!--             

            
            
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Banner Text *</label>
               <input type="text" id="title" name="banner_text" class="form-control"  required>
                   
            </div> -->
            <!-- <div class="mt-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Trending Image (252 × 252 px)</label>
                <input type="file" name="image3" class="imgCenter form-control"> 
            </div> -->
            <br>

            
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                 <input class="btn btn-danger" type="button" value="Back" onClick="window.location.href = '{{ url("/admin/blog") }}'">
            </div>
        </form>


    </div>
</div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 

@endsection