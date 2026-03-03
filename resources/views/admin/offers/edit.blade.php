@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
<style>
    .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
     border: 0px solid #c5c5c5; 
    background: #f6f6f6;
    font-weight: normal;
    color: #454545;
    text-align: center;
    margin-bottom: 7px;
    padding: 4px;
}
.ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight {
    border: 1px solid #5ba043;
    background: #5ba043fa;
    color: #ffffff;
}
.ui-datepicker .ui-datepicker-header {
    position: relative;
    padding: .2em 0;
    background-color: #5ba043;
    color: #fff;
    margin-bottom: 5px;
}
.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus, .ui-button:hover, .ui-button:focus {
    /* border: 1px solid #cccccc; */
    background: #5ba043;
    font-weight: normal;
    color: #ffffff;
}
.ui-widget-header .ui-icon {
    filter: invert(1) brightness(1.5);
    cursor: pointer;
}
</style>


<div class="card">
    <div class="card-header">
        Offers
    </div>

    <div class="card-body">
        <form action="{{ route("admin.offers.update", [$offer->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
            <div class="form-group col-md-3">
                <label>Type</label>
                <?php $types = ["1" =>"Cupon Code","2" =>"Unit Offer","3" => "Global Offer", "4" => "Discount Offer", "5" => "Coupon Code Amount","8" => "Paticular Product Offe"]?>
                <select name="type" id="type" class="form-control" disabled>
                    <option value="">Select Option</option>
                    @foreach($types as $key => $value)
                    <option value="{{$key}}" 
                    {{ ((int)$offer->type === (int)$key)?'selected':'' }}
                    >{{$value}}</option>
                    @endforeach
                </select>
            </div>  
            @if($offer->type == 8)
            <div class="form-group col-md-3 product inp-other {{ $errors->has('product') ? 'has-error' : '' }}" >
                <label for="name">Product*</label>
                
              <select name="product[]"  class="form-control select2" multiple="multiple" >

               
                   
                    @foreach($products as  $productss)
                    
                      <option value="{{$productss->id }}" @if($productss->id == $offer->product_id) selected @endif >{{$productss->product_name }}</option>
                    @endforeach
                </select>   
             </div>
             @endif
             @if($offer->type == 9)
            <div class="form-group col-md-3 product inp-other {{ $errors->has('product') ? 'has-error' : '' }}" >
                <label for="name">Product*</label>
                
              <select name="product_id"  class="form-control select2" >

               
                   
                    @foreach($products as  $productss)
                    
                      <option value="{{$productss->id }}" @if($productss->id == $offer->product_id) selected @endif>{{$productss->product_name }}</option>
                    @endforeach
                </select>   
             </div>
             @endif


            <div class="form-group  col-md-3 {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.user.fields.name') }}*</label>
                <input type="text" id="name" name="title" class="form-control" value="{{ old('title', isset($offer) ? $offer->title : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group col-md-3 {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Discout (%) *</label>
                <input type="text" id="discount" name="discount" {{ ($offer->type == '2')?'readonly':''}} class="form-control" value="{{ old('discount', isset($offer) ? $offer->discount : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group col-md-3 {{ $errors->has('valid_upto') ? 'has-error' : '' }}">
                <label for="name">With Effect From*</label>
                <input type="text" id="valid_from" name="valid_from" autocomplete="off" class="form-control inp" value="{{ old('valid_from', isset($offer) ? $offer->WED : '') }}" required>
                @if($errors->has('valid_upto'))
                    <em class="invalid-feedback">
                        {{ $errors->first('valid_upto') }}
                    </em>
                @endif
                
            </div>
            <div class="form-group col-md-3 {{ $errors->has('valid_upto') ? 'has-error' : '' }}">
                <label for="name">Valid Up to*</label>
                <input type="text" id="valid_upto" name="valid_upto" class="form-control" value="{{ old('valid_upto', isset($offer) ? $offer->valid_upto : '') }}"  required>
                @if($errors->has('valid_upto'))
                    <em class="invalid-feedback">
                        {{ $errors->first('valid_upto') }}
                    </em>
                @endif
                
            </div>
            <div class="form-group col-md-3 limit  inp-other {{ $errors->has('limitupto') ? 'has-error' : '' }}" style="display: {{ ($offer->type == '2')?'block':'none' }}">
                <label for="name"> Limit User *</label>
                <input type="text" id="limitupto" name="limitupto" class="form-control" autocomplete="off" value="{{ old('discount', isset($offer) ? $offer->limitupto : '') }}" >
                @if($errors->has('limitupto'))
                    <em class="invalid-feedback">
                        {{ $errors->first('limitupto') }}
                    </em>
                @endif
            </div>
            
            <div class="form-group col-md-3 buy_free  inp-other {{ $errors->has('buy') ? 'has-error' : '' }}" style="display: {{ ($offer->type == '2')?'block':'none'}}">
                <label for="name"> Buy Unit *</label>
                <input type="text" id="buy" name="buy" value="{{$offer->buy}}" class="form-control" autocomplete="off" >
                @if($errors->has('buy'))
                    <em class="invalid-feedback">
                        {{ $errors->first('buy') }}
                    </em>
                @endif
            </div>
            
            <div class="form-group col-md-3 buy_free inp-other {{ $errors->has('free') ? 'has-error' : '' }}" style="display: {{ ($offer->type == '2')?'block':'none'}}">
                <label for="name"> Free Unit *</label>
                <input type="text" id="free" name="free" value="{{$offer->free}}" class="form-control" autocomplete="off" >
                @if($errors->has('free'))
                    <em class="invalid-feedback">
                        {{ $errors->first('free') }}
                    </em>
                @endif
            </div>
            
            <div class="form-group col-md-3 buy_free inp-other {{ $errors->has('total_product_deliver') ? 'has-error' : '' }}" style="display: {{ ($offer->type == '2')?'block':'none'}}">
                <label for="name"> Total Product Deliver*</label>
                <input type="text" readonly id="total_product_deliver" name="total_product_deliver" value="{{$offer->total_product_deliver}}" class="form-control" autocomplete="off" >
                @if($errors->has('total_product_deliver'))
                    <em class="invalid-feedback">
                        {{ $errors->first('total_product_deliver') }}
                    </em>
                @endif
            </div>
            
            
            
            
            <!--vvvvvvvvvvvvvvv-->
             
            <div class="form-group col-md-3 global_disc_percent inp-other {{ $errors->has('global_disc_percent') ? 'has-error' : '' }}" style="display: none">
                <label for="name">Discout (%) *</label>
                <input type="text"  id="global_disc_percent" name="global_disc_percent" value="" class="form-control" autocomplete="off" >
                @if($errors->has('global_disc_percent'))
                    <em class="invalid-feedback">
                        {{ $errors->first('global_disc_percent') }}
                    </em>
                @endif
            </div>
            
            @if($offer->type == 3)
            
                <div class="form-group col-md-3 purchase_amount inp-other {{ $errors->has('global_disc_percent') ? 'has-error' : '' }}">
                    <label for="name">Purchase Amount*</label>
                    <input type="text"  id="purchase_amount" name="purchase_amount" value="{{ old('purchase_amount', isset($offer) ? $offer->purchase_amount : '') }}" class="form-control" autocomplete="off" >
                        <em class="invalid-feedback">
                           
                        </em>
                </div>
            
                <div class="form-group col-md-3 global_off_select inp-other {{ $errors->has('global_disc_percent') ? 'has-error' : '' }}">
                    <label for="name">Select Global Offer Type*</label>
                    <select name="global_offer_type" id="type_global" class="form-control">
                        
                        <option value=""  {{ ($offer->global_offer_type == '')?'selected':''}}>Select Option</option>
                        <option value="1" {{ ($offer->global_offer_type == '1')?'selected':''}}>Global Amount</option>
                        <option value="2" {{ ($offer->global_offer_type == '2')?'selected':''}}>Global Percentage</option>
                    </select>
                </div>
                
                @if($offer->global_offer_type == 1)
                 <div class="form-group col-md-3 global_off_amount inp-other {{ $errors->has('global_disc_percent') ? 'has-error' : '' }}">
                <label for="name">Offer Amount*</label>
                <input type="text"  id="global_offer_amount" name="global_offer_amount" value="{{ old('discount', isset($offer) ? $offer->discount : '') }}" class="form-control" autocomplete="off" >
                    <em class="invalid-feedback">
                       
                    </em>
                 </div>
                 @endif
            
            @if($offer->global_offer_type == 2)
                <div class="form-group col-md-3 global_off_percent inp-other {{ $errors->has('global_disc_percent') ? 'has-error' : '' }}">
                <label for="name">Offer Percent (%)*</label>
                <input type="text"  id="global_offer_percent" name="global_offer_percent" value="{{ old('discount', isset($offer) ? $offer->discount : '') }}" class="form-control" autocomplete="off" >
                    <em class="invalid-feedback">
                       
                    </em>
                </div>
                @endif
            @endif
            
            <div class="form-group col-md-3" >
                <label for="image4">Image*</label>
                <input type="file" name="image4"  class="imgLeft form-control">
            </div>

            <div class="form-group col-md-3" >
                <label for="brief">Brief*</label>
                <input type="text" name="brief"  class="imgLeft form-control" value="{{ old('brief', isset($offer) ? $offer->brief : '') }}" required>
            </div>

            <div class="form-group col-md-3" >
                <label for="description">Description*</label>
                <input type="text" name="description"  class="imgLeft form-control" value="{{ old('description', isset($offer) ? $offer->description : '') }}" required>
            </div>

            @if($offer->image)
                <img src="/public/uploads/coupon/{{$offer->image}}" style="width: 160px;height: 80px;margin: 10px"/>
            @endif
            
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                <input class="btn btn-info" type="button" value="{{ __('<<') }}" onClick="window.location.href = '{{url("admin/offers")}}'">
            </div>
        </form>


    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    function deliverProduct(buy, free){
        return +buy + +free
    }
    
    function calculateDiscount(dproduct, free){
        const discount = +free/dproduct*100;
        return discount.toFixed(2); 
    }
    
    
    $(document).on("blur","#free", function(){
       var buy = $("#buy").val();
       var free = $(this).val();
       // calculate deliver product
       const dproduct  = deliverProduct(buy, free);
       $("#total_product_deliver").val(dproduct);
       // calculate discount
       const discount = calculateDiscount(dproduct,free);
       $("#discount").val(discount);
    });
    
        $(document).on("change","#type", function(){
         $("#discount").prop("readonly", false);
         $("#total_product_deliver").prop("readonly", false);
         $(".limit,.buy_free,.cupon").children("input").prop("required", false);
         $("#discount").parent().show();
         $(".global_disc_amount , .global_off_select ").children("input").prop("required", false);
         $(".global_off_percent").children("input").prop("required", false);
         $(".global_off_amount").children("input").prop("required", false);
         $(".global_off_amount").hide();
         $(".global_off_percent").hide();
         $(".purchase_amount").hide();
       
       if($("#type").val() == '1'){
           $(this).parent().siblings(".inp-other").hide();
           $(".limit").children("input").attr("required", "required");
           $(".limit").show();
       }
       
        else if($("#type").val() == '2'){
           $(".limit,.buy_free").show();
           $(".limit,.buy_free,.cupon").children("input").attr("required", "required");
           $(".cupon").show();
           $("#discount").prop("readonly", true);
           $("#total_product_deliver").prop("readonly", true);
        }
         else if($("#type").val() == '3'){
           $(this).parent().siblings(".inp-other").hide();
           $("#discount").parent().hide();
           $(".global_disc_amount , .global_off_select ").children("input").attr("required", "required");
           $(".global_disc_amount").show();
           $(".global_off_select").show();
            $(".purchase_amount").show();
        }
        else if($("#type").val() == '8'){
            
            
            $(this).parent().siblings(".inp-other").hide();
           $(".limit").children("input").attr("required", "required");
           $(".limit").show();
           $(".product").show();
           
        }
        else {
           $(".limit").css({'display':'none'})
           $(".cupon").css({'display':'none'});
        }
        
    });
    
     $(document).on("change","#type_global", function(){
            var val = $(this).val();
            $(".global_off_percent").children("input").prop("required", false);
            $(".global_off_amount").children("input").prop("required", false);
            if(val == '1'){
                $(".global_off_amount").children("input").attr("required", "required");
               $(".global_off_amount").show();
               $(".global_off_percent").hide();
            }
           
            else if(val == '2'){
                 $(".global_off_percent").children("input").attr("required", "required");
               $(".global_off_amount").hide();
               $(".global_off_percent").show();
            }
            
        });
</script>

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
$(document).ready(function () {
    
        $("#valid_from").datepicker({
            dateFormat: "dd-M-yy",
            minDate: 0,
            onSelect: function (date) {
                var date2 = $('#valid_from').datepicker('getDate');
                date2.setDate(date2.getDate() + 1);
                $('#valid_upto').datepicker('setDate', date2);
                //sets minDate to dt1 date + 1
                $('#valid_upto').datepicker('option', 'minDate', date2);
            }
        });
        $('#valid_upto').datepicker({
            dateFormat: "dd-M-yy",
            onClose: function () {
                var dt1 = $('#valid_upto').datepicker('getDate');
                console.log(dt1);
                var dt2 = $('#valid_upto').datepicker('getDate');
                if (dt2 <= dt1) {
                    var minDate = $('#valid_upto').datepicker('option', 'minDate');
                    $('#valid_upto').datepicker('setDate', dt1);
                }
            }
        });
    });
    </script>
@endsection