//

$(".sellers-slider").slick({
  slidesToShow: 4,
  infinite: false,
  slidesToScroll: 1,
  autoplay: true,
  cssEase: "ease",
  speed: 1000,
  autoplaySpeed: 1500,
  infinite: true,
  arrows: true,
  prevArrow:
    '<button class="arrow pre-arrow">  <i class="fa-solid fa-arrow-left"></i> </button>',
  nextArrow:
    '<button class="arrow next-arrow"> <i class="fa-solid fa-arrow-right"></i> </button>',
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
      },
    },
    {
      breakpoint: 850,
      settings: {
        slidesToShow: 2,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
      },
    },
  ],
});

$(".image-sliders").slick({
  slidesToShow: 1,
  infinite: false,
  slidesToScroll: 1,
  autoplay: true,
  cssEase: "ease",
  speed: 1000,
  autoplaySpeed: 1500,
  infinite: true,
  arrows: false,
  dots: true,
  prevArrow:
    '<button class="arrow pre-arrow">  <i class="fa-solid fa-arrow-left"></i> </button>',
  nextArrow:
    '<button class="arrow next-arrow"> <i class="fa-solid fa-arrow-right"></i> </button>',
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
      },
    },
    {
      breakpoint: 850,
      settings: {
        slidesToShow: 1,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
      },
    },
  ],
});

$(".gift-slider-col").slick({
  slidesToShow: 2,
  infinite: false,
  slidesToScroll: 1,
  autoplay: true,
  cssEase: "ease",
  speed: 1000,
  autoplaySpeed: 1500,
  centerMode: true,
  infinite: true,
  centerPadding: "100px",
  autoplaySpeed: 1500,
  arrows: false,

  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
      },
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 1,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
      },
    },
  ],
});

//
//

setInterval(function time() {
  var d = new Date();
  var days = 7 - d.getDay();
  var hours = 24 - d.getHours();
  var min = 60 - d.getMinutes();
  if ((min + "").length == 1) {
    min = "0" + min;
  }
  var sec = 60 - d.getSeconds();
  if ((sec + "").length == 1) {
    sec = "0" + sec;
  }
  jQuery("#week-countdown p").html(
    '<div class="text days-text"><span class="days">' +
      days +
      "</span> Days </div>" +
      '<div class="text"><span class="hours">' +
      hours +
      "</span> Hours </div>" +
      '<div class="text"><span class="minutes">' +
      min +
      "</span> Minutes </div>" +
      '<div class="text"><span class="seconds">' +
      sec +
      "</span> Seconds </div>"
  );
}, 1000);

//
// mobile menu

$(document).ready(function () {
  $(".bumberger-menu").on("click", function () {
    $("body").toggleClass("mobile-open");
  });

  $(".mobile-overlay, .logo-wrapper").click(function () {
    $("body").removeClass("mobile-open");
  });
});

//========== Sticky menu

$(window).on("scroll", function () {
  var heightFromTop = $(this).scrollTop();
  if (heightFromTop) {
    $(".header-wrapper").addClass("sticky-header");
  } else {
    $(".header-wrapper").removeClass("sticky-header");
  }
});

$(document).ready(function () {
  $(".blog-items").slice(0, 6).show();
  $("#load-more").click(function (e) {
    e.preventDefault();
    $(".blog-items:hidden").slice(0, 3).fadeIn("slow");

    if ($(".blog-items:hidden").length == 0) {
      $("#load-more").fadeOut("slow");
    }
  });
});

// $(document).ready(function () {
//   $(".review-area").slice(0, 2).show();
//   $("#review-more").on("click", function (e) {
//     e.preventDefault();
//     $(".review-area:hidden").slice(0, 1).slideDown();
//     if ($(".review-area:hidden").length == 0) {
//       $("#review-more").text("No Content").addClass("noContent");
//     }
//   });

//   // Load More
//   $(".count-product").slice(0, 6).show();
//   if ($(".count-product").length <= 6) {
//     $(".loadmore").hide();
//   }
//   $(".loadmore").click(function (e) {
//     e.preventDefault();
//     $(".count-product:hidden").slice(0, 6).fadeIn("slow");

//     if ($(".count-product:hidden").length == 0) {
//       $(".loadmore").fadeOut("slow");
//     }
//   });
// });

//------------------price range

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

//------------

// $(document).ready(function () {
//   $(".offer-col").slice(0, 6).show();
//   $("#seeMore").click(function (e) {
//     e.preventDefault();
//     $(".offer-col:hidden").slice(0, 3).fadeIn("slow");

//     if ($(".offer-col:hidden").length == 0) {
//       $("#seeMore").fadeOut("slow");
//     }
//   });
// });

// Login Popup
let digitValidate = function (ele) {
  console.log(ele.value);
  ele.value = ele.value.replace(/[^0-9]/g, "");
};

let tabChange = function (val) {
  let ele = document.querySelectorAll(".popup-otp");
  if (ele[val - 1].value != "") {
    ele[val].focus();
  } else if (ele[val - 1].value == "") {
    ele[val - 2].focus();
  }
};

// wow animation

new WOW().init();

// price range
// const rangeInput = document.querySelectorAll(".range-input input"),
//   priceInput = document.querySelectorAll(".price-input input"),
//   range = document.querySelector(".slider .progress");
// let priceGap = 1000;

// priceInput.forEach((input) => {
//   input.addEventListener("input", (e) => {
//     let minPrice = parseInt(priceInput[0].value),
//       maxPrice = parseInt(priceInput[1].value);

//     if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
//       if (e.target.className === "input-min") {
//         rangeInput[0].value = minPrice;
//         range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
//       } else {
//         rangeInput[1].value = maxPrice;
//         range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
//       }
//     }
//   });
// });

// rangeInput.forEach((input) => {
//   input.addEventListener("input", (e) => {
//     let minVal = parseInt(rangeInput[0].value),
//       maxVal = parseInt(rangeInput[1].value);

//     if (maxVal - minVal < priceGap) {
//       if (e.target.className === "range-min") {
//         rangeInput[0].value = maxVal - priceGap;
//       } else {
//         rangeInput[1].value = minVal + priceGap;
//       }
//     } else {
//       priceInput[0].value = minVal;
//       priceInput[1].value = maxVal;
//       range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
//       range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
//     }
//   });
// });

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

// quntity Html Js

$(document).ready(function () {
  $("#filters_click").on("click", function () {
    $(".listing-sidebar  ").toggleClass("filter-open");
  });
});

/* Mobile toggle  */

$(".enq-model").click(function () {
  $("body").toggleClass("filter-open");
});

$(".close-icon").click(function () {
  $("body").removeClass("filter-open");
});

$(".moreless-button").click(function () {
  $(".moretext").slideToggle();
  if ($(".moreless-button").text() == "Read more") {
    $(this).text("Read less");
  } else {
    $(this).text("Read more");
  }
});

// product slider

// Main/Product image slider for product page

$("#detail .main-img-slider").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  infinite: true,
  arrows: true,
  fade: true,
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
  slidesToShow: 5,
  slidesToScroll: 1,
  infinite: true,
  centerPadding: "0px",
  asNavFor: ".main-img-slider",
  dots: false,
  arrows: true,
  centerMode: false,
  draggable: true,
  speed: 200,
  focusOnSelect: true,
  prevArrow:
    '<button class="arrow slick-prev<i class="fa-solid fa-chevron-up"></i> </button>',
  nextArrow:
    '<button class="arrow slick-next"><i class="fa-solid fa-chevron-up"></i> </button>',
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

$(document).ready(function () {
  $('[data-fancybox="gallery"]').fancybox();
});

const bars = document.querySelectorAll(".progress-bar__outter-line");
const COUNT_STARS = 12;

bars.forEach((el) => {
  let rating = el.dataset.rating;

  let percent = (100 * rating) / COUNT_STARS;
  console.log(percent);
  el.querySelector(".progress-bar__inner-line").style.width = `${percent}%`;
});

ScrollReveal().reveal(".headline");
