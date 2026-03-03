@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{url('public/css/checkboxdropdwon.css')}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('content')

<div class="card">
    <div class="card-header">
     Add Product Sub Category
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

        <form action="{{ route('admin.product-sub-category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

        <div class="row">
            <div class="col-lg-4">
               <div class="form-group">
                  <label for="product_falavor">Category*</label>
                  <select  class="form-control select2"  multiple="multiple" id="category-dropdown" name="main_cat_id[]"  required>
                     @foreach ($product_category as $product_categorys) 
                     <option value="{{$product_categorys->id}}">{{$product_categorys->name}} </option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name"> Sub Category Name*</label>
                <input type="text" id="title" name="name" class="form-control"  required>
                    
                </div>
            </div>

            <!-- <div class="col-lg-4">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">slug*</label>
                <input type="text" id="title" name="slug" class="form-control"  required>
                    
                </div>
            </div> -->
        </div> 
            <!-- <div class="form-group">
                <label for="images">Menu Image(686*661 Px )</label>
                <input type="file" required name="image">
            </div>
            
           <div class="form-group">
                <label for="images">Add Category on home page</label>
                 <input type="checkbox"  name="category_on_home">   
            </div>

            <div class="form-group">
            <label for="images"> Home Page banner (331*435 with black overlay ) </label>
                 <input type="file" name="image1" required>
            </div>

            <div class="form-group">
            <label for="images"> Home Page Category Icon (105*100 with With Transparent BG  ) </label>
                 <input type="file" name="image2" required>
            </div>
	
	      -->
            
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                
            </div>
        </form>


    </div>
</div>

 
@endsection
