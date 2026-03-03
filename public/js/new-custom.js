  // banner slider

 

  $(".theme-banner-slider").slick({
    slidesToShow: 1,
    infinite: false,
    slidesToScroll: 1,
    autoplay: true,
    cssEase: "ease",
    speed: 1500,
    infinite: true,
    arrows: false,
    dots: true,
    pauseOnHover: false,
    adaptiveHeight: true,
  });

  // category slider

  $(".cate-slider").slick({
    slidesToShow: 4,
    infinite: false,
    slidesToScroll: 1,
    autoplay: true,
    cssEase: "ease",
    centerMode: true,
    centerPadding: "80px",
    speed: 1500,
    infinite: true,
    arrows: true,
    dots: false,
    pauseOnHover: false,
    prevArrow:
    '<button class="arrow slick-prev"><i class="fa-solid fa-chevron-left"></i></button>',
  nextArrow:
    '<button class="arrow slick-next"><<i class="fa-solid fa-chevron-right"></i> </button>',

    responsive: [
      {
        breakpoint: 1025,
        settings: {
          slidesToShow: 3,
          centerPadding: "0px",
        },
      },


     {
        breakpoint: 990,
        settings: {
          slidesToShow: 2,
          centerPadding: "0px",
        },
      },


      {
        breakpoint: 800,
        settings: {
          slidesToShow: 2,
          centerPadding: "0px",
        },
      },

      {
        breakpoint: 601,
        settings: {
          slidesToShow: 2,
          centerPadding: "0px",
        },
      },
    ],
  });



  // mobile trust slider

  // $(".mobile-trust-slider").slick({
  //   slidesToShow: 1,
  //   infinite: false,
  //   slidesToScroll: 1,
  //   autoplay: true,
  //   cssEase: "ease",
  //   speed: 4000,
  //   infinite: true,
  //   arrows: false,
  //   dots: false,
  //   pauseOnHover: false,

  //   responsive: [
 

  //     {
  //       breakpoint: 767,
  //       settings: {
  //         slidesToShow: 1,
  //         centerPadding: "0px",
  //       },
  //     },
  //   ],
  // });

  //also slider

  $(".also-slider").slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 0,
    speed: 4000,
    cssEase: "linear",
    infinite: true,
    arrows: false,
    dots: false,
    pauseOnHover: false,

    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 4,
        },
      },

      {
        breakpoint: 601,
        settings: {
          slidesToShow: 3,
        },
      },
    ],
  });

  //=========== home logo slider

  // home logo slider
  //=========== home logo slider

  $(".logo-slider-left").slick({
    dots: false,
    slidesToShow: 4,
    infinite: true,
    autoplay: true,
    slidesToScroll: 1,
    infinite: true,
    pauseOnHover: false,
    arrows: false,
    cssEase: "linear",
    autoplaySpeed: 0,
    speed: 5000,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 3,
        },
      },

      {
        breakpoint: 601,
        settings: {
          slidesToShow: 3,
        },
      },
    ],
  });

  $(".logo-slider-right").slick({
    dots: false,
    slidesToShow: 4,
    infinite: true,
    autoplay: true,
    slidesToScroll: 1,
    infinite: true,
    pauseOnHover: false,
    arrows: false,
    cssEase: "linear",
    autoplaySpeed: 0,
    speed: 5000,
    rtl: true,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 3,
        },
      },

      {
        breakpoint: 601,
        settings: {
          slidesToShow: 3,
        },
      },
    ],
  });

  // 
   function initMobileSlider() {
      if ($(window).width() <= 1025) {
        if (!$(".popp-new-slides").hasClass("slick-initialized")) {
          $(".popp-new-slides").slick({
            slidesToShow: 2,
            infinite: false,
            slidesToScroll: 1,
            autoplay: true,
            cssEase: "ease",
            speed: 1500,
            infinite: true,
            arrows: true,
            dots: false,
            prevArrow:
            '<button class="arrow slick-prev"><i class="fa-solid fa-chevron-left"></i></button>',
          nextArrow:
            '<button class="arrow slick-next"><<i class="fa-solid fa-chevron-right"></i> </button>',
            
            responsive: [


              {
                breakpoint: 767,
                settings: {
                  slidesToShow: 2,
                },
              },

              {
                breakpoint: 601,
                settings: {
                  slidesToShow: 1,
                },
              },
            ],
          });

        }
      } else {
        if ($(".popp-new-slides").hasClass("slick-initialized")) {
          $(".popp-new-slides").slick("unslick"); // ✅ Remove slider on desktop
        }
      }
    }
  
    initMobileSlider();
    $(window).resize(initMobileSlider);

// 

  
    document.addEventListener("DOMContentLoaded", function () {
        const video = document.getElementById("video");
        const circlePlayButton = document.getElementById("circle-play-b");

        function togglePlay() {
            if (video.paused || video.ended) {
                video.play();
            } else {
                video.pause();
            }
        }

        // Click Events
        video.addEventListener("click", togglePlay);
        circlePlayButton.addEventListener("click", togglePlay);

        // Hide Play Button When Playing
        video.addEventListener("playing", function () {
            circlePlayButton.style.opacity = 0;
        });

        // Show Play Button When Paused
        video.addEventListener("pause", function () {
            circlePlayButton.style.opacity = 1;
        });

        // Restart Video If It Ends
        video.addEventListener("ended", function () {
            video.currentTime = 0;
            circlePlayButton.style.opacity = 1;
        });

        // Debugging: Check If Video Fully Loaded
        video.addEventListener("canplaythrough", function () {
            console.log("✅ Video fully loaded and ready to play.");
        });

        // Debugging: Check For Errors
        video.addEventListener("error", function () {
            console.error("❌ Video failed to load:", video.error);
        });
    });


// concern

$(document).ready(function () {
  function initMobileSlider() {
    if ($(window).width() <= 769) {
      $(".mobile-testimonial-slider, .mobile-blog-slider").not(".slick-initialized").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        speed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
      });
    } else {
      $(".mobile-testimonial-slider.slick-initialized, .mobile-blog-slider.slick-initialized").slick("unslick");
    }
  }

  initMobileSlider();
  $(window).resize(initMobileSlider);
});








// $(document).ready(function () {
//   function initMobileSlider() {
//     if ($(window).width() <= 800) {
//       $(".bottom-usp").not(".slick-initialized").slick({
//         slidesToShow: 3,
//         slidesToScroll: 1,
//         autoplay: true,
//         cssEase: "ease",
//         speed: 1500,
//         infinite: true,
//         arrows: false,
//         dots: false,
//         pauseOnHover: false,
//         responsive: [
 
//           {
//             breakpoint: 769,
//             settings: { slidesToShow: 3, centerPadding: "0px" },
//           },
//           {
//             breakpoint: 601,
//             settings: { slidesToShow: 3, centerPadding: "0px" },
//           },
//         ],
      
        
//       });
//     } else {
//       // Desktop view me slider ko remove karo
//       $(".bottom-usp .slick-initialized").slick("unslick");
//     }
//   }

//   // Initialize slider on page load
//   initMobileSlider();

//   // Window resize hone par slider ko check karo
//   $(window).resize(function () {
//     initMobileSlider();
//   });
// });



$(document).ready(function () {
  function initMobileSlider() {
    if ($(window).width() <= 1025) {
      $(".mobile-concern-slier ").not(".slick-initialized").slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        cssEase: "ease",
        centerMode: true,
        centerPadding: "80px",
        speed: 1500,
        infinite: true,
        arrows: false,
        dots: false,
        pauseOnHover: false,

        responsive: [
          {
            breakpoint: 1025,
            settings: { slidesToShow: 3, centerPadding: "0px" },
          },
          {
            breakpoint: 990,
            settings: { slidesToShow: 3, centerPadding: "0px" },
          },
          {
            breakpoint: 800,
            settings: { slidesToShow: 2, centerPadding: "0px" },
          },
          {
            breakpoint: 601,
            settings: { slidesToShow: 2, centerPadding: "0px" },
          },
        ],
      });
    } else {
      // Desktop view me slider ko remove karo
      $(".mobile-concern-slier .slick-initialized").slick("unslick");
    }
  }

  // Initialize slider on page load
  initMobileSlider();

  // Window resize hone par slider ko check karo
  $(window).resize(function () {
    initMobileSlider();
  });
});

