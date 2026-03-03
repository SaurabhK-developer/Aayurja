@extends('layouts.admin')
@section('content')
@can('categories_manage')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.dynamic-email.create") }}">
                {{ trans('global.add') }} Dynamic Email
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
    Dynamic Email {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            ID
                        </th>
                         <th>
                           Email Type
                        </th> 

                        <th>
                           To
                        </th>

                         <th>
                           Cc
                        </th> 
                        <th>
                            Bcc
                        </th>
                        <th>
                            Form Type
                        </th> 
                       
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dynamicemails as $key => $dynamicemail)
                        <tr data-entry-id="{{ $dynamicemail->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $dynamicemail->id }}
                            </td>

                           <td>
                                {{ $dynamicemail->email_types }}
                            </td>

                            <td>
                                {{ $dynamicemail->to_emails }}
                            </td>

                            <td>
                                {{ $dynamicemail->cc_emails }}
                            </td> 

                            
                            <td>
                                {{$dynamicemail->bcc_emails}}
                            </td>

                            <td>
                                @if($dynamicemail->form_type_id)
                                    @php
                                        $formTypeIds = explode(',', $dynamicemail->form_type_id);
                                        $formTypes = \App\FormType::whereIn('id', $formTypeIds)->pluck('form_type_name')->toArray();
                                    @endphp
                                    {{ implode(', ', $formTypes) }}
                                @else
                                    N/A
                                @endif
                            </td>
                            
                            
                            
                            
                            <td>
                                <a class="btn btn-xs btn-info" href="{{ route('admin.dynamic-email.edit', $dynamicemail->id) }}">
                                    {{ trans('global.edit') }}
                                </a> 

                                <form action="{{ route('admin.dynamic-email.destroy', $dynamicemail->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
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

