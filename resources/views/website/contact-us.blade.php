@include('website.header')
<!-- blog Banner -->
<section class="contact-section">
    <div class="container-wrap container">
        <div class="row align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-6 col-left">
                <div class="content-wraps new-content">
                    <h1 class="category-title heading">Contact Support</h1>
                    <p>Looking for help with nutrition? Let us know-we’re here for you with holistic solutions tailored to your needs.</p>
                    <div class="contact-address">
                        <div class="left-wraps">
                            <img src="{{url('public/images/mail-icon.webp')}}" alt="Call">
                            <div class="textt">
                                Call Us
                                <a href="tel:+91-8057244477">+91-7055433886 </a>
                            </div>
                        </div>
                        <div class="right-wraps">
                            <img src="{{url('public/images/mail-icon2.webp')}}" alt="Mail">
                            <div class="textt">
                                Email
                                <a href="mailto:helpdesk@aayurja.com">info@aayurja.com </a>
                            </div>
                        </div>
                    </div>

                    <div class="contact-address">
                        <div class="left-wraps left-full-width-wrap">
                            <img src="{{url('public/images/locate-icon.webp')}}" alt="Location">
                            <div class="textt">
                                Address
                                 <p>
                                    <!-- <strong>Building No./Flat No.:</strong>  -->
                                 C/o Reshita Overseas LLP,
                                <!-- <strong>Name Of Premises/Building:</strong> -->
                                Kashipur Road,
                                <!-- <strong>Road/Street: </strong> -->
                                Shivlalpur Pandey,
                                <!-- <strong> Nearby Landmark: </strong>  -->
                                Near Reliance Petrol Pump,
                                <!-- <strong> City/Town/Village:  </strong> -->
                                Ramnagar,
                                <!-- <strong>District: </strong> -->
                                 Nainital  State: Uttarakhand,
                                <!-- <strong>PIN Code: </strong>  -->
                                244715

                            </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-right">
                <div class="contact-img wow  fadeInRight">
                    <img src="{{url('public/images/contact-img.webp')}}" alt="Contact">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="faq-section ">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="form-section wow  fadeInLeft">
                    <h2 class="heading">Get in touch</h2>
                    <p>
                        Let us know how we can help by completing the form. We typically respond in 1 - 2 business days.
                    </p>
                    {{-- <form action="{{url('contact-save')}}" method="post"> --}}
                       <form id="contactForm" onsubmit="return submitContactForm(event)">

                        @csrf
                        <input type="hidden" name="source_url" value="" id="source_url" class="source_url">
                        <input type="hidden" name="formtype" value="contact" class="formtype">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="">Your Name*</label>
                                <input class="form-control" placeholder="" id="name" type="text" name="name" required="required">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="">Mobile*</label>
                                <input type="tel" class="form-control" name="mobile" id="phoneno" placeholder="" minlength="10" maxlength="10"onkeydown="return ( event.ctrlKey || event.altKey
                                || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                                || (95<event.keyCode &amp;&amp; event.keyCode<106)
                                || (event.keyCode==8) || (event.keyCode==9)
                                || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                                || (event.keyCode==46) )" required="" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off required="required"/>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="">Enter Email*</label>
                                <input class="form-control" placeholder="" id="email" type="email" name="email" required="required">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                              
                                <label for="">Message</label>
                                <textarea name="message" class="form-control" id="" cols="30" rows="1" placeholder="" required="required"></textarea>
                            </div>
                        </div>

                         <div class="form-group col-lg-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="consent" name="consent" required>
                                <label class="form-check-label" for="consent">
                                    I agree to the <a href="/terms-and-conditions" target="_blank">Terms & Conditions</a> and consent to receive emails from Aayurja.
                                </label>
                            </div>
                        </div>

                         <!-- Google reCAPTCHA  -->
                              <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.siteKey') }}"></div>
                                <span class="text-danger" id="recaptcha-error"></span> {{-- Always present --}}
                            </div>



                        <button class="theme-button" type="submit" onclick="submitContactForm()">
                            <span>Submit</span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="faq-inner wow  fadeInUp">
                    {{-- <form class="search-container">
                        <input class="searchInput form-controls" placeholder="Search our FAQs" type="text" autocomplete="off">
                        <button class="search-icon">
                            <svg class="svg-inline--fa fa-magnifying-glass" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="magnifying-glass" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"></path>
                            </svg>
                        </button>
                    </form> --}}
                    <h3 class="category-title">Top FAQ’s</h3>
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="heading-1">
                                <h5 class="title">
                                    <a role="button" data-toggle="collapse" href="#faq-1" aria-expanded="true" aria-controls="faq-1">
                                    My coupon code isn't working, what do I do?
                                    </a>
                                </h5>
                            </div>
                            <div id="faq-1" class="collapse show" data-parent="#accordion" aria-labelledby="heading-1">
                                <div class="card-body">
                                    <p>We’re sorry for any trouble with your coupon code. Please make sure the code is entered correctly at checkout. If it still doesn’t work, contact customer support for assistance.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card">
                            <div class="card-header" id="heading-2">
                                <h5 class="title">
                                    <a class="collapsed" role="button" data-toggle="collapse" href="#faq-2" aria-expanded="false" aria-controls="faq-2">
                                        How long does it take to personalize my order?
                                    </a>
                                </h5>
                            </div>
							
                            <div id="faq-2" class="collapse" data-parent="#accordion" aria-labelledby="heading-2">
                                <div class="card-body">
                                    <p>Commercial properties offer long-term appreciation potential and can generate steady rental income compared to residential properties.
                                    </p>
                                </div>
                            </div>
                        </div> -->
                        <div class="card">
                            <div class="card-header" id="heading-3">
                                <h5 class="title">
                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                    How long will it take to receive my order?
                                    </a>
                                </h5>
                            </div>
                            <div id="collapse-3" class="collapse" data-parent="#accordion" aria-labelledby="heading-3">
                                <div class="card-body">
                                    <p>Most orders are processed within 2-3 business days, and delivery times vary depending on your location.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="heading-4">
                                <h5 class="title">
                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                    Can I return or exchange my item?
                                    </a>
                                </h5>
                            </div>
                            <div id="collapse-4" class="collapse" data-parent="#accordion" aria-labelledby="heading-4">
                                <div class="card-body">
                                    <p>Yes, items can be returned or exchanged within 30 days of purchase, provided they are in original condition.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="heading-5">
                                <h5 class="title">
                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                    What payment methods are accepted?
                                    </a>
                                </h5>
                            </div>
                            <div id="collapse-5" class="collapse" data-parent="#accordion" aria-labelledby="heading-5">
                                <div class="card-body">
                                    <p>We accept all major credit cards, PayPal, and digital wallets.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!---------->

@include('website.footer')


<script>
    $(document).ready(function() {
        $('#name').on('input', function() {
            // Allow only alphabets and spaces
            var sanitizedValue = $(this).val().replace(/[^a-zA-Z\s]/g, '');

            // Update the input field value
            $(this).val(sanitizedValue);
        });
    });
</script>

<script>
function submitContactForm(event) {
    event.preventDefault(); // Prevent default form submit

    const recaptchaResponse = grecaptcha.getResponse();
    if (recaptchaResponse.length === 0) {
        $("#recaptcha-error").text("Please complete the reCAPTCHA.");
        return false;
    } else {
        $("#recaptcha-error").text("");
    }

    let form = document.getElementById("contactForm");
    let formData = new FormData(form);

    $.ajax({
        url: "{{ url('/contact-save') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,

        success: function (response) {
            if (response.success) {
                $('#contactForm')[0].reset();
                grecaptcha.reset();

                // Redirect to thank-you page
                window.location.href = "{{ route('thankyou') }}";
            } else {
                alert(response.message || "Something went wrong.");
            }
        },

        error: function (xhr) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;

                // Show reCAPTCHA error if present
                if (errors['g-recaptcha-response']) {
                    $("#recaptcha-error").text(errors['g-recaptcha-response'][0]);
                }

                // Show all errors in alert
                let allErrors = Object.values(errors).map(e => e[0]).join("\n");
                // alert("Please fix the following:\n" + allErrors);
            } else {
                // alert("Unexpected error occurred.");
            }
        }
    });

    return false; // Prevent actual form submission
}
</script>



