@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
      Collections
    </div>

    <div class="card-body">
        <form action="{{ route("admin.currentprice.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
             <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Jewelry Type *</label>
                 {!! Form::select('meterial_id', $meterial, old('meterial_id'), ['class' => 'form-control', 'id'=>'material','required' => '']) !!}
                   
            </div>
            
            
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name"> purity (carat)*</label>
                <select id="purity" name="purity_id" class="form-control">
                        </select>
               
            </div>


            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                 <label for="slug">price*</label>
                 <input type="text" name="current_price" class="form-control" value="{{ old('current_price', isset($currentprice) ? $currentprice->current_price : '') }}" required>
                </select>  
            </div>
         
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                  <input class="btn btn-danger" type="button" value="Back" onClick="window.location.href = '{{ url("/admin/currentprice") }}'">
            
            </div>
        </form>


    </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
});
</script>