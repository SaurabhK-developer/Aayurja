@include('website.header')

<section class="error-page thankyou-page survey-thank top-space">
    <div class="errorpage-content container">
        <div>
            <img src="{{url('public/images/thankyou.webp')}}" class="img-responsive" alt="thanks" loading="lazy"/>
       
            <h1 class="heading">Thank You for Your Feedback!</h1> 
            <p>We appreciate you taking the time to complete our survey. Your input helps us improve and serve you better.</p>

            <h2 class="heading">Exclusive Offers Await You!</h2> 
            <p>As a token of our appreciation, click the button below to explore our latest offers and deals only for you.</p>
     
            <!-- <a href="https://aayurja.com/product/organic-gucchi-mushrooms-a-natural-source-of-health-benefits-100gm-offer" class="theme-button">Buy Now</a> -->
             <button id="openProductBtn" class="theme-button">Buy Now</button>
        </div> 
    </div>

    <img src="{{url('public/images/popular-vector.png')}}" class="errorvector-1" alt="vector" loading="lazy">
    <img src="{{url('public/images/lotus-icon.png')}}" class="errorvector-2" alt="vector" loading="lazy">
    <img src="{{url('public/images/award-vector.png')}}" class="errorvector-3" alt="vector" loading="lazy">
</section>

@include('website.footer')


<script>
document.getElementById("openProductBtn").addEventListener("click", function() {
    // Define the URL slug for the exclusive product
    const slug = "organic-gucchi-mushrooms-a-natural-source-of-health-benefits-100gm-offer";
    const baseUrl = "https://aayurja.com/product/";
    
    // Generate a random token
    const token = Math.random().toString(36).substring(2);

    sessionStorage.setItem("token", token);

    var newToken = sessionStorage.getItem("token");

    // var manual_token = "{{ session('manual_token') }}";
    
    // Store the token in the session (use a server-side method if applicable)
    // For demo purposes, we will set the token as a query parameter
    const productUrl = `${baseUrl}${slug}?token=${newToken}`;
    
    // Redirect the user to the protected product page
    window.location.href = productUrl;
});



//AUTO REDIRECT
$(document).ready(function() {
    setTimeout(function() {
        const slug = "organic-gucchi-mushrooms-a-natural-source-of-health-benefits-100gm-offer";
        const baseUrl = "https://aayurja.com/product/";
    
        const token = Math.random().toString(36).substring(2);

        sessionStorage.setItem("token", token);

        var newToken = sessionStorage.getItem("token");
        const productUrl = `${baseUrl}${slug}?token=${newToken}`;
        
        window.location.href = productUrl;
    }, 3000);
});
</script>