@include('website.header')

 
<section  class="blog-details-section">
<div class="post-pagination">
   @if(isset($p_blog))
<a href="{{url('blog')}}/{{$p_blog->slug}}" class="previous-arrow">Previous  Article</a>
@endif
@if(isset($n_blog))
<a href="{{url('blog')}}/{{$n_blog->slug}}" class="next-arrow">Next  Article</a>
@endif
</div>


   <div class="container">
      <div class="row">
         <div class="col-md-12 col-lg-8 ">
            <div class="blog-details-left">
          
               <div class="details-image">
                  <img src="{{url('public/uploads/blog')}}/{{$blog->image1}}">
               </div>
               <div class="autor-section">
                  <div class="image-section">
                     <img src="{{url('website/images/fruits-author.png')}}">
                  </div>
                  <div class="author-name">
                  {{$blog->author->name}}
                  </div>
                  <div class="date">
                        <?php
                                    $date = $blog->created_at->format('y-m-d');
                                    $dates= date('d, F ,Y', strtotime($date)); 
                                ?>
                                {{$dates}}
                  </div>
               </div>
               <div class="detail-content">
                  <h1>{{$blog->title}}</h1>
                  <p>{!!$blog->description!!}</p>
                  <div class="detail-img row">
                     <div class="col-xs-6 col-sm-6">
                        <div class="detail-img details-image">
                           <img src="{{url('public/uploads/blog')}}/{{$blog->image2}}">
                        </div>
                     </div>
                     <div class="col-xs-6 col-sm-6">
                        <div class="detail-img details-image">
                           <img src="{{url('public/uploads/blog')}}/{{$blog->image2}}">
                        </div>
                     </div>
                  </div>
                 <p>
                 <p>{!!$blog->description2!!}</p>
                  
                  <div class="details-bottom-img details-image">
                     <img src="{{url('public/uploads/blog')}}/{{$blog->image4}}">
                  </div>
                  <p>{!!$blog->description3!!}</p>
                 <!-- <p>Etiam et neque nec ipsum viverra pretium. Duis dui quam, convallis eu urna in, varius aliquam sem. Duis aliquet diam in pulvinar placerat. Curabitur metus magna, dignissim ut nisi vehicula, blandit maximus velit. Nulla iaculis, leo vel imperdiet bibendum, urna ante mollis mi, vel pulvinar dolor mauris eget dolor. Nunc non mauris purus. Vivamus quis sapien porta, tempor libero et, imperdiet metus. In vehicula porttitor porttitor. Vestibulum efficitur condimentum eleifend. Vestibulum hendrerit nunc felis, efficitur interdum nulla suscipit ut. Morbi nec luctus nisl.</p>-->
                  <div class="blog-social">
                     <ul class="blog-social-wrap">
                        <span>Share Now:</span>
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-12 col-lg-4">
            <div class="blog-details-right">
               <div class="detail-author">
                  <div class="detail-author-inner">
                     <div class="image">
                        <img src="{{url('public/uploads/author')}}/{{$blog->author->image}}">
                     </div>
                     <div class="name">
                     {{$blog->author->name}}
                     </div>
                     <div class="designation">
                        Editor
                     </div>
                  </div>
               </div>
               <div class="categories-wrap">
                  <h3>CATEGORIES</h3>
                  <ul>
                  @if(isset($blog_category))
                  @foreach($blog_category as $category)
                     <li><a href="{{url('blog/category')}}/{{$category->slug}}">{{$category->name}}</a></li>
                     @endforeach
                     @endif
                  </ul>
               </div>
               <div class="read-next-wrap categories-wrap">
                  <h3>Recent Articles</h3>
                 
                  @if(isset($recent_blog))
             @foreach($recent_blog as $recent_blogs)
                  <div class="next-wrap">
                     <div class="image">
					 <a href="{{url('blog')}}/{{$recent_blogs->slug}}"> <img src="{{url('public/uploads/blog')}}/{{$recent_blogs->image}}"></a>
                       
                     </div>
                     <div class="content">
					 <a href="{{url('blog')}}/{{$recent_blogs->slug}}">    {{$recent_blogs->title}}</a>
                 
                     </div>
                  </div>
                  @endforeach
                  @endif
               </div>
               <div class="instagram-wrap">
                  <h3># INSTAGRAM <i class="fa-solid fa-chevron-left"></i> 3 </h3>
                  <div class="instagram-row">
                     <div class="instagram-col">
                        <div class="image">
                           <img src="{{url('website/images/insta1.png')}}">
                           <div class="tab-text">
                              <div class="icons-block">
                                 <a href="#" class="social-icon-1"><i class="fa fa-instagram"></i></a>
                              </div>
                           </div>
                        </div>
                     </div>
                    <div class="instagram-col">
                        <div class="image">
                           <img src="{{url('website/images/insta2.png')}}">
                           <div class="tab-text">
                              <div class="icons-block">
                                 <a href="#" class="social-icon-1"><i class="fa fa-instagram"></i></a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="instagram-col">
                        <div class="image">
                           <img src="{{url('website/images/insta3.png')}}">
                           <div class="tab-text">
                              <div class="icons-block">
                                 <a href="#" class="social-icon-1"><i class="fa fa-instagram"></i></a>
                              </div>
                           </div>
                        </div>
                     </div>
                       <div class="instagram-col">
                        <div class="image">
                           <img src="{{url('website/images/insta1.png')}}">
                           <div class="tab-text">
                              <div class="icons-block">
                                 <a href="#" class="social-icon-1"><i class="fa fa-instagram"></i></a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
			   
			   
			    <div class="follow-us-wrap">
				         <span>FOLLOW US</span>
                     <ul class="blog-social-wrap">
               
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                     </ul>
                  </div>
			   <!-- <div class="searchbar-box">
	<input type="text" class="searchbar" name="searchbar" id="mySearchbar" placeholder="">
	<button class="search-button">
		<span class="button-icon">
			<i class="fa fa-search" aria-hidden="true"></i>
		</span>
	</button>
</div> -->

<div class="searchbar-box">
<form action="{{url('/search-blog')}}" method="post">
@csrf
<input type="text" id="blogsearch" name="search" required placeholder="" class="searchbar">
<button class="search-button" type="submit">
  <span class="button-icon">
   <i class="fa fa-search" aria-hidden="true"></i>
      </span>
      </button>
   </form>
</div>



			   
            </div>
         </div>
      </div>
   </div>
</section>

@include('website.footer')

