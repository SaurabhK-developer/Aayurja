@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<div class="card">
    <div class="card-header">
        Edit Concern
    </div>

    <div class="card-body">
        <form action="{{ route('admin.shop-by-concern.update', $shop_by_concern->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">Title*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $shop_by_concern->title) }}" required>
            </div>
            


            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="shop_page_title">Shop Page Title*</label>
                <input type="text" id="shop_page_title" name="shop_page_title" class="form-control" value="{{ old('shop_page_title', isset($shop_by_concern) ? $shop_by_concern->shop_page_title : '') }}" required>
            </div>

            <!-- <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="shop_page_desc">Shop Page Title*</label>
                <input type="text" id="shop_page_desc" name="shop_page_desc" class="form-control" value="{{ old('shop_page_desc', isset($shop_by_concern) ? $shop_by_concern->shop_page_desc : '') }}" required>
            </div> -->

            <div class="form-group">
                <label for="shop_page_desc">Shop Page Description*</label>
                <!-- <input type="text" id="shop_page_desc" name="shop_page_desc" class="form-control" value="{{ old('shop_page_desc', isset($user) ? $user->shop_page_desc : '') }}" required> -->
                <textarea name="shop_page_desc" id="shop_page_desc" rows="10" cols="80" class="form-control">{{@$shop_by_concern->shop_page_desc}}</textarea>
                <script>
                    CKEDITOR.replace('shop_page_desc');
                </script>
            </div>




            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                <label for="image">Concern Image* (Recommended Size: 178 × 139 px)</label>
                <input type="file" name="image" class="form-control">
                @if($shop_by_concern->image)
                    <div class="mt-2">
                        <img src="{{ asset('public/' . $shop_by_concern->image) }}" width="100" alt="Current Image">
                    </div>
                @endif
            </div>
            
            <br>
            <div>
                <input class="btn btn-success" type="submit" value="Update">
                <input class="btn btn-danger" type="button" value="Back" onClick="window.location.href = '{{ url('/admin/shop-by-concern') }}'">
            </div>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

@endsection
