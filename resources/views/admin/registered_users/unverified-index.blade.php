@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Unverified Users {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            #
                        </th>
                        <th>
                            Name
                        </th>
                         <th>
                            Email
                        </th>
						<th>
                            Mobile
                        </th>
                        <th>
                            Recently Login At
                        </th>
						 
                    </tr>
                </thead>
                <tbody>
                    @foreach(@$unverifiedUsers as $key => $unverifiedUser )
                        <tr data-entry-id="">
                            <td>

                            </td>
                            <td>
                                {{$key+1}}
                            </td>
                            <td>
                                {{ @$unverifiedUser->name }}
                            </td>
							<td>
                                {{ @$unverifiedUser->email }}
                            </td>
			                <td>
                                {{ @$unverifiedUser->mobile }}
                            </td>
							
						    <td>	
                                {{ @$unverifiedUser->updated_at->format('d F Y h:i A') }}
			                </td>
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
@can('users_manage')
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
    order: [[ 6, 'desc' ]],
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
