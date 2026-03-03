@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
@section('content')

<div class="card">
    <div class="card-header">
      Categories
    </div>

    <div class="card-body">
        <form action="{{ route("admin.product_categories.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.user.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group">
                <label for="shop_page_title">Shop Page Title*</label>
                <input type="text" id="shop_page_title" name="shop_page_title" class="form-control" value="{{ old('shop_page_title', isset($user) ? $user->shop_page_title : '') }}" required>
                
            </div>

            <div class="form-group">
                <label for="shop_page_desc">Shop Page Description*</label>
                <!-- <input type="text" id="shop_page_desc" name="shop_page_desc" class="form-control" value="{{ old('shop_page_desc', isset($user) ? $user->shop_page_desc : '') }}" required> -->
                <textarea name="shop_page_desc" id="shop_page_desc" rows="10" cols="80" class="form-control"></textarea>
                <script>
                    CKEDITOR.replace('shop_page_desc');
                </script>
            </div>



            <div class="form-group">
            <label for="image">  Product Category Image  (236 × 236 px ) </label>
                 <input type="file" name="image" required>
            </div>
            
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                  <input class="btn btn-danger" type="button" value="Back" onClick="window.location.href = '{{ url("/admin/product_categories") }}'">
            
            </div>
        </form>
       



    </div>
</div>
@endsection

