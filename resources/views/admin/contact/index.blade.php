









@inject('request', 'Illuminate\Http\Request')
@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>


@section('content')
   

   
   
   

    <div class="card">
    <div class="card-header">
		Contacts {{ trans('global.list') }}
    </div>

       <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User"><thead>
                    <tr>
                       
                        <th width="10">

                        </th>
						<th scope="col">Name</th>
						<th scope="col">Email</th>
						<th scope="col">Mobile</th>
						<th scope="col">Message</th>
						<th scope="col">Product</th>
						<th scope="col">Weight</th>
						<th scope="col">Quantity</th>
						<th scope="col">Source URL</th>
						<th>Date</th>
                        
                      
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($contacts) > 0)
                        @foreach ($contacts as $contact)
                            <tr data-entry-id="{{ $contact->id }}">
                               
                                   <td></td>
                                


								<td>{{$contact->name}}</td>
								<td>{{$contact->email}}</td>
								<td>{{$contact->mobile}}</td>
								<td>{{$contact->message}}</td>
								<td>{{isset($contact->product) ? $contact->product : 'N/A' }}</td>
								<td>{{isset($contact->product_weight) ? $contact->product_weight : 'N/A' }}</td>
								<td>{{isset($contact->product_quantity)  ? $contact->product_quantity : 'N/A' }}</td>
								<td>{{@$contact->source_url}}</td>
								<?php
									$date = $contact->created_at->format('y-m-d');
									$dates= date('d F, Y', strtotime($date)); 
								?>
								<td>{{$dates}}</td>
                                
                                   <!-- <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.contact.show', $contact->id) }}">
                                    {{ trans('global.view') }}
                                </a>

                                <a class="btn btn-xs btn-info" href="{{ route('admin.contact.edit', $contact->id) }}">
                                    {{ trans('global.edit') }}
                                </a>

                                <form action="{{ route('admin.contact.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>

                            </td>  -->
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
@parent 
    <script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('users_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.seos.mass_destroy') }}",
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