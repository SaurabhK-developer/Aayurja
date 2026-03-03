

@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<style>
    .table thead th,
    .table td{
        text-align: center;
    }
</style>


<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span>Product Details</span>
    </div>

    <div class="card-body table-responsive">
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
		      <th scope="col">ID</th>
		      <th scope="col">PRODUCT</th>
		      <th scope="col">QUANTITY</th>
		      <th scope="col">WEIGHT</th>
		    </tr>
		  </thead>
		  <tbody>
			  @foreach($products as $key => $product)
			    <tr>
			    	 <td>{{ $product->product_id }}</td>
			    	 <td>{{ $product->product_name }}</td>
			    	 <td>{{ $product->quantity }}</td>
			    	 <td>{{ $product->weight }}</td>
			  	</tr>
		  	@endforeach  
		  </tbody>
</table>

    </div>
</div>

 
@endsection
