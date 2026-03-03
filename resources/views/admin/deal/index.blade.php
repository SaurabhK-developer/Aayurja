@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.deal.create') }}">
                {{ trans('global.add') }} Deal
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        Deal {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                       
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                        Previous Discount
                        </th>
                        <th>
                        Discount
                        </th>
                        <th>
                            Image
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deal as $key => $deals)
                        <tr data-entry-id="{{ $deals->id }}">
                            <td>

                            </td>
                            
                            <td>
                                {{ $deals->product->product_name ?? '' }}
                            </td>
                            <td>
                                {{ $deals->previous_discount ?? '' }}
                            </td>
                            <td>
                                {{ $deals->discount ?? '' }}
                            </td>
                            <td>
                            <img src="{{ URL::to('/') }}/public/uploads/deal/{{ $deals->image }}" class="img-thumbnail" width="100px" height="100px" />
                            </td>
                            <td>
                               
                                <a class="btn btn-xs btn-info" href="{{ route('admin.deal.edit', $deals->id) }}">
                                    {{ trans('global.edit') }}
                                </a>
                                <form action="{{ route('admin.deal.destroy', $deals->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                   <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>

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
    url: "{{ route('deal.mass_destroy') }}",
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