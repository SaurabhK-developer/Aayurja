@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
@section('content')




<div class="card">
    <div class="card-header">
     Orders
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

        <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
		    <tr>
        <th scope="col">#</th>
			   <th scope="col">Oder ID</th>
		      <th scope="col">Customer name</th>
		      <th scope="col">Email</th>
		      <th scope="col">Phone</th>
		      <th scope="col">Order Date</th>
		      <th scope="col">Order Amount</th>
          <th scope="col">Payment Method</th>
			  <th scope="col">Order Status</th>
			  <th scope="col">View Invoice</th>
			  <th scope="col">Download Invoice</th>
		      <th scope="col">Order Details</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($orders as $key => $order)
			  	<tr>
          <td></td>
			      <td>{{ $order->order_id }}</td>
				  <td>{{ $order->customer_name }}</td>
			      <td>{{ $order->customer_email }}</td>
			      <td>{{ $order->customer_phone }}</td>
			      <?php 
			      	$timestamp = strtotime($order->created_at);
				//$new_date_format = date('d-m-Y H:i:s', $timestamp);
				$new_date_format = date('d-m-Y', $timestamp);
			      ?>
			      <td>{{ $new_date_format }}</td>
			      <td>{{ $order->grand_total }}</td>
            <td>{{ $order->payment_source }}</td>
				  <td>@if($order->status==1) <span style="color:green;"> Success</span> @else<span style="color:red;"> cart Abandoned</span> @endif</td>
				 <td>@if($order->status==1)  <a href="{{url('public')}}/{{$order->invoice}}">View Invoice @else  @endif</a></td>
				 <td>@if($order->status==1)  <a href="{{url('public')}}/{{$order->invoice}}" download="{{ $order->invoice }}">Download Invoice @else  @endif</a></td>
			      <td><a href="{{url('admin/orders/details')}}/{{$order->order_id}}"><button class="btn btn-primary">View details</button></a></td>
			    </tr>
		  	@endforeach
		    
		    
		  </tbody>
		</table>
		</div>


</div>
</div>

 
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
    url: "",
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
