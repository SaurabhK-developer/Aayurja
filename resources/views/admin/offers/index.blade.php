@extends('layouts.admin')
@section('content')
@can('categories_manage')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.offers.create") }}">
                {{ trans('global.add') }} Offer / Cupon
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Offer {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive" style="overflow-x: visible;">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                         
                      <th>
                            Effect From
                        </th>
                        
                        <th>
                            Valid upto
                        </th>
                         
                        <th>
                            Discount
                        </th>
                         
                        <th>
                            Type
                        </th>
                         
                        <th>
                            Limit
                        </th>
                        
                        
<!--                         
                        <th>
                            buy
                        </th>
                        
                        <th>
                            Free
                        </th>
                        
                         <th>
                            Amount
                        </th>
                        
                        <th>
                            deliver Product
                        </th> -->
                        
                        
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($offers as $key => $offers)
                        <tr data-entry-id="{{ $offers->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $offers->id ?? '' }}
                            </td>
                            <td>
                                {{ $offers->title ?? '' }}
                            </td>
                            
                           <td>
                                {{ $offers->WED ?? '' }}
                            </td>
                            
                            <td>
                                {{ $offers->valid_upto ?? '' }}
                            </td>
                            
                            
                            <td>

                            @if($offers->type == '5')
                                {{ $offers->discount ?? '' }}
                            @else
                                {{ $offers->discount ?? '' }} %
                            @endif
                            </td>
                            
                            
                            <td>
                                
                                @if($offers->type == '1')
                                  Cupon
                                @elseif($offers->type == '2')
                                  Unit Offer    
                                @elseif($offers->type == '3')
                                    Global Offer
                                @elseif($offers->type == '5')
                                    Coupon Code Amount
                                 @elseif($offers->type == '8')
                                 Individual Product Offer
                                @else
                                    Discount Offer
                                @endif
                                
                            </td>
                            
                            
                            <td>
                                {{ $offers->limitupto ?? '' }}
                            </td>
                            
                           
                            
                            <!-- <td>
                                {{ $offers->buy ?? '' }}
                            </td>
                            
                            <td>
                                {{ $offers->free ?? '' }}
                            </td>
                            
                            <td>
                                {{ $offers->purchase_amount ?? '' }}
                            </td>
                            
                            <td>
                                {{ $offers->total_product_deliver ?? '' }}
                            </td> -->
                            
                    
                             
                            
                            <td>
                                <a class="btn btn-xs btn-info" href="{{ route('admin.offers.edit', $offers->id) }}">
                                    {{ trans('global.edit') }}
                                </a>

                                <form action="{{ route('admin.offers.destroy', $offers->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>
                                
                                
                                 @if($offers->deactive == "0")
                                    <form action="{{ route('admin.offers.deactivate_offer', $offers->id) }}" method="POST" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="PATCH">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-warning" value="Deactivate">
                                    </form>
                                @else
                                    <form action="{{ route('admin.offers.activate_offer', $offers->id) }}" method="POST" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="PATCH">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-secondary" value="Activate">
                                    </form>

                                
                                @endif

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
    url: "{{ route('admin.offers.mass_destroy') }}",
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