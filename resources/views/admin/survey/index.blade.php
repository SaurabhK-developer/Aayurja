@inject('request', 'Illuminate\Http\Request')
@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>


@section('content')
   

   
   
   

    <div class="card">
    <div class="card-header">
        Survey {{ trans('global.list') }}
    </div>

       <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User"><thead>
                    <tr>
                       
                        <th width="10">

                        </th>
                        <!-- <th>Url</th>
                        <th>Title</th>
                        <th>Keybords</th>
                        <th>Description</th> -->
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Address</th>
                        <th scope="col">Profession</th>
                        <th scope="col">Family Members</th>
                        <th scope="col">Routine</th>
                        <th scope="col">Consume Source</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Lifestyle</th>
                        <th scope="col">Activity</th>
                        <th scope="col">Exotic Food</th>
                        <th scope="col">Interested In Purchase</th>
                        <th scope="col">Expenditure</th>
                        <th scope="col">Reference 1</th>
                        <th scope="col">Reference 2</th>
                        <th scope="col">Reference 3</th>

                        <th>Date</th>
                        
                      
                       <th></th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($surveys) > 0)
                        @foreach ($surveys as $survey)
                            <tr data-entry-id="{{ $survey->id }}">
                               
                                   <td></td>
                                
                                <!-- <td field-key='city_number'>{{ $survey->url }}</td>
                                <td field-key='city_number'>{{ $survey->meta_tag }}</td>
                                <td field-key='city_number'>{{ $survey->keywords }}</td>
                                <td field-key='city_number'>{{ $survey->description }}</td> -->


                                <td>{{$survey->user_name}}</td>
                                <td>{{$survey->user_email}}</td>
                                <td>{{$survey->user_mobile}}</td>
                                <td>{{$survey->user_age}}</td>
                                <td>{{$survey->user_gender}}</td>
                                <td>{{$survey->user_address}}</td>
                                <td>{{$survey->user_profession}}</td>
                                <td>{{$survey->family_members}}</td>
                                <td>{{$survey->routine}}</td>
                                <td>{{$survey->consume_source}}</td>
                                <td>{{$survey->reason}}</td>
                                <td>{{$survey->lifestyle}}</td>
                                <td>{{$survey->activity}}</td>
                                <td>{{$survey->exotic_food}}</td>
                                <td>
                                    <?php
                                        $dataString = $survey->interested_in_purchase;
                                        // Decode the JSON string into a PHP array
                                        $dataArray = json_decode($dataString, true);
                                    ?>
                                    @if(count($dataArray) > 0)
                                        @foreach($dataArray as $singleElement)
                                            <span class="badge badge-primary">{{$singleElement}}</span><br>
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{$survey->expenditure}}</td>
                                <td>{{isset($survey->ref_first_name1) ? $survey->ref_first_name1 : 'N/A'}}<br>{{$survey->ref_email1}}<br>{{$survey->ref_contact1}}</td>
                                <td>{{isset($survey->ref_first_name2) ? $survey->ref_first_name2 : 'N/A'}}<br>{{$survey->ref_email2}}<br>{{$survey->ref_contact2}}</td>
                                <td>{{isset($survey->ref_first_name3) ? $survey->ref_first_name3 : 'N/A'}}<br>{{$survey->ref_email3}}<br>{{$survey->ref_contact3}}</td>


                                <?php
                                    $date = $survey->created_at->format('y-m-d');
                                    $dates= date('d F, Y', strtotime($date)); 
                                ?>
                                <td>{{$dates}}</td>
                                
                                <td></td>
                                   <!-- <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.survey.show', $survey->id) }}">
                                    {{ trans('global.view') }}
                                </a>

                                <a class="btn btn-xs btn-info" href="{{ route('admin.survey.edit', $survey->id) }}">
                                    {{ trans('global.edit') }}
                                </a>

                                <form action="{{ route('admin.survey.destroy', $survey->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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