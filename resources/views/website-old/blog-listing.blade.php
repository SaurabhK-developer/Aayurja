@include('website.header')
<div class="blog-recent-top">
   <div class="container">
      <div class="row">
      @if(isset($recent_tranding_blog))
      @foreach($recent_tranding_blog as $recent )
         <div class="col-md-12 col-lg-6 blog-single">
            <div class="categry-image">
               <img src="{{url('public/uploads/blog')}}/{{$recent->image}}">
            </div>
            <div class="content-wrap">
               <h1><a href="{{url('blog')}}/{{$recent->slug}}">{{$recent->title}}</a></h1>
               <p>{!!substr($recent->description,0,150)!!}... </p>
               <div class="autor-section">
                  <div class="image-section">
                     <img src="{{url('public/uploads/author')}}/{{$recent->author->image}}">
                  </div>
                  <div class="name">
                  By {{$recent->author->name}} 
                  </div>
                  <div class="date">
                  <?php
                                    $date = $recent->created_at->format('y-m-d');
                                    $dates= date('d, F ,Y', strtotime($date)); 
                                ?>
                                {{$dates}}
                  </div>
               </div>
            </div>
         </div>
         @endforeach
         @endif
         <div class="col-md-12 col-lg-6">
            <div class="recent-article scroll-inner">
            @if(isset($tranding_blogs))
      @foreach($tranding_blogs as $tranding_blogs )
               <div class="row">
                  <div class="content">
                     <h2><a href="{{url('blog')}}/{{$tranding_blogs->slug}}">{{$tranding_blogs->title}}</a></h2>
                     <p>{!!substr($tranding_blogs->description,0,150)!!}... </p>
                     <div class="autor-section">
                        <div class="image-section">
                           <img src="{{url('public/uploads/author')}}/{{$tranding_blogs->author->image}}">
                        </div>
                        <div class="name">
                        {{$tranding_blogs->author->name}}
                        </div>
                        <div class="date">
                        <?php
                                    $date = $tranding_blogs->created_at->format('y-m-d');
                                    $dates= date('d, F ,Y', strtotime($date)); 
                                ?>
                                {{$dates}}
                        </div>
                     </div>
                  </div>
                  <div class="image">
				  <a href="{{url('blog')}}/{{$tranding_blogs->slug}}">
                     <img src="{{url('public/uploads/blog')}}/{{$tranding_blogs->image}}">
					 </a>
                  </div>
               </div>
               @endforeach
               @endif
               
            </div>
         </div>
      </div>
   </div>
</div>
<div class="Shape-wrap">
   <div class="container">
      <div class="row">
	  <div class="shop-btn-wraps">
	    <a  href="{{url('/product')}}" >
         <img src="{{url('website/images/shop-calection.png')}}">
         </a>
		 
		  <div class="shop-btn">
		 
		 <a class=" theme-btn-custom" href="{{url('/product')}}"  id="load_more">Shop Collection <i class="fas fa-arrow-right"></i></a>
	
		 </div>
	  </div>
       
		 
		
      </div>
   </div>
</div>
<section class="latest-article-wrap">
   <div class="container">
      <div class="row">
         <div class="col-md-12 col-lg-8">
            <div class="latest-article-wrap">
               <h3>Latest Articles</h3>
               <div class="recent-article " id="myList">
                  @if(isset($blogs))
             @foreach($blogs as $blog)
		 <div class="latest-article-col">
                  <div class="latest-article-row">
                     <div class="content">
                        <div class="tag-section">
                           <span>  {{$blog->category_data->name ?? 'abc'}} </span>
                        </div>
                        <h2><a href="{{url('blog')}}/{{$blog->slug}}">{{$blog->title}}</a></h2>
                       <p> {!!substr($blog->description,0,150)!!}... </P>
                        <div class="autor-section">
                           <div class="image-section">
                          
                              <img src="{{url('public/uploads/author')}}/{{$blog->author->image}}">
                              
                           </div>
                           <div class="name">
                           By {{$blog->author->name}} 
                           </div>
                           <div class="date">
                           <?php
                                    $date = $blog->created_at->format('y-m-d');
                                    $dates= date('d, F ,Y', strtotime($date)); 
                                ?>
                                {{$dates}}
                           </div>
                        </div>
                     </div>
                     <div class="image">
					         <a href="{{url('blog')}}/{{$blog->slug}}">
                           <img src="{{url('public/uploads/blog')}}/{{$blog->image}}">
						      </a>
                     </div>
                  </div>
				  </div>
                 @endforeach 
				      @endif
				  
				  
				  
               </div>
			   
			   
			   
	  <div class="pagination">
      <a class="theme-btn2 theme-btn-custom" href="#" id="load_More">Load More</a>
      <a class="theme-btn2 theme-btn-custom" href="#" id="load_Less">Load Less</a>
   </div>
			   
            </div>
         </div>
         <div class="col-md-12 col-lg-4">
            <div class="popular-post trending-wrap">
               <div class="post-inner">
                  <div class="heading">
                     Trending Topics
                  </div>
                 <!-- <div class="view-all">
                     <a href="#">View All</a>
                  </div>-->
               </div>
               <ul>
                  @if(isset($blog_category))
                  @foreach($blog_category as $category)
                  <li>
                     <a href="{{url('blog/category')}}/{{$category->slug}}">

                     <div class="image-wrap">
                        <img src="{{url('public/uploads/blog')}}/{{$category->image}}">
                     </div>
                     <div class="heading">
                    {{$category->name}} 
                     </div>
                     </a>
                  </li>
                  @endforeach
                  @endif
               </ul>
            </div>
            <div class="popular-post trending-post-wrap">
               <div class="post-inner">
                  <div class="heading">
                     Popular Articles
                  </div>
                  <div class="view-all">
                     <a href="{{url('blog/popular')}}">View All</a>
                  </div>
               </div>
               <ul>
               @if(isset($popular_blog))
             @foreach($popular_blog as $popular_blogs)
                  <li>
                    <div class="row popular-post-row">
                    <div class="content">
                   <h2><a href="{{url('blog')}}/{{$popular_blogs->slug}}">{{$popular_blogs->title}}</a></h2>
                   
                    </div>
                     <div class="image">
					 	<a href="{{url('blog')}}/{{$popular_blogs->slug}}">
                     <img src="{{url('public/uploads/blog')}}/{{$popular_blogs->image}}">
					   </a>
                     </div>
                    </div>
					
					  <div class="autor-section">
                        <div class="image-section">
					
                           <img src="{{url('public/uploads/author')}}/{{$popular_blogs->author->image}}">
						 
                        </div>
                        <div class="name">
                             By {{$popular_blogs->author->name}}
                        </div>
                        <div class="date">
                        <?php
                                    $date = $popular_blogs->created_at->format('y-m-d');
                                    $dates= date('d,F,Y', strtotime($date)); 
                                ?>
                                {{$dates}}
                        </div>
                     </div>
                  </li>
                 
               @endforeach
               @endif
			
              
			  
               </ul>
            </div>
         </div>
      </div>
   </div>
</section>
@include('website.footer')
<script>

</script>



