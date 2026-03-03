@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<link rel="stylesheet" href="{{url('public/css/checkboxdropdwon.css')}}">
<style>
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
  
</style>
@section('content')
<div class="card">
   <div class="card-header">
      Edit Product
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
      <form action="{{ route('admin.product.edit.update', [$product->id]) }}" method="POST" enctype="multipart/form-data">
         @csrf
        <div class="row">
          
            <div class="col-lg-4">
               <div class="form-group">
                  <label for="product_falavor">Category*</label>
                  <select class="form-control" id="main_category_id" name="product_category"  required>
                     <!-- <option value="">Jewellery Style</option> -->
                     
                     @foreach ($category as $categorys) 
                     <option value="{{$categorys->id}}" {{ $categorys->id == $product->product_category ? 'selected' : '' }}>{{$categorys->name}} </option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="form-group">
                  <label for="product_category">Product Sub Category*</label>
                  <select class="form-control" id="subcategorydropdown" name="product_subcategory"  required>
                     <option value="">Select Category</option>
                     @foreach ($subcategory as $subcategory) 
                     <option value="{{$subcategory->id}}" {{ $subcategory->id == $product->product_subcategory ? 'selected' : '' }}>{{ $subcategory->name}}</option>
                     </option>
                     @endforeach
                  </select>
               </div>
            </div>


            <div class="col-lg-4">
               <div class="form-group">
                   <label for="product_falavor">Concern*</label>
                   <select class="form-control" id="main_concern_id" name="concern[]" multiple required>
                       @foreach ($concerns as $concern)      

                           <option value="{{ $concern->id }}" 
                               {{ in_array($concern->id, $selectedConcerns) ? 'selected' : '' }}>
                               {{ $concern->title }}
                           </option>
                       @endforeach
                   </select>
               </div>
           </div>
           
        </div>
        <div class="row">

            <div class="col-lg-4">
               <div class="form-group">
                  <label for="product_name">Product Name*</label>
                  <input type="text" id="title" name="product_name" class="form-control" value="{{ $product->product_name }}" required>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="form-group">
                  <label for="slug">Product Slug*</label>
                  <input type="text" name="slug" class="form-control" value="{{ $product->slug }}" required>
               </div>
            </div>
            <!-- <div class="col-lg-4">
               <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                  <label for="name">Occasion*</label>
                  <?php 
                     $occasion_ids = explode(",",$product->occasion);
                     
                     ?>
                  <select name="occasion[]"id="Occasion" class="form-control select2" multiple="multiple" >
                  @foreach($occasion as $id => $occasions)
                  <option value="{{$id }}" {{ in_array($id, $occasion_ids) ? 'selected': '' }}>{{ $occasions }}</option>
                  @endforeach
                  </select>
                  </select>
               </div>
            </div> -->
           
        </div>
        <div class="row">
            <!-- <div class="col-lg-4">
               <div class="form-group">
                  <label for="product_falavor"> Design</label>
                  <select class="form-control" id="category-dropdown" name="design"  >
                     @foreach ($design as $designs) 
                     <option value="{{$designs->id}}" {{ $designs->id == $product->design ? 'selected' : '' }} >{{$designs->designer_name}} </option>
                     @endforeach
                  </select>
               </div>
            </div> -->
            

            <!-- <div class="col-lg-4">
               <div class="form-group">
                  <label for="product_falavor"> Color*</label>
                  <select class="form-control" id="category-dropdown" name="metal_color"  >
                     @foreach ($metal_color as $metal_colors) 
                     <option value="{{$metal_colors->id}}" {{ $metal_colors->id == $product->metal_color ? 'selected' : '' }}>{{$metal_colors->name}} </option>
                     @endforeach
                  </select>
               </div>
            </div> -->

            
            <!-- <div class="col-lg-4">
               <div class="form-group">
                  <label for="product_name">Product Color Pickar*</label>
                  <input type="color" id="title" name="color_code" class="form-control" value="{{ old('color_code') }}" >
               </div>
            </div> -->
            
         </div>
         <!-- <div class="row"> -->

         <!-- <div class="col-lg-4">
               <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                  <label for="name" >Gender* </label>
                  <select name="gender" id="gender" class="form-control" required>
                  <option value="1" {{$product->gender =='1' ? 'selected': ''}}>Men</option>
                  <option value="2" {{$product->gender =='2' ? 'selected': ''}}>Woman</option>
                  <option value="3" {{$product->gender =='3' ? 'selected': ''}}>Kids</option>
                  <option value="4" {{$product->gender =='4' ? 'selected': ''}}>Unisex</option>
                  </select>
               </div>
         </div> -->
         

        
            <!-- <div class="col-lg-4">
               <div class="form-group">
                  <label for="product_name">Product Code*</label>
                  <input type="text" id="title" name="product_code" class="form-control" value="{{ old('product_code') }}" >
               </div>
            </div>  -->
            <!-- <div class="col-lg-4">
               <div class="form-group">
                  <label for="product_name">Group Code*</label>
                  <input type="text" id="title" name="group_code" class="form-control" value="{{ old('group_code') }}" >
               </div>
            </div> -->
        
           <!-- </div> -->

         <!-- <div class="row">
          
            <div class="col-lg-4">
               <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                  <label for="name">Flavours*</label>
                  <select name="flavors" id="Flavours" class="form-control" >
                  <option value="">select Flavours</option>
                  
                    @foreach($flavor as $id => $flavors)
                     <option value="{{$flavors->id }}"{{ $flavors->id == $product->flavors ? 'selected' : '' }}>{{ $flavors->name }}</option>
                     @endforeach
               
                  </select>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                  <label for="name">Tags*</label>
                  <?php 
                    $tag_ids = explode(",",$product->product_tags);
                     
                     ?>
                  <select name="tags[]" id="tags" class="form-control select2" multiple="multiple" >
                  @foreach($tags as $id => $tags )
                  <option value="{{ $id }}" {{ in_array($id, $tag_ids) ? 'selected':''}}>{{ $tags }}</option>
                  @endforeach
                  </select>
               </div>
            </div>
           
         </div> -->
         <div class="input_fields_wrap">
            <?php
               $totalvariantsCount = 0;
            ?>
            @if ($product->product_variants->count() > 0)
            @foreach ($product->product_variants as $key => $variant)
               
               <div class="clone_div row">
              

               <div class="col-lg-3 col-md-2 col-6">
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     <label for="name"> Product Size*</label>
                     
                     <div class="variant_block">
                        <input type="hidden"  name="weight_id[]" value="{{ $variant->id }}" class="clone_div" data-weight-id="{{ $variant->id }}">
                     </div>

                     <input type="text"  dataindex="0"  placeholder="If not,please write N/A" name="weight[]" id="size"  value="{{ $variant->weight }}"
                        class="form-control calculatesellingprice size" onchange="calculatedata(this)"
                        required>
                  </div>
               </div>
               
               
               <div class="col-lg-3 col-md-2 col-6">
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     <label for="subtotal">INR MRP*</label>
                     <input dataindex="0" type="number"   id="price" name="price[]" value="{{ $variant->price }}"
                        class="form-control calculatesellingprice price" onchange="calculatedata(this)"
                        required>
                  </div>
               </div>
          
               
               <div class="col-lg-3 col-md-2 col-6">
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     <label for="name">Discount</label>
                     <!-- <input dataindex="0" type="number" id="discount" name="discount[]"
                        class="form-control checkValidations discount"
                        onchange="calculatedata(this)" value="{{ $variant->discount }}" required> -->
                        <input dataindex="0" type="number" id="discount" name="discount[]"
                        class="form-control checkValidations discount"
                        onkeyup="calculatedata(this)" value="{{ $variant->discount }}" 
                        step="0.01" min="0" max="100" required>
                  </div>
               </div>
              
               
               <div class="col-lg-3 col-md-2 col-6">
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     <label for="name">Selling Price*</label>
                     <input dataindex="0" type="text" id="selling_price"
                        name="selling_price[]" class="form-control selling_price"
                        value="{{ $variant->selling_price }}"  required readonly>
                  </div>
               </div>
               <!-- <div class="col-lg-2 col-md-2 col-6">
                  <div id="outstock"
                     class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     <label for="outofstock">Out of stock*</label>
                     <input type="checkbox" id="outofstock" name="outofstock[]"
                     {{ $variant->out_of_stock == 1 ? 'checked' : '' }}>
                  </div>
               </div> -->


               <div class="col-lg-12 block">
                  <label for="name">Product Slider Image (800px X 900px)*</label>
                  <label class="button" for="images">Upload Images</label>
                  <input type="file" id="images"  name="product_images[{{$key}}][]" multiple="multiple"/>
                  <div id="multiple-file-preview">
                     <ul id="sortable">
                        <div class="clear-both"></div>
                     </ul>
                  </div>
               </div>

               
               
               <div class="row mt-5 mb-5 form-group {{ $errors->has('name') ? 'has-error' : '' }} new-mapping-img-clone">
               <?php
                  $product_variant = 'App\ProductVariants'::where('product_id', $product->id)->where('weight', $variant->weight)->first();
                  $mappedImages = 'App\Product_Image'::where('product_variant_id', $product_variant->id)->get();

               ?>
                  @foreach($mappedImages as $key => $mappedImage)
                  <div class="col-md-3 pl-0 mt-3">
                     <img src="{{url('public')}}/{{$mappedImage->url}}" style="width: 200px;height: 240px;margin-left: 10px;">    
                  </div>
                  @endforeach
               </div>


               
               @if ($key > 0)
               <a href="#" class="remove_field">Remove</a>
               @endif
            </div>

            <?php
               $totalvariantsCount++;
            ?>
            @endforeach
            @endif

            <input type="hidden" value="{{$totalvariantsCount}}" id="totalvariantsCount">
         </div>
         <div class="col-lg-3 col-md-3 col-6">
            <button class="add_field_button btn btn-warning" type="button">Add More Variant</button>
         </div>

         <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="washcare">  Short Description</label>
            <input type="text" name="short_description" class="form-control" value="{{ $product->short_description }}">
         </div>

         <div class="form-group MT-5">
            <label for="description">First Description*</label>
            <textarea class="form-control" rows="3" name="first_content" required="required" >{{ $product->first_content }}</textarea>
         </div>
         <div class="form-group">
            <label for="description">Product Description*</label>
            <textarea class="form-control" rows="3" name="description" required="required" >{{ $product->description }}</textarea>
         </div>
         <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="washcare"> Specifications*</label>
            <textarea class="form-control" rows="3" name="key_benefits" required="required" >{{ $product->key_benefits }}</textarea>
         </div>
         <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="washcare"> Additional Information*</label>
            <textarea class="form-control" rows="3" name="additional_info" required="required" >{{ $product->additional_info }}</textarea>
         </div>

         <div class="row">
             <div class="col-lg-12">
               <div class="form-group">
                  <label for="product_name">Offer *</label>
                  <input type="text" id="title" name="offer" class="form-control" value="{{$product->offer}}" >
               </div>
             </div>
             </div>
             
             <div class="mt-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
               <label for="product_video">Upload Product Video(255px X 255px)</label>
               <input type="file" id="product_video" name="product_video" class="form-control" accept="video"> 
            </div>
            @if(@$product->product_video)
            <video width="350" height="250" controls>
                <source src="{{ asset('public/' . $product->product_video) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @endif
        

         <div class="mt-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name">Product List Image (1000px X 1000px)*</label>
            <input type="file" name="list_image" class="imgLeft form-control"> 
         </div>
         @if(@$product->list_image)
         <div class="col-md-12 pl-0 mt-3">
            <img src="{{ URL::to('/') }}/public/uploads/product/{{ $product->list_image}}" class="img-thumbnail" width="350px" height="300px" />
         </div>
         @endif
         
         <br>
         <!-- <div class="col-lg-12 block">
            <label for="name">Product Slider Image (800px X 900px)*</label>
            <label class="button" for="images">Upload Images</label>
            <input type="file" id="images"  name="product_images[]" multiple="multiple"/>
            <div id="multiple-file-preview">
               <ul id="sortable">
                  <div class="clear-both"></div>
               </ul>
            </div>
         </div> -->
         <!-- <div class="row mt-5 mb-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            @foreach($images as $key => $image)
            <div class="col-md-3 pl-0 mt-3">
               <img src="{{url('public')}}/{{$image->url}}" style="width: 200px;height: 240px;margin-left: 10px;">    
            </div>
            @endforeach
         </div> -->
         <div class="row radio-check-box">
            <div class="col-lg-2">
               <div class="form-group">
                  <input type="radio" name="isoutofstock"  value="0" <?php echo ($product->outofstock == "0" ? 'checked="checked"': ''); ?> >
                  <label for="in_stock">In Stock</label>
               </div>
            </div>
            <div class="col-lg-2">
               <div class="form-group">
                  <input type="radio" name="isoutofstock"  value="1" <?php echo ($product->outofstock == "1" ? 'checked="checked"': ''); ?>>
                  <label for="in_stock">Out of Stock</label>
               </div>
            </div>
            <div class="col-lg-2">
               <div class="form-group">
                  <input type="checkbox" id="tranding" name="tranding" value="1" <?php echo ($product->tranding == "1" ? 'checked': ''); ?>>
                  <label for="Trending"> Trending </label><br>
               </div>
            </div>
            <div class="col-lg-2">
               <div class="form-group">
                  <input type="checkbox" id="on_sale" name="on_sale" value="1" <?php echo ($product->on_sale == "1" ? 'checked': ''); ?>>
                  <label for="Trending">On Sale </label><br>
               </div>
            </div>
            <div class="col-lg-2">
               <div class="form-group">
                  <input type="checkbox" id="most_popular" name="most_popular" value="1" value="1" <?php echo ($product->most_popular == "1" ? 'checked': ''); ?>>
                  <label for="Trending"> Most popular</label><br>
               </div>
            </div>
            <div class="col-lg-2">
               <div class="form-group">
                  <input type="checkbox" id="best_sellers" name="best_sellers" value="1" <?php echo ($product->best_sellers == "1" ? 'checked': ''); ?>>
                  <label for="Trending">Best Sellers</label><br>
               </div>
            </div>
         </div>
         <div class="col-lg-3">
            <input class="btn btn-danger" style="width:100%;" type="submit" value="{{ trans('global.save') }}">
         </div>
      </form>
   </div>
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<style>
   .pctype-error{
   display:block !important;
   }
</style>



{{-- <script>
   
   $(document).ready(function () {
    var max_fields = 5; // Maximum allowed fields
    var wrapper = $(".input_fields_wrap"); // Wrapper for fields
    var add_button = $(".add_field_button"); // Add button

    var totalvariantsCount = parseInt($('#totalvariantsCount').val()); 

    $(add_button).click(function (e) {
        e.preventDefault();

        if ($(".clone_div").length < max_fields) {
            var clone = $(".clone_div:first").clone();

            // 🔥 Remove images from cloned weight block
            clone.find(".new-mapping-img-clone").remove();
            clone.find(".col-md-3.pl-0.mt-3").remove(); // Remove images div

            // 🔥 Reset input values
            clone.find("input").val("");

            // 🔥 Assign new unique name for product images
            clone.find("input[name^='product_images']").attr("name", `product_images[${totalvariantsCount++}][]`);

            // 🔥 Generate a new unique data index
            let dataindex = $(".clone_div").length + 1;

            // Update dataindex attributes
            clone.find(".size").attr("dataindex", dataindex).attr("id", "size" + dataindex);
            clone.find(".price").attr("dataindex", dataindex).attr("id", "price" + dataindex);
            clone.find(".discount").attr("dataindex", dataindex).attr("id", "discount" + dataindex);
            clone.find(".selling_price").attr("dataindex", dataindex).attr("id", "selling_price" + dataindex);

            // Append Remove button only for cloned items
            clone.append('<a href="#" class="remove_field">Remove</a>');

            // Append cloned weight block
            wrapper.append(clone);
        }
    });

    // Remove weight variant block on clicking "Remove"
    $(wrapper).on("click", ".remove_field", function (e) {
      //   e.preventDefault();
      //   $(this).closest(".clone_div").remove();

      e.preventDefault();

    var variantBlock = $(this).closest(".variant_block");

    // Get the weight_id from the hidden input
    var weightIdToRemove = variantBlock.find("input[name='weight_id[]']").data("weight-id");

    console.log('weightIdToRemove:', weightIdToRemove);

    // Remove the hidden input if needed (usually handled with the block)
    variantBlock.remove();
    });

});
</script> --}}

<script>
$(document).ready(function () {
    var wrapper = $(".input_fields_wrap"); // wrapper where variants live
    var add_button = $(".add_field_button"); // add button
    var totalvariantsCount = parseInt($('#totalvariantsCount').val()) || 0;

    // Add new variant
    $(add_button).click(function (e) {
        e.preventDefault();

        totalvariantsCount++; // increase index for images

        var newVariant = `
            <div class="clone_div border p-3 mb-3 position-relative">
                <div class="row">
                    <div class="col-lg-3 col-md-2 col-6">
                        <div class="form-group">
                            <label>INR MRP*</label>
                            <input type="number" name="price[]" class="form-control price" required>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-2 col-6">
                        <div class="form-group">
                            <label>Discount</label>
                            <input type="number" name="discount[]" 
                                   class="form-control discount"
                                   step="0.01" min="0" max="100" required>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-2 col-6">
                        <div class="form-group">
                            <label>Selling Price*</label>
                            <input type="text" name="selling_price[]" 
                                   class="form-control selling_price" 
                                   readonly required>
                        </div>
                    </div>

                    <!-- 🔥 Image Upload Section -->
                    <div class="col-lg-12 block mt-3">
                        <label>Product Slider Image (800px X 900px)*</label>
                        <input type="file" 
                               name="product_images[${totalvariantsCount}][]" 
                               class="form-control product_images" 
                               multiple>
                        <div class="multiple-file-preview" id="preview-${totalvariantsCount}"></div>
                    </div>
                </div>

                <a href="javascript:void(0);" 
                   class="remove_field btn btn-danger btn-sm position-absolute" 
                   style="top:5px; right:5px;">Remove</a>
            </div>
        `;

        $(wrapper).append(newVariant);
    });

    // Remove variant
    $(wrapper).on("click", ".remove_field", function (e) {
        e.preventDefault();
        $(this).closest(".clone_div").remove();
    });

    // Auto calculate Selling Price
    $(wrapper).on("input", ".price, .discount", function () {
        var variantBlock = $(this).closest(".clone_div");
        var price = parseFloat(variantBlock.find(".price").val()) || 0;
        var discount = parseFloat(variantBlock.find(".discount").val()) || 0;
        var sellingPrice = price - (price * (discount / 100));
        variantBlock.find(".selling_price").val(sellingPrice.toFixed(2));
    });

    // Preview images when uploaded
    $(wrapper).on("change", ".product_images", function () {
        var input = this;
        var previewContainer = $(this).siblings(".multiple-file-preview");
        previewContainer.html(""); // clear old previews

        if (input.files) {
            $.each(input.files, function (i, file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    previewContainer.append(
                        `<img src="${e.target.result}" 
                              style="width:120px; height:140px; margin:5px; border:1px solid #ddd; padding:3px;">`
                    );
                }
                reader.readAsDataURL(file);
            });
        }
    });
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
      //          var selling_price= +price - (+price * +discount/100) ;
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
</scrip>

<script>
   CKEDITOR.replace('description');
   CKEDITOR.replace('key_benefits');
   CKEDITOR.replace('additional_info');
   CKEDITOR.replace('first_content');
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
                   $("#metal_price").val();
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
   
   
   
   // <!-- add variant button click then fatch price od gold-->
   
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
</script>
@endsection