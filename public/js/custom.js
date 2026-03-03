//========== Sticky menu

$(window).on("scroll", function () {
  var heightFromTop = $(this).scrollTop();
  if (heightFromTop) {
    $(".main-header").addClass("sticky-header");
  } else {
    $(".main-header").removeClass("sticky-header");
  }
});

$(window).on("scroll", function () {
  var searchFromTop = $(this).scrollTop();
  if (searchFromTop) {
    $("#ui-id-1").addClass("stick-searcbox");
  } else {
    $("#ui-id-1").removeClass("stick-searcbox");
  }
});

$(document).ready(function () {
  $(".qty-btn-minus ").click(function () {
    var $input = $(this).parent().find("input");
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.change();
    return false;
  });
  $(".qty-btn-plus").click(function () {
    var $input = $(this).parent().find("input");
    $input.val(parseInt($input.val()) + 1);
    $input.change();
    return false;
  });
});

// banner slider

// $(".banner-slider").slick({
//   slidesToShow: 1,
//   infinite: false,
//   slidesToScroll: 1,
//   autoplay: true,
//   cssEase: "ease",
//   speed: 1500,
//   infinite: true,
//   arrows: false,
//   dots: true,
//   pauseOnHover: false,
// });

$(".mobile-slider").slick({
  slidesToShow: 1,
  infinite: false,
  slidesToScroll: 1,
  autoplay: true,
  cssEase: "ease",
  speed: 1200,
  infinite: true,
  arrows: false,
  dots: true,
});

// popular Slider

$(".blog-slider").slick({
  slidesToShow: 4,
  infinite: false,
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

$(".category-slider").slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  centerMode: true,
  arrows: false,
  dots: true,
  centerPadding: "120px", // Adjusted center padding
  infinite: true,
  cssEase: "ease",
  speed: 1200,
  autoplay: true,

  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 2,
      },
    },

    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      },
    },

    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      },
    },
  ],
});

//
$(".fixed-slider").slick({
  slidesToScroll: 1,
  slidesToShow: 1,
  arrows: false,
  autoplay: true,
  dots: true,
  vertical: true,
  cssEase: "ease",
  autoplaySpeed: 2000,
  speed: 2000,
  verticalSwiping: true,

  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        verticalSwiping: false,
        vertical: false,
      },
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,

        verticalSwiping: false,
        vertical: false,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        verticalSwiping: false,
        vertical: false,
      },
    },
  ],
});

//

$(".testimonial-slider").slick({
  slidesToShow: 1,
  slidesToScroll: 1,

  arrows: false,
  dots: true,
  // Adjusted center padding
  infinite: true,
  cssEase: "ease",
  speed: 1200,
  autoplay: true,
});

// $(".partner-slider ").slick({
//   slidesToScroll: 1,
//   slidesToShow: 6,
//   infinite: true,
//   autoplay: true,
//   autoplaySpeed: 0,
//   cssEase: "linear",
//   speed: 8000,
//   arrows: false,

//   responsive: [
//     {
//       breakpoint: 1024,
//       settings: {
//         slidesToShow: 3,
//       },
//     },
//     {
//       breakpoint: 600,
//       settings: {
//         slidesToShow: 3,
//       },
//     },
//     {
//       breakpoint: 576,
//       settings: {
//         slidesToShow: 2,
//       },
//     },
//   ],
// });

//=========== instagram

$(".insta-slider").slick({
  dots: false,
  slidesToShow: 6,
  autoplay: true,
  slidesToScroll: 1,
  infinite: true,
  loop: true,
  arrows: false,
  speed: 1200,
  cssEase: "ease",
  pauseOnHover: false,
  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 4,
      },
    },

    {
      breakpoint: 767,
      settings: {
        slidesToShow: 3,
      },
    },

    {
      breakpoint: 599,
      settings: {
        slidesToShow: 1,
      },
    },
  ],
});

//=========== survey banner

$(".surveybanner-slider").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  infinite: true,
  dots: true,
  autoplay: true,
  autoplaySpeed: 2500,
  pauseOnHover: false,
  speed: 1200,
  arrows: false,
});

// popular mobile slider

mobileOnlySlider(".popp-slides", true, false, 767);

function mobileOnlySlider($slidername, $dots, $arrows, $breakpoint) {
  var slider = $($slidername);
  var settings = {
    mobileFirst: true,
    dots: $dots,
    arrows: $arrows,
    responsive: [
      {
        breakpoint: $breakpoint,
        settings: "unslick",
      },
    ],
  };

  slider.slick(settings);

  $(window).on("resize", function () {
    if ($(window).width() > $breakpoint) {
      return;
    }
    if (!slider.hasClass("slick-initialized")) {
      return slider.slick(settings);
    }
  });
} // Mobile Only Slider

/* popup scroll  */

$(".modal").on("show.bs.modal", function () {
  $("html").css("overflow", "hidden");
});

$(".modal").on("hidden.bs.modal", function () {
  $("html").css("overflow", "unset");
});

//

/* Mobile toggle  */

$(".enq-model").click(function () {
  $("body").toggleClass("filter-open");
});

$(".close-icon").click(function () {
  $("body").removeClass("filter-open");
});

$(document).ready(function () {
  $("#filters_click").on("click", function () {
    $(".listing-sidebar  ").toggleClass("filter-open");
  });
});

// price range

// price range
const rangeInput = document.querySelectorAll(".range-input input"),
  priceInput = document.querySelectorAll(".price-input input"),
  range = document.querySelector(".slider .progress");
let priceGap = 100;

priceInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minPrice = parseInt(priceInput[0].value),
      maxPrice = parseInt(priceInput[1].value);

    if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
      if (e.target.className === "input-min") {
        rangeInput[0].value = minPrice;
        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
      } else {
        rangeInput[1].value = maxPrice;
        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
      }
    }
  });
});

rangeInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minVal = parseInt(rangeInput[0].value),
      maxVal = parseInt(rangeInput[1].value);

    if (maxVal - minVal < priceGap) {
      if (e.target.className === "range-min") {
        rangeInput[0].value = maxVal - priceGap;
      } else {
        rangeInput[1].value = minVal + priceGap;
      }
    } else {
      priceInput[0].value = minVal;
      priceInput[1].value = maxVal;
      range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
      range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }
  });
});

//=========== about quantity

var buttonPlus = $(".qty-btn-plus");
var buttonMinus = $(".qty-btn-minus");

var incrementPlus = buttonPlus.click(function () {
  var $n = $(this)
    .parent(".siteform-box .qty-container")
    .find(".siteform-box .input-qty");
  $n.val(Number($n.val()) + 1);
});

var incrementMinus = buttonMinus.click(function () {
  var $n = $(this)
    .parent(".siteform-box .qty-container")
    .find(".siteform-box .input-qty");
  var amount = Number($n.val());
  if (amount > 1) {
    $n.val(amount - 1);
  }
});

// fancy box

// $(document).ready(function () {
//   $(".zoom-image")
//     .on("mousemove", function (e) {
//       var img = $(this);
//       var zoomDisplay = $(".zoom-display");
//       var offset = img.offset();
//       var mouseX = e.pageX - offset.left;
//       var mouseY = e.pageY - offset.top;
//       var imgWidth = img.width();
//       var imgHeight = img.height();

//       var zoomLevel = 2; // Adjust zoom level as needed
//       var zoomWidth = imgWidth * zoomLevel;
//       var zoomHeight = imgHeight * zoomLevel;

//       var bgPosX = -((mouseX / imgWidth) * zoomWidth - zoomDisplay.width() / 2);
//       var bgPosY = -(
//         (mouseY / imgHeight) * zoomHeight -
//         zoomDisplay.height() / 2
//       );

//       zoomDisplay.css({
//         "background-image": "url(" + img.attr("src") + ")",
//         "background-size": zoomWidth + "px " + zoomHeight + "px",
//         "background-position": bgPosX + "px " + bgPosY + "px",
//         display: "block",
//       });
//     })
//     .on("mouseleave", function () {
//       $(".zoom-display").hide();
//     });
// });



$(document).on("mousemove", ".zoom-image", function (e) {
  var img = $(this);
  var zoomDisplay = $(".zoom-display");
  var offset = img.offset();
  var mouseX = e.pageX - offset.left;
  var mouseY = e.pageY - offset.top;
  var imgWidth = img.width();
  var imgHeight = img.height();

  var zoomLevel = 2; // Adjust zoom level as needed
  var zoomWidth = imgWidth * zoomLevel;
  var zoomHeight = imgHeight * zoomLevel;

  var bgPosX = -((mouseX / imgWidth) * zoomWidth - zoomDisplay.width() / 2);
  var bgPosY = -(
      (mouseY / imgHeight) * zoomHeight -
      zoomDisplay.height() / 2
  );

  zoomDisplay.css({
      "background-image": "url(" + img.attr("src") + ")",
      "background-size": zoomWidth + "px " + zoomHeight + "px",
      "background-position": bgPosX + "px " + bgPosY + "px",
      display: "block",
  });
}).on("mouseleave", ".zoom-image", function () {
  $(".zoom-display").hide();
});

// product slider

// Main/Product image slider for product page

$(".main-img-slider").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  infinite: true,
  arrows: false,
  dots: false,
  arrows: false,
  autoplay: false,
  autoplaySpeed: 4000,
  speed: 300,
  lazyLoad: "ondemand",
  asNavFor: ".thumb-nav",
  prevArrow:
    '<button class="arrow slick-prev"><i class="fa-solid fa-chevron-up"></i> </button>',
  nextArrow:
    '<button class="arrow slick-next"><i class="fa-solid fa-chevron-up"></i></button>',
});
// Thumbnail/alternates slider for product page
$(".thumb-nav").slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  infinite: true,
  centerPadding: "0px",
  asNavFor: ".main-img-slider",
  dots: false,
  arrows: true,
  centerMode: false,
  draggable: true,
  speed: 200,
  autoplay: false,
  focusOnSelect: true,
  prevArrow:
    '<button class="arrow slick-prev"><i class="fa-solid fa-chevron-left"></i></button>',
  nextArrow:
    '<button class="arrow slick-next"><<i class="fa-solid fa-chevron-right"></i> </button>',
});

//keeps thumbnails active when changing main image, via mouse/touch drag/swipe
$(".main-img-slider").on(
  "afterChange",
  function (event, slick, currentSlide, nextSlide) {
    //remove all active class
    $(".thumb-nav .slick-slide").removeClass("slick-current");
    //set active class for current slide
    $(".thumb-nav .slick-slide:not(.slick-cloned)")
      .eq(currentSlide)
      .addClass("slick-current");
  }
);
// fancy box
$(document).ready(function () {
  $('[data-fancybox="gallery"]').fancybox();
});

$(document).ready(function () {
  // $(".minus").click(function () {
  //   var $input = $(this).parent().find("input");
  //   var count = parseInt($input.val()) - 1;
  //   count = count < 1 ? 1 : count;
  //   $input.val(count);
  //   $input.change();
  //   return false;
  // });
  // $(".plus").click(function () {
  //   var $input = $(this).parent().find("input");
  //   $input.val(parseInt($input.val()) + 1);
  //   $input.change();
  //   return false;
  // });

  function changeSlide(elm) {
    $(".slideshow-items").removeClass("active");
    $(".slideshow-items").eq(elm.index()).addClass("active");
    $(".slideshow-thumbnails").removeClass("active");
    $(".slideshow-thumbnails").eq(elm.index()).addClass("active");
  }
});

//=========== more checkout

// $(".moreless-button").click(function () {
//   $(".moretext").slideToggle();
//   if ($(".moreless-button").text() == "Read More") {
//     $(this).text("Read Less");
//   } else {
//     $(this).text("Read More");
//   }
// });

//=========== more revirw

$(".review-loadmore").slice(0, 5).show();
$("#review-more").click(function (e) {
  e.preventDefault();
  $(".review-loadmore:hidden").slice(0, 2).fadeIn("slow");

  if ($(".review-loadmore:hidden").length == 0) {
    $("#review-more").fadeOut("slow");
  }
});

//=========== home parallax vedio

// $('.video').parent().click(function() {
//     var video = $(this).children(".video").get(0);
//     if (video.paused) {
//         video.play();
//         video.muted = false;
//         $(this).children(".playpause").fadeOut();
//     } else {
//         video.pause();
//         video.muted = true;
//         $(this).children(".playpause").fadeIn();
//     }
// });

//=========== home video

window.addEventListener("load", videoScroll);
window.addEventListener("scroll", videoScroll);

function videoScroll() {
  if (document.querySelectorAll(".homepage-video video[loop]").length > 0) {
    var windowHeight = window.innerHeight,
      videoEl = document.querySelectorAll(".homepage-video video[loop]");

    for (var i = 0; i < videoEl.length; i++) {
      var thisVideoEl = videoEl[i],
        videoHeight = thisVideoEl.clientHeight,
        videoClientRect = thisVideoEl.getBoundingClientRect().top;

      if (
        videoClientRect <= windowHeight - videoHeight * 0.5 &&
        videoClientRect >= 0 - videoHeight * 0.5
      ) {
        thisVideoEl.play();
      } else {
        thisVideoEl.pause();
      }
    }
  }
}

//=========== recipe loadmore

// $(document).ready(function(){
//   $("#recipeLess").hide();
//   $(".recipe-item").slice(0,5).show();

//   $("#recipeMore").click(function(e){
//     e.preventDefault();

//     $(".recipe-item:hidden").slice(0,2).fadeIn("slow");

//     if($(".recipe-item:hidden").length == 0){
//       $("#recipeMore").hide();
//       $("#recipeLess").show();
//     }
//   });

//   $("#recipeLess").click(function(e){
//     $(".recipe-item").hide();
//     $(".recipe-item").slice(0,5).show();
//     $("#recipeMore").show();
//     $("#recipeLess").hide();
//   });
// });

//========== MENU open

$(".hamburger-icon").on("click", function (e) {
  $("body").toggleClass("active-bumberger");

  if ($(".new-mobile-menu").hasClass("open")) {
    $(".new-mobile-menu").css("transition-delay", "0.5s");
    $("html").toggleClass("nonoverflow");
    $("#overlay-menu").toggleClass("open");
  } else {
    $(".new-mobile-menu").css("transition-delay", "0s");
    $("html").toggleClass("nonoverflow");
    $("#overlay-menu").toggleClass("open");
  }
});


//

$(".mobile-items >li.mobile-dropdown > a").click(function () {
  $(this).parents("li").siblings().children("ul").slideUp(),
    $(this).parents("li").siblings().removeClass("open_child"),
    $(this).siblings("ul").slideToggle(),
    $(this).parent().toggleClass("open_child");
}),


//==========  menu img change

$(".bigmenu-main-link li a").hover(function () {
  var value = $(this).attr("data-src");

  $(".bigmenu-image-box img").attr("src", value);
});


// 

$(document).ready(function () {
  function initMobileSlider() {
    if ($(window).width() <= 800) {
      $(".bottom-usp").not(".slick-initialized").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        cssEase: "ease",
        speed: 1500,
        infinite: true,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [
 
          {
            breakpoint: 769,
            settings: { slidesToShow: 3, centerPadding: "0px" },
          },
          {
            breakpoint: 601,
            settings: { slidesToShow: 3, centerPadding: "0px" },
          },
        ],
      
        
      });
    } else {
      // Desktop view me slider ko remove karo
      $(".bottom-usp .slick-initialized").slick("unslick");
    }
  }

  // Initialize slider on page load
  initMobileSlider();

  // Window resize hone par slider ko check karo
  $(window).resize(function () {
    initMobileSlider();
  });
});


// 

$(document).ready(function () {
  $(".call-slider").slick({
    slidesToShow: 1,
    infinite: true,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 0,
    speed: 8000,
    cssEase: "linear",
    infinite: true,
    arrows: true,
    dots: false,
    pauseOnHover: false,
    prevArrow:
      '<button class="arrow-top slick-prev" aria-label="Previous slide"><i class="fa-solid fa-angle-left"></i> </button>',
    nextArrow:
      '<button class="arrow-top slick-next" aria-label="next slide"><i class="fa-solid fa-angle-right"></i></button>',
  });
  
  });
  


  