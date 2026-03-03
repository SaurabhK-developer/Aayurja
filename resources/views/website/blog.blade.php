@include('website.header')
@php
    use Illuminate\Support\Str;
@endphp

<!-- blog-listing head section -->
<section class="blog-head-area">
<div class="container">
    <div class="col-lg-12 text-center">
        <h1 class="heading">Latest Blogs & Update</h1>
        <p class="bloghead-para">Welcome to the Aayurja Blog, where you can discover insightful articles and expert advice on holistic health, nutrition, and wellness. Stay updated with the latest trends and insights on superfoods and Ayurvedic practices. We're passionate about empowering you with the knowledge to make informed choices that enhance your well-being and help you live a more balanced life.</p>
        <div class="page-breadcrum">
            <p><a href="{{url('/')}}">Home</a> |  </p>
            <p>Blogs</p>
        </div>
    </div>
</div>

    <!-- <div class="container">
        <div class="row align-items-center">
            @if ($latestBlog)
            <div class="col-lg-6 ">
                <a href="{{url('/blog/' .$latestBlog->slug)}}" class="">
                <div class="blog-main-content">
                    <h2>{{ $latestBlog->title }}</h2>
                    <p>{!! Str::limit($latestBlog->description, 300) !!}</p>
                    <div class="blog-user-box">
                        <img src="{{url('/public/uploads/blog/' . $latestBlog->image)}}" alt="user" loading="lazy">
                        <div class="blog-user-name">
                            <span>{{ $latestBlog->author->name }}</span>
                            <label>{{$latestBlog->created_at->format('d M Y')}}</label>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            @endif

            <div class="col-lg-6 fix-pad">
                <img class="blog-head-img" src="{{url('/public/uploads/blog/' . $latestBlog->image2)}}" alt="head-pic" loading="lazy">
            </div>
        </div>
    </div> -->


    @if ($latestBlog)
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 ">
                <div class="blog-main-content">
                    <a href="{{url('/blog/'.$latestBlog->slug)}}">
                    <h2>{{ $latestBlog->title }}</h2>
                    </a>
                    <p>{!! Str::limit($latestBlog->description, 300) !!}</p>
                    <div class="blog-user-box">

                    <img src="{{url('/public/uploads/blog/' . $latestBlog->image)}}" alt="user" loading="lazy">
                        <div class="blog-user-name">
                            <span>{{ $latestBlog->author->name }}</span>
                            <label>{{$latestBlog->created_at->format('d M Y')}}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 fix-pad">
                <a href="{{url('/blog/' .$latestBlog->slug)}}">
                <img class="blog-head-img" src="{{url('/public/uploads/blog/' . $latestBlog->image2)}}"  alt="{{ $latestBlog->title }}" loading="lazy">
                </a>
            </div>
        </div>
    </div>
    @endif

    <img src="{{url('public/images/popular-vector.png')}}" alt="vector" class="bloglist-vector" loading="lazy">
</section>

<!-- blog cards -->

<section class="blog-cards">
    <div class="container">
        <div class="row">

            @foreach ($blogs as $blog)
            <div class="col-lg-4 col-md-6 blog-item">
                <div class="blog-card-wrap">
                    <div class="blog-card-img">
                        <img src="{{url('/public/uploads/blog/' . $blog->image2)}}" alt="blog-card" loading="lazy">
                    </div>
                    <div class="blog-card-content">
                    <a  href="{{url('/blog/' .$blog->slug)}}">
                        <h3>{{ ($blog->title) }}</h3>
                    </a>
                        {!! Str::limit($blog->description, 110) !!}
                        <div class="blogcard-user-box">
                            <img src="{{url('/public/uploads/blog/' . $blog->image)}}" alt="user" loading="lazy">
                            <div class="blogcard-user-name">
                                <span>{{ $blog->author->name }}</span>
                                <label>{{$blog->created_at->format('d M Y')}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- <div class="col-lg-4 col-md-6 blog-item">
                <a href="blog-detail.php" class="blog-card-wrap">
                    <div class="blog-card-img">
                        <img src="{{url('public/images/blog-card-img2.webp')}}" alt="blog-card" loading="lazy">
                    </div>
                    <div class="blog-card-content">
                        <h3>Morbi tempus vel risus sed for vehicula Nam rutrum.</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority hav suffered
                            alteration in some.</p>
                        <div class="blogcard-user-box">
                            <img src="{{url('public/images/blogcard-user2.png')}}" alt="user" loading="lazy">
                            <div class="blogcard-user-name">
                                <span>Geet Kapoor</span>
                                <label>December 12, 2022</label>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 blog-item">
                <a href="blog-detail.php" class="blog-card-wrap">
                    <div class="blog-card-img">
                        <img src="{{url('public/images/blog-card-img3.webp')}}" alt="blog-card" loading="lazy">
                    </div>
                    <div class="blog-card-content">
                        <h3>Morbi tempus vel risus sed for vehicula Nam rutrum.</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority hav suffered
                            alteration in some.</p>
                        <div class="blogcard-user-box">
                            <img src="{{url('public/images/blogcard-user3.png')}}" alt="user" loading="lazy">
                            <div class="blogcard-user-name">
                                <span>Saurabh Sinha</span>
                                <label>June 22, 2024</label>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 blog-item">
                <a href="blog-detail.php" class="blog-card-wrap">
                    <div class="blog-card-img">
                        <img src="{{url('public/images/blog-card-img4.webp')}}" alt="blog-card" loading="lazy">
                    </div>
                    <div class="blog-card-content">
                        <h3>Morbi tempus vel risus sed for vehicula Nam rutrum.</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority hav suffered
                            alteration in some.</p>
                        <div class="blogcard-user-box">
                            <img src="{{url('public/images/blogcard-user4.png')}}" alt="user" loading="lazy">
                            <div class="blogcard-user-name">
                                <span>Rajiv Kashyap</span>
                                <label>February 12, 2024</label>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 blog-item">
                <a href="blog-detail.php" class="blog-card-wrap">
                    <div class="blog-card-img">
                        <img src="{{url('public/images/blog-card-img5.webp')}}" alt="blog-card" loading="lazy">
                    </div>
                    <div class="blog-card-content">
                        <h3>Morbi tempus vel risus sed for vehicula Nam rutrum.</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority hav suffered
                            alteration in some.</p>
                        <div class="blogcard-user-box">
                            <img src="{{url('public/images/blogcard-user5.png')}}" alt="user" loading="lazy">
                            <div class="blogcard-user-name">
                                <span>Atul Arya</span>
                                <label>July 10, 2024</label>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 blog-item">
                <a href="blog-detail.php" class="blog-card-wrap">
                    <div class="blog-card-img">
                        <img src="{{url('public/images/blog-card-img6.webp')}}" alt="blog-card" loading="lazy">
                    </div>
                    <div class="blog-card-content">
                        <h3>Morbi tempus vel risus sed for vehicula. Nam rutrum iaculis est, sit amet dignissim</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority hav suffered
                            alteration in some form majority have suffered alteration in some</p>
                        <div class="blogcard-user-box">
                            <img src="{{url('public/images/blogcard-user6.png')}}" alt="user" loading="lazy">
                            <div class="blogcard-user-name">
                                <span>Abhishek Rawat</span>
                                <label>January 11, 2023</label>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 blog-item">
                <a href="blog-detail.php" class="blog-card-wrap">
                    <div class="blog-card-img">
                        <img src="{{url('public/images/blog-card-img7.webp')}}" alt="blog-card" loading="lazy">
                    </div>
                    <div class="blog-card-content">
                        <h3>Morbi tempus vel risus sed for vehicula Nam rutrum.</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority hav suffered
                            alteration in some.</p>
                        <div class="blogcard-user-box">
                            <img src="{{url('public/images/blogcard-user7.png')}}" alt="user" loading="lazy">
                            <div class="blogcard-user-name">
                                <span>Akash Rawat</span>
                                <label>March 15, 2021</label>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 blog-item">
                <a href="blog-detail.php" class="blog-card-wrap">
                    <div class="blog-card-img">
                        <img src="{{url('public/images/blog-card-img8.webp')}}" alt="blog-card" loading="lazy">
                    </div>
                    <div class="blog-card-content">
                        <h3>Morbi tempus vel risus sed for vehicula. Nam rutrum iaculis est, sit amet dignissim</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority hav suffered
                            alteration in some form majority have suffered alteration in some</p>
                        <div class="blogcard-user-box">
                            <img src="{{url('public/images/blogcard-user8.png')}}" alt="user" loading="lazy">
                            <div class="blogcard-user-name">
                                <span>Harshita Kumari</span>
                                <label>August 12, 2024</label>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 blog-item">
                <a href="blog-detail.php" class="blog-card-wrap">
                    <div class="blog-card-img">
                        <img src="{{url('public/images/blog-card-img9.webp')}}" alt="blog-card" loading="lazy">
                    </div>
                    <div class="blog-card-content">
                        <h3>Morbi tempus vel risus sed for vehicula Nam rutrum.</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority hav suffered
                            alteration in some.</p>
                        <div class="blogcard-user-box">
                            <img src="{{url('public/images/blogcard-user9.png')}}" alt="user" loading="lazy">
                            <div class="blogcard-user-name">
                                <span>Vivek Kumar</span>
                                <label>April 22, 2022</label>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 blog-item">
                <a href="blog-detail.php" class="blog-card-wrap">
                    <div class="blog-card-img">
                        <img src="{{url('public/images/blog-card-img7.webp')}}" alt="blog-card" loading="lazy">
                    </div>
                    <div class="blog-card-content">
                        <h3>Morbi tempus vel risus sed for vehicula Nam rutrum.</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority hav suffered
                            alteration in some.</p>
                        <div class="blogcard-user-box">
                            <img src="{{url('public/images/blogcard-user7.png')}}" alt="user" loading="lazy">
                            <div class="blogcard-user-name">
                                <span>Akash Rawat</span>
                                <label>March 15, 2021</label>
                            </div>
                        </div>
                    </div>
                </a>
            </div> --}}
            @if(count($blogs) > 9)
                <div class="col-lg-12 text-center">
                    <a id="seeMore" href="javascript:void(0);" class="theme-button">load more</a>
                    <a id="seeLess" href="javascript:void(0);" class="theme-button">load less</a>
                </div>
            @endif
        </div>
    </div>
    <img src="{{url('public/images/lotus-icon.png')}}" alt="lotus" class="blog-card-vec" loading="lazy">
    <img src="{{url('public/images/blogcard-vector.png')}}" alt="lotus" class="blog-card-vec-two" loading="lazy">
</section>
@include('website.footer')

<script>
$(document).ready(function() {
    $("#seeLess").hide();
    $(".blog-item").slice(0, 6).show();

    $("#seeMore").click(function(e) {
        e.preventDefault();

        $(".blog-item:hidden").slice(0, 3).fadeIn("slow");

        if ($(".blog-item:hidden").length == 0) {
            $("#seeMore").hide();
            $("#seeLess").show();
        }
    });

    $("#seeLess").click(function(e) {
        $(".blog-item").hide();
        $(".blog-item").slice(0, 6).show();
        $("#seeMore").show();
        $("#seeLess").hide();
    });
});
</script>