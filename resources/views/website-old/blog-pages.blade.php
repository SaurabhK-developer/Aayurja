@include('website.header')
<section class="about-banner banner-area ">
   <img src="{{url('website/images/about-banner.png')}}">
   <div class="container">
      <div class="content-wrap">
         <h1 class="banner-title">  Blog </h1>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{url('/blog')}}"> Blog</a></li>
               @if(isset($category_name))
               <li class="breadcrumb-item active" aria-current="page"> {{@$category_name->name}}</li>
               @else
               <li class="breadcrumb-item active" aria-current="page">Popular</li>
               @endif
            </ol>
         </nav>
      </div>
   </div>
</section>
<section class="blog-detail">
   <div class="container">
      <div class="row">

      
      
      @if(isset($blog))
      <?php $wordCount = $blog->count(); ?>
    
             @foreach($blog as $blogs)
         <div class="col-lg-4 col-md-4 col-xs-12 blog-counting">
            <div class="blog-box">
               <a href="{{url('blog')}}/{{$blogs->slug}}">
                  <picture>
                     <img src="{{url('public/uploads/blog')}}/{{$blogs->image}}">
                  </picture>
                  <div class="blog-content">
                     <div class="blog-create">
                        <p><img src="{{url('website/images/author-imagee.png')}}"> By {{$blogs->author->name}}</p>
                        <p><i class="fa fa-calendar"></i><?php
                                    $date = $blogs->created_at->format('y-m-d');
                                    $dates= date('d,F,Y', strtotime($date)); 
                                ?>
                                {{$dates}}</p>
                     </div>
                     <h2 class="blog-title">
                     {{$blogs->title}}                     
                     </h2>
                  </div>
               </a>
            </div>
         </div>
		 @endforeach
      
		 
      </div>
      @if($wordCount > 6)
	  <div class="blog-more-wrap">
	  	  <a class="theme-btn2 theme-btn-custom" href="javascript:void(0)" id="blog-more">Load More</a>
	  </div>
     @endif


     @endif
	  
	  
   </div>
</section>
@include('website.footer')

<script>
$(document).ready(function(){
  $(".blog-counting").slice(0,6).show();
  $("#blog-more").click(function(e){
    e.preventDefault();
    $(".blog-counting:hidden").slice(0,3).fadeIn("slow");
       
    if($(".blog-counting:hidden").length == 0){
       $("#blog-more").fadeOut("slow");
      }
   
   
  });
})

</script>