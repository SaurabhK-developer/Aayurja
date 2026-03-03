@include('website.header')
@php
    use Illuminate\Support\Str;
@endphp
<section class="blog-detail-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-breadcrum">
                    <p><a href="{{url('/')}}">Home</a> |  </p>
                    <p><a href="{{url('/blog')}}">Blogs</a> |</p>
                    <p>{!! Str::limit($blog->title, 20) !!}</p>
                </div>
                <h1 class="main-heading-details">{!! Str::limit($blog->title, 300) !!}</h1>
            </div>
            

            <div class="col-lg-12">
                <div class="detail-user-wrap">
                    <div class="detail-user-box">
                        <img src="{{url('/public/uploads/blog/' . $blog->image)}}" alt="user" loading="lazy">
                        <div class="detail-user-name">
                            <span>{{ $blog->author->name }}</span>
                            <label>{{ $blog->created_at->format('d M Y') }}</label>
                        </div>
                    </div>
                    <div class="detailpage-social">
                        <label>Share:</label>
                        <ul>
                            <li>
                                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="detail-main-img">
                    <img src="{{url('/public/uploads/blog/' . $blog->image1)}}" alt="details" loading="lazy">
                </div>

                <div class="detail-main-content">
                    <p>{!! $blog->description !!}</p>
                </div>

                <div class="next-prev-blogs">
                    
                    @if($n_blog)
                    <a href="{{url('/blog/' .$n_blog->slug)}}" class="next-detail-box">
                        <img src="{{url('/public/uploads/blog/' . $n_blog->image2)}}" alt="blog" loading="lazy">
                        <div class="next-detail-contant">
                            <h3>{!! str::limit ($n_blog->title,35) !!}</h3>
                            <p>{!! Str::limit($n_blog->description, 45) !!}</p>
                            <span>Previous Post</span>
                        </div>
                    </a>
                    @endif

                    @if ($p_blog)
                    <a href="{{ url('/blog/' . $p_blog->slug) }}" class="next-detail-box">
                        <div class="next-detail-contant">
                            <h3>{!! Str::limit($p_blog->title, 35) !!}</h3>
                            <p>{!! Str::limit($p_blog->description, 45) !!}</p>
                            <span>NEXT Post</span>
                        </div>
                        <img src="{{ url('/public/uploads/blog/' . $p_blog->image2) }}" alt="Previous Blog Image" loading="lazy">
                        
                    </a>
                @endif
                </div>
                
            </div>
        </div>

    </div>
    <img src="{{url('public/images/popular-vector.webp')}}" alt="vector" class="blogdetail-vec-one" loading="lazy">
    <img src="{{url('public/images/lotus-icon.webp')}}" alt="lotus" class="blogdetail-vec-lotus" loading="lazy">
    <img src="{{url('public/images/blogcard-vector.webp')}}" alt="lotus" class="blogdetail-vec-two" loading="lazy">
</section>

<section class="detail-cards-area">
    <div class="container">

             <div class="row">
            <div class="col-lg-12">
                <h4 class="heading detail-cards-areahead">More Related Blogs</h4>
            </div>
            </div>

             <div class="blog-sliders">
           
            @foreach ($recent_blog as $key=> $item)
            <div class="blog-detail-post">
                <a href="{{url('/blog/' .$item->slug)}}" class="blog-card-wrap">
                    <div class="blog-card-img">
                        <img src="{{url('/public/uploads/blog/' . $item->image2)}}" alt="blog-card" loading="lazy">
                    </div>
                    <div class="blog-card-content">
                        <h3>{!! str::limit ($item->title,40) !!}</h3>
                        {!! Str::limit($item->description, 70) !!}
                        <div class="blogcard-user-box">
                            <img src="{{url('/public/uploads/blog/' . $item->image)}}" alt="user" loading="lazy">
                            <div class="blogcard-user-name">
                                <span>{{$item->author->nam}}</span>
                                <label>{{$item->created_at->format('d M Y')}}</label>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
          
            </div>

            <div class="col-lg-12 text-center">
                <a href="{{url('blog')}}" class="theme-button">See All</a>
            </div>
      
    </div>
</section>

@include('website.footer')

<script>
$(".blog-sliders").slick({
  slidesToShow: 3,
  infinite: true,
  slidesToScroll: 1,
  autoplay: true,
  cssEase: "ease",
  speed: 1200,
  infinite: true,
  arrows: false,

  responsive: [
    {
      breakpoint: 1199,
      settings: {
        slidesToShow: 3,
      },
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
      },
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      },
    },
  ],
});

</script>