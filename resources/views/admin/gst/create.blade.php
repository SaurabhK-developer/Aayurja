@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{url('public/css/checkboxdropdwon.css')}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('content')

<div class="card">
    <div class="card-header">
     Add GST
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

        <form action="{{ route('admin.gst.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-lg-4">
                <div class="form-group">
                    <label for="product_falavor">Product*</label>
                    <select  class="form-control select2"  multiple="multiple" id="category-dropdown" name="product_ids[]"  required>
                        @foreach ($products as $product) 
                        <option value="{{$product->id}}">{{$product->product_name}} </option>
                        @endforeach
                    </select>
                </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name"> HSN Code*</label>
                        <input type="text" id="hsn_code" name="hsn_code" class="form-control" required>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name"> GST percentage*</label>
                        <input type="text" placeholder="Ex. 18" id="gst_percentage" name="gst_percentage" class="form-control" required>
                    </div>
                </div>

              
            </div> 
            
            
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                
            </div>
        </form>


    </div>
</div>

 
@endsection
