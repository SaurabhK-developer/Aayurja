@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('content')

<div class="card">
    <div class="card-header">
     Add Coupon
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

        <form action="{{ route("admin.coupon.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
             <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="coupon">Coupon*</label>
                <input type="text" name="coupon" class="form-control" required>
            </div>
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="discount_percentage">Discount Type*</label>
                <select id="discount_type" name="discount_type" class="form-control" onchange="discountType()" required>
                    <option value="default" disabled>-- Select Discount Type</option>
                    <option value="discount_percentage">Discount Percentage</option>
                    <option value="discount_flat">Discount Flat</option>
                    <option value="specific_product">specific product</option>
                </select>
            </div>
            


            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}" id="product_id">
                <label for="discount_percentage">selec product*</label>
                <select id="product_id" name="product_id[]" class="form-control select2" multiple="multiple">
                <option value="">-- Select product--</option>
                @if(isset($products))
                 @foreach($products as $product)
                 <option value="{{$product->id}}">{{$product->product_name}}</option>
                 @endforeach
                @endif
               </select>
            </div>


            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}" id="discount_percentage">
                <label for="discount_percentage">Discount Percentage*</label>
                <input type="text" name="discount_percentage" class="form-control" id="discount_percentage_id">
            </div>
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}" id="discount_flat">
                <label for="discount_flat">Discount Flat*</label>
                <input type="text" name="discount_flat" class="form-control" id="discount_flat_id">
            </div>
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="valid_from">Valid From*</label>
                <input type="date" name="valid_from" class="form-control" id="valid_from" value="" required>
            </div>
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="valid_upto">Valid Upto*</label>
                <input type="date" name="valid_upto" class="form-control" required>
            </div>
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="limit_upto">User Limit*</label>
                <input type="text" name="limit_upto" class="form-control" required>
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="limit_upto">Short description*</label>
                <input type="text" name="discription" class="form-control"  required>
            </div>
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="status">Status*</label><br>
                <table>
                    <tr>
                        <td>Inactive</td>
                        <td><input type="radio" name="status" value="0" style="margin-left: 15px;margin-top: 5px;width: 18px;height: 18px" checked></td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td><input type="radio" name="status" value="1" style="margin-left: 15px;margin-top: 5px;width: 18px;height: 18px"></td>
                    </tr>
                </table>
            
            </div>
            
            
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                
            </div>
        </form>


    </div>
</div>

<script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("valid_from")[0].setAttribute('min', today);
    document.getElementsByName("valid_upto")[0].setAttribute('min', today);
    
    var currentDate = new Date();
    document.getElementById('valid_from').value = currentDate.getFullYear() + '-' + ('0' + (currentDate.getMonth() + 1)).slice(-2) + '-' + ('0' + currentDate.getDate()).slice(-2);
</script>

<script type="text/javascript">
    // $('#discount_percentage').hide();
    $('#discount_flat').hide();

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
 
@endsection
