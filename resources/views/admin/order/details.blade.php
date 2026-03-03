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
        <span>Order Details</span>
        <h2>Order #{{ $orders[0]->order_id }}</h2>
        <a href="/admin/orders"><button class="btn btn-primary">Back to orders</button></a>
    </div>

	<div class="card-body">
	<div class="container">
       <div class="row">
       <div class="col-md-6">
        <h4>Customer Details:</h4>
        <p>Name: {{ $orders[0]->customer_name }}</p>
        <p>Email: {{ $orders[0]->customer_email }}</p>
        <p>Phone: {{ $orders[0]->customer_phone }}</p>
		<p>Date of order: {{ date('d-m-Y', strtotime($orders[0]->created_at)) }}</p>

        <h4>Shipping Address:</h4>
        <p>{{ $orders[0]->shipping_address }}</p>
		
		</div>
		<div class="col-md-6">
		<h4>Order Status: @if($orders[0]->status==1) <span style="color:green;"> Success</span> @else<span style="color:red;"> Cart Abandoned</span> @endif    </h4>
		<p><b>Grand Total: {{ number_format($orders[0]->grand_total,2) }}</b></p>
		<p><b>Payment Method: {{ @$orders[0]->payment_source }}</b></p>
		<p><b>Discount: {{ number_format($orders[0]->discount_amount,2) }}</b></p>
		<p><b>Coupan Code: {{ ($orders[0]->coupon_used) }}</b></p>
		<td>@if($orders[0]->status==1)  <a href="{{url('public')}}/{{$orders[0]->invoice}}" download="{{ $orders[0]->invoice }}">Download Invoice @else  @endif</a></td>
       </div>

    </div>
	</div>
	</div>
	


	<div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
		    <tr>
		      <th scope="col">ID</th>
		      <th scope="col">NAME</th>
		      <th scope="col">SIZE</th>
		      <th scope="col">PER ITEM PRICE</th>
		      <th scope="col">QUANTITY</th>
		      <th scope="col">TOTAL</th>
		     
		   
		    </tr>
		  </thead>
		  <tbody>
			  @foreach($orders as $key => $order)
			    <tr>
			    	 <td>{{ $order->product_id }}</td>
			    	 <td>{{ $order->product_name }}</td> 
			    	 <td>{{ $order->product_size }}</td>
			    	 <td>{{ $order->per_product_price }}</td>
			    	 <td>{{ $order->product_quantity }}</td>
			    	 <td>{{  number_format($order->per_product_price * $order->product_quantity,2) }} </td>
			    	
			    	
			  	</tr>
		  	@endforeach  
		  </tbody>
</table>


</div>
</div>

    </div>
</div>

 
@endsection
