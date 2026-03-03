










@extends('layouts.admin')
@section('content')

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
.coin-inner {
    border: 1px solid rgb(0 0 0 / 40%);
    margin-bottom: 25px;
}


.coin-inner  .title {
    padding: 10px 10px 10px 10px;
    color: #000000b0;
    border-bottom: 1px solid rgb(0 0 0 / 48%);
}

.coin-inner  .content-area {
    padding: 10px 10px 20px 20px;
    min-height: 60px;
    color: #20a8d8;
    font-weight: 600;
}

.coin-box {
    margin-top: 30px;
    margin-left: -10px;
    margin-right: -10px;
}

.filter-wrap {
    display: flex;
    align-items: center;
}

.filter-wrap label {
    display: inline-block;
    margin-bottom: 0px;
    margin-right:20px;
}

.filter-section {
    margin: 0px;
    margin-bottom: 30px;
}

#filter_div{

    display:none;
}


</style>



<div class="card">
    <div class="card-header">
        Influencer Points Redeem {{ trans('global.list') }}
    </div>

    <div class="card-body">

        <div class="filter-section">
            <div class="row">
                <div class="col-md-4 filter-by-days ">
                    <h6>Filter By Days:</h6>
                    <?php $selectedType = $_GET['type'] ?? ''; ?>

                    <select id="date_filter" class="form-control option" >
                    <option>Select Option</option>
                        <option value="7"   <?= $selectedType == 7     ? 'selected' : '' ?>>Last 7 Days</option>
                        <option value="15"  <?= $selectedType == 15    ? 'selected' : '' ?>>Last 15 Days</option>
                        <option value="30"  <?= $selectedType == 30    ? 'selected' : '' ?>>Last 30 Days</option>
                        <option value="90"  <?= $selectedType == 90    ? 'selected' : '' ?>>Last 90 Days</option>
                        <option value="date"<?= $selectedType == 'date' ? 'selected' : '' ?>>Custom</option>
                    </select>
                </div>
                <div class="col-md-8 " id="filter_div" >
                    <div class="row">
                    <div class="col-md-6 select-date">
                        <h6>Date From:</h6>
                        <input type="date" class="form-control hasDatepicker" value="" autocomplete="off" id="from_date" name="from_date" placeholder="from date">
                    </div>
                    <div class="col-md-6  select-date">
                        <h6>Date To:</h6>
                        <input type="date" class="form-control hasDatepicker" value="" autocomplete="off" id="to_date" name="to_date" placeholder="to date">
                    </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Influencer Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Mobile
                        </th>
                        <th>
                            Account
                        </th>
                        <th>
                            IFSC
                        </th>
                        <th>
                            Total Points
                        </th>
                        <th>
                            Redeemed Points
                        </th>
                        <th>
                            Balance Points
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Action
                        </th>

                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($influencers as $key => $influencer)
                        <tr data-entry-id="{{ $influencer->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $influencer->name }}
                            </td>

                            <td>{{ $influencer->email }}</td>
                            <td>{{ $influencer->mobile }}</td>
                            <td>{{ $influencer->account }}</td>
                            <td>{{ $influencer->ifsc }}</td>
                            <td>{{ $influencer->total_points }}</td>
                            <td>{{ $influencer->redeemed_points }}</td>
                            <td>{{ $influencer->balance_points }}</td>
                            <td>
                                @if($influencer->status == 'Approved')
                                <span class="label label-success">Approved</span>
                                @elseif($influencer->status == 'Rejected')
                                <span class="label label-danger">Rejected</span>
                                @else
                                    <span class="label label-warning">Pending</span>
                                @endif
                            </td>
                            <td>{{ $influencer->created_at }}</td>
                            <td><a href="" data-toggle="modal" data-target="#influencerModal{{$key}}"><i class="fa fa-eye" aria-hidden="true"></i> View</a></td>

                                <!-- The Modal -->
                                <div class="modal" id="influencerModal{{$key}}">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                    
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">Influencer Detail</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="{{ route('infuencer.redeem.statuschange') }}" method="POST" >
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="influencer_redeem_id" value="{{ $influencer->id }}">
                                                <input type="hidden" name="user_id" value="{{ $influencer->user_id }}">
                                                <input type="hidden" name="redeemed_points" value="{{ $influencer->redeemed_points }}">


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="name">Name</label>
                                                            <input type="text" id="name" name="name" class="form-control" value="{{ $influencer->name }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="name">Email</label>
                                                            <input type="email" id="email" name="email" class="form-control" value="{{ $influencer->email }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="name">Mobile</label>
                                                            <input type="text" id="mobile" name="mobile" class="form-control" value="{{ $influencer->mobile }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="name">Account</label>
                                                            <input type="text" id="account" name="account" class="form-control" value="{{ $influencer->account }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="name">IFSC</label>
                                                            <input type="text" id="ifsc" name="ifsc" class="form-control" value="{{ $influencer->ifsc }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="name">Total Points</label>
                                                            <input type="text" id="total_points" name="total_points" class="form-control" value="{{ $influencer->total_points }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="name">Redeemed Points</label>
                                                            <input type="text" id="redeemed_points" name="redeemed_points" class="form-control" value="{{ $influencer->redeemed_points }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="name">Balance Points</label>
                                                            <input type="text" id="balanec_points" name="balanec_points" class="form-control" value="{{ $influencer->balance_points }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group ">
                                                            <label for="name">Remarks*</label>
                                                            @if($influencer->status == 'Pending')
                                                                <textarea name="remarks" id="" class="form-control" row="5" col="4"  required>{{ $influencer->remarks }}</textarea>
                                                            @else
                                                                <textarea name="remarks" id="" class="form-control" row="5" col="4" required="required" disabled>{{ $influencer->remarks }}</textarea>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="name">Status</label>
                                                            @if($influencer->status == 'Pending')
                                                                <select name="status" class="form-control" required>
                                                                    <option value="Approved">Approve</option>
                                                                    <option value="Rejected">Reject</option>
                                                                </select>
                                                            @else
                                                                <select name="status" class="form-control" required="required" disabled>
                                                                    <option value="{{ $influencer->status }}">{{ $influencer->status }}</option>
                                                                </select>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <button type="submit" class="btn btn-success" data-dismiss="modal">Save</button> -->
                                                @if($influencer->status == 'Pending')  
                                                    <div class="text-center">
                                                        <input type="submit" style="width:130px;" class="btn btn-success" value="Save">
                                                    </div>
                                                @endif
                                            </form>
                                        </div>
                                        
                                        <!-- Modal footer -->
                                        <!-- <div class="modal-footer">
                                        
                                        </div> -->
                                        
                                    </div>
                                    </div>
                                </div>
                            

                            <!-- <td>

                                @if($influencer->status == 'Pending')
                                <form action="{{ route('infuencer.redeem.approved') }}" method="POST" style="display: inline-block;">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="influencer_redeem_id" value="{{ $influencer->id }}">
                                    <input type="hidden" name="user_id" value="{{ $influencer->user_id }}">
                                    <input type="hidden" name="redeemed_points" value="{{ $influencer->redeemed_points }}">


                                    <input type="submit" class="btn btn-xs btn-success" value="Approved">
                                </form>
                                @endif

                                @if($influencer->status == 'Pending')
                                <form action="{{ route('infuencer.redeem.rejected') }}" method="POST" style="display: inline-block;">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="influencer_redeem_id" value="{{ $influencer->id }}">
                                    <input type="hidden" name="user_id" value="{{ $influencer->user_id }}">
                                    <input type="hidden" name="redeemed_points" value="{{ $influencer->redeemed_points }}">


                                    <input type="submit" class="btn btn-xs btn-danger" value="Rejected">
                                </form>
                                @endif
                            </td> -->

                            
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
    url: "author_mass_destroy",
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
  //dtButtons.push(deleteButton)
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

<script>
    $(document).ready(function() {
        $("#date_filter").change(function(e) {
            const today = new Date(); // current date and time
            const selectedRange = parseInt($('#date_filter').val());

            const urlParams = new URLSearchParams(window.location.search);

            if ([7, 15, 30, 90].includes(selectedRange)) {
                let dateFromCalc = new Date();
                dateFromCalc.setDate(today.getDate() - selectedRange);

                // Set time to 12 AM
                dateFromCalc.setHours(0, 0, 0, 0);

                dateFrom = dateFromCalc.toISOString(); // e.g. 2025-04-15T00:00:00.000Z
                dateTo = today.toISOString();          // current datetime
                

                urlParams.set('dateFrom', dateFrom);
                urlParams.set('dateTo', dateTo);
                urlParams.set('type', $('#date_filter').val());

                window.location.search = urlParams.toString();
            } 
            else {
                // dateFrom = $("#from_date").val();
                // dateTo = $("#to_date").val();

                $('#filter_div').hide(); // Initially hide the div

                if ($(this).val() === 'date') {
                    $('#filter_div').show(); // Show when "Custom" is selected
                } else {
                    $('#filter_div').hide(); // Hide otherwise
                }
            }

            
        });


        // DATE RANGE
        $('#to_date').change(function () {
            const fromDateStr = $('#from_date').val();
            const toDateStr = $(this).val();
            const urlParams = new URLSearchParams(window.location.search);

            if (fromDateStr) {
                // Convert to Date objects
                let fromDate = new Date(fromDateStr);
                let toDate = new Date(toDateStr);

                // Set fromDate to 00:00:00 and toDate to 23:59:59 if needed
                fromDate.setHours(0, 0, 0, 0);
                toDate.setHours(23, 59, 59, 999); // Optional: include the full day

                // Format to ISO
                let formattedFromDate = fromDate.toISOString();
                let formattedToDate = toDate.toISOString();

                // Set in URL
                urlParams.set('dateFrom', formattedFromDate);
                urlParams.set('dateTo', formattedToDate);
                urlParams.set('type', 'date');


                // Reload with new params
                window.location.search = urlParams.toString();

            } else {
                alert('Please select From Date first');
            }
        });

});
</script>
@endsection