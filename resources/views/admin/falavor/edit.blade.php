@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<div class="card">
    <div class="card-header">
     Edit Product Designer
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
       
        <form action="{{ route("admin.falavor.update", [$falavors->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
      
             <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">falavor Name*</label>
               <input type="text" id="title" name="name" class="form-control" value="{{ $falavors->name }}" required> 
            </div>
            
             

            
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                
            </div>
        </form>


    </div>
</div>

 
@endsection
