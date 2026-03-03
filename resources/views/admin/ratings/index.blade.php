@extends('layouts.admin')
@section('content')
<div class="card">
   <div class="card-header">
      Product Rating
   </div>
   <div class="card-body">
      <div class="row mt-4 mb-4">
         <div class="col-md-3">
            <div class="filter-by-product">
               <h6>Filter By Product:</h6>
               <select id="products" name="products" class="form-control" onChange="return searchlogs()">
                  <option disabled="disabled" selected="">Select Option</option>
                  @foreach($products as $key => $value)
                  <option value="{{$key}}" {{($key == $selectedproduct) ? 'selected': ''}}>{{$value}}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-md-3">
            <div class="filter-by-days">
               <h6>Filter By Days:</h6>
               <select id="option" name="option" class="form-control" onChange="return changeDateOption(event)">
                  <option disabled="disabled" selected="">Select Option</option>
                  <?php 
                     $options = [
                         "7" => "7 Last Days",
                         "15" => "15 Last Days",
                         "30" => "30 Last Days",
                         "90" => "90 Last Days",
                         "date" => "Custom",
                         
                     ];
                     ?>
                  @foreach($options as $key => $value)
                  <option value="{{$key}}" {{($key == $option) ? 'selected': ''}}>{{$value}}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-md-3">
            <h6>&nbsp;</h6>
            <a class="btn btn-success " href="ratings/create">
            {{ trans('global.add') }} Review 
            </a>
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
                     Product Name
                  </th>
                  <th>
                     User Name
                  </th>
                  <th>
                     Email
                  </th>
                  <th>
                     Rating
                  </th>
                  <th>
                     Title
                  </th>
                  <th>
                     Description
                  </th>
                  <th>
                     Image
                  </th>
                  <th>
                     Status
                  </th>
                  <th>Date</th>
                  <th>
                     Action
                  </th>
               </tr>
            </thead>
            <tbody>
               @foreach($ratings as $key => $ratings)
               <tr data-entry-id="{{ $ratings->id }}">
                  <td>
                  
                  </td>
                 
                  <td>
                  <?php
                     $product='App\Product'::where('id',$ratings->product_id)->first();
                     ?>
                     {{ $product->product_name ?? '' }}
                  </td>
                  <td>
                     {{ $ratings->user_name ?? '' }}
                  </td>
                  <td>
                     {{ $ratings->user_email ?? '' }}
                  </td>
                  <td>
                     {{ $ratings->rating ?? '' }}
                  </td>
                  <td>
                     {!! $ratings->title ?? '' !!}
                  </td>
                  <td>
                     {!! $ratings->description ?? '' !!}
                  </td>
                  <td>
                     @if(!empty($ratings->product_image))
                         @php
                             $images = json_decode($ratings->product_image);
                         @endphp
                 
                         @if(is_array($images) && count($images) > 0)
                             @foreach($images as $image)
                                 <img src="{{ asset('public/' . $image) }}" alt="Review Image" style="width: 100px; height: auto; margin: 5px;">
                             @endforeach
                         @endif
                     @endif
                 </td>
                 <td>
                     @if($ratings->status == 1) Active @else Deactive @endif
                  </td>

                 
                  <td>
                     {{ $ratings->created_at ?? ''}}
                  </td>
                  <td>
                     <a class="btn btn-xs btn-info" href="{{ route('admin.ratings.edit', $ratings->id) }}">
                        {{ trans('global.edit') }}
                    </a>
                    
                     <form action="{{ url('admin/ratings/destroy') }}/{{$ratings->id}}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



<script>
   if($("#option").val() == 'date'){
           $("#filter_div").css({'display':'block'});
   }
   
   $("#from_date").datepicker({
       dateFormat: 'yy-mm-dd'
   });
   $("#to_date").datepicker({
       dateFormat: 'yy-mm-dd',
       maxDate: 0
   });
   
   function UpdateStatus(id){
       
       var status = $('#Order-'+id).val(); 
       var id =   id;
       var url = '{{url("admin/ratings")}}/'+id;
       
       $.ajax({
          type:'PUT',
          url:url ,
          data:{status:status, _token: "{{ csrf_token() }}"},
          success:function(data){
                 //alert("Review Status Update");
                  swal({
                             title: "Review Status Update",
                            // text: " Uploaded size is " + this.width+'x'+this.height+' px',
                             icon: "warning",
                             button: "ok",
                           });
                   
           }
       });
      
   };
       $(function () {
     let dtButtons = $.extend(true, $.fn.dataTable.defaults.buttons)
   
   
     $.extend(true, $.fn.dataTable.defaults, {
       order: [[ 0, 'desc' ]],
       pageLength: 100,
     });
     $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
       $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
           $($.fn.dataTable.tables(true)).DataTable()
               .columns.adjust();
       });
   })
   
   function changeDateOption(e){
       var type = e.target.value;
       
       if(type != ''){
           if(type == 'date'){
               $("#filter_div").css({'display':'block'});
           }else{
               $("#filter_div").css({'display':'none'});
               searchlogs();
           }
       }
   }
   
   
   function searchlogs(){
        var option = $("#option").val();
        var selectedproduct = $("#products").val();
   
       //  if(option == 'Select Option'){
       //      return;
       //  }
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();
        let params = '';
        
       if(option !== null && selectedproduct === null){
           if(option == 'date'){
               params = 'option='+option+'&from_date='+from_date+'&to_date='+to_date;
           }else{
               params = 'option='+option;
           }
       }else if(option === null && selectedproduct !== null){
           params = 'selectedproduct='+selectedproduct;
       }else if(option !== null && selectedproduct !== null){
           if(option == 'date'){
               params = 'option='+option+'&from_date='+from_date+'&to_date='+to_date;
           }else{
               params = 'option='+option;
           }
           params = params + '&selectedproduct='+selectedproduct;
   
       }
   
        window.location.href = '{{ url("/admin/ratings")}}'+'?'+params;
   }
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


@endsection