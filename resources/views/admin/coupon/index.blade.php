@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.coupon.create") }}">
                {{ trans('global.add') }} Coupon 
            </a>
        </div>
</div>

<div class="card">
    <div class="card-header">
     Coupon
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
		      <th scope="col">Coupon</th>
		      <th scope="col">Percentage</th>
		      <th scope="col">Flat</th>
		      <th scope="col">Valid From</th>
		      <th scope="col">Valid Upto</th>
		      <th scope="col">User Limit</th>
		      <th scope="col">Used Limit</th>
		      <th scope="col">Total Discount Given</th>
		      <th scope="col">Status</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($coupons as $key => $coupon)
		  	<tr>
		  	    <td>{{$coupon->id}}</td>
		  	    <td>{{$coupon->title}}</td>
		  	    <td>@if($coupon->discount_percentage == null) --- @else {{$coupon->discount_percentage}}% @endif</td>
		  	    <td>@if($coupon->discount_flat == null) --- @else <span>&#8377;</span> {{$coupon->discount_flat}} @endif</td>
		  	    <td>{{$coupon->valid_from}}</td>
		  	    <td>{{$coupon->valid_upto}}</td>
		  	    <td>{{$coupon->limit_upto}}</td>
		  	    <td>{{$coupon->limit_used}}</td>
		  	    <td>${{$coupon->total_discount_given}}</td>
		  	    <td>
		  	        @if(!empty($coupon->active) && $coupon->active == 1)
		  	            <span class="badge badge-success">ACTIVE</span>
		  	        @else
		  	            <span class="badge badge-danger">INACTIVE</span>
		  	        @endif
		  	    </td>
		  	    <td>
		  	        <a class="btn btn-xs btn-info" href="{{ route('admin.coupon.edit', $coupon->id) }}">
                                    {{ trans('global.edit') }}
                    </a>
		  	    </td>
		  	</tr>
		    @endforeach
		    
		  </tbody>
		</table>
        {!! $coupons->links() !!}
    </div>
</div>

 
@endsection
