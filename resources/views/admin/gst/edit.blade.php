@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{url('public/css/checkboxdropdwon.css')}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@section('content')

<div class="card">
    <div class="card-header">
     Edit  Sub Product Category
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

        
            <form action="{{ route('admin.gst.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

       <div class="row">
            <div class="col-lg-4">
               <div class="form-group">
                  <label for="product_falavor">Product Name*</label>
                  <!-- <select  class="form-control select2"  multiple="multiple" id="category-dropdown" name="product_ids[]"  required>
                     @foreach ($products as $product) 
                     <option value="{{$product->id}}"  {{ $product->id == $gst->product_id ? 'selected' : '' }} >{{$product->product_name}} </option>
                     @endforeach
                  </select> -->
                  <!-- <input type="text" id="title" class="form-control" value="{{ $gst->product->product_name }}" disabled> -->

                  <input type="hidden" id="title" class="form-control" name="gst_id" value="{{ $gst->id }}"><br>
<label><b>{{ $gst->product->product_name }}</b></label>

               </div>
            </div>

            <div class="col-lg-4">
             <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">HSN Code*</label>
               <input type="text" id="title" name="hsn_code" class="form-control" value="{{ $gst->hsn_code }}" required>
                   
            </div>
            </div>

            <div class="col-lg-4">
             <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">GST percentage*</label>
               <input type="text" id="title" name="gst_percentage" class="form-control" value="{{ $gst->gst_percentage }}" required>
                   
            </div>
            </div>
            
            <!-- <div class="col-lg-4">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">slug*</label>
                <input type="text" id="title" name="slug" class="form-control"  value="{{ $gst->slug }}" required>
                    
                </div>
            </div> -->
    </div>
            <!-- <div class="form-group">
                <label for="images">Menu Image(686*661 Px ) </label>
                <input type="file" name="image">
                @if(!empty($category->image))
                    <img src="{{url('/public/uploads/catrgory')}}/{{$category->image}}" style="width: 50px;height: 70px;margin-left: 10px;">
                   
                @endif
            </div>
            
            <div class="form-group">
                <label for="images">Add Category on home page</label>
                 <input type="checkbox" name="category_on_home" value="1" @if(!empty($category->category_on_home) && $category->category_on_home == 1) checked @endif>   
            </div>

            <div class="form-group">
                 <input type="file" class="form-control" name="image1">   
                 <label for="images">  Category banner (331*435 Px with black overlay ) </label>           
                @if(!empty($category->image1))
                    <img src="{{url('/public/uploads/catrgory')}}/{{$category->image1}}" style="width: 50px;height: 70px;margin-left: 10px;">
                   
                @endif
            </div>

            <div class="form-group">
                 <input type="file" class="form-control" name="image2"> 
                 <label for="images">  Category Icon (105*100 px with With Transparent BG  ) </label>             
                 @if(!empty($category->image2))
                <img src="{{url('/public/uploads/catrgory')}}/{{$category->image2}}" style="width: 50px;height: 70px;margin-left: 10px;"> 
                @endif
            </div> -->
           



            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                
            </div>
        </form>


    </div>
</div>

 
@endsection
