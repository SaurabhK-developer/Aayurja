@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
@section('content')

<div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.product.create') }}">
                {{ trans('global.add') }} Product 
            </a>
        </div>
</div>

<div class="card">
    <div class="card-header">
     Products

     <form  method="GET" id = "search_form" onsubmit="searchFunction()">
	     <div class="input-group">
			  <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" name="search" value="@if(isset($search_value)){{$search_value}}@endif" id="search" />
			  <input type="submit" class="btn btn-outline-primary" value="search" ></button>
		</div>
	</form>

	{{--
	<div class="form-group mb-3">
        <select  id="category-dd" class="form-control">
        	<option value="">Select Category</option>
        	@foreach ($categories as $category)
	        	<option value="{{$category->name}}">
	        		{{$category->name}}
	        	</option>
        	@endforeach
    	</select>
    </div>
    <div class="form-group mb-3">
	    <select id="product-dd" class="form-control">
	    </select>
    </div>
    
    <div class="form-group">
	    <select id="city-dd" class="form-control">
	    </select>
    </div>
	--}}
	<a href="tranding">clear</a>
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

        <table class="table">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Product</th>
		      <th scope="col">Designer Name</th>
		      <th scope="col">Category</th>
		      <th scope="col">Trending</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($products as $key => $product)
			  	<tr id="city-dd">
			      <th scope="row">{{ $product->id }}</th>
			      <td>{{ $product->product_name }}</td>
			      <td>{{ $product->designer_name }}</td>
			      <td>{{ $product->product_category }}</td>

			      <td width="150px">
			      	<form action="{{route('admin.tranding.store', ['product_id' => $product->id])}}" method="POST" enctype="multipart/form-data">
			      		@csrf
				      	<span><input type="checkbox" name="tranding" value="1" <?php if(isset($product->tranding) && $product->tranding == 1){ echo "checked"; } ?>>Trending Product</span><br>
				      	<input type="file" name="tranding_image1" >
				      	<input type="file" name="tranding_image2" >
				      	@if(!empty($product->tranding_image1))
				      	<img src="{{env('APP_URL')}}{{$product->tranding_image1}}" style="width: 50px;height: 70px;margin-left: 10px;">
				      	<img src="{{env('APP_URL')}}{{$product->tranding_image2}}" style="width: 50px;height: 70px;margin-left: 10px;"><br>
				      	@endif
				      	
				      	<input type="submit" class="btn btn-xs btn-success" name="save" value="Update">
				    </form>
			      </td>
			    </tr>
		  	@endforeach
		    
		  </tbody>
		</table>

		{!! $products->appends(['search' => request()->query('search')])->links() !!}
    </div>
</div>

<script type="text/javascript">
 function searchFunction(){

    var action_src = $("#search").val();
    var search_form = $('#search_form').val();
    console.log("action_src" + action_src);
    var urlLink = "product";
    urlLink = urlLink + action_src;



    search_form.action = urlLink;

}
</script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
	// // $(function(){
	// //    $('#trending_checkbox').on('click', function(){           
	// //    	console.log("checkbox: clicked");
	// //        if($('#trending_checkbox').is(':checked')){
	// //            $('#image1').attr('disabled', true);
	// //        } else {
	// //            $('#image2').attr('disabled', false);
	// //        }
	// //    });
	// // });

	// $(".trending_checkbox").change(function() {
	// 	console.log("checkbox: clicked");
	//     if(this.checked) 
	//     {
	//         $('.image1').attr('disabled', false);
	//         $('.image2').attr('disabled', false);
	//     }
	//     else
	//     {
	//     	$('.image1').attr('disabled', true);
	//     	$('.image2').attr('disabled', true);
	//     }
	// });
</script>
<script>
        // $(document).ready(function () {
        //     $('#category-dd').on('change', function () {
        //         console.log("country start");

        //         var idCategory = this.value;
        //         console.log("country id or name: " + idCategory);
        //         $("#product-dd").html('');
        //         $.ajax({
        //             url: "{{url('admin/tranding/api/fetch-products')}}",
        //             type: "POST",
        //             data: {
        //                 category_name: idCategory,
        //                 _token: '{{csrf_token()}}'
        //             },
        //             dataType: 'json',
        //             success: function (result) {
        //                 $('#product-dd').html('<option value="">Select Product</option>');
        //                 $.each(result.products, function (key, value) {
        //                     $("#product-dd").append('<option value="' + value
        //                         .id + '">' + value.product_name + '</option>');

        //                 });
        //                 // $('#city-dd').html('<option value="">Select City</option>');
        //                 // $('#city-dd').append('<tr><th>anmolllll</th></tr>');
        //             }
        //         });
        //     });
        // //     $('#product-dd').on('change', function () {
        // //     	console.log("clicked on product");
        // //         var idProduct = this.value;
        // //         console.log("product idd :" + idProduct);
        // //     //     $("#city-dd").html('');
        // //         $.ajax({
        // //             url: "{{url('admin/tranding/api/fetch-cities')}}",
        // //             type: "POST",
        // //             data: {
        // //                 product_id: idProduct,
        // //                 _token: '{{csrf_token()}}'
        // //             },
        // //     //         dataType: 'json',
        // //     //         success: function (res) {
        // //     //             $('#city-dd').html('<option value="">Select City</option>');
        // //     //             $.each(res.cities, function (key, value) {
        // //     //                 $("#city-dd").append('<option value="' + value
        // //     //                     .id + '">' + value.name + '</option>');
        // //     //             });
        // //     //         }
        // //         });
        // //     });
        // // });
    </script>
@endsection







