@include('website.header')

<section class="sub-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="sub-header-content">
                    <label>About Us</label>
                    <div class="page-breadcrum white-text">
                      <p><a href="{{url('/')}}">Home </a> |    </p>
                      <p >    &nbsp; About Us </p>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--------->

<section class="aboutpage-head top-space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <img src="{{url('public/images/about-text.webp')}}" class="about-text" alt="text" loading="lazy">
                <h1 class="heading">Pure Nutrition <br>Backed by Science</h1>
                <p>Our mission began with the goal of offering holistic nutrition solutions that are trustworthy, natural, and effective.</p>
                <p>We combine products backed by ancient wellness traditions with modern scientific advancements to create superfoods that deliver multifaceted benefits.</p>
                <p>We believe in a comprehensive approach to health. Explore how our products are designed to nourish, sustain, and fortify—ensuring lasting wellness.</p>
                <p>We stand by our promise of delivering wholesome nutrition without compromise, ensuring that each of our solutions provides real, tangible results.</p>
            </div>
        </div>
    </div>

    <img src="{{url('public/images/popular-vector.webp')}}" class="abouthead-1" alt="vector" loading="lazy">
    <img src="{{url('public/images/about-vector.png')}}" class="abouthead-2" alt="vector" loading="lazy">
</section>

<!--------->

<section class="aboutpage-brand">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7">
                <h2 class="heading">Our Story</h2>
                
                <p>Founded with the vision to craft holistic wellness solutions, A glorious pursuit from <b>Reshita Overseas LLP</b>. we are committed to providing natural, honest, and effective nutrition.</p>

                <p>Blending ancient practices with modern science, we create superfood products that support well-being on multiple levels.</p>

                <p>We believe true health is comprehensive. Our formulations not only nourish but protect and rejuvenate, offering lasting benefits.</p>

                <p>Our commitment remains unchanged: delivering natural, wholesome nutrition that works, bringing real results to those who seek the best in wellness.</p>
            </div>
        </div>
    </div>

    <img src="{{url('public/images/about-brand.webp')}}" class="aboutbrand-image" alt="about" loading="lazy">
    <img src="{{url('public/images/lotus-icon.webp')}}" class="aboutbrand-vector" alt="vector" loading="lazy">
</section>

<!--------->

<!-- <div class="main-fixed-slider">
  <div class="container">
  <div class="fixed-slider">
  @if(count($limitFourproducts) > 0)
    @foreach($limitFourproducts as $key => $limitFourproducts)
      <div class="vertical-slide">
        <div class="hydra-col">
          <div class="section__img">
            <div class="section__img__inner">
            <a href="{{url('product')}}/{{@$limitFourproducts->slug}}"><img src="{{url('public')}}/uploads/product/{{$limitFourproducts->list_image}}" alt="{{$limitFourproducts->product_name}}" />  </a> 

            </div>
          </div>
          <div class="section__body">
            <div class="section__text">
              <h2>
                {{$limitFourproducts->product_name}}
              </h2>
              <div class="price-wrap">
                <span>
                  <strong>₹{{number_format($limitFourproducts->variants_price->selling_price)}}</strong>
                </span>
                <span>
                  <del>₹{{number_format($limitFourproducts->variants_price->price)}}</del>
                </span>
                @if($limitFourproducts->variants_price->discount!=0 or $limitFourproducts->variants_price->discount='')  <span class="off-items">({{$limitFourproducts->variants_price->discount}}% off)</span> @endif
              </div>
              <div class="review-wrap">
                <div class="review-icon">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
                <div class="review-txt">
                  <p>299 ratings</p>
                </div>
              </div>
              @if(Auth()->check())
                @if($limitFourproducts->outofstock == 0)
                <div class="button-wrap">
                  <a href="javascript::void(0)" class="theme-button submitbtnbyclass" data-weight="{{$limitFourproducts->variants_size->weight}}" data-quantity="1" data-productid="{{$limitFourproducts->id}}" data-productname="{{$limitFourproducts->product_name}}" data-sellingprice="{{number_format($limitFourproducts->variants_price->selling_price)}}" data-image="{{url('public')}}/uploads/product/{{$limitFourproducts->list_image}}">
                    <img src="{{url('public/images/shopping-icon.png')}}" /> Add to cart
                  </a>
                </div>
                @else
                <div class="button-wrap">
                  <a class="theme-button">
                    <img src="{{url('public/images/shopping-icon.png')}}" /> Out of Stock
                  </a>
                </div>
                @endif
              @else
                @if($limitFourproducts->outofstock == 0)
                <div class="button-wrap">
                  <a class="theme-button" data-toggle="modal" data-target="#loginModel" href="#">
                    <img src="{{url('public/images/shopping-icon.png')}}" /> Add to cart
                  </a>
                </div>
                @else
                <div class="button-wrap">
                  <a class="theme-button" >
                    <img src="{{url('public/images/shopping-icon.png')}}" /> Out of Stock
                  </a>
                </div>
                @endif
              @endif


              
            </div>
          </div>
        </div>
      </div>
      @endforeach
      @endif
  </div>
  </div>
</div> -->

<!--------->

<!----Video Section----->

<div class="homepage-video">
    <!-- <img src="{{url('public/images/video-thumbnail.webp')}}" class="video-thumb" alt="video" /> -->

    <video class="video" loop playsinline muted>
        <source src="{{url('public/video/aayurja.mp4')}}" type="video/mp4">
    </video>

    <div class="playpause">
        <a class="video-play-button" href="javascript:void(0);"><span></span></a> 
    </div>
</div> 

<!--------->

<section class="aboutpage-form">
   <div class="container">
      <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="aboutpage-benefit">
                  <span class="sub-heading">Benefit</span>
                  <h3 class="heading">Unlock Nature’s Power for Your Well-Being</h3>
                  
                  <p>Our premium superfoods harness the natural vitality of earth’s treasures, delivering the essential nutrients your body craves.</p>

                  <div>
                      <img src="{{url('public/images/benefit-icon-1.webp')}}" alt="benefit" loading="lazy">
                      <p><span>Authentic Organic Goods</span>Derived from sustainable farming that focuses on soil health, biodiversity, and farmer welfare.</p>
                  </div>

                  <div>
                      <img src="{{url('public/images/benefit-icon-2.webp')}}" alt="benefit" loading="lazy">
                      <p><span>Uncompromising Purity</span>Our commitment to transparency ensures each product is pure, natural, and beneficial for your health.</p>
                  </div>

                  <div>
                      <img src="{{url('public/images/benefit-icon-3.webp')}}" alt="benefit" loading="lazy">
                      <p><span>Eco-Friendly Sourcing</span>We prioritize environmental sustainability, sourcing each ingredient with respect for the earth and its resources.</p>
                  </div>
              </div>
            </div>

           <div class="col-lg-6 col-md-6">
              <div class="siteform-box">
                  <span class="sub-heading">Benefit</span>
                  <h4 class="heading">Fill out this form for booking online</h4>  

                  <form class="query_form" action="{{url('contact-save')}}" method="POST">
                    @csrf
                    <input type="hidden" name="source_url" value="" id="source_url" class="source_url">
                      <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-field">
                                <input type="text" class="form-control" name="name" id='fname' placeholder="Full Name" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' required="required">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                          <div class="form-field">
                              <input type="tel" class="form-control" name="mobile" id="phoneno" placeholder="Phone Number" minlength="10" maxlength="10"onkeydown="return ( event.ctrlKey || event.altKey
                                 || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                                 || (95<event.keyCode &amp;&amp; event.keyCode<106)
                                 || (event.keyCode==8) || (event.keyCode==9)
                                 || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                                 || (event.keyCode==46) )" required="" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off required="required"/>
                          </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-field">
                                <input type="Email" name="email" id="email" placeholder="Email Address" class="form-control" required="required">
                            </div>
                       </div>

                       <div class="col-lg-6 col-md-6">
                        <div class="form-field">
                            <select name="product" id="product" class="form-control disable-field" required="require">
                                <option value="" disabled="" selected="">Select Product</option>
                                <option value="Mushroom">Mushroom</option>
                                <option value="Shilajit">Shilajit</option>
                                <option value="Honey">Honey</option>
                            </select>
                        </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-field">
                                <select name="product_weight" id="product_wt" class="form-control disable-field" required="required">
                                    <option value="" disabled="disabled" selected="">Select Weight</option>
                                    <option value="50 GM">50 GM</option>
                                    <option value="100 GM">100 GM</option>
                                    <option value="250 GM">250 GM</option>
                                    <option value="500 GM">500 GM</option>
                                    <option value="1 KG">1 KG</option>
                                    <option value="2 KG">2 KG</option>
                                    <option value="3 KG">3 KG</option>
                                </select>
                            </div>
                        </div>

                       <div class="col-lg-6 col-md-6">
                            <div class="qty-container">
                                <button class="qty-btn-minus" type="button"><i class="fa fa-minus"></i></button>
                                <input type="text" name="product_quantity" value="1" class="input-qty form-control" required="required"/>
                                <button class="qty-btn-plus" type="button"><i class="fa fa-plus"></i></button>
                            </div>
                       </div>

                       <div class="col-lg-12">
                            <div class="form-field">
                                <textarea id="message" placeholder="Message" name="msg" class="form-control" required="required"></textarea>
                            </div> 
                       </div>

                       <div class="col-lg-12 col-md-12">
                          <button type="submit" class="theme-button">Book Online</button> 
                       </div>
                    </div>
                  </form>
              </div>
           </div>
      </div>
   </div>

   <img src="{{url('public/images/popular-vector.webp')}}" class="aboutform" alt="vector" loading="lazy">
</section>

<!--------->

<section class="testimonial-section top-space">
  <div class="container">

  <div class="heading-section">
            <h5 class="heading">
              Customer Cheers<br />
              Wellness Reviews
            </h5>
          </div>
    <div class="testimonial-slider">   

      <div class="testimonial-col">
        <div class="testimonial-inn">
         
          <img
            class="quotes-wrap"
            src="{{url('public/images/quotes-icon.png')}}"
            alt="Seller"
          />
          <p>
          Aayurja’s Gucchi Mushrooms have transformed my cooking! Their rich, earthy flavour elevates every dish, and I love knowing they’re packed with nutrients. Highly recommended!
          </p>
          <div class="name">Priya Mehta</div>
        </div>
      </div>
      <div class="testimonial-col">
        <div class="testimonial-inn">
        
          <img
            class="quotes-wrap"
            src="{{url('public/images/quotes-icon.png')}}"
            alt="Seller"
          />
          <p>
          The Aayurja Shilajit has been a lifesaver for my energy levels. Since I started taking it, I feel more focused and alert throughout the day. Natural and effective!
          </p>
          <div class="name">Rahul Singh</div>
        </div>
      </div>
      <div class="testimonial-col">
        <div class="testimonial-inn">
          
          <img
            class="quotes-wrap"
            src="{{url('public/images/quotes-icon.png')}}"
            alt="Seller"
          />
          <p>
          I love the pure sweetness of Aayurja Honey. It’s the perfect addition to my morning tea, and it feels great to consume something so natural and unprocessed.
          </p>
          <div class="name">Sunita Arora</div>
        </div>
      </div>
    </div>
  </div>
</section>


@include('website.footer')
