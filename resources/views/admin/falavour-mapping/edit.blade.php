@extends('layouts.admin')
@section('content')
<style>
    .click-border:hover{
    outline: black solid 2px;
}
</style>
<div class="card">
    <div class="card-header">
        Flavour mapping
    </div>

    <div class="card-body">
        <form action="{{ route("admin.flavours.update", [$flavourmappings->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Product*</label>
                  
                <input type="text"  class="form-control" value="{{$flavourmappings->productdetails->product_name}}" readonly>    
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Flavour name*</label>
                <input type="text" id="flavour" name="flavour" class="form-control" value="{{ $flavourmappings->flavour}}" required>
            </div>
            <div class="form-group">
                <label for="name">Select Flavour Image*</label>
                <input type="hidden" name="image_id" id="image_id" value="">
                <div class="row" id="product_images">
                    @foreach($images as $img)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-6 click-border" onclick="addImageClass(this,{{$img->id}})" @if($img->id == $flavourmappings->image_id) style="outline: black solid 2px;" @endif style="margin-bottom:15px;">
                        <img style="width: 100%;"  src="{{url('public')}}/{{$img->url}}">
                    </div>
                    @endforeach
                </div>
            </div>
           <div class="col-lg-4 col-md-3 col-6">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="outofstock">Out of stock*</label>
                    <input type="checkbox" id="outofstock"  @if($flavourmappings->out_of_stock == 1) checked value="1" @else value="0" @endif  name="out_of_request" class="form-control">
                </div>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                 <input class="btn btn-danger" type="button" value="Back" onClick="window.location.href = '{{ url("/admin/flavours") }}'">
            
            </div>
        </form>


    </div>
</div>

@endsection
@section('scripts')
<script>
function addImageClass(obj,id){
    console.log(id)
    classvalue=$(obj).attr('class');
    $('.click-border').css({"outline": "none"});
    $(obj).css({"outline": "black solid 2px"})
    $('#image_id').val(id)
}
$( document ).ready(function() {
    $('#outofstock').on('change', function(){
   this.value = this.checked ? 1 : 0;
   // alert(this.value);
}).change();
});
</script>
@endsection