@include('website.header')
<section class="about-banner banner-area ">
   <img src="{{url('website/images/about-banner.png')}}">
   <div class="container">
      <div class="content-wrap">
         <h1 class="banner-title"> Contact Us </h1>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="/">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page"> <a href="/contact-us"> Contact Us</a></li>
            </ol>
         </nav>
      </div>
   </div>
</section>
<section class="contact-wrapper">
   <div class="container">
      <div class="row">
         <div class="col-md-7">
            <div class="about-b2b-content contact">
               <h4>Contact Us</h4>
               <div class="footer_link footer_address">
                  <ul>
                     <li>
                     
                           <i class="fa fa-map-marker" aria-hidden="true"> </i>
                           <p><b>CORPORATE OFFICE</b>
                              511, Udyog Vihar Phase V, Sector 19, <br>Gurugram, Haryana 122016
                              
                           </p>
                      
                     </li>
                     <li>
                       
                           <i class="fa fa-map-marker" aria-hidden="true"> </i>
                           <p><b>OPERATIONAL OFFICE</b>
                              Mango Nutraceuticals Pvt Ltd
                              Plot No : GR - 166B-167A, GDIA, <br>Bahadurgarh, Distt. Jhajjar, Haryana - 124507
                           </p>
                    
                     </li>
                     <li>
                        <a href="mailto:helpdesk@justgonutrition.com">
                           <i class="fa fa-envelope" aria-hidden="true"></i>  
                           <p class="email">helpdesk@justgonutrition.com</p>
                        </a>
                     </li>
                     <li>
                        <a href="tel:8595122207">
                           <i class="fa fa-phone" aria-hidden="true"></i>  
                           <p>+91-8595122207</p>
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-md-5">
		 <div class="contact-image">
		 <img src="{{url('website/images/contact-image.png')}}" class="">
		 </div>
            
         </div>
      </div>
   </div>
   <div class="b2b-product-image">
      <img src="{{url('website/images/section1-bg-image.png')}}" class="">
    </div>
</section>



@include('website.footer')