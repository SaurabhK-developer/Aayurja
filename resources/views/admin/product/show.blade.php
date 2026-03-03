@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    input#outofstock {
    width: 20px;
    height: 20px;
    margin-right: 10px;
    float: left;
    display: block;
}
input#freeshipping {
    width: 20px;
    height: 20px;
    margin-right: 10px;
    float: left;
    display: block;
}
    #product-preview{
        display:none;
        background-color: #ffff;
        margin-top: 4em;
    }
    section.product_overview.bg-gray.sec-padding {
        background-color: #fff !important;
    }
    .product_detail .product_quantity .btn-default {
        color: #fff;
    }
    .image-show {
        margin-bottom: 25px;
    }
    .preview_btn{
        display: inline-block;
        font-weight: 400;
        text-align: center;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        padding: .375rem .75rem;
        font-size: .875rem;
        line-height: 1.5;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        color: #fff;
        background-color: #4dbd74;
        border-color: #4dbd74;
        cursor:pointer;
    }
    .preview_btn:hover{
        background-color: #44915f;
    }
    .error_file_text{
        display:none;
    }

    .view-img {
            border: 1px solid #ccc;
        margin-right: 1rem;
        margin-bottom: 40px;
        /* height: 12rem; */
        width: 11.6rem;
        /* margin: auto; */
        position: relative;
        display: flex;
        flex-flow: column;
        height: 11em;
        position: relative;
        justify-content: center;
            background-color: #fff;
    }
    .view-img:before {
        content: '';
        background-color: #0000;
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 2;
        cursor: pointer;
    }
    .imgmain-select {
        position: relative;
        width: 100%;
        height: 100px;
    }
    .imgmain-select img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 100%;
        max-height: 100%;
    }
    .var_img_num {
        position: absolute;
        right: 15px;
        background-color: #0000006b;
        color: #fff;
        padding: 10px;
        font-weight: 900;
    }
    #sequence{
        margin:15px 0px;
        width:100%;
        display:none;
    }
    div#drag-data {
        display: none;
        width: 100%;
        min-height: 175px;
        border: 1px solid #999;
        padding: 0;
        margin: 10px 0px;
        position: relative;
        max-height: 300px;
        overflow-y: scroll;
        background-color: #f5f5f5;
    }
    div#drag-data:before {
        content: 'Drag & Drop';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 3rem;
        color: #ccc;
    }
    div#fileList {
        padding: 10px;
        min-width: 76vw;
        margin: auto;
        max-height: 375px;
        border: 1px solid #ccc;
        min-height: 200px;
        display: none;
        display: flex;
        flex-wrap: wrap;
        display:none;
    }
    .updatedImages img{
            width: 20%;
        margin-right: 10px;
        margin-bottom: 10px;
    }
    #drag-data img {
        width: 20%;
        padding: 10px;
        pointer-events: none;
    }
    .btns_sequence {
        display: flex;
        justify-content: space-between;
    }
    #update_seq{
        display:none;
    }
    #upload_again{
        display:none;
    }
    .view-img:hover{
       box-shadow: 1px 2px 5px #5ba043; 
    }
    
    .view-img:hover .delete-img{
        opacity:1;
    }
    .delete-img {
        padding: 5px 0px;
        cursor: pointer;
        position: absolute;
        bottom: 0;
        right: 0;
        background-color: #5ba043;
        padding: 3px 10px;
        z-index: 9;
        color: #ffffff;
        opacity:0;
        transition: all 0.5s;
    }
    /*.delete-img:hover i {*/
    /*     color:red;                       */
    /*    transition: all 0.3s;*/
    /*    transform: scale(1.1);*/
    /*}*/
    .updatedImages img {
        width: 10%;
        margin-right: 10px;
    }
    .chnageseq-box{
        display:none;
        
    }
    
    .imgInput {
        display: none;
    }
    #sortable {
        display: flex;
        flex-wrap: inherit; 
    }
    
    #pro_back{
        display:none;
    }
    .error_msg{
        display:none;
    }

</style>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


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

        <form action="{{ route('admin.product.edit.update', [$product->id]) }}" method="GET" enctype="multipart/form-data">
            @csrf
             <div class="form-group">
                <label for="product_name">Product Name*</label>
               <input type="text" id="title" name="product_name" class="form-control" value="{{ $product->product_name }}" disabled>
            </div>

            <div class="form-group">
                <label for="product_category">Product Category*</label>
                <select class="form-control form-select-lg mb-3" aria-label=".form-select-lg example" name="product_category" disabled>
                    <option value="null" disabled="">--Select Category--</option>
                      @foreach($category as $key => $pcategory)
                    <option value="{{ $pcategory->id}}" {{ $pcategory->id == $product->product_category ? 'selected' : '' }}>{{ $pcategory->name}}</option>
                      @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="designer_name">Designer Name*</label>

               <input type="text" id="title" name="designer_name" class="form-control" value="{{ $product->designer_name }}" disabled>
            </div>

            <div class="form-group">
                <label for="sizes_available">Sizes Available*</label>
               
                <select multiple class="form-control" name="sizes_available[]" disabled>
                    
                    @foreach($Sizes as $Size)
                        <option {{ (in_array($Size->size,$availablesizes)) ? 'selected' : '' }}>{{$Size->size}}</option>
                    @endforeach
                    

                </select>
            </div>

            <div class="form-group">
                <label for="color">Colors*</label>
                
                <table>
                    <tr>
                        <td>
                           <input type="text" class="form-control" name="color1" value="{{$product->color1}}" readonly/>
                        </td>
                        <td>
                           <input type="text" class="form-control" name="color2" value="{{$product->color2}}" readonly/>
                        </td>
                        <td>
                             <input type="text" class="form-control" name="color3" value="{{$product->color3}}" readonly/>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="color4" value="{{$product->color4}}" readonly/>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="color5" value="{{$product->color5}}" readonly/>  
                        </td>
                    </tr>
                </table>
            </div>

            
            @if(!empty($product->product_category) && $product->product_category == 4)
                {{-- product_category = 4 MEANS KIDS --}} 
                <?php $counter = 1; ?>
                @foreach($productPriceBySize as $key => $productPrice)
                    <div class="form-group rendered_price">
                        <label for="price">Price for 
                        <?php if($counter == 1)
                        {
                        echo '1st';
                        }
                        elseif($counter == 2)
                        {
                            echo '2nd';
                        }
                        elseif($counter == 3)
                        {
                            echo '3rd';
                        }
                        elseif($counter == 4)
                        {
                            echo '4th';
                        }
                        elseif($counter == 5)
                        {
                            echo '5th';
                        }
                        elseif($counter == 6)
                        {
                            echo '6th';
                        }
                        elseif($counter == 7)
                        {
                            echo '7th';
                        }
                        else
                        {
                            echo $counter;
                        }
                        ?>
                        size*</label>
                       <input type="text" id="title" name="price[]" class="form-control beforeUpdatedPrice" value="{{ $productPrice->price }}" disabled>
                    </div>
                    <?php $counter++ ?>
                @endforeach
            @else
                <div class="form-group">
                    <label for="price">Price*</label>
                   <input type="text" id="title" name="price" class="form-control" value="{{ $product->price }}" disabled>
                </div>
            @endif
            
            <div class="form-group">
                <label for="sku">SKU*</label>
               <input type="text" id="title" name="sku" class="form-control" value="{{ $product->sku }}" disabled>
            </div>
            {{--
            <div class="form-group">
                <label for="bust">Bust</label>
               <input type="text" id="title" name="bust" class="form-control" value="{{ $product->bust }}" disabled>
            </div>
            <div class="form-group">
                <label for="waist">Waist</label>
               <input type="text" id="title" name="waist" class="form-control" value="{{ $product->waist }}" disabled>
            </div>
            <div class="form-group">
                <label for="length">Length</label>
               <input type="text" id="title" name="length" class="form-control" value="{{ $product->length }}" disabled>
            </div>
            --}}
            <div class="form-group">
                <label for="fabric">Fabric*</label>
               <input type="text" id="title" name="fabric" class="form-control" value="{{ $product->fabric }}" disabled>
            </div>
            <div class="form-group">
                <label for="great_for">Great For*</label>
               <input type="text" id="title" name="great_for" class="form-control" value="{{ $product->great_for }}" disabled>
            </div>
            <div class="form-group">
                <label for="description">Description*</label>
               <textarea class="form-control" rows="3" name="description" disabled>{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="additional_info">Additional Info*</label>
               <input type="text" id="title" name="additional_info" class="form-control" value="{{ $product->additional_info }}" disabled>
            </div>
            <div class="form-group">
                <label for="technique">Technique*</label>
               <input type="text" id="title" name="technique" class="form-control" value="{{ $product->technique }}" disabled>
            </div>
            <div class="form-group">
                <label for="type_of_product">Type of product*</label>
               <select class="form-control form-select-lg mb-3" aria-label=".form-select-lg example" name="type_of_product" disabled>
                    <option value="null" disabled="">--Select Category--</option>
                      @foreach($subcategory as $key => $subcategory)
                    <option value="{{ $subcategory->id}}" {{ $subcategory->id == $product->type_of_product ? 'selected' : '' }}>{{ $subcategory->name}}</option>
                      @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="product_image">Product Images</label>
            </div>
            <div class="form-group">
                @foreach($images as $key => $image)
                    <img src="{{env('APP_URL')}}{{$image->url}}" style="width: 50px;height: 70px;margin-left: 10px;">    
                @endforeach
            </div>

            {{--<div class="row" id="best_seller" style="">
                <div class="col-lg-12 col-md-12 col-12">
                     <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}" >
                        <label for="name">Featured Images</label>
                        <input type="file" name="select_image[]" id="fileElem"  class="imgLeft form-control d-none" multiple="multiple">
                        <input type="file"  id="fileSelect"  class="imgLeft form-control" multiple="multiple">
                        <div class="error_file_text text-danger"><b>Select Only Ten Images</b></div>
                        <span class='text-danger error_msg'>Select Atleast 1 Image</span>
                    </div>
                </div>
                
                <div id="fileList">
                    <ul id="sortable">
        
                    </ul>
                </div>
                <div class="preview_btn" id="sequence" >Upload Images</div>
            </div>--}}

            <div class="form-group">
                <label for="in_stock">In Stock</label>
                <input type="radio" name="isoutofstock"  value="0" <?php echo ($product->outofstock == "0" ? 'checked="checked"': ''); ?> disabled>
                <br>
                <label for="in_stock">Out of Stock</label>
                <input type="radio" name="isoutofstock"  value="1" <?php echo ($product->outofstock == "1" ? 'checked="checked"': ''); ?> disabled>
            </div>


        </form>


    </div>
</div>

 



 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


 <style>
      .pctype-error{
          display:block !important;
      }
  </style>

  <script type="text/javascript">
  
  $(document).click(function(){
      $(".error_msg").hide();
      $("#pc_type").children(".error_msg").removeClass("pctype-error");
  })
  
  function validateform(){
      var shop_by_goal =    $("#shop_by_goal").val();
      var category = $("#category").val();
    //   var no_excuse_zone =       $("#no_excuse_zone").val();
    //   var flavour =        $("#flavour").val();
      var weight =       $("#weight").val();
    //   var gst  =       $("#gst").val();
      var description =         $("#description").val();
      var how_to_use =    $("#how_to_use").val();
      var sustainability =     $("#sustainability").val();
      var ingredients =         $("#ingredients").val();
      var nutrition=    $("#nutrition").val();
       var imagecount =    $("#sortable").children().length;
       
       
      if(shop_by_goal == null){
          $(".error_msg").hide();
         $("#shop_by_goal").focus();
          $("#shop_by_goal").siblings(".error_msg").show();
          return false;
      }else if(category == null){
          $(".error_msg").hide();
          $("#category").focus();
          $("#category").siblings(".error_msg").show();
          return false;
      }else if(weight == null){
          $(".error_msg").hide();
          $("#weight").focus();
          $("#weight").siblings(".error_msg").show();
          return false;
      }
    //   else if(gst == null){
    //       $(".error_msg").hide();
    //       $("#gst").focus();
    //       $("#gst").siblings(".error_msg").show();
    //       return false;
    //   }
      else if(imagecount == 0 ){
          $(".error_msg").hide();
          $("#fileSelect").focus();
          $("#fileSelect").siblings(".error_msg").show();
          return false;
      }
      return true;

  }
  
  
  
    $("#gst").change(function(e){
        var mrp = $("#mrp").val();
        var gst = $("#gst option:selected").val();
    
        var ga  = +mrp * +gst  ;
        var gb =   +gst + 100;
        var gstAmt = +ga / +gb;
     
        $("#gst").attr("GSTamount" , gstAmt );
   
    });

    $(".calculatesellingprice").blur(function(e){
        var discount = $("#discount").val();
        var mrp = $("#mrp").val();
        var selling_price = +mrp - (+mrp * +discount /100);
        $("#selling_price").val(selling_price.toFixed(2));
    });

    
  </script>
  <script>
          // product create img uploader

           const fileSelect = document.getElementById("fileSelect"),
            fileElem = document.getElementById("fileElem"),
            fileList = document.getElementById("fileList");

        fileSelect.addEventListener("click", function (e) {
          if (fileElem) {
            fileElem.click();
            $("#fileList").show();
          }
          e.preventDefault(); // prevent navigation to "#"
        }, false);

        fileElem.addEventListener("change", handleFiles, false);
        

        function handleFiles() {
          var uploadedImg = $("#sortable").children().length;
          var imgLimt = 10 - +uploadedImg ;
          if (!this.files.length > imgLimt) {
            fileList.innerHTML = "<p>No files selected!</p>";
          } 
          else if(this.files.length > imgLimt){
            alert("Upload Only "+imgLimt+" Images")
            
            swal({
              title: "Upload Only "+imgLimt+" Images",
              icon: "warning",
            });
          }
          else {
              
            $("#sortable").empty();
            const list = $("#sortable");
            
            for (let i = 0; i < this.files.length; i++) {
              const li = document.createElement("li");
                    li.className = "view-img";

                    list.append(li);

              const imgSelect = document.createElement("div");
                    imgSelect.className="imgmain-select";
              const deleteImg = document.createElement("div");
                    deleteImg.className="delete-img";
              const deleteIcon = document.createElement("i");
                    deleteIcon.className="fas fa-trash-alt";
                    deleteImg.setAttribute("onclick" , "$(this).deleteImg()");

                    li.appendChild(deleteImg);
                    deleteImg.appendChild(deleteIcon);
                    li.appendChild(imgSelect);

              const img = document.createElement("img");
                    img.src = URL.createObjectURL(this.files[i]);
              const input = document.createElement("input");
                    input.setAttribute("value" , this.files[i].name); 
                    input.className = 'imgInput';
                    input.type = 'text';
              var imgNum =    +[i] + 1 +uploadedImg;
                    input.name = "image"+imgNum;
                    li.setAttribute("title" , this.files[i].name); 
              
              
              img.onload = function() {
                URL.revokeObjectURL(this.src);
              }
              
            
              imgSelect.appendChild(img);
              const info = document.createElement("span");
              li.appendChild(info);
              li.appendChild(input);
               $("#sequence").show();
              $("#sequence").text("Upload Image");
            }
          }
        }


                $(".delete-img").click(function(){
                    var imgrow = $("#sortable").children().length;
                    if(imgrow > 1){
                         $(this).parent().remove();
                    }else{
                        swal({
                                title: "Last Image Cannot  Removed",
                                icon: "warning",
                        });
                    }
                  
                });
                
                
                   $(document).ready(function(){
                       $.fn.deleteImg = function(msg) {
                             $(this).parent().remove();
                             $("#sequence").text("Upload Images ");
                         }; 
                     });


                    $("#sequence").click(function(){
                        var current = 1;
                          $(".imgInput").each(function() {
                                  $(this).attr("serial", current);
                                  $(this).attr("name", "image"+current);
                                  current++;
                              }); 
                                    
                          $("#sequence").text("Uploaded Successfully");
                      })
      


           $('#product_type').change(function() {
              if ($(this).is(":checked")) {
                $(this).val(1);
                return;
              }else{
                  $(this).val(0);
              }
            });
            
            $('#new_arival').change(function() {
              if ($(this).is(":checked")) {
                $(this).val(2);
                return;
              }else{
                  $(this).val(0);
              }
            });
            
            
            var dealActive = 0;
             $('#deal_of_day').change(function() {
              if ($(this).is(":checked")) {
                $(this).val(3);
                dealActive = 1;
                return;
                
              }else{
                   dealActive = 0;
                  $(this).val(0);
              }
            });
            
            $("#offer").change(function(){
               var opt =  $("#offer option:selected").val();
               if( dealActive == 1 && opt == ""  ){
                   swal({
                          title: "Select Offer for DEAL OF THE DAY",
                          icon: "warning",
                        });
               }else{
                   
               }
            })
            
            
            
            
            
  </script>
      <script>
  $( function() {
    $( "#sortable" ).sortable({
        revert:         true,
        containment:    'parent',
        cursor:         'move',
        smooth:         true,
        opacity:        0.7,
        tolerance:      'pointer',
        update: function(event, ui) {
            $(this).sortable("serialize");
           $("#sequence").text("Uplaod Images ");
        }
        
    });

  } );
  </script>

<script type="text/javascript">
    $('#cp1').colorpicker();
</script>
<script type="text/javascript">
    $('#cp2').colorpicker();
</script>
<script type="text/javascript">
    $('#cp3').colorpicker();
</script>
<script type="text/javascript">
    $('#cp4').colorpicker();
</script>
<script type="text/javascript">
    $('#cp5').colorpicker();
</script>
    
@endsection