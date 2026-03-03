@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<div class="card">
    <div class="card-header">
     Create Influencer
    </div>

    <div class="card-body">
        <form action="{{ route("admin.referinfluencer.store") }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" value="{{$maxID}}" id="max_id">

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="fname">First Name*</label>
               <input type="text" id="fname" name="fname" class="form-control"  required>  
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="lname">Last Name*</label>
               <input type="text" id="lname" name="lname" class="form-control"  required>  
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="mobile">Mobile Number*</label>
               <input type="text" id="mobile" name="mobile" class="form-control"  required>  
            </div>

            <!-- <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="referral_code">Referral Code</label>
               <input type="text" id="referral_code" name="referral_code" class="form-control" value=""  readonly>  
            </div> -->

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="discount_type">Discount Type*</label>
                <select name="discount_type" id="discount_type" class="form-control" required>
                    <option value="discount_percentage">Discount Percentage</option>
                    <option value="discount_flat">Discount Flat</option>
                </select>
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="discount">Discount*</label>
               <input type="text" id="discount" name="discount" class="form-control" value="0" required>  
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="valid_from">Valid From*</label>
               <input type="date" id="valid_from" name="valid_from" class="form-control" value="{{ date('Y-m-d') }}" required>  
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="valid_upto">Valid Upto*</label>
               <input type="date" id="valid_upto" name="valid_upto" class="form-control" required>  
            </div>
            
             
             
             <!-- <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name"> Description*</label>
                {!! Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                  <script>
                                CKEDITOR.replace('description');
                            </script>
            </div> -->
        
             <!-- <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Featured Image*</label>
                <input type="file" name="image" required class="imgLeft form-control"> 
            </div> -->
            
            
          
            
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                 <input class="btn btn-danger" type="button" value="Back" onClick="window.location.href = '{{ url("/admin/referinfluencer") }}'">
            </div>
        </form>


    </div>
</div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        // $('#fname').on('input', function() {
        //     // Convert the input to uppercase and replace spaces with hyphens
        //     let name = $(this).val().toUpperCase().replace(/\s+/g, '-');
        //     var maxID = $('#max_id').val();
        //     if (name.length > 0) {
        //         let currentYear = new Date().getFullYear();
        //         let referralCode = name + '-' + currentYear + (parseInt(maxID) + 1);
        //         $('#referral_code').val(referralCode);
        //         console.log('aaa');
        //     } else {
        //         $('#referral_code').val('');
        //         console.log('bbb');
        //     }
        // });



        $('#mobile').on('input', function() {
            // Replace any non-numeric characters with an empty string and limit input to 10 characters
            let sanitizedValue = this.value.replace(/[^0-9]/g, '');
            if (sanitizedValue.length > 10) {
                sanitizedValue = sanitizedValue.substring(0, 10);
            }
            this.value = sanitizedValue;
        });
    });

    
</script>