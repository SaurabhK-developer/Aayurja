@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<div class="card">
    <div class="card-header">
        Deal Edit
    </div>

    <div class="card-body">
        <form action="{{ route('admin.deal.update', [$deal->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            
            
            
           <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                 <label for="name">Product*</label>
                  <select name="product_id"  class="form-control select2"  required>
                    @foreach($product as $id => $products)
                        <option value="{{ $id }}" {{ $deal->product_id == $id ? 'selected' : '' }}>{{ $products }}</option>
                      
                    @endforeach
                </select>  </div>
            
                
              <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Privius Discount*</label>
                <input type="text" readonly id="previous_discount" name="previous_discount" class="form-control" value="{{ old('previous_discount', isset($deal) ? $deal->previous_discount : '') }}" required>
               
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name"> Discount*</label>
                <input type="text" id="discount" name="discount" class="form-control" value="{{ old('discount', isset($deal) ? $deal->discount : '') }}" required>
               
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name"> Start_date*</label>
                <input type="Date" id="start_date" name="start_date" class="form-control" value="{{ old('start_date', isset($deal) ? $deal->start_date : '') }}" required>
               
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name"> End Date*</label>
                <input type="Date" id="end_date" name="end_date" class="form-control" value="{{ old('end_date', isset($deal) ? $deal->end_date : '') }}" required>
               
            </div>
                         
                <div class="mt-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Featured Image* (796 × 580 px)</label>
                <input type="file" name="image"  class="imgLeft form-control"> 
            </div>
          
           
           
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