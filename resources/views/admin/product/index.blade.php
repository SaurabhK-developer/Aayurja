@extends('layouts.admin')
@section('content')

<div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.product.create") }}">
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
	<a href="product">clear</a>
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

     
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
		  <thead>
		    <tr>
            <th width="10">

</th>
		      <th scope="col">SN</th>
		      <th scope="col">Product</th>
		      <!-- <th scope="col">Product Category</th> -->
		      <th scope="col">Url</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($products as $key => $product)
			  
                  <tr data-entry-id="{{ $product->id }}">
                            <td>

                            </td>
			      <th scope="row">{{ $key+1 }}</th>
			      <td>{{ $product->product_name }}</td>
			     
		
			      
            <td>{{url('product')}}/{{ $product->slug }}</td>

			      <td>
			      		<a class="btn btn-xs btn-info" href="{{ route('admin.product.edit', $product->id) }}">
                                    {{ trans('global.edit') }}
                        </a>

                        <form action="product/destroy/{{ $product->id }}" method="GET" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                        </form>

                        {{--<a class="btn btn-xs btn-success" href="product/show/{{ $product->id }}">
                            View Details
                        </a>--}}
			      </td>
			     
			    </tr>
		  	@endforeach
		    
		    
		  </tbody>
		</table>
       

    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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


@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  @can('categories_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "product_mass_destroy",
    
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})




</script>

@endsection