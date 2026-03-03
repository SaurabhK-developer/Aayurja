<!DOCTYPE HTML>
<html lang="en">
<head>
  <title>Archade</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{url('website/assets/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('website/assets/css/slick.css')}}" rel="stylesheet">
  <link href="{{url('website/assets/css/jquery.countdown.css')}}" rel="stylesheet">
  <link href="{{url('website/assets/fonts/font-awesome.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/v4-shims.css">
  <link href="{{url('website/assets/css/style.css')}}" rel="stylesheet">
  <link href="{{url('website/assets/css/thank.css')}}" rel="stylesheet">
   <link href="{{url('website/assets/css/add-cart.css')}}" rel="stylesheet">
  <link href="{{url('website/assets/css/product-list.css')}}" rel="stylesheet">
  <link href="{{url('website/assets/css/login.css')}}" rel="stylesheet">
  <link href="{{url('website/assets/css/press-release.css')}}" rel="stylesheet">
  <link href="{{url('website/assets/css/blog.css')}}" rel="stylesheet">
  <link href="{{url('website/assets/css/designer.css')}}" rel="stylesheet">
  <!-- <link href="{{url('website/assets/css/add-cart.css')}}" rel="stylesheet"> -->
  <link href="{{url('website/assets/css/responsive.css')}}" rel="stylesheet">

</head>

<body>
    <div class="aside-overlay aside-trigger"></div>
    
    <!--sec-error start-->
    <section class="sec-error">
        <div class="container">
          <div class="sec-error-main">
              <div class="sec-error-content1">
                  <h2>OOps</h2>
                  <p>The page you are looking for cannot be found</p>
                  <a href="{{url('/contact-us')}}" class="error-contact">Contact Us</a>
                  
              </div>
                <div class="sec-error-content2">
                    <a href="{{url('/')}}" class="theme_btn">Go to homepage</a>
                </div>
              
          </div>
          <!--sec-error-main end-->
        </div>
        
    </section>
    <!--sec-error end-->
   
     
     
  
    <!--Scripts-->
    <script type="text/javascript" src="{{url('website/assets/js/jquery-3.4.1.min.js')}}"></script>
    <script type="text/javascript" src="{{url('website/assets/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{url('website/assets/js/bootstrap.min.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js')}}"></script>
    <script type="text/javascript" src="{{url('website/assets/js/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{url('website/assets/js/jquery.countdown.min.js')}}"></script>
    <script src="{{url('website/assets/js/main.js')}}"></script>
    <script src="{{url('website/assets/js/custom.js')}}"></script>
     <script src="{{url('website/assets/js/slide.js')}}"></script>
    
    <script>
        function wcqib_refresh_quantity_increments() {
    jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
        var c = jQuery(b);
        c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
    })
}
String.prototype.getDecimals || (String.prototype.getDecimals = function() {
    var a = this,
        b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
    return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
}), jQuery(document).ready(function() {
    wcqib_refresh_quantity_increments()
}), jQuery(document).on("updated_wc_div", function() {
    wcqib_refresh_quantity_increments()
}), jQuery(document).on("click", ".plus, .minus", function() {
    var a = jQuery(this).closest(".quantity").find(".qty"),
        b = parseFloat(a.val()),
        c = parseFloat(a.attr("max")),
        d = parseFloat(a.attr("min")),
        e = a.attr("step");
    b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
});
    </script>
    
</body>
    
</html>