@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
       Categories
    </div>

    <div class="card-body">
        <form action="{{ route('admin.deal.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Product*</label>
               <select name="product_id" class="form-control mb-0 " id="product_id">
                                            <option disabled="" selected="" class="invalid">Select one</option>
                                            @foreach($product as $post)
                                            <option value="{{$post->id}}">{{$post->product_name}}</option>
                                            @endforeach
                                            
                                        </select>

             <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">previous  Discount*</label>
               <input type="text" readonly id="previous_discount" name="previous_discount" class="form-control"  required>
                   
            </div>
           <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Discount*</label>
               <input type="text" id="discount" name="discount" class="form-control"  required>
                   
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Sale Start Date*</label>
               <input type="Date" id="start_date" name="start_date" class="form-control"  required>
                   
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Sale End Date*</label>
               <input type="Date" id="end_date" name="end_date" class="form-control"  required>
                   
            </div>
           <div class="mt-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name"> Image* </label>
                <input type="file" name="image" required class="imgLeft form-control"> 
            </div>
                
               
                
            </div>
         
             
            <div>
              <input class="btn btn-danger" type="submit" id="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>



@endsection
@section('scripts')

<script>
$(document).ready(function() {
    $('#product_id').on('change', function() {

            var product_id = this.value;
            $("#previous_discount").html('');
            $.ajax({
            url:"{{url('get-discount')}}",
            type: "POST",
            data: {
            product_id: product_id,
            _token: '{{csrf_token()}}' 
            },
            dataType : 'json',
            success: function(result){
           
            // $("##previous_discount").append('<option value="'+value.id+'">'+value.product_name+'</option>');
            $("#previous_discount").val(result);
          
            
            }
            });
        });    


 });
</script>
@endsection




