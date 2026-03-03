@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<div class="card">
    <div class="card-header">
     PRODUCTS
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
		      <th scope="col">ID</th>
		      <th scope="col">NAME</th>
		      {{--<th scope="col">DESCRIPTION</th>--}}
		      <th scope="col">ACTION</th>
		    </tr>
		  </thead>
		  <tbody>
		      @if(!empty($products) && count($products) > 0)
		        @foreach($products as $key => $product)
			  	<tr>
			      <th scope="row">{{$product->id}}</th>
			      <td>{{$product->product_name}}</td>
			      {{--<td></td>--}}
			      <td>
			      		<a class="btn btn-xs btn-success" href="{{ route('admin.product.approved', ['id' => $product->id]) }}">
                            Approve
                        </a>
                        <a class="btn btn-xs btn-info" href="/admin/product/edit/{{$product->id}}">
                                    {{ trans('global.edit') }}
                        </a>
                        <a class="btn btn-xs btn-warning" href="https://www.thearcadecollection.com/developer/product-detail/{{$product->slug}}" target="_blank">
                            View
                        </a>
			      </td>
			    </tr>
			    @endforeach
		      @else
		        <td colspan="3" style="text-align: center;color: #c9c9c9;">NO PRODUCTS UPDATED/CREATED FOR APPROVAL</td>
		      @endif
		  </tbody>
		</table>

    </div>
</div>


<div class="card">
    <div class="card-header">
     SUB CATEGORIES
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
		      <th scope="col">ID</th>
		      <th scope="col">NAME</th>
		      {{--<th scope="col">DESCRIPTION</th>--}}
		      <th scope="col">ACTION</th>
		    </tr>
		  </thead>
		  <tbody>
			  	@if(!empty($subcategories) && count($subcategories) > 0)
		        @foreach($subcategories as $key => $subcategory)
			  	<tr>
			      <th scope="row">{{$subcategory->id}}</th>
			      <td>{{$subcategory->name}}</td>
			      {{--<td></td>--}}
			      <td>
			      		<a class="btn btn-xs btn-success" href="{{ route('admin.subcategory.approved', ['id' => $subcategory->id]) }}">
                            Approve
                        </a>
                        <a class="btn btn-xs btn-info" href="/admin/subcategories/{{$subcategory->id}}/edit">
                                    {{ trans('global.edit') }}
                        </a>
                        <a class="btn btn-xs btn-warning" href="https://www.thearcadecollection.com/developer" target="_blank">
                            View
                        </a>
			      </td>
			    </tr>
			    @endforeach
		      @else
		        <td colspan="3" style="text-align: center;color: #c9c9c9;">NO SUBCATEGORIES UPDATED/CREATED FOR APPROVAL</td>
		      @endif
		  </tbody>
		</table>

    </div>
</div>


<div class="card">
    <div class="card-header">
     DESIGNERS
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
		      <th scope="col">ID</th>
		      <th scope="col">NAME</th>
		      {{--<th scope="col">DESCRIPTION</th>--}}
		      <th scope="col">ACTION</th>
		    </tr>
		  </thead>
		  <tbody>
			  	@if(!empty($designers) && count($designers) > 0)
		        @foreach($designers as $key => $designer)
			  	<tr>
			      <th scope="row">{{$designer->id}}</th>
			      <td>{{$designer->designer_name}}</td>
			      {{--<td></td>--}}
			      <td>
			      		<a class="btn btn-xs btn-success" href="{{ route('admin.designer.approved', ['id' => $designer->id]) }}">
                            Approve
                        </a>
                        <a class="btn btn-xs btn-info" href="/admin/designer/edit/{{$designer->id}}">
                                    {{ trans('global.edit') }}
                        </a>
                        <a class="btn btn-xs btn-warning" href="https://www.thearcadecollection.com/developer" target="_blank">
                            View
                        </a>
			      </td>
			    </tr>
			    @endforeach
		      @else
		        <td colspan="3" style="text-align: center;color: #c9c9c9;">NO DESIGNERS UPDATED/CREATED FOR APPROVAL</td>
		      @endif
		  </tbody>
		</table>

    </div>
</div>


<div class="card">
    <div class="card-header">
     OCCASIONS
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
		      <th scope="col">ID</th>
		      <th scope="col">NAME</th>
		      {{--<th scope="col">DESCRIPTION</th>--}}
		      <th scope="col">ACTION</th>
		    </tr>
		  </thead>
		  <tbody>
			  	@if(!empty($occasions) && count($occasions) > 0)
		        @foreach($occasions as $key => $occasion)
			  	<tr>
			      <th scope="row">{{$occasion->id}}</th>
			      <td>{{$occasion->name}}</td>
			      {{--<td></td>--}}
			      <td>
			      		<a class="btn btn-xs btn-success" href="{{ route('admin.occasion.approved', ['id' => $occasion->id]) }}">
                            Approve
                        </a>
                        <a class="btn btn-xs btn-info" href="/admin/occasion/{{$occasion->id}}/edit">
                                    {{ trans('global.edit') }}
                        </a>
                        <a class="btn btn-xs btn-warning" href="https://www.thearcadecollection.com/developer/product-grid" target="_blank">
                            View
                        </a>
			      </td>
			    </tr>
			    @endforeach
		      @else
		        <td colspan="3" style="text-align: center;color: #c9c9c9;">NO OCCASIONS UPDATED/CREATED FOR APPROVAL</td>
		      @endif
		  </tbody>
		</table>

    </div>
</div>

 
@endsection
