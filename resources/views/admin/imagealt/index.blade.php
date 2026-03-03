
@inject('request', 'Illuminate\Http\Request')
@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>


@section('content')

<div class="card">
    <div class="card-header">
        Image-Alt-Count {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th scope="col">Sr.No</th>
                        <th scope="col">FileName</th>
                        <th scope="col">Image Count</th>
                        <th scope="col">Images Without Alt</th>
                        <th scope="col">Images With Null Alt</th>
                        <th scope="col">Source URL</th>
                        <th scope="col">Null Alt Source URLs</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($imagealts) > 0)
                        @foreach ($imagealts as $key => $imagealt)
                            <tr data-entry-id="{{ $imagealt->id }}">
                                <td></td>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $imagealt->file_name }}</td>
                                <td>{{ $imagealt->total_images }}</td>
                                <td>{{ $imagealt->images_without_alt }}</td>
                                <td>{{ $imagealt->images_with_null_alt }}</td>
                                <td>
                                    @if(!empty($imagealt->image_sources) && $decodedSrcs = json_decode($imagealt->image_sources))
                                        @foreach($decodedSrcs as $index => $src)
                                            <li>
                                                @php
                                                    $cleanedSrc = str_replace('public/public', 'public', $src); 
                                                @endphp
                                                <a href="{{ url($cleanedSrc) }}" target="_blank">
                                                    {{ $cleanedSrc }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                        NA
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($imagealt->image_sources_with_null_alt) && $decodedNullSrcs = json_decode($imagealt->image_sources_with_null_alt))
                                        @foreach($decodedNullSrcs as $index => $src)
                                            <li>
                                                @php
                                                    $cleanedNullSrc = str_replace('public/', '', $src); 
                                                @endphp
                                                <a href="{{ url($cleanedNullSrc) }}" target="_blank" class="text-danger">
                                                    {{ $cleanedNullSrc }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                        NA
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $formattedDate = $imagealt->created_at->format('d F, Y'); 
                                    @endphp
                                    {{ $formattedDate }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent 
    {{-- <script>
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

</script> --}}
@endsection