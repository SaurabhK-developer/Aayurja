@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<div class="card">
    <div class="card-header">
     Add Review
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


        <form action="store" method="POST" enctype="multipart/form-data">
            @csrf
             <div class="form-group">
                <label for="product_name">Product Name*</label>
                
                <select class="form-control" name="product_id" required>
                    <option value="">Select Product</option>
                    @foreach ($products as $product) 
                    <option value="{{$product->id}}">
                    {{$product->product_name}}
                    </option>
                    @endforeach
                </select>
            </div>
            
        

            <div class="form-group">
                <label for="comment">Comment*</label>
                <textarea class="form-control" rows="3" name="more_suggestion" required></textarea>   
            </div>
            
            <div class="form-group">
                <label for="user_name">User Name*</label>
                 <input type="text" name="user_name" class="form-control" required>   
            </div>

            <div class="form-group">
                <label for="rating">Rating*</label>
                
                <select class="form-control" name="rating" required>
                    <option value="">Select Rating</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select>
            </div>

            <div class="form-group">
                 <input type="hidden" name="status" value="1" required>   
            </div>

            <!-- <div class="form-group">
                <label for="image">Image</label>
                 <input type="file" class="form-control" name="image">
            </div> -->

            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                
            </div>
        </form>


    </div>
</div>

 
@endsection
