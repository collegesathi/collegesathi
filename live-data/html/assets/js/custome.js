
// responsive nav bar js open slide

$(document).ready(function () {
    $('.menu').click(function () {
        $('.navigation').toggleClass('open');
    });
});
$(document).ready(function () {
    $('.menu').click(function () {
        $(this).toggleClass('open');
    });
});
$(document).ready(function (){
    $('.close-toast').click(function(){
        $('.toast').toggleClass('toast_hide')
    })
});

// navigation open backdrop click close navigation 
$(document).ready(function () {
    $(".menu").click(function () {
        $(".overley_backdrop").toggleClass("overlay");
        
    });

});
$(".menu").click(function () {
    $('body').toggleClass("scroll_stop");

});

$(window).scroll(function(){
    var sticky = $('.placement_section'),
        scroll = $(window).scrollTop();
  
    if (scroll >= 450) sticky.addClass('fixed');
    else sticky.removeClass('fixed');
  });

  $(window).scroll(function(){
    var sticky = $('header'),
        scroll = $(window).scrollTop();
  
    if (scroll >= 100) sticky.addClass('fixed');
    else sticky.removeClass('fixed');
  });



  


$('.search-button').click(function () {
    $(this).toggleClass('open');
    $('.search-dropdown').toggleClass('open');
});

$('.close-btn').click(function () {
    $('nav').removeClass('open');
});
$('.search-close-btn').click(function () {
    $('.search-dropdown').removeClass('open');
    $('.search-button').removeClass('open');
});

// 

// 

$('.search_box').click(function () {
    $('.search-open').addClass('open');
});

$('.search-close').click(function () {
    $('.search-open').removeClass('open');
});



$(document).ready(function(){

  });
  $('.accordion-collapse').on('shown.bs.collapse', function () {
    $(this).parent().addClass('panel-open');
  });

  $('.accordion-collapse').on('hidden.bs.collapse', function () {
    $(this).parent().removeClass('panel-open');
  });


  $(document).ready(function () {
    $(".colss-btn").on("click", function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this)
                .siblings(".mob-tab-view")
                .slideUp(200);
        } else {
            $(this)
            $(".colss-btn").removeClass("active");
            $(this).addClass("active");
            $(".mob-tab-view").slideUp(300);
            $(this)
                .siblings(".mob-tab-view")
                .slideDown(300);
        }
    });
});


// Slider js

$('.universities_carousel').owlCarousel({
    loop: true,
    margin: 32,
    responsiveClass: true,
    center:true,
    autoWidth:true,
    autoplay: true,
         autoplaySpeed: 1500,
         autoplayTimeout: 2000,

    nav: true,
    responsive: {
        0: {
            items: 1,
            nav: false,
            margin:5,
            autoWidth:false,
        },
        600: {
            items: 2,
            nav: false,
        },
        1000: {
            items: 3,
        }
    }

})


$('.degrees').owlCarousel({
    loop: true,
    margin: 1,
    responsiveClass: true,
    nav: true,
    autoplay: true,
         autoplaySpeed: 1500,
         autoplayTimeout: 3000,

    responsive: {
        0: {
            items: 1,
            nav: false
        },
        600: {
            items: 2,
            nav: false
        },
        1000: {
            items: 4,
            loop: true,
        }
    }

})

$('.universities_programs').owlCarousel({
    loop: true,
    margin: 30,
    responsiveClass: true,
    autoplay: true,
         autoplaySpeed: 1500,
         autoplayTimeout: 2000,
    nav: true,
    responsive: {
        0: {
            items: 1,
            nav: false
        },
        600: {
            items: 2,
            nav: false
        },
        1000: {
            items: 2,
        }
    }

})
$('.blog_slider').owlCarousel({
    loop: true,
    margin: 30,
    responsiveClass: true,
    autoplay: true,
         autoplaySpeed: 1500,
         autoplayTimeout: 2000,
    nav: true,
    responsive: {
        0: {
            items: 1,
            nav: false
        },
        600: {
            items: 2,
            nav: false
        },
        1000: {
            items: 4,
        }
    }

})

$('.trending_slider').owlCarousel({
    loop: true,
    margin: 30,
    responsiveClass: true,
    autoplay: true,
         autoplaySpeed: 1500,
         autoplayTimeout: 2000,
    nav: true,
    responsive: {
        0: {
            items: 1,
            nav: false
        },
        600: {
            items: 2,
            nav: false
        },
        768: {
            items: 2,
            nav: false
        },
        912: {
            items: 1,
            nav: false
        },
        1000: {
            items: 2,
        }
    }

})
$('.experts_slider').owlCarousel({
    loop: true,
    margin: 40,
    responsiveClass: true,
    autoplay: true,
         autoplaySpeed: 1500,
         autoplayTimeout: 2000,
    nav: true,
    responsive: {
        0: {
            items: 1,
            nav: false,
            mouseDrag: true,
            pullDrag: true,
            touchDrag: true,
        },
        600: {
            items: 2,
            nav: false
        },
        1000: {
            items: 4,
            loop: false,
            mouseDrag: false,
            pullDrag: false,
            touchDrag: false,
        }
    }

})

// test

$(document).ready(function () {
    $('.testimonials_slider').owlCarousel({
        margin: 30,
        center: true,
        loop: true,
        autoplay: true,
         autoplaySpeed: 1500,
         autoplayTimeout: 2000,
        Speed:800,
        nav: true,
        responsive: {
            0: {
                items: 1,
                nav: false,
            },
            600: {
                items: 1,
                nav: false,
            },
            991: {
                items: 1,
            },
            1200: {
                items: 3,
                nav: true,
            },
        }


    })
})

$('.counter_slider').owlCarousel({
    loop: true,
    margin: 10,
    responsiveClass: true,
    autoplay: true,
         autoplaySpeed: 1500,
         autoplayTimeout: 2000,
    nav: true,
    responsive: {
        0: {
            items: 1,
            nav: false,
            mouseDrag: true,
            pullDrag: true,
            touchDrag: true,
        },
        600: {
            items: 3,
            nav: false
        },
        1000: {
            items: 5,
            loop: false,
            mouseDrag: false,
            pullDrag: false,
            touchDrag: false,
        }
    }

});
// $('.approved_universities').owlCarousel({
//     loop: true,
//     margin: 10,
//     responsiveClass: true,
//     autoplay: true,
//          autoplaySpeed: 1500,
//          autoplayTimeout: 3000,
//     nav: false,
//     dots:false,
//     responsive: {
//         0: {
//             items: 1,
//         },
//         600: {
//             items: 1,

//         },
//         1000: {
//             items: 1,
//         }
//     }

// })
    $(document).ready(function() {
        var el = $('.approved_universities');
        
        var carousel;
        var carouselOptions = {
          margin: 20,
          nav: false,
          dots: false,
          slideBy: 'page',
          loop:false,
          autoplay: false,
          responsive: {
            0: {
              items: 2,
              rows: 2 //custom option not used by Owl Carousel, but used by the algorithm below
            },
            768: {
              items: 3,
              rows: 2 //custom option not used by Owl Carousel, but used by the algorithm below
            },
            991: {
              items: 4,
              rows: 2 //custom option not used by Owl Carousel, but used by the algorithm below
            }
          }
        };
      
        //Taken from Owl Carousel so we calculate width the same way
        var viewport = function() {
          var width;
          if (carouselOptions.responsiveBaseElement && carouselOptions.responsiveBaseElement !== window) {
            width = $(carouselOptions.responsiveBaseElement).width();
          } else if (window.innerWidth) {
            width = window.innerWidth;
          } else if (document.documentElement && document.documentElement.clientWidth) {
            width = document.documentElement.clientWidth;
          } else {
            console.warn('Can not detect viewport width.');
          }
          return width;
        };
      
        var severalRows = false;
        var orderedBreakpoints = [];
        for (var breakpoint in carouselOptions.responsive) {
          if (carouselOptions.responsive[breakpoint].rows > 1) {
            severalRows = true;
          }
          orderedBreakpoints.push(parseInt(breakpoint));
        }
        
        //Custom logic is active if carousel is set up to have more than one row for some given window width
        if (severalRows) {
          orderedBreakpoints.sort(function (a, b) {
            return b - a;
          });
          var slides = el.find('[data-slide-index]');
          var slidesNb = slides.length;
          if (slidesNb > 0) {
            var rowsNb;
            var previousRowsNb = undefined;
            var colsNb;
            var previousColsNb = undefined;
      
            //Calculates number of rows and cols based on current window width
            var updateRowsColsNb = function () {
              var width =  viewport();
              for (var i = 0; i < orderedBreakpoints.length; i++) {
                var breakpoint = orderedBreakpoints[i];
                if (width >= breakpoint || i == (orderedBreakpoints.length - 1)) {
                  var breakpointSettings = carouselOptions.responsive['' + breakpoint];
                  rowsNb = breakpointSettings.rows;
                  colsNb = breakpointSettings.items;
                  break;
                }
              }
            };
      
            var updateCarousel = function () {
              updateRowsColsNb();
      
              //Carousel is recalculated if and only if a change in number of columns/rows is requested
              if (rowsNb != previousRowsNb || colsNb != previousColsNb) {
                var reInit = false;
                if (carousel) {
                  //Destroy existing carousel if any, and set html markup back to its initial state
                  carousel.trigger('destroy.owl.carousel');
                  carousel = undefined;
                  slides = el.find('[data-slide-index]').detach().appendTo(el);
                  el.find('.fake-col-wrapper').remove();
                  reInit = true;
                }
      
      
                //This is the only real 'smart' part of the algorithm
      
                //First calculate the number of needed columns for the whole carousel
                var perPage = rowsNb * colsNb;
                var pageIndex = Math.floor(slidesNb / perPage);
                var fakeColsNb = pageIndex * colsNb + (slidesNb >= (pageIndex * perPage + colsNb) ? colsNb : (slidesNb % colsNb));
      
                //Then populate with needed html markup
                var count = 0;
                for (var i = 0; i < fakeColsNb; i++) {
                  //For each column, create a new wrapper div
                  var fakeCol = $('<div class="fake-col-wrapper"></div>').appendTo(el);
                  for (var j = 0; j < rowsNb; j++) {
                    //For each row in said column, calculate which slide should be present
                    var index = Math.floor(count / perPage) * perPage + (i % colsNb) + j * colsNb;
                    if (index < slidesNb) {
                      //If said slide exists, move it under wrapper div
                      slides.filter('[data-slide-index=' + index + ']').detach().appendTo(fakeCol);
                    }
                    count++;
                  }
                }
                //end of 'smart' part
      
                previousRowsNb = rowsNb;
                previousColsNb = colsNb;
      
                if (reInit) {
                  //re-init carousel with new markup
                  carousel = el.owlCarousel(carouselOptions);
                }
              }
            };
      
            //Trigger possible update when window size changes
            $(window).on('resize', updateCarousel);
      
            //We need to execute the algorithm once before first init in any case
            updateCarousel();
          }
        }
      
        //init
        carousel = el.owlCarousel(carouselOptions);
      });

// counter js

const counters = document.querySelectorAll('.counter');
const speed = 200;

counters.forEach(counter => {
    const animate = () => {
        const value = +counter.getAttribute('data-target');
        const data = +counter.innerText;

        const time = value / speed;
        if (data < value) {
            counter.innerText = Math.ceil(data + time);
            setTimeout(animate, 1);
        } else {
            counter.innerText = value;
        }

    }

    animate();
});


// range slider

const range = document.querySelectorAll(".range-slider span input");
progress = document.querySelector(".range-slider .progress");
let gap = 0.1;
const inputValue = document.querySelectorAll(".numberVal input");

range.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minRange = parseInt(range[0].value);
    let maxRange = parseInt(range[1].value);

    if (maxRange - minRange < gap) {
      if (e.target.className === "range-min") {
        range[0].value = maxRange - gap;
      } else {
        range[1].value = minRange + gap;
      }
    } else {
      progress.style.left = (minRange / range[0].max) * 100 + "%";
      progress.style.right = 100 - (maxRange / range[1].max) * 100 + "%";
      inputValue[0].value = minRange;
      inputValue[1].value = maxRange;
    }
  });
});





