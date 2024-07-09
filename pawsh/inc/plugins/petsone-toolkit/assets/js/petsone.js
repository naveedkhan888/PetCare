
jQuery(document).ready(function($) {
    jQuery('.testimonial-carousel').owlCarousel({
        margin: 30,
        nav: true,
        loop: true,
        dots: false,
        autoplay: false,
        autoplayTimeout: 4500,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })
    jQuery('.services_section .owl-carousel').owlCarousel({
        margin: 30,
        nav: true,
        loop: true,
        dots: true,
        autoplay: false,
        autoplayTimeout: 4500,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            }
        }
    })
    jQuery('.store_section .owl-carousel').owlCarousel({
        margin: 30,
        nav: true,
        loop: true,
        dots: true,
        autoplay: false,
        autoplayTimeout: 4500,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            }
        }
    })
    jQuery(document).ready(function($){
        var owl = $('.store_section .owl-carousel');
        owl.owlCarousel({
            margin: 30,
            nav: true,
            loop: true,
            dots: true,
            autoplay: false,
            autoplayTimeout: 4500,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                }
        }
    });
    });
    jQuery('.testimonial-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        autoplayTimeout: 10000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    })
    jQuery('.testimonial-carousel1').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 10000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })
    jQuery('.testimonial-carousel-2').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        autoplayTimeout: 10000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 2
            }
        }
    })
    jQuery(document).ready(function($){
        var owl = $('.blog-carousel');
        owl.owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        with:350,
        responsive: {
            0: {
                dotsEach: 1,
                items: 1
            },
            767: {
                dotsEach: 1,
                items: 2,
                margin: 15,
            },
            1000: {
                dotsEach: 1,
                items: 3,
            }
        }
    });
    setTimeout(function(){owl.trigger('refresh.owl.carousel');},1000);
    // Function to trigger Owl Carousel refresh
    function refreshOwl() {
        owl.trigger('refresh.owl.carousel');
    }

    // Call refreshOwl when the carousel becomes visible or on window resize
    jQuery(window).on('resize scroll', function() {
        refreshOwl();
    });

    // Call refreshOwl when the element containing the carousel becomes visible
    jQuery('.blog-carousel').on('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', function() {
        refreshOwl();
    });
    });


    //Home 1 Gallery Section
jQuery(window).load(function($) {
    jQuery(".gallery-section img").click(function($) {
        var $lightbox = jQuery(this).closest('.tab-pane').find('.lightbox');
        $lightbox.fadeIn(300);
        jQuery($lightbox).append("<img src='" + jQuery(this).attr("src") + "' alt='" + jQuery(this).attr("alt") + "' />");
        jQuery(".filter").css("background-image", "url(" + jQuery(this).attr("src") + ")");
        jQuery("html").css("overflow", "hidden");
      if (jQuery(this).is(":last-child")) {
        jQuery(".arrowr").css("display", "none");
        jQuery(".arrowl").css("display", "block");
      } else if (jQuery(this).is(":first-child")) {
        jQuery(".arrowr").css("display", "block");
        jQuery(".arrowl").css("display", "none");
      } else {
        jQuery(".arrowr").css("display", "block");
        jQuery(".arrowl").css("display", "block");
      }
    });
    jQuery(".close").click(function($) {
      jQuery(".lightbox").fadeOut(300);
      jQuery("h1").remove();
      jQuery(".lightbox img").remove();
      jQuery("html").css("overflow", "auto");
    });
    jQuery(document).keyup(function(e) {
      if (e.keyCode == 27) {
        jQuery(".lightbox").fadeOut(300);
        jQuery(".lightbox img").remove();
        jQuery("html").css("overflow", "auto");
      }
    });
    jQuery(".arrowr").click(function($) {
      var imgSrc = jQuery(this).parent().find("img").attr("src");
      var search = jQuery(this).parent().parent().find(".gallery-images").find("img[src$='" + imgSrc + "']");
      var newImage = search.next().attr("src");
      jQuery(".lightbox img").attr("src", newImage);
      jQuery(".filter").css("background-image", "url(" + newImage + ")");
 
      if (!search.next().is(":last-child")) {
        jQuery(".arrowl").css("display", "block");
      }
      else {
        jQuery(".arrowr").css("display", "none");
      }
    });
    jQuery(".arrowl").click(function($) {
      var imgSrc = jQuery(this).parent().find("img").attr("src");
      var search = jQuery(this).parent().parent().find(".gallery-images").find("img[src$='" + imgSrc + "']");
      var newImage = search.prev().attr("src");
      jQuery(".lightbox img").attr("src", newImage);
      jQuery(".filter").css("background-image", "url(" + newImage + ")");
 
      if (!search.prev().is(":first-child")) {
        jQuery(".arrowr").css("display", "block");
      } else {
        jQuery(".arrowl").css("display", "none");
      }
    });
});

    jQuery('#search i').click(function(){
        jQuery('#search').submit();
    });
})



