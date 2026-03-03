@extends('layouts.admin')
@section('content')
<style>
    .click-border:hover{
    outline: black solid 2px;
}
</style>
<div class="card">
    <div class="card-header">
      Add Flavour mapping
    </div>

    <div class="card-body">
        <form action="{{ route('admin.flavours.store') }}" method="POST" enctype="multipart/form-data">
            @csrf


           
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">category*</label>
                 {!! Form::select('categoryid', $category, null, ['placeholder' => 'Please select','id' => 'category-dropdown',  'class' => 'form-control', 'required' => '']) !!}
                   
            </div>
            <div class="form-group">
                <label for="type_of_product">product*</label>
                <select class="form-control select2 product_selecter" name="productid" id="product-dropdown" required>
                </select>
            </div>
           
           
           
             <!--<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Product*</label>
                 {!! Form::select('productid', $products, null, ['placeholder' => 'Please select', 'class' => 'form-control select2 product_selecter', 'required' => '']) !!}
                   
            </div>-->
            
            
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Flavour name*</label>
                <input type="text" id="flavour" name="flavour" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="name">Select Flavour Image*</label>
                <input type="hidden" name="image_id" id="image_id" value="">
                <div class="row" id="product_images">
                    
                </div>
            </div>
            
            <div class="col-lg-4 col-md-3 col-6">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="outofstock">Out of stock*</label>
                    <input type="checkbox" id="outofstock" name="out_of_request" class="form-control">
                </div>
            </div>
         
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                  <input class="btn btn-danger" type="button" value="Back" onClick="window.location.href = '{{ url("/admin/flavours") }}'">
            
            </div>
        </form>


    </div>
</div>
@endsection
@section('scripts')

<script>
$(document).ready(function() {
    $('#category-dropdown').on('change', function() {
            var category_id = this.value;
            $("#product-dropdown").html('');
            $.ajax({
            url:"{{url('get-product-by-category')}}",
            type: "POST",
            data: {
            category_id: category_id,
            _token: '{{csrf_token()}}' 
            },
            dataType : 'json',
            success: function(result){
            $('#product-dropdown').html('<option value="">Select product </option>'); 
            $.each(result.product,function(key,value){
            $("#product-dropdown").append('<option value="'+value.id+'">'+value.product_name+'</option>');
            });
            
            }
            });
        });    


 });
</script>







<script>
function addImageClass(obj,id){
    console.log(id)
    classvalue=$(obj).attr('class');
    $('.click-border').css({"outline": "none"});
    $(obj).css({"outline": "black solid 2px"})
    $('#image_id').val(id)
}
$( document ).ready(function() {
    $(".product_selecter").change(function(){
        $.ajax({
            url : "{{route('admin.getProductImageById')}}",
            type: "POST",
            data :{
                    "_token": "{{ csrf_token() }}",
                    "id": this.value
                },
            success: function(data, textStatus, jqXHR)
            {
                $('#product_images').html('')
                jQuery.each(data.data, function(index, item) {
                    $('#product_images').append(`<div class="col-lg-3 col-md-6 col-sm-6 col-6 click-border" onclick="addImageClass(this,${item.id})"   style="margin-bottom:15px;">
                        <img style="width: 100%;"  src="{{url('public')}}/${item.url}">
                    </div>`)
                });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
         alert("something went wrong")
            }
        });
    });
    
    $(".product_image_class").click(function(){
        console.log('dddfdfdfdf')
        
    });


    $('#outofstock').on('change', function(){
   this.value = this.checked ? 1 : 0;
   // alert(this.value);
}).change();
});
</script>
@endsection