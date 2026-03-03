@extends('layouts.admin')
@section('content')
@can('categories_manage')
    <!-- <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.referinfluencer.create") }}">
                {{ trans('global.add') }} Influencer
            </a>
        </div>
    </div> -->
@endcan


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
    margin: 20px 20px;
    margin-bottom: 0px;
}

#filter_div{

    display:none;
}


</style>




<div class="card   refer-card">
<div class="card-header">
   Refer and Earn
</div>
<div class="box-main">
   <div class="coin-box">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12 col-lg-4">
               <div class="coin-inner">
                  <div class="title">Total Referral Count</div>
                  <div class="content-area">{{$referredCount ? $referredCount : 0}}</div>
               </div>
            </div>
            <div class="col-md-12 col-lg-4">
               <div class="coin-inner">
                  <div class="title">Total Referee Count</div>
                  <div class="content-area">{{$referrerCount ? $referrerCount : 0}}</div>
               </div>
            </div>
            <div class="col-md-12 col-lg-4">
               <div class="coin-inner">
                  <div class="title">Total Referral Sales</div>
                  <div class="content-area">INR {{$sumTransactionAmount ? $sumTransactionAmount : 0}}</div>
               </div>
            </div>
            <!-- <div class="col-md-12 col-lg-4">
               <div class="coin-inner">
                  <div class="title">Total Referral Count</div>
                  <div class="content-area">451</div>
               </div>
            </div>
            <div class="col-md-12 col-lg-4">
               <div class="coin-inner">
                  <div class="title">Total Referral Count</div>
                  <div class="content-area">451</div>
               </div>
            </div>
            <div class="col-md-12 col-lg-4">
               <div class="coin-inner">
                  <div class="title">Total Referral Count</div>
                  <div class="content-area">451</div>
               </div>
            </div> -->
         </div>
      </div>
   </div>
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
                            Date
                        </th>
                          
                        
                        <th>
                            Referred By
                        </th>
                        <th>
                            Referred To
                        </th>
                        <!-- <th>
                            Status
                        </th> -->
                        <th>
                            Cart Amount
                        </th>
                        <th>
                            Commission
                        </th>
                        <th>
                            Order ID
                        </th>
                        <th>
                            Referral Code
                        </th>
                    </tr>
                </thead>
                <tbody>
                        @if(count($referrerDetails) > 0)
                    @foreach($referrerDetails as $key => $referrerDetail)
                        <tr>
                        <th scope="row"></th>

                            <th scope="row">{{$key+1}}</th>
                            <td>
                                <?php
                                $timestamp = strtotime($referrerDetail->created_at);
                                $formattedDate = date('d M, Y h:i A', $timestamp);
                                ?>
                                {{$formattedDate}}
                            </td>
                            <td>{{$referrerDetail->referrer->name}}</td>

                            <td>{{$referrerDetail->referred->name}}</td>
                            <!-- <td>{{$referrerDetail->status}}</td> -->
                            <td>
                                @if($referrerDetail->transaction_amount && $referrerDetail->transaction_amount != 0)
                                ₹{{number_format($referrerDetail->transaction_amount, 2)}}
                                @else
                                ₹{{ 0.00 }}
                                @endif
                            </td>
                            <td class="commission-green">
                                @if($referrerDetail->reward_value && $referrerDetail->reward_value != 0)
                                ₹{{number_format($referrerDetail->reward_value, 2)}}
                                @else
                                ₹{{ 0.00 }}
                                @endif
                            </td>
                            @if(Auth::check() && Auth::user()->is_influencer == 1)
                            <!-- <td> -->
                                <!-- <button data-toggle="modal" data-target="#exampleModal" class="ref-disable-btn">Redeemed</button> -->
                                <!-- <button data-toggle="modal" data-target="#exampleModal" class="ref-approved-btn">Redeemed</button> -->
                                

                                
                                <!-- <button data-toggle="modal" data-target="#exampleModal" class="ref-completed-btn">Redeemed</button> -->

                            <!-- </td> -->
                            @endif
                            <td class="commission-green">
                                {{$referrerDetail->order_id}}
                            </td>
                            <td class="commission-green">
                                {{$referrerDetail->referral_code}}
                            </td>
                        </tr>
                    @endforeach
                    @endif
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
//   dtButtons.push(deleteButton)
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
//   $(document).ready(function () {
//     $('#filter_div').hide(); // Initially hide the div

//     $('.option').on('change', function () {
//       if ($(this).val() === 'date') {
//         $('#filter_div').show(); // Show when "Custom" is selected
//       } else {
//         $('#filter_div').hide(); // Hide otherwise
//       }
//     });
//   });
</script>



<script>
    // $(document).ready(function() {
    //     $("#date_filter").change(function(e) {
    //         // alert('test');

    //         const urlParams = new URLSearchParams(window.location.search);

    //         var dateFrom = '';
    //         var dateTo = '';

    //         // console.log('test date: ' + $('#date_filter').val());

    //         if($('#date_filter').val() == 7)
    //         {
    //             let today = new Date();

    //             let sevenDaysBack = new Date();
    //             sevenDaysBack.setDate(today.getDate() - 7);

    //             dateFrom = sevenDaysBack.toISOString().split('T')[0];
    //             dateTo = today.toISOString().split('T')[0];
    //         }
    //         else if($('#date_filter').val() == 15)
    //         {
    //             let today = new Date();

    //             let sevenDaysBack = new Date();
    //             sevenDaysBack.setDate(today.getDate() - 15);

    //             dateFrom = sevenDaysBack.toISOString().split('T')[0];
    //             dateTo = today;
    //         }
    //         else if($('#date_filter').val() == 30)
    //         {
    //             let today = new Date();

    //             let sevenDaysBack = new Date();
    //             sevenDaysBack.setDate(today.getDate() - 30);

    //             dateFrom = sevenDaysBack.toISOString().split('T')[0];
    //             dateTo = today;
    //         }
    //         else if($('#date_filter').val() == 90)
    //         {
    //             let today = new Date();

    //             let sevenDaysBack = new Date();
    //             sevenDaysBack.setDate(today.getDate() - 90);

    //             dateFrom = sevenDaysBack.toISOString().split('T')[0];
    //             dateTo = today;
    //         }
    //         else
    //         {
    //             dateFrom = $("#from_date").val();
    //             dateTo = $("#to_date").val();
    //         }

    //         // You can update dateFrom/dateTo based on your selected value here if needed
    //         urlParams.set('dateFrom', dateFrom);
    //         urlParams.set('dateTo', dateTo);

    //         // Redirect with updated URL
    //         window.location.search = urlParams.toString();
    //     });
    // });


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