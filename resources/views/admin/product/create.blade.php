@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{url('public/css/checkboxdropdwon.css')}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet"/> -->
 <link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" rel="stylesheet"/>




<style>
   /* multiple tag */
   .bootstrap-tagsinput {
	margin: 0;
	width: 100%;
	padding: 0.5rem 0.75rem 0;
	font-size: 1rem;
  line-height: 1.25;
	transition: border-color 0.15s ease-in-out;
	
	&.has-focus {
    background-color: #fff;
    border-color: #5cb3fd;
	}
	
	.label-info {
		display: inline-block;
		background-color: #636c72;
      color: #fff;
		padding: 0 .4em .15em;
		border-radius: .25rem;
		margin-bottom: 0.4em;
	}
	
	input {
		margin-bottom: 0.5em;
	}
}

.bootstrap-tagsinput .tag [data-role="remove"]:after {
	content: '\00d7';
}
/* multiple tag end*/

   .radio-check-box .form-group{
   display:flex;
   }
   .radio-check-box label {
   display: inline-block;
   margin-bottom: 0;
   margin-left: 10px;
   font-size: 18px;
   }
   .radio-check-box input[type="checkbox"], .radio-check-box input[type="radio"]{
   width: 30px; /*Desired width*/
   height: 30px; /*Desired height*/
   cursor: pointer;
   }
   .form-switch .form-check-input {
    width: 15em;
    padding: 20px;
   }
   .form-check-label {
    margin-bottom: 0;
    display: block;
}
.switches-container {
    width: 12rem;
    position: relative;
    display: flex;
    padding: 0;
    position: relative;
    background: var(--switches-bg-color);
    line-height: 3rem;
    border-radius: 3rem;
    margin-left: auto;
    margin-right: auto;
}

/* input (radio) for toggling. hidden - use labels for clicking on */
.switches-container input {
    visibility: hidden;
    position: absolute;
    top: 0;
}

/* labels for the input (radio) boxes - something to click on */
.switches-container label {
    width: 50%;
    padding: 0;
    margin: 0;
    text-align: center;
    cursor: pointer;
    color: var(--switches-label-color);
}

:root {
    --switches-bg-color: goldenrod;
    --switches-label-color: white ;
    --switch-bg-color: white;
    --switch-text-color: goldenrod ;
}
.switches-container .switch-wrapper {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 50%;
    padding: 0.15rem;
    z-index: 3;
    transition: transform .5s cubic-bezier(.77, 0, .175, 1);
    /* transition: transform 1s; */
}

/* switch box highlighter */
.switches-container .switch {
    border-radius: 3rem;
    background: var(--switch-bg-color);
    width: 100%;
    height: 100%;
}

/* switch box labels
    - default setup
    - toggle afterwards based on radio:checked status 
*/
.switches-container .switch div {
    width: 100%;
    text-align: center;
    opacity: 0;
    display: block;
    color: var(--switch-text-color) ;
    transition: opacity .2s cubic-bezier(.77, 0, .175, 1) .125s;
    will-change: opacity;
    position: absolute;
    top: 0;
    left: 0;
}

/* slide the switch box from right to left */
.switches-container input:nth-of-type(1):checked~.switch-wrapper {
    transform: translateX(0%);
}

/* slide the switch box from left to right */
.switches-container input:nth-of-type(2):checked~.switch-wrapper {
    transform: translateX(100%);
}

/* toggle the switch box labels - first checkbox:checked - show first switch div */
.switches-container input:nth-of-type(1):checked~.switch-wrapper .switch div:nth-of-type(1) {
    opacity: 1;
}

/* toggle the switch box labels - second checkbox:checked - show second switch div */
.switches-container input:nth-of-type(2):checked~.switch-wrapper .switch div:nth-of-type(2) {
    opacity: 1;
}
</style>
@section('content')
<div class="card">
   <div class="card-header">
      Add Product
   </div>
   <div class="card-body">
      @if (session('status'))
      <div class="alert alert-success" role="alert">
         <button type="button" class="close" data-dismiss="alert">×</button>
         {{ session('status') }}
      </div>
      @elseif(session('failed'))
      <div class="alert alert-danger" role="alert">
         <button type="button" class="close" data-dismiss="alert">×</button>
         {{ session('failed') }}
      </div>
      @endif
      <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="row">
            <div class="col-lg-4">
               <div class="form-group">
                  <label for="product_falavor">Product Category*</label>
                  <select class="form-control" id="main_category_id" name="product_category"  required>
                     <option value="">- Select Category -</option>
                     @foreach ($category as $category) 
                     <option value="{{$category->id}}">{{$category->name}} </option>
                     @endforeach
                  </select>
               </div>
            </div>
         
            <div class="col-lg-4">
               <div class="form-group">
                  <label for="product_sub_category">Product Sub Category*</label>
                  <select class="form-control" id="subcategorydropdown" name="product_subcategory"  value="" >
                  </select>
               </div> 
            </div>

            <div class="col-lg-4">
               <div class="form-group">
                   <label for="product_falavor">Concern*</label>
                   <select class="form-control" id="main_concern_id" name="concern[]" multiple required>
                       @foreach ($concerns as $concern) 
                           <option value="{{ $concern->id }}">{{ $concern->title }}</option>
                       @endforeach
                   </select>
               </div>
           </div>
           

            <div class="col-lg-4">
               <div class="form-group">
                  <label for="product_name">Product Name*</label>
                  <input type="text" id="title" name="product_name" class="form-control" value="{{ old('product_name') }}" required>
               </div>
            </div>

         </div>
         <div class="row">

         
         </div>



         <h5>Variant 1</h5>
         <div class="input_fields_wrap">
            <div class="clone_div row">
               <h5></h5>
               
               <div class="col-lg-3 col-md-2 col-6">
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     <label for="name"> Product Size*</label>
                     <input type="text"  dataindex="0" placeholder="If not,please write N/A" name="weight[]" id="size"    value=""
                        class="form-control calculatesellingprice size" onchange="calculatedata(this)"
                        required>
                  </div>
               </div>
              

               <div class="col-lg-3 col-md-2 col-6">
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     <label for="subtotal">INR MRP*</label>
                     <input dataindex="0" type="text"   id="price" name="price[]" value=""
                        class="form-control calculatesellingprice price" onkeyup="calculatedata(this)"
                        required>
                  </div>
               </div>
              

               <div class="col-lg-3 col-md-2 col-6">
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     <label for="name">Discount*</label>
                    

                           <input dataindex="0" type="number" id="discount" name="discount[]"
                        class="form-control checkValidations discount"
                        onkeyup="calculatedata(this)" value="0" 
                        step="0.01" min="0" max="100" required>

                     <span class='text-danger error_msg'></span>
                  </div>
               </div>
              
             
               <div class="col-lg-3 col-md-2 col-6">
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     <label for="name">Selling Price*</label>
                     <input dataindex="0" type="text" id="selling_price" name="selling_price[]"
                        class="form-control selling_price" readonly>
                  </div>
               </div>
               <!-- 
                  <div class="col-lg-2 col-md-2 col-6">
                      <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                          <label for="outofstock">Out of stock*</label>
                          <input type="checkbox" id="outofstock" name="outofstock[]">
                      </div>
                  </div> -->

                


                  <div class="row">
                     <div class="col-lg-4">
                        <div class="mt-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                           <label for="name">Product Slider Image (800px X 900px)*</label>
                           <input type="file" id="images" name="product_images[0][]" class="form-control" multiple="multiple" required/>
                           <div id="multiple-file-preview">
                              <ul id="sortable">
                                 <div class="clear-both"></div>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               
            </div>
         </div>
         <div class="form-group mt-5">
            <button class="add_field_button btn btn-warning" type="button">Add More Variant</button>
         </div>

         <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="washcare">  Short Description*</label>
            <input type="text" name="short_description" class="form-control" required= ''>
         </div>

         <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="washcare">  First Description*</label>
            {!! Form::textarea('first_content', old('first_content'), ['class' => 'form-control ', 'placeholder' => '', 'required' => 'required']) !!}
         </div>
         <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="washcare"> Product  Discription*</label>
            {!! Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => '', 'required' => 'required']) !!}
         </div>
         <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="washcare"> Specifications*</label>
            {!! Form::textarea('key_benefits', old('key_benefits'), ['class' => 'form-control ', 'placeholder' => '', 'required' => 'required']) !!}
         </div>
         <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="washcare"> Additional Information*</label>
            {!! Form::textarea('additional_info', old('additional_info'), ['class' => 'form-control ', 'placeholder' => '', 'required' => 'required']) !!}
         </div>
        
         <div class="row">
             <div class="col-lg-12">
               <div class="form-group">
                  <label for="product_name">Offer *</label>
                  <input type="text" id="title" name="offer" class="form-control" value="{{ old('offer') }}" required>
               </div>
             </div>
             </div>
             <div class="row">
            <div class="col-lg-4">
               <div class="mt-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                  <label for="name">Product List Image (1000px X 1000px)*</label>
                  <input type="file" name="list_image" required class="imgLeft form-control"> 
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-lg-4">
               <div class="mt-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                  <label for="product_video">Upload Product Video(255px X 255px)</label>
                  <input type="file" id="product_video" name="product_video" class="form-control" accept="video/*"> 
               </div>
            </div>
         </div>


         <!-- <div class="row">
            <div class="col-lg-4">
               <div class="mt-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                  <label for="name">Product Slider Image (800px X 900px)*</label>
                  <input type="file" id="images" name="product_images[]" class="form-control" multiple="multiple" required/>
                  <div id="multiple-file-preview">
                     <ul id="sortable">
                        <div class="clear-both"></div>
                     </ul>
                  </div>
               </div>
            </div>
         </div> -->


         <div class="row mt-5 radio-check-box">
            <div class="col-lg-2">
               <div class="form-group">
                  <input type="radio" name="isoutofstock"  value="0" checked>
                  <label for="in_stock">In Stock</label>
               </div>
            </div>
            <div class="col-lg-2">
               <div class="form-group">
                  <input type="radio" name="isoutofstock"  value="1">
                  <label for="in_stock">Out of Stock</label>
               </div>
            </div>
            <div class="col-lg-2">
               <div class="form-group">
                  <input type="checkbox" id="tranding" name="tranding" value="1">
                  <label for="Trending"> Trending</label><br>
               </div>
            </div>
            <div class="col-lg-2">
               <div class="form-group">
                  <input type="checkbox" id="on_sale" name="on_sale" value="1">
                  <label for="Trending">On Sale</label><br>
               </div>
            </div>
            <div class="col-lg-2">
               <div class="form-group">
                  <input type="checkbox" id="most_popular" name="most_popular" value="1">
                  <label for="Trending"> Most popular</label><br>
               </div>
            </div>
            <div class="col-lg-2">
               <div class="form-group">
                  <input type="checkbox" id="best_sellers" name="best_sellers" value="1">
                  <label for="Trending">Best Sellers</label><br>
               </div>
            </div>
         </div>
         <div class="col-lg-3 mt-4">
            <input class="btn btn-success" style="width:100%;" type="submit" value="{{ trans('global.save') }}">
         </div>
      </form>
   </div>
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<style>
   .pctype-error{
   display:block !important;
   }
</style>

<script>


   $(document).ready(function(){
    var max_fields      = 5; //maximum div allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var clone           = $(".clone_div:first").clone().append('<a href="#" class="remove_field">Remove</a>');
    var x = 1; 
   
                        var x = 1; //initial div count
       $(add_button).click(function(e){ //on add input button click
        // console.log('aaaaa'+x);
   
        // Clone the first form-container
        var newForm = $(".clone_div:first").clone().find('h5').text('Variant'+' ' + parseInt(x+1));
        // newForm.find('h1').text('2222');
   
        clone.find("input[name^='product_images']").attr("name", `product_images[${x}][]`);
   
   
        var size = $('#size').val();
        var price = $('#price').val();
        var discount = $('#discount').val(); 
        if( price.trim() != "" && discount.trim() != ""){
            e.preventDefault();
            if(x < max_fields){ //max div allowed
                x++; //div increment
                wrapper.append(newForm).append(clone.clone()); //
                // wrapper.append(clone.clone()); //
                var indexvalue_price=$('.price:last');
                var indexvalue_size=$('.size:last');
                var indexvalue_dis=$('.discount:last');
                var indexvalue_sell=$('.selling_price:last');
          
   

                let dataindex=parseInt($('.discount').length)+1;
                indexvalue_size.attr('dataindex',dataindex);
                indexvalue_price.attr('dataindex',dataindex);
                indexvalue_dis.attr('dataindex',dataindex);
                indexvalue_sell.attr('dataindex',dataindex);

                indexvalue_price.attr('id',indexvalue_price.attr('id')+dataindex);
                indexvalue_size.attr('id',indexvalue_size.attr('id')+dataindex);
                indexvalue_dis.attr('id',indexvalue_dis.attr('id')+dataindex);
                indexvalue_sell.attr('id',indexvalue_sell.attr('id')+dataindex);
                
            }
        }else{
            alert('Please fill the first variants')
        }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
        $(this).parent('div').remove(); 
        x--;
    })
   
    $.fn.deleteImg = function(msg) {
        $(this).parent().remove();
        $("#sequence").text("Upload Images ");
    };
     });
   
</script>
<script>
   $(document).ready(function(){
         //   $(".calculatesellingprice").on('blur',function(e){
   
         //       calculatedata(this);
               
         //       });
         $(".calculatesellingprice").on('keyup', function (e) {
            

            calculatedata(this);
         });

         $(".checkValidations").on('keyup', function (e) {
            let value = parseFloat($(this).val());

            if (value > 100) {
               $(this).val(100);
            } 
            // else if (value <= 0 || isNaN(value)) {
            //    $(this).val(0);
            // }

            calculatedata(this);
         });



       })

      
      
   
   
      //  function calculatedata(obj){
      //           var dataindex= $(obj).attr('dataindex');
      //          if(dataindex==0){
      //              dataindex="";
      //          }
      //          var size= $("#size"+dataindex).val();
      //          var price= $("#price"+dataindex).val();
      //          var discount = $("#discount"+dataindex).val();
      //           var selling_price= +price - (+price * +discount/100) ;
      //          $("#selling_price"+dataindex).val(selling_price.toFixed(2));
      //  }

      function calculatedata(obj) {
         var dataindex = $(obj).attr('dataindex');
         if (dataindex == 0) {
            dataindex = "";
         }

         var size = $("#size" + dataindex).val();
         var price = $("#price" + dataindex).val();
         var discount = $("#discount" + dataindex).val();
         
         var selling_price = +price - (+price * +discount / 100);
         
         // Round up to the next whole number
         $("#selling_price" + dataindex).val(Math.round(selling_price));
      }
   
       
</script>
<script>
   CKEDITOR.replace('description');
   CKEDITOR.replace('additional_info');
   CKEDITOR.replace('key_benefits');
   CKEDITOR.replace('first_content');
</script>



<script>
   $(document).ready(function() {
  $('#main_category_id').on('change', function() {
    var main_category_id = this.value;
    $("#subcategorydropdown").html('');
    $.ajax({
      url: "{{url('get-subcategory-by-category')}}",
      type: "POST",
      data: {
        main_category_id: main_category_id,
        _token: '{{csrf_token()}}'
      },
      dataType: 'json',
      success: function(result) {
        console.log(result); // inspect the response data
        if (result.subcategorydropdown && result.subcategorydropdown.length > 0) {
          $('#subcategorydropdown').html('<option value="">Select product category </option>');
          $.each(result.subcategorydropdown, function(key, value) {
            $("#subcategorydropdown").append('<option value="' + value.id + '">' + value.name + '</option>');
          });
        } else {
          console.log('No subcategories found');
        }
      },
      error: function(xhr, status, error) {
        console.log('Error:', error);
      }
    });
  });
});
</script>

<script>
$(document).ready(function() {
   $('#main_category_id').on('change', function() {
       var main_category_id = this.value;
       var selectedValues = $('#main_concern_id').val() || []; 

       $.ajax({
           url: "{{ url('get-concern-by-category') }}",
           type: "POST",
           data: {
               main_category_id: main_category_id,
               _token: '{{ csrf_token() }}'
           },
           dataType: 'json',
           success: function(result) {
               if (result.concerns && result.concerns.length > 0) {
                   var options = '<option value="">- Select concern -</option>';
                   $.each(result.concerns, function(key, value) {
                       var isSelected = selectedValues.includes(value.id.toString()) ? 'selected' : '';
                       options += '<option value="' + value.id + '" ' + isSelected + '>' + value.title + '</option>';
                   });
                   $('#main_concern_id').html(options);
               } else {
                   $('#main_concern_id').html('<option value="">No concerns found</option>');
               }
           },
           error: function(xhr, status, error) {
               console.log('Error:', error);
           }
       });
   });
});
</script>

<script>
   $(document).ready(function () {
   
       $('#material').on('change', function () {
           var material_id = this.value;
           $("#purity").html('');
           $.ajax({
               url: "{{url('admin/fetch-purity')}}",
               type: "POST",
               data: {
                   material_id: material_id,
                   _token: '{{csrf_token()}}'
               },
               dataType: 'json',
               success: function (result) {
                   $('#purity').html('<option value="">-- Select purity --</option>');
                   $.each(result.purity, function (key, value) {
                       $("#purity").append('<option value="' + value
                           .id + '">' + value.name + '</option>');
                   });
                  // $('#city-dropdown').html('');
                   $(".metal_price").val();
               }
           });
       });
   
   
       
   
       $('#purity').on('change', function () {
           //alert('hi');
           var idpurity = this.value;
           var meterial_id = $('#material').val();
          // alert(meterial_id);
           $(".metal_price").html('');
           $.ajax({
               url: "{{url('admin/fetch-price')}}",
               type: "POST",
               data: {
                   purity_id: idpurity,
                   material_id: meterial_id,
                   _token: '{{csrf_token()}}'
               },
               dataType: 'json',
               success: function (res) {
                  // console.log(res);
                  if(res)
                  {
                   $(".metal_price").val(res.current_price.toFixed(2));
   
                  }
                  else{
                   $(".metal_price").html('');
   
                  }
                
               }
           });
       });
   
   });
   
   
   // <!-- add variant button click then fatch price of gold-->
   $(document).ready(function(){
   var add_button = $(".add_field_button"); 
   $(add_button).click(function(e){ 
   var meterial_id = $('#material').val();
   var purity=$('#purity').val();
            $.ajax({
               url: "{{url('admin/fetch-price')}}",
               type: "POST",
               data: {
                   purity_id: purity,
                   material_id: meterial_id,
                   _token: '{{csrf_token()}}'
                  },
               dataType: 'json',
               success: function (res) {
                  // console.log(res);
                  if(res)
                       {
                           $(".metal_price").val(res.current_price.toFixed(2));
   
                       }
                       else{
                           $(".metal_price").html('');
   
                       }
                
               }
                   });
           });
           });
           $('#flexSwitchCheckDefault').on('change', function() {
    console.log($(this).is(':checked'));
});




$('input[name="input"]').tagsinput({
		trimValue: true,
		confirmKeys: [13, 44, 32],
		focusClass: 'my-focus-class'
	});
	
	$('.bootstrap-tagsinput input').on('focus', function() {
		$(this).closest('.bootstrap-tagsinput').addClass('has-focus');
	}).on('blur', function() {
		$(this).closest('.bootstrap-tagsinput').removeClass('has-focus');
	});


</script>
@endsection