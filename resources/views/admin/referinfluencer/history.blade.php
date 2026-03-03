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


<div class="card">
    <div class="card-header">
        Referral History
    </div>

    <div class="card-body">

        <?php
            $totalCartAmount = 0;
            $totalCommission = 0;
        ?>
        
        @if(count($referrerDetails) > 0)
            @foreach($referrerDetails as $key => $referrerDetail)
                @if($referrerDetail->transaction_amount && $referrerDetail->transaction_amount != 0)
                    <?php $totalCartAmount = $totalCartAmount + $referrerDetail->transaction_amount; ?>
                @endif

                @if($referrerDetail->reward_value && $referrerDetail->reward_value != 0)
                    <?php $totalCommission = $totalCommission + $referrerDetail->reward_value; ?>
                @endif
            @endforeach
        @endif
        <div class="coin-box">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-4">
                    <div class="coin-inner">
                        <div class="title">Total Referral Count</div>
                        <div class="content-area">{{count($referrerDetails)}}</div>
                    </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                    <div class="coin-inner">
                        <div class="title">Total Cart Amount</div>
                        <div class="content-area">INR {{number_format($totalCartAmount, 2)}}</div>
                    </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                    <div class="coin-inner">
                        <div class="title">Total Commission</div>
                        <div class="content-area">INR {{number_format($totalCommission, 2)}}</div>
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
                            #
                        </th>
                        <th>
                            Date
                        </th>
                          
                        
                       
                        <th>
                            Name
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