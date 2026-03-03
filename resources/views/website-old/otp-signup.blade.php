@include('website.header')
<style>
    .otp_popup_box {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    width: 100%;
}
section#mobile_num_Popup {
    padding: 8rem 20rem;
}
@media(max-width:575px){
    section#mobile_num_Popup {
    padding: 8rem 2rem;
}
}
</style>
<section class="mobilenumPopup" id="mobile_num_Popup">
    <div class="container">
        <div class="row">
            <div class="otp_popup_box">

                <div class="left-otp-image-box">
                    <div class="logo-container">
                        <img src="{{ url('website/images/home/icons/footer-logo.png') }}"
                            alt="">
                        <p class="logo-content">Start your fitness journey</p>
                    </div>
                </div>

                <div class="otp_content">
                    <div class="subscribe-new-area-detail">
                        <p class="h3 text-center" id="addcart_popup_text">Welcome to Just Go</p>
                        <form action="" id="otp_signup_mobile_form" method="post">
                            <div class="material-textfield">
                                <label>Enter Mobile Number</label>
                                <input placeholder="" type="number" name="mobile_num" class="mobile_num" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" required="">
                                <p><span id="mob-num-validation_otp" style="display:none;"></span></p>

                            </div>


                            <div class="otp-button-box">
                                <button type="submit" id="next" class="btn btn__text">Request OTP <span
                                        class="arrow">⟶</span></button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('website.footer')
<script>
    $('#otp_signup_mobile_form').on('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var mob_no = $(".mobile_num").val();
            var formData = {
                mobile: $(".mobile_num").val(),
                "_token": "{{ csrf_token() }}",

            };
            $.ajax({
                method: "post",
                url: "{{url('generate-otp')}}",
                data: formData,
                success: function(result) {
                    if (result.status == false) {
                        if (result.error.otp) {
                            $("#mob-num-validation_otp").show();
                            $("#mob-num-validation_otp").html(
                                '<label style="color: #dc3545;" class="control-label validation-message" for="inputError">' +
                                result.error.otp + '</label>');
                        } else if (result.error.mobile) {
                            $("#mob-num-validation_otp").show();
                            $("#mob-num-validation_otp").html(
                                '<label style="color: #dc3545;" class="control-label validation-message" for="inputError">' +
                                result.error.mobile + '</label>');
                        } else {
                            $("#mob-num-validation_otp").show();
                            $("#mob-num-validation_otp").html(
                                '<label style="color: #dc3545;" class="control-label validation-message" for="inputError">Something went wrong</label>'
                            );
                        }
                    } else if (result.status == true) {
                        $('#mobile_num_Popup').modal('hide');
                        $('#change_number').text(mob_no)
                        $('#mobile_otp_Popup').modal('show');
                    }
                }
            });
        });
</script>