@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<div class="card">
    <div class="card-header">
        Ratings Edit
    </div>

    <div class="card-body">
        <form action="{{ route('admin.ratings.update', $rating->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')


            <div class="form-group">
                <label for="product_id">Product</label>
                <select name="product_id" id="product_id" class="form-control">
                    @foreach($products as $id => $product_name)
                        <option value="{{ $id }}" {{ $rating->product_id == $id ? 'selected' : '' }}>{{ $product_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="rating">Rating</label>
                <input type="number" name="rating" id="rating" class="form-control" value="{{ $rating->rating }}">
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <select name="title" id="title" class="form-control" required>
                    <option value="Product Quality" {{ $rating->title == 'Product Quality' ? 'selected' : '' }}>Product Quality</option>
                    <option value="Color" {{ $rating->title == 'Color' ? 'selected' : '' }}>Color</option>
                    <option value="Material" {{ $rating->title == 'Material' ? 'selected' : '' }}>Material</option>
                    <option value="Fit" {{ $rating->title == 'Fit' ? 'selected' : '' }}>Fit</option>
                    <option value="Value For Money" {{ $rating->title == 'Value For Money' ? 'selected' : '' }}>Value For Money</option>
                    <option value="Issue Need To Fix" {{ $rating->title == 'Issue Need To Fix' ? 'selected' : '' }}>Issue Need To Fix</option>
                </select>
            </div>
            

            <div class="form-group">
                <label for="user_email">Email</label>
                <input type="email" name="user_email" id="user_email" class="form-control" value="{{ $rating->user_email }}">
            </div>

            <div class="form-group">
                <label for="user_name">User Name</label>
                <input type="text" name="user_name" id="user_name" class="form-control" value="{{ $rating->user_name }}">
            </div>

            <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $rating->description }}</textarea>
        </div>


            <div class="form-group">
                <label for="product_image">Images</label>
                <input type="file" name="product_image[]" id="product_image" class="form-control-file" accept="image/*" multiple>
                @if(!empty($rating->product_image))
                <div class="form-group">
                    <label for="product_image"></label><br>
                    @foreach(json_decode($rating->product_image, true) as $image)
                        <img src="{{ asset('public/' . $image) }}" alt="Product Image" style="width: 150px; height: auto;">
                    @endforeach
                </div>
            @endif
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" {{ $rating->status == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $rating->status == '0' ? 'selected' : '' }}>Deactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Rating</button>
        </form>

    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 
@endsection