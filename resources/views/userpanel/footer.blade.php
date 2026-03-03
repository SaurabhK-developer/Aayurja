<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
<script src="js/{{url('public/userpanel/js/custom.js')}}"></script>


<script>
$("#contact_code").intlTelInput({
    initialCountry: "in",
    separateDialCode: true,
});
</script>


<script>
$(document).ready(function() {
    $(".hamburger-icon").click(function() {
        $("body").addClass("active-menu");
    });

    // to remove a class
    $(".aside-trigger").click(function() {
        $("body").removeClass("active-menu");
    });
});
</script>
</body>

</html>