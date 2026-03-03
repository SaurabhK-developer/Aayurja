@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

        <form action="{{ route('admin.coupon.edit.update', [$coupon->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
      
             <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="coupon">Coupon*</label>
                <input type="text" name="coupon" class="form-control" value="{{$coupon->title}}" readonly>
            </div>
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="discount_percentage">Discount Type*</label>
                <select id="discount_type" name="discount_type" class="form-control" onchange="discountType()" required>
                    <option value="default" disabled>-- Select Discount Type</option>
                    <option value="discount_percentage" {{ $coupon->discount_type == 'discount_percentage' ? 'selected' : '' }}>Discount Percentage</option>
                    <option value="discount_flat" {{ $coupon->discount_type == 'discount_flat' ? 'selected' : '' }}>Discount Flat</option>
                    <option value="specific_product"{{ $coupon->discount_type == 'specific_product' ? 'selected' : '' }}>specific product</option>
                </select>
            </div>


                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}"  id="product_id"> 
                  <label for="name">Product*</label>
                  <?php 
                     $product_ids = explode(",",$coupon->product);
                     ?>
                  <select name="product_id[]"  id="product_id" class="form-control select2" multiple="multiple" >
                  @foreach($products as $id => $product)
                  <option value="{{$id }}" {{ in_array($id, $product_ids) ? 'selected': '' }}>{{ $product }}</option>
                  @endforeach
                  </select>
                  </select>
               </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}" id="discount_percentage">
                <label for="discount_percentage">Discount Percentage*</label>
                <input type="text" name="discount_percentage" class="form-control" id="discount_percentage_id" value="{{$coupon->discount_percentage}}">
            </div>
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}" id="discount_flat">
                <label for="discount_flat">Discount Flat*</label>
                <input type="text" name="discount_flat" class="form-control" id="discount_flat_id" value="{{$coupon->discount_flat}}">
            </div>
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="valid_from">Valid From*</label>
                <input type="date" name="valid_from" class="form-control" id="valid_from" value="{{$coupon->valid_from}}" required>
            </div>
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="valid_upto">Valid Upto*</label>
                <input type="date" name="valid_upto" class="form-control" value="{{$coupon->valid_upto}}" required>
            </div>
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="limit_upto">User Limit*</label>
                <input type="text" name="limit_upto" class="form-control" value="{{$coupon->limit_upto}}" required>
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="limit_upto">Short description*</label>
                <input type="text" name="discription" class="form-control" value="{{$coupon->discription}}" required>
            </div>
         
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="status">Status*</label><br>
                <table>
                    <tr>
                        <td>Inactive</td>
                        <td><input type="radio" name="status" value="0" style="margin-left: 15px;margin-top: 5px;width: 18px;height: 18px" @if($coupon->active == 0) checked @endif
                        ></td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td><input type="radio" name="status" value="1" style="margin-left: 15px;margin-top: 5px;width: 18px;height: 18px" @if($coupon->active == 1) checked @endif
                        ></td>
                    </tr>
                </table>
            
            </div>
            
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>

<script type="text/javascript">
    function discountType() {
        
        var x = document.getElementById("discount_type").value;
        console.log(x);
        if(x == 'discount_percentage')
        {
            $('#discount_percentage').show();
            $('#discount_flat').hide();
            $("#discount_flat_id").val(""); 
            $("#product_id").val(""); 
            $("#product_id").hide(); 
        }
        else if(x =='specific_product')

        {   $('#product_id').show();
            $('#discount_flat').hide();
            $('#discount_percentage').show();
            $("#discount_flat_id").val("");
        }

        else{
            $("#product_id").val(""); 
            $("#product_id").hide(); 
            $('#discount_flat').show();
            $('#discount_percentage').hide();
            $("#discount_percentage_id").val("");
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
    var x=document.getElementById("discount_type");
      var selectedValues= '';
      var selectedLength= 0;
      for (var i = 0; i < x.options.length; i++) {
         if(x.options[i].selected ==true){
              selectedValues += x.options[i].value;
              selectedLength = selectedLength+1;
          }
      }
      console.log('selectedValues: '+ selectedValues);

    if(selectedValues == 'discount_percentage')
    {
        $('#discount_percentage').show();
            $('#discount_flat').hide();
            $("#discount_flat_id").val(""); 
            $("#product_id").val(""); 
            $("#product_id").hide(); 
    }


   else if(selectedValues == 'specific_product')
    {

           $('#product_id').show();
            $('#discount_flat').hide();
            $('#discount_percentage').show();
            $("#discount_flat_id").val("");

    }


    else
    {
       
            $("#product_id").val(""); 
            $("#product_id").hide(); 
            $('#discount_flat').show();
            $('#discount_percentage').hide();
            $("#discount_percentage_id").val("");


        
    }
    });
</script>
 
@endsection
